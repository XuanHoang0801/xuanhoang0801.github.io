<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\nsx;
use App\Models\card;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\order;
use App\Models\Notify;
use App\Models\Comment;
use App\Models\product;

use App\Models\producer;
use App\Models\Wishlist;

use App\Models\Categories;
use Illuminate\Support\Str;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use App\Models\Album;
use App\Models\Ratting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Builder;

class CustomerController extends Controller
{
    public function register(Request $request)
    {
        $qty = Cart::count();
        $url = $request->url();
        if(Auth::check()){

            $amount = Wishlist::where('user_id',Auth::user()->id)->get();
            return view('register',compact('qty','amount','url'));
        }
        else{
            
            return view('register',compact('qty','url'));
        }

    }
    public function postRegister(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255','unique:users,name'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
           
        ],[
            'name.required'=> ' Tên đăng nhập không được để trống!',
            'name.string'=> 'Chỉ được nhập ký tự!',
            'email.required'=> 'Email của bạn không được để trống!',
            'email.email'=> 'Email không đúng định dạng',
            'email.unique'=>'Email này đã tồn tại!',
            'name.unique'=>'Tên đăng nhập này đã tồn tại!',
            'password.required'=> 'Bạn chưa nhập mật khẩu!',
            'password.min'=>'Mật khẩu của bạn phải từ 6 ký tự trở lên!',
            'password.confirmed' => 'Mật khẩu không trùng khớp!',
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->fullname = $request->fullname;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->address=$request->address;
        $user->phone = $request->phone;
        if (!($request->hasFile('file'))) {
            $user->image='img.png';
        }
        else{
            $file= $request->file('file');
            $name = $file->getClientOriginalName(); //Lấy tên file
            $user->image=$name;
            $upload = $file->move('assets/img/',$name); //upload file vào thư mục     
        }
        $user->level=0;
        $user->save();
        return redirect('/dang-nhap');
    }
    public function login(Request $request)
    {
        $qty = Cart::count();
        $url = $request->url();
        if(Auth::check()){
            Auth::logout();
            return redirect('/dang-nhap');
        }
        else{
            return view('login',compact('qty','url'));
        }
    }
    public function postLogin(Request $request)
    {
        $email=$request->email;
        $password=$request->password;
        if (Auth::attempt(['email'=>$email,'password'=>$password])) {
            return redirect('/');
        }
        else
        {
            return redirect('/dang-nhap')->with('loi', 'Tài khoản hoặc mật khẩu không chính xác!');
        }
    }

    public function Logout(Request $request)
    {
        Auth::logout();
        return redirect('/dang-nhap');
    }

    public function profile(Request $request)
    {
        $qty = Cart::count();
        $url = $request->url();
        $amount = Wishlist::where('user_id',Auth::user()->id)->get();
        $notify = Notify::where('user_id', Auth::user()->id)->where('style',1)->orderBy('id','DESC')->get();
        $amount_notify = Notify::where('user_id', Auth::user()->id)->where('status',0)->where('style',1)->get();
        return view('profile',compact('qty','amount','url','notify','amount_notify'));
        
    }

    public function changePassword(Request $request)
    {
        $qty  = Cart::count();
        $url = $request->url();
        $amount = Wishlist::where('user_id',Auth::user()->id)->get();
        $notify = Notify::where('user_id', Auth::user()->id)->where('style',1)->orderBy('id','DESC')->get();
        $amount_notify = Notify::where('user_id', Auth::user()->id)->where('status',0)->where('style',1)->get();
        return view('change_password',compact('qty','amount','url','notify','amount_notify'));
    }
    public function changePasswordPost(Request $request)
    {
        $this->validate($request,[
            'newpassword'=>'min:6',
            'repassword'=> 'same:newpassword'
        ],[
           
            'newpassword.min'=>'Vui lòng nhập mật khẩu từ 6 ký tự!',
            'repassword.same'=>'Mật khẩu không trùng khớp!',
        ]);
        $password = $request->password;
        $check = Auth::user()->password;
        if (!(Hash::check($password,$check)) ) {
            return back()->withErrors(['password'=>'Mật khẩu không chính xác!']);
        }
        else{
            $user = Auth::user()->id;
            $user  = User::find($user);
            $user->password = Hash::make($request->newpassword);
            $user->save();
            return redirect('/doi-mat-khau')->with(['success' =>'Đổi mật khẩu thành công!']);
        }
    }

    public function emailPassword(Request $request)
    {
        $qty  = Cart::count();
        $url = $request->url();
        return view('email',compact('qty','url'));
    }
    public function sendMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);

        Mail::send('email.forgot', ['token' => $token,'email'=>$request->email], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('status', 'Kiểm tra email của bạn và ấn vào link để tiếp tục!');
    }
    
    public function resetPassword(Request $request)
    {
       $qty  = Cart::count();
       $url = $request->url();
       $token = $request->route()->parameter('token');
       $email = $request->email;
        return view('reset',compact('qty','url','token','email'));
    }

    public function updateUser(UserRequest $request)
    {
        $fullname = $request->fullname;
        $gender = $request->gender;
        $phone = $request->phone;
        $address = $request->address;
        $user = User::find(Auth::user()->id);
        $user->fullname = $fullname;
        $user->gender = $gender;
        $user->phone = $phone;
        $user->address  = $address;
        if(!($request->hasFile('file'))){

        }
        else{
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $upload = $file->move('assets/img/',$name); //upload file vào thư mục     
            $user->image = $name;
        }
        $user->save();
        return redirect('/thong-tin')->with(['success' => 'Cập nhật thông tin thành công!']);


    }

    public function index(Request $request)
    {
       $product= product::with('categories','nsx')->orderBy('id','DESC')->get();
       $qty  = Cart::count();
       $url = $request->url();
       if(!(Auth::user())){
           return view('index',compact('product','qty','url'));
        }
        else{
            $amount = Wishlist::where('user_id',Auth::user()->id)->get();
            $notify = Notify::where('user_id', Auth::user()->id)->where('style',1)->orderBy('id','DESC')->get();
            $amount_notify = Notify::where('user_id', Auth::user()->id)->where('status',0)->where('style',1)->get();
           return view('index',compact('product','qty','amount','url','notify','amount_notify'));
       }
    }

    public function list(Request $request)
    {
        $fillter = Categories::all();
        $producer = nsx::all();
        $url = $request->url();
        $phone= product::with('categories','nsx')->where('categories_id',1)->orderBy('id','DESC')->get();
        $laptop= product::with('categories','nsx')->where('categories_id',3)->get();
        $qty=Cart::count();
        if(!(Auth::user())){
            return view('product',compact('fillter','phone','laptop','qty','producer','url'));
        }
        else{
            $amount = Wishlist::where('user_id',Auth::user()->id)->get();
            $notify = Notify::where('user_id', Auth::user()->id)->where('style',1)->orderBy('id','DESC')->get();
            $amount_notify = Notify::where('user_id', Auth::user()->id)->where('status',0)->where('style',1)->get();
            return view('product',compact('fillter','phone','laptop','qty','amount','producer','url','notify','amount_notify'));
        }
    }

    public function detail(Request $request,$id)
    {
        $view = product::find($id);
        $view->view++;
        $view->save();
        $product= product::with('categories','nsx')->find($id);
        $url = $request->url();
        $comment= Comment::with('users')->where('product_id',$id)->get();
        $like = Like::where('product_id',$id)->get();
        $qty = Cart::count();
        $album = Album::where('product_id',$id)->get();

        if(!(Auth::user())){
            return view('detail', compact('product','comment','qty','like','url','album'));
        }
        else{
            $checklike = Like::where('product_id',$id)->where('user_id', Auth::user()->id)->get();
            $rat = Ratting::where('product_id',$id)->where('user_id', Auth::user()->id)->get();
            $amount = Wishlist::where('user_id',Auth::user()->id)->get();
            $notify = Notify::where('user_id', Auth::user()->id)->where('style',1)->orderBy('id','DESC')->get();
            $amount_notify = Notify::where('user_id', Auth::user()->id)->where('status',0)->where('style',1)->get();
            return view('detail', compact('product','comment','qty','amount','like','checklike','url','notify','amount_notify','rat','album'));
        }
    }
    public function card(Request $request,$id)
    {
        $check=card::where('product_id', $id)->where('user_id',$request->user()->id)->get();
        if (!($check->isEmpty())) {
            return redirect('/san-pham/'.$id)->with(['loi' =>'Sản phẩm đã tồn tại trong giỏ hàng!']);
        }
        else{
            $card= new card();
            $card->product_id=$id;
            $card->user_id=$request->user()->id;
            $card->amount=$request->amount;
            $card->save();
            return redirect('/san-pham/'.$id)->with(['thongbao' =>'Đã thêm vào giỏ hàng!']); 
        }
    }

    public function DatHang(Request $request)
    {
        $check = $request->check;
        $url = $request->url();
        if(!($check)){
            return redirect('/gio-hang')->with(['loi'=>'Không thể đặt hàng! Vui lòng chọn sản phẩm!']);
        }
        else{
            foreach($check as $item){
                $cart[] =Cart::get($item);
            }
            $qty = Cart::count();
            $amount = Wishlist::where('user_id',Auth::user()->id)->get();
            $notify = Notify::where('user_id', Auth::user()->id)->where('style',1)->orderBy('id','DESC')->get();
            $amount_notify = Notify::where('user_id', Auth::user()->id)->where('status',0)->where('style',1)->get();
            return view('order',compact('cart','qty','amount','url','notify','amount_notify'));
        }
    }
    
    public function DonHang()
    {
        $user=Auth::user()->id;
        $qty = Cart::count();
        $order=order::with('products','statuses','users','cards')->where('user_id',$user)->get();
        $amount = Wishlist::where('user_id',Auth::user()->id)->get();
        return view('bill',compact('qty','order','amount'));
    }

    public function DaGiao(Request $request)
    {
        $user=Auth::user()->id;
        $qty = Cart::count();
        $order=order::with('products','statuses','users','cards')->where(['user_id'=>$user,'status_id'=>4])->get();
        $notify = Notify::where('user_id', Auth::user()->id)->where('style',1)->orderBy('id','DESC')->get();
        $amount_notify = Notify::where('user_id', Auth::user()->id)->where('status',0)->where('style',1)->get();
        $url = $request->url();
        $amount = Wishlist::where('user_id',Auth::user()->id)->get();
        return view('delivered',compact('qty','order','amount','amount_notify','notify','url'));
    }

    public function detaiBill(Request $request, $id)
    {
        $user=Auth::user()->id;
        $qty = Cart::count();
        $order=order::with('products','statuses','users','cards')->find($id);
        $notify = Notify::where('user_id', Auth::user()->id)->where('style',1)->orderBy('id','DESC')->get();
        $amount_notify = Notify::where('user_id', Auth::user()->id)->where('status',0)->where('style',1)->get();
        $url = $request->url();
        $amount = Wishlist::where('user_id',Auth::user()->id)->get();
        return view('bill_detail',compact('qty','order','amount','amount_notify','notify','url'));
    }

    public function listpost( Request $request)
    {
        $post = Post::orderBy('id','DESC')->get();
        $qty = Cart::count();
        $url = $request->url();
        if(!(Auth::user())){
            return view('post',compact('post','qty','url'));
        }
        else{
            $amount = Wishlist::where('user_id',Auth::user()->id)->get();
            $notify = Notify::where('user_id', Auth::user()->id)->where('style',1)->orderBy('id','DESC')->get();
            $amount_notify = Notify::where('user_id', Auth::user()->id)->where('status',0)->where('style',1)->get();
            return view('post',compact('post','qty','amount','url','notify','amount_notify'));
        }
    }

    public function detailpost(Request $request,$id)
    {
        $view = post::find($id);
        $view->view++;
        $view->save();
        $url = $request->url();
        $post = Post::with('users')->find($id);
        $qty = Cart::count();
        $comment = Comment::with('users')->where('post_id',$id)->get();
        $like = Like::where('post_id',$id)->get();
        if(!(Auth::user())){
            return view('post-detail',compact('post','qty','comment','like','url'));
        }
        else{
            $checklike = Like::where('post_id',$id)->where('user_id', Auth::user()->id)->get();
            $amount = Wishlist::where('user_id',Auth::user()->id)->get();
            $notify = Notify::where('user_id', Auth::user()->id)->where('style',1)->orderBy('id','DESC')->get();
            $amount_notify = Notify::where('user_id', Auth::user()->id)->where('status',0)->where('style',1)->get();
            return view('post-detail',compact('post','qty','comment','amount','like','checklike','url','notify','amount_notify'));
        }
    }

    public function gioithieu(Request $request)
    {
        $qty = Cart::count();
        $url = $request->url();
        $post = Post::with('categories','users')->find(3);
        if(!(Auth::user())){
            return view('gioithieu',compact('post','qty','url'));
        }
        else{
            $amount = Wishlist::where('user_id',Auth::user()->id)->get();
            $notify = Notify::where('user_id', Auth::user()->id)->where('style',1)->orderBy('id','DESC')->get();
            $amount_notify = Notify::where('user_id', Auth::user()->id)->where('status',0)->where('style',1)->get();
            return view('gioithieu',compact('post','qty','amount','url','notify','amount_notify'));
        }
    }

    public function commentpost(Request $request)
    {
        $comment = new Comment();
        $comment->post_id=$request->id;
        $comment->name=$request->user()->name;
        $comment->body=$request->body;
        $comment->save();
        $body = $request->body;
        echo '
        <div class="form-group div-comment">
            <p class="name text-primary">'.$request->user()->name.'</p>
            <span class="blockquote-footer">Vừa xong</span>
            <p class="content ml-3 text-muted">'.$body.'</p>
            <span class="text-danger delete" id="" style="cursor: pointer" data-id="'.$comment->id.'">Xóa</span>
            <div style=" width:100%;height: .1px; background:rgb(246, 243, 243)"></div>
        </div>
        ';
    }
    public function destroy($id)
    {
        Comment::find($id)->delete();
    }

    public function search(Request $request)
    {
        $key  = $request->key;
        $url =  $request->url();
        $qty = Cart::count();
        $product  = product::with('categories','nsx')->where('name','like', '%'.$key.'%')->get();
        if(!(Auth::user())){
            return view('search',compact('key','qty','product','url'));
        }
        else{
            $amount = Wishlist::where('user_id',Auth::user()->id)->get();
            $notify = Notify::where('user_id', Auth::user()->id)->where('style',1)->orderBy('id','DESC')->get();
            $amount_notify = Notify::where('user_id', Auth::user()->id)->where('status',0)->where('style',1)->get();
            return view('search',compact('key','qty','product','amount','url','notify','amount_notify'));
        }
    }
}

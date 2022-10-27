<?php

namespace App\Http\Controllers;

use App\Models\nsx;
use App\Models\card;
use App\Models\Post;
use App\Models\User;
use App\Models\order;
use App\Models\Comment;
use App\Models\product;
use App\Models\producer;
use App\Models\Wishlist;

use App\Models\Categories;

use function Ramsey\Uuid\v1;

use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Builder;

class CustomerController extends Controller
{
    public function register()
    {
        $qty = Cart::count();

        return view('register',compact('qty'));

    }
    public function postRegister(Request $request)
    {
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->level=0;
        $user->save();
        return redirect('/dang-nhap');
    }
    public function login()
    {
        $qty = Cart::count();
        return view('login',compact('qty'));
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
    public function index()
    {
       $product= product::with('categories','nsx')->get();
       $qty  = Cart::count();
       if(!(Auth::user())){
           return view('index',compact('product','qty'));
       }
       else{
           $amount = Wishlist::where('user_id',Auth::user()->id)->get();
           return view('index',compact('product','qty','amount'));
       }
    }

    public function list()
    {
        $fillter = Categories::all();
        $producer = nsx::all();
        $phone= product::with('categories','nsx')->where('categories_id',1)->get();
        $laptop= product::with('categories','nsx')->where('categories_id',3)->get();
        $qty=Cart::count();
        if(!(Auth::user())){
            return view('product',compact('fillter','phone','laptop','qty','producer'));
        }
        else{
            $amount = Wishlist::where('user_id',Auth::user()->id)->get();
            return view('product',compact('fillter','phone','laptop','qty','amount','producer'));
        }
    }

    public function detail($id)
    {
        $product= product::with('categories','nsx')->find($id);
        $comment= Comment::where('product_id',$id)->get();
        $qty=Cart::count();
        if(!(Auth::user())){
            return view('detail', compact('product','comment','qty'));
        }
        else{
            $amount = Wishlist::where('user_id',Auth::user()->id)->get();
            return view('detail', compact('product','comment','qty','amount'));
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
        // $user=Auth::user()->id;
        $check = $request->check;
        if(!($check)){
            return redirect('/cart')->with(['loi'=>'Không thể đặt hàng! Vui lòng chọn sản phẩm!']);
        }
        else{
            foreach($check as $item){
                $cart[] =Cart::get($item);
            }
            $qty = Cart::count();
            $amount = Wishlist::where('user_id',Auth::user()->id)->get();
            return view('order',compact('cart','qty','amount'));
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

    public function listpost()
    {
        $post = Post::all();
        $qty = Cart::count();
        if(!(Auth::user())){
            return view('post',compact('post','qty'));
        }
        else{
            $amount = Wishlist::where('user_id',Auth::user()->id)->get();
            return view('post',compact('post','qty','amount'));

        }

    }

    public function detailpost($id)
    {
        $post = Post::with('users')->find($id);
        $qty = Cart::count();
        $comment = Comment::where('post_id',$id)->get();
        if(!(Auth::user())){
            return view('post-detail',compact('post','qty','comment'));
        }
        else{
            $amount = Wishlist::where('user_id',Auth::user()->id)->get();
            return view('post-detail',compact('post','qty','comment','amount'));

        }
    }

    public function commentpost(Request $request)
    {
        $comment = new Comment();
        $comment->post_id=$request->id;
        $comment->name=$request->name;
        $comment->body=$request->body;
        $comment->save();

        $name = $request->name;
        $body = $request->body;

        echo '
        <div class="form-group div-comment">
            <p class="name text-primary">'.$name.'</p>
            <span class="blockquote-footer">bây giờ</span>
            <p class="content ml-3 text-muted">'.$body.'</p>
            <div style=" width:100%;height: .1px; background:rgb(246, 243, 243)"></div>
        </div>
    ';
    }

    public function search(Request $request)
    {
        $key  = $request->key;
        $qty = Cart::count();
        $product  = product::with('categories','producer')->where('name','like', '%'.$key.'%')->get();
        if(!(Auth::user())){
            return view('search',compact('key','qty','product'));
        }
        else{
            $amount = Wishlist::where('user_id',Auth::user()->id)->get();
            return view('search',compact('key','qty','product','amount'));

        }
    }
}

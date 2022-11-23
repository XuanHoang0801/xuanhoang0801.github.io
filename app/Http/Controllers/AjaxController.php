<?php

namespace App\Http\Controllers;

use App\Models\card;
use App\Models\Categories;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Notify;
use App\Models\producer;
use App\Models\product;
use App\Models\Ratting;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AjaxController extends Controller
{
    public function checkPass(Request $request)
    {
        $pass = $request->pass;
        $password = $request->user()->password;
        if(!(Hash::check($pass,$password))){
            return response()->json([
                'success'=> '<span class="text-danger">Mật khẩu không chính xác!</span>',
            ]);
        }
        else{
            return response()->json([
                'success'=> '<span class="text-success">Mật khẩu chính xác!</span></br><span class="text-primary"> Mời nhập mật khẩu mới!</span',
            ]);
        }
    }

   public function amount(Request $request)
   {
        $id = $request->id;
        $amount = $request->amount;
        $card = card::find($id);
        $card->amount=$amount;
        $card->save();
    }

    public function delete($id)
    {
        card::find($id)->delete();
    }

    public function fill(Request $request)
    {
        $id = $request->id;
        $product = product::with('categories')->where('categories_id',$id)->orderBy('id','DESC')->get();
        foreach ($product as $list)
        {
            echo '
                <div class="project_box" data-id="'.$list->id.'">
                    <a href="/san-pham/'.$list->id.'">
                    <div class="dark_white_bg" >
                        <img  src="assets/img/product/'.$list->image.'" alt="#" width="500">
                    </div>
                    <h3  class="text-center" style="text-transform: uppercase;"><b>'.$list->name.'</b></h3>
        
                    <p class="text-warning">'.number_format($list->price).' &#8363</p>
                    </a>
        
                    <button class="btn btn-success mb-2  add-cart">Thêm vào giỏ hàng</button>
                    <div class="success" style="position: fixed;right: 0;top: 0;"> 
                        <div class="alert"></div>
                    </div>
                </div>               
            ';
        };

        if ($id == 'all') {
            $product = product::all()->orderBy('id','DESC');
            foreach ($product as $list)
            {
                echo '
                    <div class="project_box" data-id="'.$list->id.'">
                        <a href="/san-pham/'.$list->id.'">
                        <div class="dark_white_bg" >
                            <img  src="assets/img/product/'.$list->image.'" alt="#" width="500">
                        </div>
                        <h3  class="text-center" style="text-transform: uppercase;"><b>'.$list->name.'</b></h3>
            
                        <p class="text-warning">'.number_format($list->price).' &#8363</p>
                        </a>
            
                        <button class="btn btn-success mb-2  add-cart">Thêm vào giỏ hàng</button>
                        <div class="success" style="position: fixed;right: 0;top: 0;"> 
                            <div class="alert"></div>
                        </div>
                    </div>               
                ';
            };
        }
    }

    public function fillPrice(Request $request)
    {
        $id = $request->id;
        if ($id =='up') {
            $product = product::orderBy('price','ASC')->get();
            foreach ($product as $list)
            {
                echo '
                    <div class="project_box" data-id="'.$list->id.'">
                        <a href="/san-pham/'.$list->id.'">
                        <div class="dark_white_bg" >
                            <img  src="assets/img/product/'.$list->image.'" alt="#" width="500">
                        </div>
                        <h3  class="text-center" style="text-transform: uppercase;"><b>'.$list->name.'</b></h3>
            
                        <p class="text-warning">'.number_format($list->price).' &#8363</p>
                        </a>
            
                        <button class="btn btn-success mb-2  add-cart">Thêm vào giỏ hàng</button>
                        <div class="success" style="position: fixed;right: 0;top: 0;"> 
                            <div class="alert"></div>
                        </div>
                    </div>               
                ';
            };
        } 
        if($id == 'down')
        {
            $product = product::orderBy('price','DESC')->get();
            foreach ($product as $list)
            {
                echo '
                    <div class="project_box" data-id="'.$list->id.'">
                        <a href="/san-pham/'.$list->id.'">
                        <div class="dark_white_bg" >
                            <img  src="assets/img/product/'.$list->image.'" alt="#" width="500">
                        </div>
                        <h3  class="text-center" style="text-transform: uppercase;"><b>'.$list->name.'</b></h3>
            
                        <p class="text-warning">'.number_format($list->price).' &#8363</p>
                        </a>
            
                        <button class="btn btn-success mb-2  add-cart">Thêm vào giỏ hàng</button>
                        <div class="success" style="position: fixed;right: 0;top: 0;"> 
                            <div class="alert"></div>
                        </div>
                    </div>               
                ';
            };
        }

        if ($id == 'all') {
            $product = product::all()->orderBy('id','DESC');
            foreach ($product as $list)
            {
                echo '
                    <div class="project_box" data-id="'.$list->id.'">
                        <a href="/san-pham/'.$list->id.'">
                        <div class="dark_white_bg" >
                            <img  src="assets/img/product/'.$list->image.'" alt="#" width="500">
                        </div>
                        <h3  class="text-center" style="text-transform: uppercase;"><b>'.$list->name.'</b></h3>
            
                        <p class="text-warning">'.number_format($list->price).' &#8363</p>
                        </a>
            
                        <button class="btn btn-success mb-2  add-cart">Thêm vào giỏ hàng</button>
                        <div class="success" style="position: fixed;right: 0;top: 0;"> 
                            <div class="alert"></div>
                        </div>
                    </div>               
                ';
            };
        }    
    }
    public function fillProducer(Request $request)
    {
        $id = $request->id;
        $product = product::where('producer_id',$id)->orderBy('id','DESC')->get();
        foreach ($product as $list)
        {
            echo '
                <div class="project_box" data-id="'.$list->id.'">
                    <a href="/san-pham/'.$list->id.'">
                        <div class="dark_white_bg" >
                            <img  src="assets/img/product/'.$list->image.'" alt="#" width="500">
                        </div>
                        <h3  class="text-center" style="text-transform: uppercase;"><b>'.$list->name.'</b></h3>
                        <p class="text-warning">'.number_format($list->price).' &#8363</p>
                    </a>
                    <button class="btn btn-success mb-2  add-cart">Thêm vào giỏ hàng</button>
                    <div class="success" style="position: fixed;right: 0;top: 0;"> 
                        <div class="alert"></div>
                    </div>
                </div>               
            ';
        }; 
    }
    //notify
    public function UpdateNotify(Request $request)
    {
        $id = $request->id;
        $notify = Notify::find($id);
        $notify->status = 1;
        $notify->save();
    }
    public function deleteNotify(Request $request)
    {
       $id = $request->id;
        Notify::find($id)->delete();
       $notify = Notify::where('user_id',$request->user()->id)->where('status', 0)->get();
       
       $notify = count($notify);
       $check = Notify::where('user_id',$request->user()->id)->get();
       if (count($check) == 0) 
       {
            return response()->json([
                'notify'=>$notify,
                'css' => 'display:block',
                'success' => 'Không có thông báo nào!',
            ]);
       }
       else
       {
           return response()->json([
            'notify'=>$notify,
           ]);
       }

    }

    public function likeProduct(Request $request)
    {
        $id = $request->id;
        $user = $request->user()->id;
        $like = Like::where('user_id',$user)->where('product_id',$id)->get();
        if($like->isEmpty()){
            $addlike = new Like();
            $addlike->user_id = $user;
            $addlike->product_id=$id;
            $addlike->status = 1;
            $addlike->save();
            $count = Like::where('product_id',$id)->where('status',1)->get();
            $count = count($count);
            return response()->json([
                'count'=>$count,
                'success'=> 'Đã thích',
                'icon' => '<i class="fas fa-thumbs-up text-primary"></i>'
            ]);
        } 
        else{
            Like::where('product_id',$id)->where('user_id',$user)->delete();
            $count = Like::where('product_id',$id)->get();
            $count = count($count);
            return response()->json([
                'count'=>$count,
                'success'=> 'Thích',
                'icon' => '<i class="far fa-thumbs-up"></i>'
            ]);
        }
    }
    public function likePost(Request $request)
    {
        $id = $request->id;
        $user = $request->user()->id;
        $like = Like::where('user_id',$user)->where('post_id',$id)->get();
        if($like->isEmpty()){
            $addlike = new Like();
            $addlike->user_id = $user;
            $addlike->post_id=$id;
            $addlike->status = 1;
            $addlike->save();
            $count = Like::where('post_id',$id)->get();
            $count = count($count);
            return response()->json([
                'count'=>$count,
                'success'=> 'Đã thích',
                'icon' => '<i class="fas fa-thumbs-up text-primary"></i>'
            ]);
        } 
        else{
            Like::where('post_id',$id)->where('user_id',$user)->delete();
            $count = Like::where('post_id',$id)->get();
            $count = count($count);
            return response()->json([
                'count'=>$count,
                'success'=> 'Thích',
                'icon' => '<i class="far fa-thumbs-up"></i>'
            ]);
        }
    }

    public function Ratting(Request $request)
    {
        $id = $request->id;
        $user = $request->user()->id;
        $rat_id = $request->rat_id;
        $check= Ratting::find($rat_id);
        if(!(empty($check))){
            $check->level = $request->ratingValue;
            $check->save();
        }
        else{
            $ratting = new Ratting();
            $ratting->product_id = $id;
            $ratting->user_id = $user;
            $ratting->level = $request->ratingValue;
            $ratting->save();   
        } 
    }
}

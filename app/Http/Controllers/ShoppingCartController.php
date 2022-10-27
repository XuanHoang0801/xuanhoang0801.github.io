<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
// use Gloudemans\Shoppingcart\Facades\Cart;
use Laravel\Ui\Presets\React;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

// use Gloudemans\Shoppingcart\Facades\Cart;


class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $card = Cart::content();
        $qty  = Cart::count();
        $amount = Wishlist::where('user_id',Auth::user()->id)->orderby('id','DESC')->get();
        return view('shoppingcart',compact('card','qty','amount'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id=$request->id;
        $product = product::find($id);
        $name=$product->name;
        $qty=$request->qty;
        $price=$product->price;
        $image=$product->image;

        Cart::add($id,$name,$qty,$price,550,['image'=>''.$image.'']);
        $amount = Cart::count();
        return response()->json([
            'success'=>'<div class="alert alert-success mt-3"><i class="fas fa-check"></i> Đã thêm vào giỏ hàng  </div>',
            'amount'=> $amount
        ]);

    }

    public function addWishlist(Request $request)
    {
        $user=$request->user()->id;
        $check = Wishlist::where('product_id', $request->id)->where('user_id',$user)->get();
        if($check->isEmpty()){
            $wishlist= new Wishlist();
            $wishlist->product_id=$request->id;
            $wishlist->user_id=$user;
            $wishlist->save();
            return response()->json([
                'success'=>'<div class="alert alert-success mt-3">Đã thêm vào mục yêu thích </div>',
            ]);
        }
        else{
            
            return response()->json([
                'success'=>'<div class="alert alert-danger mt-3">Sản phẩm đã tồn tại trong mục yêu thích! </div>',
            ]);
        }
        
    }

    public function add(Request $request)
    {
        $id=$request->id;
        $product = product::find($id);
        $name=$product->name;
        $qty=1;
        $price=$product->price;
        // $image=$product->image;

        Cart::add($id,$name,$qty,$price);
        $amount = Cart::count();
        return response()->json([
            'success'=>'<div class="alert alert-success mt-3"><i class="fas fa-check"></i> Đã thêm vào giỏ hàng  </div>',
            'amount'=>$amount
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        $amount = Cart::count();
        return response()->json([
            'total'=> Cart::subtotal(0,','),
            'amount'=>$amount
        ]);
    }

    public function amount(Request $request)
    {
        $id = $request->id;
        $qty = $request->amount;
        $price =$request->price;
        Cart::update($id, $qty);
        $cart = Cart::get($id);

        return response()->json([
            'price'=> $cart->price * $cart->qty,
            'total'=> Cart::subtotal(0,','),
        ]);
    }


}

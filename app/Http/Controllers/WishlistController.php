<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user= Auth::user()->id;
        $qty = Cart::count();
        $url = $request->url();
        $wishlist = Wishlist::with('products')->where('user_id', $user)->get();
        $amount = Wishlist::with('products')->where('user_id', $user)->get();
        return view('wishlist',compact('qty', 'wishlist','amount','url'));
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
        $user=$request->user()->id;
        $check = Wishlist::where('product_id', $request->id)->where('user_id',$user)->get();
        if($check->isEmpty()){
            $wishlist= new Wishlist();
            $wishlist->product_id=$request->id;
            $wishlist->user_id=$user;
            $wishlist->save();
            $wishlist = Wishlist::where('user_id', $user)->get();
            $amount = count($wishlist);
            $qty = Cart::count();
            return response()->json([
                'success'=>'<div class="alert alert-success mt-3"><i class="fas fa-check"></i> Đã thêm vào mục yêu thích </div>',
                'amount'=> $amount,
                'qty' =>$qty
            ]);
        }
        else{
            return response()->json([
                'success'=>'<div class="alert alert-danger mt-3">Sản phẩm đã tồn tại trong mục yêu thích! </div>',
            ]);
        }
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
        Wishlist::find($id)->delete();
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->get();
        $amount = count($wishlist);
        return response()->json([
            'success'=>'<div class="alert alert-success mt-3"><i class="fas fa-check"></i> Đã xóa khỏi mục yêu thích! </div>',
            'amount'=>$amount
        ]);
    }
}

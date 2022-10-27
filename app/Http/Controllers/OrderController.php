<?php

namespace App\Http\Controllers;

use App\Models\card;
use App\Models\User;
use App\Models\order;
use App\Models\Notify;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user()->id;
        $qty = Cart::count();
        $order=order::with('products','statuses','users','cards')->where('user_id',$user)->get();
        $amount = Wishlist::where('user_id',Auth::user()->id)->get();
        
        return view('bill',compact('qty', 'order','amount'));
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
    public function store(OrderRequest $request)
    {
        $user=Auth::user()->id;
        $upAddress=User::find($user);;
        $upAddress->phone=$request->phone;
        $upAddress->save();
       
        $id=$request->id;
        foreach ($id as $id){
            $card = Cart::get($id);
            $order = new order();
            $order->card_id=$id;
            $order->user_id=$user;
            $order->status_id=1;
            $order->product_id=$card->id;
            $order->amount=$card->qty;
            $order->address=$request->address;
            $order->total=$card->price * $card->qty;
            $order->save();
            $notify = new Notify();
            $notify->body = 'Có đơn hàng '.$order ->products->name.' mới!';
            $notify->order_id= $order->id;
            $notify->save();
        }
        return redirect('/don-hang');   

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
        $order = order::with('products', 'users')->find($id);
        $notify = new Notify();
        $notify->body = 'Đơn hàng '.$order->products->name .' của '.$order->users->name.' đã bị hủy';
        $notify->order_id = $id;
        $notify->save();
        order::find($id)->delete();

        return redirect('/don-hang');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user()->id;
        $card=card::with('products','users')->where('user_id',$user)->get();
        return view('card',['card'=>$card]);
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
        $id=$request->product;
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
            return redirect('/san-pham/'.$id)->with(['thongbao','Đã thêm vào giỏ hàng!']); 
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
        $card=card::find($id);
        $card->amount=$request->amount;
        $card->save();
        return redirect('/gio-hang')->with('thongbao','Cập nhật giỏ hàng thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        card::find($id)->delete();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\Notify;
use App\Models\status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order=order::with('products','statuses','users','cards')->paginate(5);
        $notify = Notify::where('status',0)->orderBy('id', 'DESC')->get();


        return view('admin2.pages.order.list',compact('order','notify'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=order::with('products','statuses','users','cards')->find($id);
        $notify = Notify::where('status',0)->orderBy('id', 'DESC')->get();
        $status =status::all();
        return view('admin2.pages.order.update',compact('order','status','notify'));
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
        $order= order::find($id);
        $order->status_id=$request->status;
        $order->save();
        return redirect('/admin/quan-ly-don-hang/'.$id.'')->with(['thongbao'=>'Đã cập nhật đơn hàng!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

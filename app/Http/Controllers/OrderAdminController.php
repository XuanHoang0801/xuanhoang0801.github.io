<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\Notify;
use App\Models\product;
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
    public function index(Request $request)
    {
        $order=order::with('products','statuses','users','cards')->orderBy('id','DESC')->paginate(5);
        $notify = Notify::where('style',0)->orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->where('style',0)->get();
        $url = $request->url();
        return view('admin2.pages.order.list',compact('order','notify','amount','url'));
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
    public function show($id,Request $request)
    {
        $order=order::with('products','statuses','users','cards')->find($id);
        if (!($order)) {
            return redirect('404');
        }
        $notify = Notify::where('style',0)->orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->where('style',0)->get();
        $status =status::all();
        $url = $request->url();
        return view('admin2.pages.order.update',compact('order','status','notify','amount','url'));
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
        $order= order::with('statuses')->find($id);
        //cập nhật trạng thái
        if ($order->status_id == $request->status) {
            return redirect('admin/quan-ly-don-hang/'.$id.'')->with(['thongbao'=>'Không có gì thay đổi!']);
        } else {
            $order->status_id=$request->status;
            $order->save();
        }
        //cập nhật số lượng bán được
        $order= order::with('statuses')->find($id);
        if($request->status == 4){

            $product = product::find($order->product_id);
            $product->qty--;
            $product->buy++;
            $product->save();
        }
        //Tạo thông báo
        $notify = new Notify();
        $notify->body = 'Đơn hàng <span class="text-primary">'.$order->order_id.'</span> của bạn đã cập nhật trạng thái thành <span class="text-success">'.$order->statuses->name.'</span>';
        $notify->user_id = $order->user_id;
        $notify->order_id = $order->id;
        $notify->style = 1;
        $notify->save();
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

    public function delivered(Request $request)
    {
        $order = order::with('products','statuses','users','cards')->where('status_id',4)->get();
        $notify = Notify::where('style',0)->orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->where('style',0)->get();
        $url = $request->url();
        return view('admin2.pages.order.delivered',compact('order','notify','amount','url'));
    }

    public function garbage(Request $request)
    {
        $order = order::onlyTrashed()->orderBy('id','DESC')->get();
        $notify = Notify::where('style',0)->orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->where('style',0)->get();
        $url = $request->url();
        return view('admin2.pages.order.garbage',compact('order','notify','amount','url'));
    }

    public function force($id)
    {
        order::withTrashed()->find($id)->forceDelete();
        return redirect('/admin/quan-ly-don-hang/don-huy')->with(['thongbao'=>'Đã xóa đơn hàng thành công!']);
    }
}

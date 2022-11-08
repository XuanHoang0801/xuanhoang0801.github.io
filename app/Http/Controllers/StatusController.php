<?php

namespace App\Http\Controllers;

use App\Models\Notify;
use App\Models\status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status= status::all();
        $notify = Notify::orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->get();
        $url = $request->url();
        return view('admin2.pages.status.list',compact('status','notify','amount','url'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $notify = Notify::orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->get();
        $url = $request->url();
        return view('admin2.pages.status.add',compact('notify','amount','url'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'color'=>'required'],[
            'name.required'=>'Bạn chưa nhập tên trạng thái!',
            'color.required'=>'Bạn chưa chọn màu sắc hiển thị!'
        ]);
        $status=new status();
        $status->name=$request->name;
        $status->color=$request->color;
        $status->save();
        return redirect('/admin/trang-thai/create')->with(['thongbao'=>'Đã thêm trạng thái đơn hàng mới!']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $status= status::find($id);
        $notify = Notify::orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->get();
        $url = $request->url();
        return view('admin2.pages.status.update',compact('status','notify','amount','url'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        
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
        $this->validate($request,[
            'name'=>'required',
            'color'=>'required'],[
            'name.required'=>'Bạn chưa nhập tên trạng thái!',
            'color.required'=>'Bạn chưa chọn màu sắc hiển thị!'
        ]);
        $status=status::find($id);
        $status->name=$request->name;
        $status->color=$request->color;
        $status->save();
        return redirect('/admin/trang-thai/'.$id.'')->with(['thongbao'=>'Đã cập nhật trạng thái đơn hàng!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        status::find($id)->delete();
        return redirect('/admin/trang-thai')->with(['thongbao'=>'Đã xóa trạng thái đơn hàng!']);
    }
}

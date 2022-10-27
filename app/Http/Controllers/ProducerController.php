<?php

namespace App\Http\Controllers;

use App\Models\Notify;
use App\Models\product;
use App\Models\producer;
use App\Models\Categories;
use Illuminate\Http\Request;

class ProducerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producer = producer::with('categories')->get();
        $notify = Notify::where('status',0)->get();

        // return view('admin.producer.list', ['producer'=>$producer]);
        return view('admin2.pages.producer.list',compact('producer','notify'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Categories::all();
        $notify = Notify::where('status',0)->get();

        return view('admin2.pages.producer.add',compact('categories','notify'));
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
            'name'=>'required|unique:producers,name'
        ],[
            'name.required'=>'Bạn chưa nhập nhà sản xuất!',
            'name.unique'=>'Nhà sản xuất đã tồn tại!'
        ]);
        $producer=new producer();
        $producer->name=$request->name;
        $producer->categories_id=$request->categories;
        $producer->save();
        return redirect('/admin/nha-san-xuat/create')->with(['thongbao'=>'Đã thêm nhà sản xuất mới!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producer=producer::with('categories')->find($id);
        $notify = Notify::where('status',0)->get();

        $categories=Categories::all();
        return view('admin2.pages..producer.update',compact('producer','categories','notify'));
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
        $this->validate($request,[
            'name'=>'required|'
        ],[
            'name.required'=>'Bạn chưa nhập nhà sản xuất!',
        ]);
        $producer=producer::find($id);
        $producer->name=$request->name;
        $producer->categories_id=$request->categories;
        $producer->save();
        return redirect('/admin/nha-san-xuat/'.$id.'')->with(['thongbao'=>'Cập nhật nhà sản xuất thành công!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producer= producer::find($id)->delete();
        return redirect('admin/nha-san-xuat')->with(['thongbao'=>'Xóa nhà sản xuất thành công!']);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\nsx;
use App\Models\Notify;
use App\Models\Categories;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class NsxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producer = nsx::all();
        $notify = Notify::where('status',0)->orderBy('id', 'DESC')->get();

        return view('admin2.pages.nsx.list', compact('producer','notify'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();
        $notify = Notify::where('status',0)->orderBy('id', 'DESC')->get();

        return view('admin2.pages.nsx.add', compact('categories', 'notify'));
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
            'categories'=>'required',
            'name'=>'required'
        ],[
            'categories.required'=>'Bạn chưa chọn danh mục!',
            'name.required'=> 'Bạn chưa nhập tên nhà sản xuất'
        ]);
        $categories=$request->categories;
        $name = $request->name;
        $producer = new nsx();
        $producer->name = $name;
        $producer->categories_id = $categories;
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
        $producer = nsx::find($id);
        $notify = Notify::where('status',0)->orderBy('id', 'DESC')->get();
        
        $categories = Categories::all();
        return view('admin2.pages.nsx.update', compact('producer', 'categories','notify'));

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
            'categories'=>'required',
            'name'=>'required'
        ],[
            'categories.required'=>'Bạn chưa chọn danh mục!',
            'name.reuqired'=> 'Bạn chưa nhập tên nhà sản xuất'
        ]);
        $name = $request->name;
        $categories=$request->categories;
        $producer = nsx::find($id);
        $producer->name = $name;
        $producer->categories_id = $categories;
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
        $producer = nsx::find($id)->delete();
        return redirect('/admin/nha-san-xuat/')->with(['thongbao'=>'Đã xóa nhà sản xuất thành công!']);

        
    }
}

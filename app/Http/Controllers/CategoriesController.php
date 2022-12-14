<?php

namespace App\Http\Controllers;

use App\Models\Notify;
use App\Models\Categories;
use App\Models\product;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
        // public function __construct(Request $request)
        // {
        //     $url  = $request->url();
        //     return response()->json([
        //         'url'=>$url,
        //     ]);
        // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories=Categories::all();
        $notify = Notify::where('style',0)->orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->where('style',0)->get();
        $url  = $request->url();

        // return view('admin.danh-muc.list',['categories'=>$categories]);
        return view('admin2.pages.categories.list',compact('categories','notify','amount','url'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $notify = Notify::where('style',0)->orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->where('style',0)->get();
        $url = $request->url();
        return view('admin2.pages.categories.add',compact('notify','amount','url'));
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
            'name'=>'required|min:3|unique:categories,name',
        ],[
            'name.required'=>'Bạn chưa nhập tên danh mục!',
            'name.min'=>'Tên danh mục quá ngắn!',
            'name.unique'=>'Danh mục đã tồn tại!'
        ]);

        $categories=new Categories();
        $categories->name=$request->name;
        $categories->save();
        return redirect('/admin/danh-muc/create')->with(['thongbao'=> 'Thêm danh mục thành công!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $categories=Categories::find($id);
        $notify = Notify::where('style',0)->orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->where('style',0)->get();
        $url = $request->path();
        $parameters = request()->route()->parameters;
        return view('admin2.pages.categories.update', compact('categories','notify','amount','url','parameters'));
        
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
        $categories=Categories::find($id);
        $this->validate($request,[
            'name'=>'required|min:3'
        ],[

            'name.required'=>"Bạn chưa nhập tên danh mục!",
            'name.min'=>'Tên danh mục quá ngắn!'
        ]);
        $categories->name=$request->name;
        $categories->save();
        return redirect('/admin/danh-muc/'.$id.'')->with(['thongbao'=>'Cập nhật danh mục thành công!']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        product::where('categories_id',$id)->delete();
        $categories= Categories::find($id)->delete();
        return redirect('admin/danh-muc')->with(['thongbao'=>'Xóa danh mục thành công!']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Notify;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $url = $request->url();
        $notify = Notify::where('style',0)->orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->where('style',0)->get();
        $banner = Banner::all(); 
        return view('admin2.pages.banner.list', compact('banner','url','notify','amount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $url = $request->url();
        $notify = Notify::where('style',0)->orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->where('style',0)->get();
        // $banner = Banner::all(); 
        return view('admin2.pages.banner.add', compact('url','notify','amount'));    
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
            'name' => 'required|min:3',
            'file'=>'required'
        ],[
            'name.required'=> "Vui lòng nhập tiêu đề!",
            'name.min'=> "Vui lòng nhập tiêu đề dài hơn!",
            'file.required'=>'Vui lòng chọn file ảnh!'
        ]);

        $banner = new Banner();
        $banner->title = $request->name;

        $file= $request->file('file');
        $name = $file->getClientOriginalName(); //Lấy tên file
        $file->move('assets/img/banner',$name); //upload file vào thư mục     
        $banner->image=$name;

        if($request->show == 'on'){

            $banner->status = 1;
        }
        else{
            $banner->status = 0;
        }
        $banner->save();
        return redirect('/admin/banner');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $url = $request->url();
        $notify = Notify::where('style',0)->orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->where('style',0)->get();
        $banner = Banner::find($id);
        return view('admin2.pages.banner.update', compact('banner','url','notify','amount'));    
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
            'name' => 'required|min:3',
        ],[
            'name.required'=> "Vui lòng nhập tiêu đề!",
            'name.min'=> "Vui lòng nhập tiêu đề dài hơn!",
        ]);

        $banner = Banner::find($id);
        $banner->title = $request->name;
        if (!($request->hasFile('file'))) {
        }
        else{
            $file= $request->file('file');
            $name = $file->getClientOriginalName(); //Lấy tên file
            $file->move('assets/img/banner',$name); //upload file vào thư mục     
            $banner->image=$name;
        }
     
        if($request->show == 'on'){

            $banner->status = 1;
        }
        else{
            $banner->status = 0;
        }
        $banner->save();
        return redirect('/admin/banner/'.$id.'')->with(['thongbao' => 'Cập nhật banner thành công!']);
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

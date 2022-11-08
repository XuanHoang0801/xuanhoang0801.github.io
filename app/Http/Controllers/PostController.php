<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Notify;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Laravel\Ui\Presets\React;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $post = Post::with('categories','users')->paginate(5);
       $notify = Notify::orderBy('id', 'DESC')->get();
       $amount = Notify::where('status',0)->get();
       $url = $request->url();
       return view('admin2.pages.post.list',compact('post','notify','amount','url'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Categories::all();
        $notify = Notify::orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->get();
        $url = $request->url();


        return view('admin2.pages.post.add',compact('categories','notify','amount','url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post=new Post();
        $post->title=$request->name;
        $post->body=$request->body;
        $post->categories_id=$request->categories;
        $post->user_id=$request->user()->id;
        if (!($request->hasFile('file'))) {
            $post->image='img.png';
        }
        else{
            $file= $request->file('file');
            $name = $file->getClientOriginalName(); //Lấy tên file
            $post->image=$name;
            // $file->move('assets/img/',$request->name);
            $upload = $file->move('assets/img/',$name); //upload file vào thư mục     
        }
        $post->save();
        return redirect('/admin/quan-ly-bai-viet/create')->with(['thongbao'=>'Đã thêm bài viết mới!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $post = Post::find($id);
        $notify = Notify::orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->get();
        $url = $request->url();
        $categories = Categories::all();
        return view('admin2.pages.post.update',compact('post','categories','notify','amount','url'));
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
        $post = Post::find($id);
        $post->title=$request->name;
        $post->body=$request->body;
        $post->categories_id=$request->categories;
        $post->user_id=$request->user()->id;
        if (!($request->hasFile('file'))) {
           
        }
        else{
            $file= $request->file('file');
            $name = $file->getClientOriginalName(); //Lấy tên file
            $post->image=$name;
            // $file->move('assets/img/',$request->name);
            $upload = $file->move('assets/img/',$name); //upload file vào thư mục     
        }
        $post->save();
        return redirect('/admin/quan-ly-bai-viet/'.$id)->with(['thongbao'=>'Cập nhật bài viết thành công!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id)->delete();
        return redirect('/admin/quan-ly-bai-viet')->with(['thongbao'=>'Xóa bài viết thành công!']); 
    }

    public function garbage(Request $request)
    {
        $post=Post::onlyTrashed()->paginate(5);
        $notify = Notify::orderBy('id', 'DESC')->get();
        $amount = Notify::where('status', 0)->get();
        $url = $request->url();
        return view('admin2.pages.post.garde',compact('post','notify','amount','url'));
    }
    public function khoiphuc($id)
    {
        Post::withTrashed()->find($id)->restore();
        return redirect('/admin/quan-ly-bai-viet/da-xoa')->with(['thongbao'=>'Sản phẩm đã được khôi phục!']);
    }
    public function xoa($id)
    {
        Post::withTrashed()->where('id',$id)->forceDelete();
        return redirect('/admin/quan-ly-bai-viet/da-xoa')->with(['thongbao'=>'Sản phẩm đã bị xóa vĩnh viễn!']);

    }

    public function gioithieu(Request $request)
    {
        $notify = Notify::orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->get();
        $url = $request->url();
        $post = Post::with('categories')->find(3);
        return view('admin2.pages.post.gioithieu',compact('notify','amount','url','post'));
    }
}

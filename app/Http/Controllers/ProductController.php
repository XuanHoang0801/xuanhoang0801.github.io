<?php

namespace App\Http\Controllers;

use App\Models\nsx;
use App\Models\Notify;
use App\Models\product;
use App\Models\producer;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use Laravel\Ui\Presets\React;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product=product::with('categories','nsx','users')->orderBy('id','DESC')->paginate(5);
        $notify = Notify::orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->get();
        $url = $request->url();
        return view('admin2.pages.product.list',compact('product','notify','amount','url'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories=Categories::all();
        $notify = Notify::orderBy('id', 'DESC')->get();
        $url = $request->url();
        $amount = Notify::where('status',0)->get();

        $producer=nsx::all();
        // return view('admin.product.add',['categories'=>$categories, 'producer'=>$producer]);
        return view('admin2.pages.product.add',compact('categories','producer','notify','amount','url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product=new product();
        $product->name=$request->name;
        $product->body=$request->body;
        $product->qty=$request->qty;
        $product->categories_id=$request->categories;
        $product->producer_id=$request->producer;
        $product->user_id=$request->user()->id;
        $product->price=$request->price;
        if (!($request->promotion)) {
            $product->promotion=null;
        }
        else{
            $product->promotion=$request->promotion;
            }
        if (!($request->hasFile('file'))) {
            $product->image='img.png';
        }
        else{
            $file= $request->file('file');
            $name = $file->getClientOriginalName(); //Lấy tên file
            $product->image=$name;
            $upload = $file->move('assets/img/',$name); //upload file vào thư mục     
        }
        $product->save();
        return redirect('/admin/quan-ly-san-pham/create')->with(['thongbao'=>'Đã thêm sản phẩm mới!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $product=product::with('categories','nsx','users')->find($id);
        $notify = Notify::orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->get();
        $url = $request->url();

        $categories=Categories::all();
        $producer=nsx::all();
        return view('admin2.pages.product.update',compact('product','categories','producer','notify','amount','url'));
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
    public function update(ProductUpdateRequest $request, $id)
    {
        $product=product::find($id);
        $product->name=$request->name;
        $product->body=$request->body;
        $product->qty=$request->qty;
        $product->categories_id=$request->categories;
        $product->producer_id=$request->producer;
        $product->user_id=$request->user()->id;
        $product->price=$request->price;

        if (!($request->promotion)) {
            null;
        }
        else
        {
           if($request->promotion>= $request->price){
            return redirect('/admin/quan-ly-san-pham/'.$id.'')->with(['loi'=>'Giá khuyến mãi phải nhỏ hơn giá gốc!']);
           }
           else{
            $product->promotion=$request->promotion;
           }
        }

        if (!($request->hasFile('file'))) {
           null;
        }
        else{
            $file= $request->file('file');
            $name = $file->getClientOriginalName(); //Lấy tên file
            $product->image=$name;
            $upload = $file->move('assets/img/',$name); //upload file vào thư mục           
        }
        $product->save();
        return redirect('/admin/quan-ly-san-pham/'.$id.'')->with(['thongbao'=>'Cập nhật sản phẩm thành công!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        product::find($id)->delete();
        return redirect('/admin/quan-ly-san-pham')->with(['thongbao'=>'Xóa sản phẩm thành công!']);
    }
    public function garbage(Request $request)
    {
        $product=product::onlyTrashed()->paginate(5);
        $notify = Notify::orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->get();
        $url = $request->url();
        return view('admin2.pages.product.garde',compact('product','notify','amount','url'));
    }
    public function khoiphuc($id)
    {
        $product=product::withTrashed()->find($id)->restore();
        return redirect('/admin/quan-ly-san-pham/da-xoa')->with(['thongbao'=>'Sản phẩm đã được khôi phục!']);
    }
    public function xoa($id)
    {
        product::withTrashed()->where('id',$id)->forceDelete();
         return redirect('/admin/quan-ly-san-pham/da-xoa')->with(['thongbao'=>'Sản phẩm đã bị xóa vĩnh viễn!']);

    }
}

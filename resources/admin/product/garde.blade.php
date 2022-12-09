@extends('layouts.app')
@section('title', 'Quản lý sản phẩm')

@section('content')
<div class="container">
    <h1>Sản phẩm đã xóa</h1>

   @if (session('thongbao'))
       <div class="alert alert-success">{{session('thongbao')}}</div>
   @endif
   @if ($product->isEmpty())
       <div class="alert alert-danger">Danh sách trống!</div>
   @else
       
   <table class="table">
       <thead>
           <tr>
               <th>STT</th>
               <th>Sản phẩm</th>
               <th>Giá</th>
               <th>Giá khuyến mãi</th>
               <th>Thể loại</th>
               <th>Nhà sản xuất</th>
               <th>Người đăng</th>
               <th class="text-center">Hành động</th>
           </tr>
       </thead>
       <tbody>
        <?php $stt = 1?>
           @foreach ($product as $list)
               
           <tr>
               <td scope="row">{{$stt++}}</td>
               <td>
                   <img src="assets/img/{{$list->image}}" alt="" width="30">
               
                   {{$list->name}}
               </td>
               <td>{{number_format($list->price)}} &#8363</td>
               <td>{{number_format($list->promotion)}} &#8363</td>
               <td>{{$list->categories->name}}</td>
               <td>{{$list->producer->name}}</td>
               <td>{{$list->users->name}}</td>

               <td class="d-flex justify-content-around">
                   <a href="admin/quan-ly-san-pham/khoi-phuc/{{$list->id}}" class="btn btn-success  " onclick="return confirm('Bạn có chắc hắn muốn khôi phục sản phẩm này không!')"><i class="fas fa-undo"></i></a>
                   
                   <form action="admin/quan-ly-san-pham/xoa/{{$list->id}}" method="post">
                       @csrf
                       @method('delete')
                       <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa vĩnh viễn sản phẩm này không?')"><i class="fas fa-trash"></i></button>
                   </form>
                   
               </td>
           </tr>
           @endforeach
           
       </tbody>
   </table>
   @endif
</div>
@endsection

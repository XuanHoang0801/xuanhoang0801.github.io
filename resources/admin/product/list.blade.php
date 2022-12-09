@extends('layouts.app')
@section('title', 'Quản lý sản phẩm')

@section('content')
<div class="container">
    <h1>Quản lý sản phẩm</h1>

    <div class="form-group d-flex justify-content-between">
        <a href="/admin/quan-ly-san-pham/create" class="btn btn-primary">Thêm mới</a>
        <a href="/admin/quan-ly-san-pham/da-xoa" class="btn btn-warning">Sản phẩm đã xóa</a>

    </div>
    
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
            <?php $stt=1?>
            @foreach ($product as $list)
                
            <tr>
                <td scope="row">{{$stt++}}</td>
                <td>
                    <img src="assets/img/{{$list->image}}" alt="" width="35">
                
                    {{$list->name}}
                </td>
                <td>{{number_format($list->price)}} &#8363</td>
                <td>{{number_format($list->promotion)}} &#8363</td>
                <td>{{$list->categories->name}}</td>
                <td>{{$list->producer->name}}</td>
                <td>{{$list->users->name}}</td>

                <td class="d-flex justify-content-around">
                    <a href="admin/quan-ly-san-pham/{{$list->id}}" class="btn btn-success "><i class="fas fa-pen"></i></a>
                    
                    <form action="admin/quan-ly-san-pham/{{$list->id}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa hãng này không?')"><i class="fas fa-trash"></i></button>
                    </form>
                    
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
@endsection

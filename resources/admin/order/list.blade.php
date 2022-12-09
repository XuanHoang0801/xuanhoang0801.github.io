@extends('layouts.app')
@section('title','Quản lý đơn hàng')
@section('content')
<div class="container">
    <h1>Quản lý đơn hàng</h1>

    
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Người mua</th>
                <th>Tổng tiền</th>
                <th>Ngày lập</th>
                <th>Trạng thái</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php $stt=1;?>
            @foreach ($order as $list)
                
            <tr>
                <td scope="row">{{$stt++}}</td>
                <td>
                    <img src="assets/img/{{$list->products->image}}" alt="" width="35">
                
                    {{$list->products->name}}
                </td>
                <td>{{$list->amount}}</td>
                <td>{{number_format($list->products->price)}} &#8363</td>
                <td>{{$list->users->name}}</td>
                <td>{{number_format($list->total)}} &#8363</td>
                <td>{{$list->created_at->format('d/m/Y- H:i:s')}}</td>
                <td>
                    <span style="color:{{$list->statuses->color}};border-radius: 2rem; ">{{$list->statuses->name}}</span>
                </td>
                <td class="d-flex justify-content-around">
                    <a href="admin/quan-ly-don-hang/{{$list->id}}" class="btn btn-success">Chi tiết</a>
                    
                    <form action="admin/don-hang/{{$list->id}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa trạng thái này không?')"><i class="fas fa-trash"></i></button>
                    </form>
                    

                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
@endsection

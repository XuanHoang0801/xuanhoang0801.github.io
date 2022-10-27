@extends('layouts.app')
@section('title','Trạng thái đơn hàng')
@section('content')
<div class="container">
    <h1>Quản lý trạng thái đơn hàng</h1>

    <div class="form-group">
        <a href="/admin/trang-thai/create" class="btn btn-primary">Thêm mới</a>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Trạng thái</th>
                <th>Màu sắc</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($status as $st)
                
            <tr>
                <td scope="row">{{$st->id}}</td>
                <td>{{$st->name}}</td>
                <td><div style="background:{{$st->color}}; width: 40px;height: 40px;border-radius: 2rem; "></div></td>
                <td class="d-flex ">
                    <a href="admin/trang-thai/{{$st->id}}" class="btn btn-success" style="margin: 0 5px"><i class="fas fa-pen"></i></a>
                    
                    <form action="admin/trang-thai/{{$st->id}}" method="post">
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

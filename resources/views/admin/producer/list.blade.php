@extends('layouts.app')
@section('title', 'Quản lý nhà sản xuất')

@section('content')
<div class="container">
    <h1>Quản lý nhà sản xuất</h1>

    <div class="form-group">
        <a href="/admin/nha-san-xuat/create" class="btn btn-primary">Thêm mới</a>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Thể loại</th>
                <th>Nhà sản xuất</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($producer as $list)
                
            <tr>
                <td scope="row">{{$list->id}}</td>
                <td>{{$list->categories->name}}</td>
                <td>{{$list->name}}</td>
                <td class="d-flex">
                    <a href="admin/nha-san-xuat/{{$list->id}}" class="btn btn-success" style="margin: 0 5px"><i class="fas fa-pen"></i></a>
                    
                    <form action="admin/nha-san-xuat/{{$list->id}}" method="post">
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

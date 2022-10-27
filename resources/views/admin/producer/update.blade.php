@extends('layouts.app')
@section('title','Cập nhật nhà sản xuất')
@section('content')
<div class="container">
    <form action="/admin/nha-san-xuat/{{$producer->id}}" method="post">
        @csrf
        @method('put')
        @if (session('thongbao'))
            <div class="alert alert-success mt-3">{{session('thongbao')}}</div>
        @endif
        <div class="form-group mb-3 pt-3 d-flex">
            <label for="" class="form-label col-1">Chọn danh mục:</label>
            <select class="form-select" aria-label="Default select example" class="form-control" name="categories">
                <option value="{{$producer->categories_id}}">{{$producer->categories->name}}</option>

                @foreach ($categories as $list)

                @if ($producer->categories_id==$list->id)
                @else 
                <option value="{{$list->id}}">{{$list->name}}</option>
                @endif
                    
                @endforeach
                
            </select>
            
        </div>
        <div class="form-group mb-3 pt-3 d-flex">
            <label for="" class="form-label col-1">Tên danh mục:</label>
            <input type="text" name="name" placeholder="Nhập tên danh mục..." class="form-control @error('name') is-invalid @enderror " value="{{$producer->name}}">
            
        </div>
        @error('name')
        <p class="alert alert-danger mt-3">{{ $message }}</p>
        @enderror
        <div class="form-group pb-3">
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="/admin/nha-san-xuat" class="btn btn-danger">Trở về</a>
        </div>
    </form>
</div>
@endsection

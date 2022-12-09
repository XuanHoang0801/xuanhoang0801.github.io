@extends('layouts.app')
@section('title','Thêm mới nhà sản xuất')
@section('content')
<div class="container">
    <form action="/admin/nha-san-xuat" method="post">
        @csrf
        @if (session('thongbao'))
            <div class="alert alert-success mt-3">{{session('thongbao')}}</div>
        @endif
        
        <div class="form-group mb-3 pt-3 d-flex">
            <label for="" class="form-label col-1">Chọn danh mục:</label>
            <select class="form-select" aria-label="Default select example" name="categories" class="form-control @error('categories') is-invalid @enderror ">
                @foreach ($categories as $list)
                <option value="{{$list->id}}">{{$list->name}}</option>
                @endforeach
            </select>
        </div>
        @error('categories')
        <p class="alert alert-danger mt-3">{{ $message }}</p>
        @enderror

        <div class="form-group mb-3 pt-3 d-flex">
            <label for="" class="form-label col-1">Tên nhà sản xuất:</label>
            <input type="text" name="name" placeholder="Nhập tên danh mục..." class="form-control @error('name') is-invalid @enderror ">
            
        </div>
        @error('name')
        <p class="alert alert-danger mt-3">{{ $message }}</p>
        @enderror

        
       
        <div class="form-group pb-3">
            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <a href="/admin/nha-san-xuat" class="btn btn-danger">Trở về</a>
        </div>
    </form>
</div>
@endsection

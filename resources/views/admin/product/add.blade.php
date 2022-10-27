@extends('layouts.app')
@section('title','Thêm mới sản phẩm')
@section('content')
<div class="container">
    <form action="/admin/quan-ly-san-pham" method="post" enctype="multipart/form-data">
        @csrf
        @if (session('thongbao'))
            <div class="alert alert-success mt-3">{{session('thongbao')}}</div>
        @endif
        
        <div class="form-group mb-3 pt-3 d-flex">
            <label for="" class="form-label col-1">Chọn danh mục:</label>
            <select class="form-select" aria-label="Default select example" name="categories" class="form-control @error('categories') is-invalid @enderror " id="categories">
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
            <select class="form-select" aria-label="Default select example" name="producer" class="form-control @error('producer') is-invalid @enderror " id="producer">
                @foreach ($producer as $producer)
                <option value="{{$producer->id}}">{{$producer->name}}</option>
                @endforeach
            </select>
            
        </div>
        @error('producer')
        <p class="alert alert-danger mt-3">{{ $message }}</p>
        @enderror

        <div class="form-group mb-3 pt-3 d-flex">
            <label for="" class="form-label col-1">Tên sản phẩm:</label>
            <input type="text" name="name" placeholder="Nhập tên sản phẩm..." class="form-control @error('name') is-invalid @enderror " value="{{old("name")}}">
            
        </div>
        @error('name')
        <p class="alert alert-danger mt-3">{{ $message }}</p>
        @enderror

        <div class="form-group mb-3 pt-3 d-flex">
            <label for="" class="form-label col-1">Mô tả sản phẩm:</label>
            <textarea name="body" placeholder="Nhập mô tả sản phẩm..." class="form-control @error('body') is-invalid @enderror " >{{old('body')}}</textarea>
            
        </div>
        @error('body')
        <p class="alert alert-danger mt-3">{{ $message }}</p>
        @enderror
        
        <div class="form-group mb-3 pt-3 d-flex">
            <label for="" class="form-label col-1">Giá sản phẩm:</label>
            <input type="number" name="price" placeholder="Nhập giá sản phẩm..." class="form-control @error('price') is-invalid @enderror " min='1000' value="{{old("price")}}">
            
        </div>
        @error('price')
        <p class="alert alert-danger mt-3">{{ $message }}</p>
        @enderror

        <div class="form-group mb-3 pt-3 d-flex">
            <label for="" class="form-label col-1">Giá khuyến mãi:</label>
            <input type="number" name="promotion" placeholder="Nhập giá khuyến mãi..." class="form-control @error('promotion') is-invalid @enderror " min='1000' value="{{old("promotion")}}">
            
        </div>
        @error('promotion')
        <p class="alert alert-danger mt-3">{{ $message }}</p>
        @enderror

        @if (session('loi'))
            <div class="alert alert-danger mt-3">{{session('loi')}}</div>
        @endif

        <div class="form-group mb-3 pt-3 d-flex">
            <label for="" class="form-label col-1">Ảnh sản phẩm:</label>
            <img src="assets/img/img.png" alt="">
            <input type="file" name="file"  class="form-control ">
            
        </div>
       
        <div class="form-group pb-3">
            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <a href="/admin/quan-ly-san-pham" class="btn btn-danger">Trở về</a>
        </div>
    </form>
</div>


@endsection

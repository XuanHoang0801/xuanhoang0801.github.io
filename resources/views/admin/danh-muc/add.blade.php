@extends('layouts.app')
@section('title','Thêm mới danh mục')
@section('content')
<div class="container">
    <form action="/admin/danh-muc" method="post">
        @csrf
        @if (session('thongbao'))
            <div class="alert alert-success mt-3">{{session('thongbao')}}</div>
        @endif
        
        <div class="form-group mb-3 pt-3 d-flex">
            <label for="" class="form-label col-1">Tên danh mục:</label>
            <input type="text" name="name" placeholder="Nhập tên danh mục..." class="form-control @error('name') is-invalid @enderror " value="{{old('name')}}">
            @error('name')
                <p class="alert alert-danger mt-3">{{ $message }}</p>
            @enderror
        </div>
       
        <div class="form-group pb-3">
            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <a href="/admin/danh-muc" class="btn btn-danger">Trở về</a>
        </div>
    </form>
</div>
@endsection

@extends('layouts.app')
@section('title','Cập nhật trạng thái đơn hàng')
@section('content')
<div class="container">
    <form action="/admin/trang-thai/{{$status->id}}" method="post">
        @csrf
        @method('put')
        @if (session('thongbao'))
            <div class="alert alert-success mt-3">{{session('thongbao')}}</div>
        @endif
        
        <div class="form-group mb-3 pt-3 d-flex">
            <label for="" class="form-label col-1">Tên trạng thái:</label>
            <input type="text" name="name" placeholder="Nhập tên trạng thái..." class="form-control @error('name') is-invalid @enderror " value="{{$status->name}}">
            
        </div>
        @error('name')
        <p class="alert alert-danger mt-3">{{ $message }}</p>
        @enderror
        <div class="form-group mb-3 pt-3 d-flex">
            <label for="" class="form-label col-1">Màu sắc hiển thị:</label>
            <input type="color" name="color" placeholder="Chọn màu hiển thị..." class="form-control form-control-color @error('color') is-invalid @enderror " value="{{$status->color}}">
            
        </div>  
        @error('color')
        <p class="alert alert-danger mt-3">{{ $message }}</p>
        @enderror
        
        <div class="form-group pb-3">
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="/admin/trang-thai" class="btn btn-danger">Trở về</a>
        </div>
    </form>
</div>
@endsection

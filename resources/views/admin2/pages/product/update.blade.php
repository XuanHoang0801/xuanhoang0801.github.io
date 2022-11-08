@extends('admin2.index')
@section('title','Cập Nhật Sản Phẩm')
@section('url','/ quan-ly-san-pham / '.$product->name.'')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h3>Cập nhật sản phẩm</h3>
          </div>
          <div class="card-body pb-0">
            
              <form class="row g-2" action="/admin/quan-ly-san-pham/{{$product->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                  <div class="col-md-4">
                    <label for="validationDefault01" class="form-label">Tên sản phẩm</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}} {{$product->name}}" name="name" placeholder="Nhập tên sản phẩm...">
                    @error('name')
                    <p class="text-danger mt-3 text-sm">{{ $message }}</p>
                    @enderror

                    <div class="mt-3">
                      <div class="d-flex">
                        <label for="validationDefault02" class="form-label col-4 mx-2 my-2">Giá sản phẩm:</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror price" value="{{old('price')}}{{$product->price}}" name="price" placeholder="Nhập giá sản phẩm..."> 
                        <span class="mx-2 my-2">&#8363</span>
                        @error('price')
                        <p class="text-danger mt-3 text-sm">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="d-flex mt-3">
                        <label for="validationDefault02" class="form-label col-4 mx-2 my-2">Giá khuyến mãi:</label>
                        <input type="number" class="form-control @error('promotion') is-invalid @enderror promotion" value="{{old('promotion')}}{{$product->promotion}}" name="promotion" placeholder="Nhập giá khuyến mãi..."> 
                        <span class="mx-2 my-2">&#8363</span>

                        @error('promotion')
                        <p class="text-danger mt-3 text-sm error"></p>
                        @enderror
                      </div>
                      <div class="d-flex mt-3">
                        <label for="validationDefault02" class="form-label col-4 mx-2 my-2">Số lượng trong kho:</label>
                        <input type="number" class="form-control @error('qty') is-invalid @enderror qty" value="{{old('qty')}}{{$product->qty}}" name="qty" placeholder="Nhập số lượng sản phẩm trong kho..."> 
                        @error('qty')
                        <p class="text-danger mt-3 text-sm error"></p>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label for="validationDefault02" class="form-label">Thể loại</label>
                    <select name="categories"  class="form-select" id="categories" >
                      <option value="{{$product->categories_id}}">{{$product->categories->name}}</option>

                      @foreach ($categories as $cat)
                        @if ($product->categories_id == $cat->id)
                            
                        @else
                            
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endif
                      @endforeach
                    </select>
                    <label for="validationDefault04" class="form-label my-2">Ảnh sản phẩm</label>
                    <input type="file" name="file" id="imageFile"  onchange= "chooseFile(this)"  class="form-control col-4">
                    <img src="/assets/img/{{$product->image}}" id="image" alt="" width="100" class="mt-3">
                  </div>
                  <div class="col-md-2">
                    <label for="validationDefaultUsername" class="form-label">Nhà sản xuất</label>
                    <select name="producer" class="form-select" id="producer">
                      <option value="{{$product->producer_id}}">{{$product->nsx->name}}</option>

                      @foreach ($producer as $pr)
                        @if ($product->producer_id == $pr->id)
                            
                        @else
                            
                        <option value="{{$pr->id}}">{{$pr->name}}</option>
                        @endif
                      @endforeach
                    </select>

                  </div>
                  <label for="validationDefault01" class="form-label">Mô tả sản phẩm</label>
                  <textarea type="text" class="ckeditor @error('body') is-invalid @enderror" value="{{old('body')}}" name="body" placeholder="Nhập mô tả sản phẩm...">{{$product->body}}</textarea>
                  @error('body')
                  <p class="text-danger mt-3 text-sm">{{ $message }}</p>
                  @enderror
                  <div class="col-12">
                    <button class="btn btn-success" type="submit">Cập nhật</button>
                    <a class="btn btn-danger" href="/admin/quan-ly-san-pham">Trở về</a>
                  </div>
              </form> 
          </div>
        </div>
      </div>
    </div>
    @if(session('thongbao'))
    <div class="success" style="position: fixed;right: 0;top: 0;"> 
      <div class="alert alert-success mt-3">{{session('thongbao')}}</div>

     </div>
    @endif
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    
@endsection
@extends('admin2.index')
@section('title','Cập Nhật Bài Viết')
@section('url','/ quan-ly-bai-viet / '.$post->id.'')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h3>Cập nhật bài viết</h3>
          </div>
          <div class="card-body pb-0">
            
              <form class="row g-2" action="/admin/quan-ly-bai-viet/{{$post->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                  <div class="col-md-4">
                    <label for="validationDefault01" class="form-label">Tiêu đề bài viết</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}} {{$post->title}}" name="name" placeholder="Nhập tên sản phẩm...">
                    @error('name')
                    <p class="text-danger mt-3 text-sm">{{ $message }}</p>
                    @enderror
                    
                    
                    
                    <label for="validationDefault02" class="form-label">Thể loại</label>
                    <select name="categories"  class="form-select" id="categories" >
                      <option value="{{$post->categories_id}}">{{$post->categories->name}}</option>
  
                      @foreach ($categories as $cat)
                      @if ($post->categories_id == $cat->id)
                      
                      @else
                      
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="validationDefault04" class="form-label">Ảnh đại diện</label>
                    <input type="file" name="file" id="imageFile"  onchange= "chooseFile(this)"  class="form-control col-4">
                    <img src="/assets/img/{{$post->image}}" id="image" alt="" width="100" class="mt-3">
                  </div>
                  
                  <label for="validationDefault01" class="form-label">Nội dung bài viết</label>
                  <textarea type="text" class="ckeditor @error('body') is-invalid @enderror" value="{{old('body')}}" name="body" placeholder="Nhập mô tả sản phẩm...">{{$post->body}}</textarea>
                  @error('body')
                  <p class="text-danger mt-3 text-sm">{{ $message }}</p>
                  @enderror
                  <div class="col-12">
                    <button class="btn btn-success" type="submit">Cập nhật</button>
                    <a href="/admin/quan-ly-bai-viet" class="btn btn-danger" type="submit">Trở về</a>
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
<script>
   $(document).ready(function()
   {
     
     $('#categories').change(function()
     {
       var idTheLoai = $(this).val();
       $.get("admin/ajax/producer/" +idTheLoai, function(data)
       {
           $("#producer").html(data);
         });
        //  alert(idTheLoai);
        });
        $('.alert').delay(1000).hide(300);
          setTimeout(function() 
          {
            $(".alert").remove();
          }, 2000);

      });
</script>
    
@endsection
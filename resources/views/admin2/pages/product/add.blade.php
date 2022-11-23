@extends('admin2.index')
@section('title','Thêm Sản Phẩm')
@section('url','/ quan-ly-san-pham / create')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h3>Thêm sản phẩm</h3>
          </div>
          <div class="card-body pb-0">
            <div class="table-responsive p-0">
              <form class="row g-3" action="/admin/quan-ly-san-pham" method="post" enctype="multipart/form-data">
                @csrf
                  <div class="col-md-4">
                    <label for="validationDefault01" class="form-label mx-2 my-2">Tên sản phẩm</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" name="name" placeholder="Nhập tên sản phẩm...">
                    @error('name')
                    <p class="text-danger mt-3 text-sm">{{ $message }}</p>
                    @enderror

                    <div class="mt-3">
                      <div class="d-flex mb-3">
                        <label for="validationDefault02" class="form-label col-4 mx-2 my-2">Giá sản phẩm:</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror price" value="{{old('price')}}" name="price" placeholder="Nhập giá sản phẩm...">
                        <span class="mx-2 my-2">&#8363</span>

                      </div>
                      @error('price')
                      <p class="text-danger mt-3 text-sm">{{ $message }}</p>
                      @enderror
                        
                      {{-- <div class="d-flex">
                        <label for="validationDefault02" class="form-label col-4 mx-2 my-2">Giá khuyến mãi:</label>
                        <input type="number" class="form-control @error('promotion') is-invalid @enderror promotion" value="{{old('promotion')}}" name="promotion" placeholder="Nhập giá khuyến mãi..."> 
                        <span class="mx-2 my-2">&#8363</span>
                      </div>
                      @error('promotion')
                      <p class="text-danger mt-3 text-sm">{{ $message }}</p>
                      @enderror --}}

                      <div class="d-flex mt-3">
                        <label for="validationDefault02" class="form-label col-4 mx-2 my-2">Số lượng trong kho:</label>
                        <input type="number" class="form-control  @error('qty') is-invalid @enderror qty" value="{{old('qty')}}" name="qty" placeholder="Nhập số lượng sản phẩm..."> 
                      </div>
                      @error('qty')
                      <p class="text-danger mt-3 text-sm">{{ $message }}</p>
                      @enderror
                      
                    </div>

                  </div>
                  <div class="col-md-3">
                    <label for="validationDefault02" class="form-label">Thể loại</label>
                    <select name="categories"  class="form-select" id="categories" >
                      @foreach ($categories as $cat)
                      <option value="{{$cat->id}}">{{$cat->name}}</option>
                      @endforeach
                    </select>
                    <label for="validationDefault04" class="form-label mt-3">Ảnh sản phẩm</label>
                    <input type="file" name="file" id="imageFile"  onchange= "chooseFile(this)"  class="form-control col-4">
                    <img src="assets/img/img.png" alt="" srcset="" width="100" id="image" class="mt-3">
                    <label for="validationDefault04" class="form-label mt-3">Album</label>
                    <input type="file" name="album[]" multiple  id="imageFile"  onchange= "chooseFile(this)"  class="form-control col-4">
                    <img src="assets/img/img.png" alt="" srcset="" width="100" id="image" class="mt-3">

                  </div>
                  <div class="col-md-3">
                    <label for="validationDefaultUsername" class="form-label">Nhà sản xuất</label>
                    <select name="producer" class="form-select" id="producer">
                      @foreach ($producer as $pr)
                          <option value="{{$pr->id}}">{{$pr->name}}</option>
                      @endforeach
                    </select>

                  </div>
                  
                  <label for="validationDefault01" class="form-label">Mô tả sản phẩm</label>
                  <textarea type="text" class="ckeditor @error('body') is-invalid @enderror" value="{{old('body')}}" name="body" placeholder="Nhập mô tả sản phẩm..."></textarea>
                  @error('body')
                  <p class="text-danger mt-3 text-sm">{{ $message }}</p>
                  @enderror
                  <div class="col-12">
                    <button class="btn btn-primary" type="submit">Thêm mới</button>
                    <a href="/admin/quan-ly-san-pham" class="btn btn-danger" >Trở về</a>
                  </div>
              </form>
            </div>
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
  //  $(document).ready(function()
  //  {
     
  //    $('#categories').change(function()
  //    {
  //      var idTheLoai = $(this).val();
  //      $.get("admin/ajax/producer/" +idTheLoai, function(data)
  //      {
  //          $("#producer").html(data);
  //        });
  //       //  alert(idTheLoai);
  //       });
  //       $('.alert').delay(1000).hide(300);
  //         setTimeout(function() 
  //         {
  //           $(".alert").remove();
  //         }, 2000);

  //     });



</script>
    
@endsection
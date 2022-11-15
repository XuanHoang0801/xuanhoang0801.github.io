@extends('admin2.index')
@section('title','Quản Lý Trạng Thái Đơn Hàng')
@section('url','/ trang-thai')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h3>Quản lý trạng thái đơn hàng </h3>
            <div class="btn btn-primary btn-sm col-2 add">Thêm mới</div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">STT</th>
                    <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">Trạng thái</th>
                    <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">Màu sắc</th>
                    <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">Hành động</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $stt=1 ?>
                    @foreach ($status as $item)
                        
                    <tr>
                      <td>
                          <p class=" text-secondary text-center">{{$stt++}}</p>   
                      </td>
                      
                      <td>
                        <p class="font-weight-bold mb-0">{{$item->name}}</p> 
                      </td>
                      <td class="text-center">
                        <span class="badge badge-sm " style="background:{{$item->color}}"> Color</span>

                      </td>
                      
                     
                      <td class=" d-flex justify-content-center text-sm">
                        <a href="admin/trang-thai/{{$item->id}}" class="btn btn-success" title="Chỉnh sửa"><i class="fas fa-pen"></i></a>
                        <div style="height: 100%;width:5px"></div>
                        <form action="admin/trang-thai/{{$item->id}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" title="Xóa" onclick="return confirm('Bạn chắc chắn muốn xóa danh mục này không?')"><i class="fas fa-trash"></i></button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  
                </tbody>
              </table>
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
   $(document).ready(function(){
    $('.alert').delay(1000).hide(300);
                setTimeout(function() {
                $(".alert").remove();
                }, 2000);
   });

</script>
    
<script>
    $(document).ready(function(){
      
      $('.add').click(function(){
        window.location.href = "/admin/trang-thai/create";
      });

    });
</script>

    
@endsection
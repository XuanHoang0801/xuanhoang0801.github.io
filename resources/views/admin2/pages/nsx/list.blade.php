@extends('admin2.index')
@section('title','Quản Lý Nhà sản xuất')
@section('url','/ nha-san-xuat')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h3>Quản lý nhà sản xuất</h3>
            <div class="btn btn-primary btn-sm col-2 add">Thêm mới</div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">STT</th>
                    <th class=" text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Nhà sản xuất</th>
                    <th class=" text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Các loại sản phẩm</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Hành động</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $stt=1 ?>
                    @foreach ($producer as $item)
                        
                    <tr>
                      <td>
                          <p class=" text-center text-secondary ">{{$stt++}}
                          
                      </td>
                      <td>
                        <p class="text-uppercase font-weight-bold mb-0">{{$item->name}}</p>
                      </td>
                      <td>
                        @foreach ($item->categories_id as $s)
                          <span>{{$s}},</span>
                        @endforeach

                      </td>
                      <td class=" d-flex justify-content-center text-sm">
                        <a href="admin/nha-san-xuat/{{$item->id}}" class="btn btn-success" title="Chỉnh sửa"><i class="fas fa-pen"></i></a>
                        <div style="height: 100%;width:5px"></div>
                        <form action="admin/nha-san-xuat/{{$item->id}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tất cả sản phẩm liên quan sẽ bị xóa. Bạn chắc chắn muốn xóa nhà sản xuất này không?')" title="Xóa"><i class="fas fa-trash"></i></button>
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
        window.location.href = "/admin/nha-san-xuat/create";
      });

    });
</script>

    
@endsection
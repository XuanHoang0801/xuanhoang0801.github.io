@extends('admin2.index')
@section('title','Danh Sách Khách Hàng')
@section('url','/ danh-sach-khach-hang')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h3>Danh sách khách hàng</h3>
            {{-- <div class="btn btn-success btn-sm col-2 delivered">Đơn hàng đã giao</div>
            <div class="btn btn-warning btn-sm col-2 garde">Đơn hàng bị hủy</div> --}}

          </div>
        
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-center text-uppercase text-secondary  text-xs  font-weight-bolder opacity-7">STT</th>
                    <th class="text-center text-uppercase text-secondary  text-xs  font-weight-bolder opacity-7">Tên đăng nhập</th>
                    <th class="text-center text-uppercase text-secondary  text-xs font-weight-bolder opacity-7"></th>
                    <th class="text-center text-uppercase text-secondary  text-xs font-weight-bolder opacity-7">Họ tên</th>
                    {{-- <th class="text-center text-uppercase text-secondary  text-xs font-weight-bolder opacity-7">SL</th>
                    <th class="text-center text-uppercase text-secondary  text-xs font-weight-bolder opacity-7">Đơn giá</th> --}}
                    <th class="text-center text-uppercase text-secondary  text-xs font-weight-bolder opacity-7">Email</th>
                    <th class="text-center text-uppercase text-secondary  text-xs font-weight-bolder opacity-7">Điện thoại</th>
                     <th class="text-center text-uppercase text-secondary  text-xs font-weight-bolder opacity-7">Địa chỉ</th>
                    {{-- <th class="text-center text-uppercase text-secondary  text-xs font-weight-bolder opacity-7">Trạng thái</th>  --}}
                    <th class="text-center text-uppercase text-secondary  text-xs font-weight-bolder opacity-7">Hành động</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $stt=1 ?>
                    @foreach ($client as $item)
                    @if ($item->status_id ==4)
                        
                    @else
                        
                    <tr>
                      <td>
                        <p class=" text-xs text-secondary text-center">{{$stt++}}</p>   
                      </td>
                      <td>
                        <p class="text-xs">{{$item->name}}</p>
                      </td>
                      <td>
                        <img src="/assets/img/{{$item->image}}" alt="" width="30">
                      </td>
                      <td>
                        <p class="font-weight-bold mb-0 text-xs">{{$item->fullname}}</p> 
                      </td>
                     
                      <td class="text-center">
                        <p class="font-weight-bold mb-0 text-xs">{{$item->email}}</p> 
                      </td>
                      <td class="text-center">
                        <p class="font-weight-bold mb-0 text-xs">{{$item->phone}}</p> 
                      </td>
                      <td class="text-center">
                        <p class="font-weight-bold mb-0 text-xs">{{$item->address}}</p> 
                      </td>
                     
                      <td class=" d-flex justify-content-around text-sm">
                      
                        <a href="admin/khach-hang/{{$item->id}}" class="btn btn-primary" title="Chi tiết"><i class="fas fa-eye"></i></a>
                        
                        {{-- <div style="height: 100%;width:5px"></div>
                        <form action="admin/quan-ly-don-hang/{{$item->id}}" method="post">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa đơn hàng này không?')"><i class="fas fa-trash"></i></button>
                        </form> --}}
                      </td>
                    </tr>
                    @endif

                    @endforeach
                </tbody>
              </table>
              <div class="d-flex justify-content-center">
              {{$client->links('paginate')}}
              </div>
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
   $(document).ready(function()
   {
      $('.alert').delay(1000).hide(300);
        setTimeout(function() 
        {
          $(".alert").remove();
        }, 
      2000);

      $('.garde').click(function()
      {
        window.location.href = "/admin/quan-ly-don-hang/don-huy";
      });

      $('.delivered').click(function()
      {
        window.location.href = "/admin/quan-ly-don-hang/da-giao";
      });
    });
</script>
@endsection
@extends('admin2.index')
@section('title','Sản Phẩm Đã Xóa')
@section('url','/ san-pham')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h3>Sản phẩm đã xóa</h3>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">STT</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7"></th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Sản phẩm</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Giá</th>
                    {{-- <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Giá km</th> --}}
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Thể loại</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Nhà sản xuất</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Người đăng</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Hành động</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $stt=1 ?>
                    @foreach ($product as $item)
                        
                    <tr>
                      <td>
                          <p class=" text-secondary text-center">{{$stt++}}</p>   
                      </td>
                      <td>

                        <img src="assets/img/{{$item->image}}" alt="" width="35">
                      </td>
                      <td>
                        <p class="text-uppercase font-weight-bold mb-0">{{$item->name}}</p> 
                      </td>
                      <td>
                        <p class="font-weight-bold mb-0 text-danger">{{number_format($item->price)}} &#8363</p>
                      </td>
                      {{-- <td>
                        <p class="font-weight-bold mb-0 text-primary">{{number_format($item->promotion)}} &#8363</p>
                      </td> --}}
                      <td>
                        <p class="font-weight-bold mb-0 text-center ">{{$item->categories->name}}</p>
                      </td>
                      <td>
                        <p class="text-uppercase font-weight-bold mb-0 text-center">{{$item->nsx->name}}</p>
                      </td>
                      <td>
                        <p class="font-weight-bold mb-0 text-center">{{$item->users->name}}</p>
                      </td>
                      <td class=" d-flex justify-content-center text-sm">
                        <a href="admin/quan-ly-san-pham/khoi-phuc/{{$item->id}}" class="btn btn-success" title="Khôi phục" onclick="return confirm('Bạn có chắc hắn muốn khôi phục sản phẩm này không!')"><i class="fas fa-undo"></i></a>
                        <div style="height: 100%;width:5px"></div>
                   
                        <form action="admin/quan-ly-san-pham/xoa/{{$item->id}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" title="Xóa" onclick="return confirm('Bạn chắc chắn muốn xóa vĩnh viễn sản phẩm này không?')"><i class="fas fa-trash"></i></button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  
                </tbody>
              </table>
              <div class="d-flex justify-content-center">

                {{$product->links('paginate')}}
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
        window.location.href = "/admin/quan-ly-san-pham/create";
      });

    });
</script>

    
@endsection
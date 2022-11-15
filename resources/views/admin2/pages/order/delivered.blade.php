@extends('admin2.index')
@section('title','Đơn Hàng Đã Giao')
@section('url','/ quan-ly-don-hang / da-giao')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h3>Đơn hàng đã giao</h3>
          </div>
        
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-center text-uppercase text-secondary  text-xs  font-weight-bolder opacity-7">STT</th>
                    <th class="text-center text-uppercase text-secondary  text-xs  font-weight-bolder opacity-7">Mã đơn hàng</th>
                    <th class="text-center text-uppercase text-secondary  text-xs font-weight-bolder opacity-7"></th>
                    <th class="text-center text-uppercase text-secondary  text-xs font-weight-bolder opacity-7">Sản phẩm</th>
                    {{-- <th class="text-center text-uppercase text-secondary  text-xs font-weight-bolder opacity-7">SL</th>
                    <th class="text-center text-uppercase text-secondary  text-xs font-weight-bolder opacity-7">Đơn giá</th> --}}
                    <th class="text-center text-uppercase text-secondary  text-xs font-weight-bolder opacity-7">Khách hàng</th>
                    <th class="text-center text-uppercase text-secondary  text-xs font-weight-bolder opacity-7">Tổng tiền</th>
                    <th class="text-center text-uppercase text-secondary  text-xs font-weight-bolder opacity-7">Ngày lập HĐ</th>
                    <th class="text-center text-uppercase text-secondary  text-xs font-weight-bolder opacity-7">Trạng thái</th>
                    <th class="text-center text-uppercase text-secondary  text-xs font-weight-bolder opacity-7">Hành động</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $stt=1 ?>
                    @foreach ($order as $item)
                    
                        
                    <tr>
                      <td>
                        <p class=" text-xs text-secondary text-center">{{$stt++}}</p>   
                      </td>
                      <td>
                        <p class="text-xs">{{$item->order_id}}</p>
                      </td>
                      <td>
                        <img src="/assets/img/{{$item->products->image}}" alt="" width="30">
                      </td>
                      <td>
                        <p class="font-weight-bold mb-0 text-xs">{{$item->products->name}}</p> 
                      </td>
                      <td class="text-center">
                        <p class="font-weight-bold mb-0 text-xs">{{$item->users->name}}</p> 
                      </td>
                      <td class="text-center">
                        <p class="font-weight-bold mb-0 text-xs text-danger">{{number_format($item->total)}} &#8363</p> 
                      </td>
                      <td class="text-center">
                        <p class="font-weight-bold mb-0 text-xs">{{$item->created_at->format(' H:i:s - d/m/Y')}}</p> 
                      </td>
                      <td class="text-center">
                        <p class="font-weight-bold mb-0 text-xs" style="color:{{$item->statuses->color}}">{{$item->statuses->name}}</p> 
                      </td>
                      <td class=" d-flex justify-content-around text-sm">
                       
                        <a href="admin/quan-ly-don-hang/{{$item->id}}" class="btn btn-primary" title="Chi tiết"><i class="fas fa-eye"></i></a>
                       
                        <div style="height: 100%;width:5px"></div>
                        <form action="admin/quan-ly-don-hang/{{$item->id}}" method="post">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-danger" title="Xóa" onclick="return confirm('Bạn chắc chắn muốn xóa đơn hàng này không?')"><i class="fas fa-trash"></i></button>
                        </form>
                      </td>
                    </tr>
                  

                    @endforeach
                </tbody>
              </table>
              <div class="d-flex justify-content-center">
                {{-- {{$order->links('paginate')}} --}}
              </div>
              <a href="/admin/quan-ly-don-hang" class="btn btn-danger">Trở về</a>
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

@endsection
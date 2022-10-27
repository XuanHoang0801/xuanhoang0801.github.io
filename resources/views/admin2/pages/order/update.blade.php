@extends('admin2.index')
@section('title','Cập Nhật Trạng Thái Đơn Hàng')
@section('url','/ quan-ly-don-hang/{{$order->id}}')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h3>Cập nhật trạng thái đơn hàng</h3>
          </div>
          <div class="card-body pb-0">
            <div class="table-responsive p-0">
              <form action="/admin/quan-ly-don-hang/{{$order->id}}" method="post">
                @csrf
                @method('put')
                
                <div class="d-flex justify-content-around mt-3 mb-3">
                    <div class="product">
                        <div class="form-group">
                            <label for="" class="form-label">Sản phẩm:</label>
                            <img src="assets/img/{{$order->products->image}}" alt="" width="50">
                                
                            {{$order->products->name}}
                            
                        </div>
                        
                        <div class="form-group mb-3 pt-3 ">
                            <label for="" class="form-label ">Số lượng:</label>
                            {{$order->amount}}
                            
                        </div>  
                
                        <div class="form-group">
                            <label for="" class="form-label ">Giá:</label>
                            {{number_format($order->products->price)}} &#8363
                        </div> 
                        
                        <div class="form-group mb-3 pt-3">
                            <label for="" class="form-label ">Tổng tiền:</label>
                            <span class="text-danger">{{number_format($order->total)}} &#8363</span>
                        </div>
        
                        <div class="form-group mb-3 pt-3">
                            <label for="" class="form-label ">Ngày lập:</label>
                            <span class="text-primary">{{$order->created_at->format(' H:i:s - d/m/Y')}}</span>
                        </div>
                    </div>
        
                    <div class="user">
                        <div class="form-group mb-3 pt-3">
                            <label for="" class="form-label ">Khách hàng:</label>
                            <span >{{$order->users->name}}</span>
                        </div>
                
                        <div class="form-group mb-3 pt-3">
                            <label for="" class="form-label ">Email:</label>
                            <span >{{$order->users->email}}</span>
                        </div>
                
                        <div class="form-group mb-3 pt-3 ">
                            <label for="" class="form-label ">Số điện thoại:</label>
                            <span >{{$order->users->phone}}</span>
                        </div>
                
                        <div class="form-group mb-3 pt-3">
                            <label for="" class="form-label ">Địa chỉ nhận hàng:</label>
                            <span >{{$order->address}}</span>
                        </div>
                    </div>
                </div>
        
                <div class="form-group mb-3 pt-3">
                    <label for="" class="form-label ">Trạng thái đơn hàng:</label>
                    <select class="form-select col-3" aria-label="Default select example" name="status">
                      
                        <option value="{{$order->statuses->id}}">{{$order->statuses->name}}</option>
                        
                            
                        @foreach ($status as $item)
                        @if ($order->statuses->id == $item->id)
                            
                        @else
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endif
                        @endforeach
                       
                      </select>
                </div>
                
                
                
                @error('color')
                <p class="alert alert-danger mt-3">{{ $message }}</p>
                @enderror
                
                <div class="form-group pb-3">
                    <button type="submit" class="btn btn-success">Cập nhật</button>
                    <a href="/admin/quan-ly-don-hang" class="btn btn-danger">Trở về</a>
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
   $(document).ready(function(){
    $('.alert').delay(1000).hide(300);
                setTimeout(function() {
                $(".alert").remove();
                }, 2000);
   });

</script>
    
@endsection
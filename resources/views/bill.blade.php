@extends('home')
@section('title','Thông tin đơn hàng')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="card">
                @if ($order->isEmpty())
                    <div class="alert alert-danger mt-3 mx-3">Bạn không có đơn hàng nào!</div>
                @else
                    
                <h1 class="card-header text-center bg-warning">Thông tin đơn hàng</h1>
                <h3 class="text-center mt-3">Thông tin của bạn</h3>
            
                    
                    <table class="table">
                        <thead>
                            <tr>
                                
                                <th scope="col">Họ tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Địa chỉ nhận hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                                <td>{{Auth::user()->name}}</td>
                                <td>{{Auth::user()->email}}</td>
                                <td>{{Auth::user()->phone}}</td>
                                <td>
                                    <div class="mb-1">
                                        
                                        {{Auth::user()->address}}
                                        
                                    </div>
                                </td>
                            </tr>
                            
                        </tbody>
                </table>
                <table class="table table-striped">
                    <h3 class="text-center">Thông tin đơn hàng</h3>
                    <thead>
                        <tr class="text-center">
                            
                            <th scope="col">STT</th>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Ngày lập hóa đơn</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php $stt=1;?>
                        @foreach ($order as $item)
                        
                       
                        <tr >
                            
                            <th  class="text-center">{{$stt++}}</th>
                            <td  class="text-center">{{$item->order_id}}</td>
                            <td class="d-flex">
                                <a href="/san-pham/{{$item->product_id}}">

                                    <img src="assets/img/{{$item->products->image}}" alt="" srcset="" width="50">
                                    <span class="ml-3">{{$item->products->name}}</span>
                                </a>
                            </td>
                            <td  class="text-center">{{number_format($item->products->price)}} &#8363</td>
                            <td  class="text-center" >
                                <span>{{$item->amount}}</span>
                                
                            </td>
                            
                            <td class="text-center text-danger">
                                {{number_format($item->total)}}  &#8363
                            </td>
                            <td class="text-center">{{$item->created_at->format('d-m-Y  H:i:s')}}</td>
                            <td class="text-center">
                                <div class="" style="color:{{$item->statuses->color}}; border-radius:2rem">{{$item->statuses->name}}</div>
                            </td>
                            <td class="text-center">
                                @if ($item->status_id == 4)
                                    
                                @else
                                <form action="/don-hang/{{$item->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-warning" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng không?')">Hủy đơn hàng</button>
                                </form>
                                    
                                @endif
                            </td>
                        </tr>
                  
                    @endforeach
                    
                </tbody>
            </table>  
            
            
        </form>
        @endif
    </div>
</div>
</div>
</div>
@endsection
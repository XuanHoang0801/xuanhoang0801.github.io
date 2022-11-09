@extends('home')
@section('title','Đơn hàng đã giao')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="card">
                @if ($order->isEmpty())
                    <div class="alert alert-danger mt-3 mx-3">Bạn không có đơn hàng nào!</div>
                @else
                                    
                <h1 class="card-header text-center bg-warning">Đơn hàng đã giao</h1>

                <table class="table table-striped">
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
                            <td >
                                <a class="d-flex" href="/san-pham/{{$item->product_id}}">

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
                                <div class="d-flex">
                                    <a href="/don-hang/{{$item->id}}" class="btn btn-primary mr-2" title="Chi tiết"><i class="far fa-eye"></i></a>
                                    <a href="/san-pham/{{$item->product_id}}" class="btn btn-success" >Mua tiếp</a>      
                                </div>
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
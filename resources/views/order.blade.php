@extends('home')
@section('title','Đặt hàng')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="card">
                <h1 class="card-header text-center bg-warning">Đặt hàng</h1>
                <h3 class="text-center">Thông tin của bạn</h3>
                <form action="/don-hang" method="post">
                    @csrf
                
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
                        
                        <td>{{Auth::user()->fullname}}</td>
                        <td>{{Auth::user()->email}}</td>
                        <td>
                            <input type="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Nhập số điện thoại của bạn..." value="{{Auth::user()->phone}}">
                            @error('phone')
                            <div class="mt-3 btn alert-danger">{{$message}}
                           @enderror
                        </td>
                        <td>
                            <div class="mb-3">
                                <textarea class="form-control @error('address') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" name="address"placeholder="Nhập địa chỉ nhận hàng của bạn...">{{Auth::user()->address}}</textarea>
                                @error('address')
                                 <div class="mt-3 btn alert-danger">{{$message}}
                                @enderror
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
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thành tiền</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $stt=1;
                            $sum=0;
                         ?>
                        @foreach ($cart as $cart)
                        <tr >
                           
                            <th  class="text-center">{{$stt++}}</th>
                            <td class="d-flex">
                                {{-- <img src="assets/img/{{$item->image}}" alt="" srcset="" width="50"> --}}
                                <input type="hidden" name="id[]" value="{{$cart->rowId}}">
                                <span class="ml-3">{{$cart->name}}</span>
                            </td>
                            <td  class="text-center">{{number_format($cart->price)}} &#8363</td>
                            <td  class="text-center" >
                                <span>{{$cart->qty}}</span>

                            </td>
                            <td class="text-center">
                                <span class="text-primary">{{number_format($cart->price* $cart->qty)}} &#8363</span>
                            </td>
                        </tr>
                        
                        <?php 
                           $tt=$cart->price * $cart->qty;
                            $sum += $tt;
                            ?>
                            {{-- <input type="text" name="total" value="{{$tt}}"> --}}
                        @endforeach
                        
                      </tbody>
                    </table>  
                    <div class="text-danger d-flex justify-content-end mr-3">Tổng tiền: <span>{{number_format($sum)}}  &#8363</span>
                        
                    </div>
                    <div class="d-flex justify-content-end ">

                        <button type="submit" class="btn btn-warning">Đặt hàng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('home')
@section('title','Giỏ hàng của bạn')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header ">Giỏ hàng của bạn</div>
                @if (session('thongbao'))
                    <div class="alert alert-success mt-3 mx-3">{{session('thongbao')}}</div>
                @endif
                @if (session('loi'))
                    <div class="alert alert-danger mt-3 mx-3">{{session('loi')}}</div>
                @endif
                @if ($card->isEmpty())
                <div class="alert alert-danger mt-3 mx-3 ">
                    Không tồn tại sản phẩm nào trong giỏ hàng của bạn!
                    <a href="/" class="text-primary">Mua ngay</a>
                </div>
                @else
                <div class="empty">

                </div>
                    <table class="table table-striped">
                        <thead>
                        <tr class="text-center">
                            <th></th>
                            <th scope="col">STT</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                            <th scope="col">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $stt=1;
                                $sum=0;
                            ?>
                        <form action="dat-hang" method="post"> 
                            @csrf 
                          
                            @foreach ($card as $item)
                           
                            <tr data-id="{{$item->rowId}}">
                                    <th class="text-center">
                                        <input type="checkbox" name="check[]" class="checkbox" value="{{$item->rowId}}">
                                    </th>
                                    <th  class="text-center">{{$stt++}}
                                    </th>
                                    <td class="d-flex">
                                        {{-- <img src="assets/img/{{$item->image}}" alt="" srcset="" width="50"> --}}
                                        <a href="/san-pham/{{$item->id}}"><span class="ml-3">{{$item->name}}</span></a>
                                        
                                    </td>
                                    <td class="text-center">
                                   
                                         <span>{{number_format($item->price)}} &#8363</span>
                                         <input type="hidden" name="price" value="{{$item->price}}" class="price">
                                        </td>  
                                    <td  class="text-center" >
                                        <input type="number" value="{{$item->qty}}" name="amount" min="1" max="100" style="width:50px;text-align: center" class="amount">
                                    </td>
                                    <td class="text-center">
                                        <span class="text-primary  tt" id="tt-{{$item->rowId}}">{{number_format($item->price* $item->qty)}} &#8363</span>
                                    </td>
                                    <td class="text-center">
                                        <button  type="button"  class="btn btn-danger btn-sm delete" name="delete"value="{{$item->rowId}}">Xóa</button>
                                    </td>
                            </tr>
                            <?php 
                            $tt=$item->price * $item->qty;
                            $sum += $tt;
                            ?>
                            @endforeach
                        </tbody>
                    </table>  
                    
                    <div class="text-danger d-flex justify-content-end mr-3 mb-3" id="sum">
                        Tổng tiền: <span >{{number_format($sum)}}  &#8363</span>
                    </div>
                    <div class="d-flex justify-content-end mb-2 mr-2">

                        <button type="submit" class="btn btn-success col-1  text-end add">Đặt hàng</button>
                    </div>
                </form>
                    @endif
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
{{-- <script>
    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
--}}
<script>
    $(document).ready(function(){
      
        $('.amount').change(function(){
            var id=$(this).parents('tr').attr('data-id');
            var qty=$(this).val();
            var price=$('.price').val();
            $.post("ajax/cart-update",
            {
                _token: '{{ csrf_token() }}',
                id:id,
                amount:qty,
                price:price,
            },
            function(data){
               $('#tt-'+id).html(data['price'].toLocaleString('en-US') +'&#8363');
               var sum=0;
               $('#sum').html('Tổng tiền:'+ data['total'] +"&#8363");
               $('.amount-cart').html(data['qty']);
            }); 

        });
    });

</script>

<script>
    $(document).ready(function(){
     
     $('.delete').click(function(){
       var id = $(this).val();
       $(this).parent().parent().remove();
       $.get("/ajax/cart-delete/" +id, function(data){
       var sum=0;
               $('.tt').each(function () {
                   var tt = parseFloat($(this).text());
                   sum = sum + tt;
               });
               if (sum == 0) 
               {
                   var text= '<div class="alert alert-danger mt-3 mx-3"> Không tồn tại sản phẩm nào trong giỏ hàng của bạn! <a href="/" class="text-primary">Mua ngay</a></div>';
                   $('.empty').html(text);
                   $('table').remove();
                   $('#sum').remove();
                   $('.add').remove();
               }
               else
               {
                    $('#sum').html('Tổng tiền:'+ data['total'] +"&#8363");
                }
                $('.amount-cart').html(data['amount']);
       });
     });
 });
</script>

@endsection
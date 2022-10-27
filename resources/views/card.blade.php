@extends('home')
@section('title','Giỏ hàng của bạn')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header ">Giỏ hàng của bạn</div>
                @if (session('thongbao'))
                    <div class="alert alert-success mt-3">{{session('thongbao')}}</div>
                @endif
                @if (session('loi'))
                    <div class="alert alert-danger mt-3">{{session('loi')}}</div>
                @endif
                @if ($card->isEmpty())
                <div class="alert alert-danger mt-3 ">
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
                          
                           <button type="submit" class="btn btn-success col-1 text-center add">Đặt hàng</button>
                            @foreach ($card as $item)
                           
                            <tr>
                                    <th class="text-center"><input type="checkbox" name="check[]" class="checkbox" value="{{$item->id}}"></th>
                                    <th  class="text-center">{{$stt++}}</th>
                                    <td class="d-flex">
                                        <img src="assets/img/{{$item->products->image}}" alt="" srcset="" width="50">
                                        <span class="ml-3">{{$item->products->name}}</span>
                                    </td>
                                    <td >
                                         <span >{{number_format($item->products->price)}} &#8363</span>
                                         <input type="hidden" name="price" value="{{$item->products->price}}" class="price">
                                        </td>  
                                    <td  class="text-center" >
                                        <input type="number" value="{{$item->amount}}" name="amount" min="1" max="100" style="width:50px;text-align: center" class="amount" onchange="updateCart(this.value.{{$item->id}})">
                                    </td>
                                    <td>
                                        <span class="text-primary tt" id="tt-{{$item->id}}">{{number_format($item->products->price* $item->amount)}} &#8363</span>
                                    </td>
                                    <td class="text-center">
                                        <button  type="button"  class="btn btn-danger btn-sm delete" name="delete"value="{{$item->id}}">Xóa</button>
                                    </td>
                            </tr>
                            <?php 
                            $tt=$item->products->price * $item->amount;
                            $sum += $tt;
                            ?>
                            @endforeach
                        </form>
                        </tbody>
                    </table>  
                    
                    <div class="text-danger d-flex justify-content-end mr-3" id="sum">
                        Tổng tiền: <span>{{number_format($sum)}}  &#8363</span>
                    </div>
                    @endif
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script>
    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>

<script>
    function updateCart(qty,id){
        $.get(
            '{{asset('cart/update')}}',
            {amount:qty,id:id},function(data){
                $('#tt-'+id).html(data);

                var price = $('.price').val();
                var amount = $('.amount').val();
                // console.log(price,amount);
                var sum=0;
                $('.tt').each(function () {
                    var tt = parseFloat($(this).text());
                    sum = sum + tt;
                });
                $('#sum').html('Tổng tiền:'+ (sum.  +"&#8363");
            });   
        }
 </script>

 <script>
    // $(document).ready(function(){
    //     function thanhtien($index){
    //         var price = $index.find('.price').val();
    //         var amount = $index.find('.amount').val();
    //         var tt= parseFloat(price) * parseFloat(amount);
    //         $index.find('.tt').text(tt.toLocaleString('en-US')+" ₫");
    //     }
    //     function sum(){
    //         var tt=0;
    //         var sum=0;
    //         $('tr').each(function(){
    //             var price = $(this).find('.price').val();
    //             var amount = $(this).find('.amount').val();
    //              tt= parseFloat(price) * parseFloat(amount);
    //             sum =sum+parseInt(tt);
    //             // alert(tt);
    //         });
    //         // console.log(sum);
    //             alert(sum);

    //         // $('#sum').html(sum.toLocaleString('en-US')+" ₫");


                    
    //     }
    //     $(document).on('change', '.amount',function(){
    //         var myTr = $(this).parent().parent();
    //         thanhtien(myTr);
    //         sum(myTr);

    //     });
    // });
 </script>

 <script>
     $(document).ready(function(){
      
      $('.delete').click(function(){
        var id = $(this).val();
        $(this).parent().parent().remove();
        $.get("/cart/delete/" +id, function(data){
        var sum=0;
                $('.tt').each(function () {
                    var tt = parseFloat($(this).text());
                    sum = sum + tt;
                });
                if (sum == 0) 
                {
                    var text= '<div class="alert alert-danger mt-3 "> Không tồn tại sản phẩm nào trong giỏ hàng của bạn!<a href="/" class="text-primary">Mua ngay</a></div>';
                    $('.empty').html(text);
                    $('table').remove();
                    $('#sum').remove();
                    $('.add').remove();
                }
                else
                {
                    $('#sum').html('Tổng tiền:'+ (sum.toLocaleString('en-US')) +"&#8363");
                }
        });
      });
  });
 </script>

@endsection
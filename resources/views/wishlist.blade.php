@extends('home')
@section('title','Sản phẩm yêu thích')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="card">
                <h3 class="card-header h3 ">Sản phẩm yêu thích</h3>
                @if (session('thongbao'))
                    <div class="alert alert-success mt-3">{{session('thongbao')}}</div>
                @endif
                @if (session('loi'))
                    <div class="alert alert-danger mt-3">{{session('loi')}}</div>
                @endif
                @if ($wishlist->isEmpty())
                <div class="alert alert-danger mt-3 ">
                    Không tồn tại sản phẩm nào trong mục yêu thích của bạn của bạn!
                    <a href="/" class="text-primary">Xem ngay</a>
                </div>
                @else
                <div class="empty">

                </div>
                    <table class="table table-striped">
                        <thead>
                        <tr class="text-center">
                            <th scope="col">STT</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $stt=1;
                                $sum=0;
                            ?>
                        
                            @foreach ($wishlist as $item)
                            
                            <tr data-id="{{$item->products->id}}">
                                
                                <th  class="text-center">{{$stt++}}
                                </th>
                                <td class="d-flex">
                                           <a href="/san-pham/{{$item->products->id}}">
                                            <img src="assets/img/{{$item->products->image}}" alt="" srcset="" width="50">
                                            <span class="ml-3 name">{{$item->products->name}}</span>
                                            </a>
                                           
                                       </td>
                                       <td class="text-center">
                                      
                                            <span>{{number_format($item->products->price)}} &#8363</span>
                                            <input type="hidden" name="price" value="{{$item->products->price}}" class="price" >
                                           </td>  
                                       {{-- <td  class="text-center" >
                                           <input type="number" value="{{$item->qty}}" name="amount" min="1" max="100" style="width:50px;text-align: center" class="amount">
                                       </td> --}}
                                       
                                       <td class="text-center">
                                           <button  type="button"  class="btn btn-success btn-sm add-cart" name="delete"><i class="fas fa-cart-plus"></i></button>
                                           <button  type="button"  class="btn btn-danger btn-sm delete" name="delete"value="{{$item->id}}"><i class="fas fa-trash-alt"></i></button>
                                       </td>
                               </tr>
                            <div class="success" style="position: fixed;right: 0;top: 0;"> 
                                <div class="alert"></div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>  
                    
                   
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
      
        $('.add-cart').click(function(){
            var id=$(this).parents('tr').attr('data-id');
            $.post("/ajax/add-cart-index",
            {
                _token: '{{ csrf_token() }}',
                id:id,
            },
            function(data){
                $('.success').html(data['success']);
                $('.alert').delay(1000).hide(300);
                setTimeout(function() {
                  $(".alert").remove();
                  }, 2000);
            }); 
            // alert(id);

        });
    });

</script>

<script>
    $(document).ready(function(){
     
     $('.delete').click(function(){
       var id = $(this).val();
       $(this).parent().parent().remove();
       $.get("/ajax/wishlist-delete/" +id, function(data){
            $('.success').html(data['success']);
            $('.alert').delay(1000).hide(300);
            setTimeout(function() {
            $(".alert").remove();
            }, 2000);
            $('.amount-wishlist').html(data['amount']);

       });
     });
 });
</script>

@endsection
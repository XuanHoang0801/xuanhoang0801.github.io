@extends('home')
@section('title',''.$product->name.'')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="detail d-flex">
                <div class="body-image">
                    <img src="assets/img/{{$product->image}}" alt="">
                </div>
                <div class="body-form mt-3 ml-3">  
                    {{$product->categories->name}}/{{$product->nsx->name}}/<span class="text-bought">{{$product->name}}</span>
                    <h2>{{$product->name}}</h2>
                    <p class="text-primary price">{{number_format($product->price)}} &#8363</p>
                    <span>Số lượng</span>
                    <input type="hidden" name="id" class="id" value="{{$product->id}}">
                    <input type="number" name="qty" id=""min="1" value="1" style="width:50px;text-align: center" class="qty"></br>
                    @if ($product->qty == 0)
                        <span class="text-danger">Hết hàng</span></br>
                    @else
                        <span>Kho: </span><span class="text-primary">{{$product->qty}}</span></br>
                    @endif
                    <span>Đã bán: </span><span class="text-primary">{{$product->buy}} </span> <span>sản phẩm</span></br>
                    <span>Lượt xem: </span><span class="text-success">{{$product->view}} <i class="fas fa-eye text-success"></i></span></br>

                    <button type="button" class="btn btn-warning mt-3 add">Thêm vào giỏ hàng</button>
                    <button type="button" class="btn btn-danger mt-3 ml-3 tim">Thêm vào yêu thích</button>
                    <div class="success" style="position: fixed;right: 0;top: 0;"> 
                        <div class="alert"></div>
                     </div>

                    @if (session('thongbao'))
                    <div class="alert alert-success mt-3">{{session('thongbao')}}</div>
                    @endif

                    @if (session('loi'))
                    <div class="alert alert-danger mt-3">{{session('loi')}}</div>
                    @endif
                </div>
            </div>
            <div class="mt-4">
                <h6 class="h6 border-bottom border-dark text-uppercase text-center">Chi tiết sản phẩm</h6>
                {!!$product->body!!}
            </div>
            <div class="">
               @if (Auth::check())
                   
               @if ($checklike->isEmpty())
                   <button class="badge bg-primary text-white like">Thích</button>
                   <span class="icon-like"><i class="far fa-thumbs-up"></i>: </span>
                   <span class="count-like">{{count($like)}}</span>
               @else
                   
                <button class="badge bg-primary text-white like">Đã thích</button>
                <span class="icon-like"><i class="fas fa-thumbs-up text-primary"></i> </span>
                <span class="count-like">{{count($like)}}</span>
               @endif
               @else
               <a href="/dang-nhap"  class="badge bg-primary text-white like">Thích</a>
               <span class="icon-like"><i class="fas fa-thumbs-up text-primary"></i> </span>
               <span class="count-like text-primary">{{count($like)}}</span>
               @endif

            </div>
            <div style="border:2px solid rgb(195, 192, 192); padding:10px" class="col-6 mt-3">

                <h2 class="text-uppercase text-success">Đánh giá sản phẩm</h2>
                @if (Auth::check())
                <div class="form-group">
                    <label for="" class="form-lable">Nội dung:</label>
                  <textarea name="body" id="" placeholder="Nhập đánh giá sản phẩm..." class="form-control body"></textarea>
                  <div class="error"></div>
                  <button class="btn btn-success mt-3 comment">Đánh giá</button>
                </div>
                @else
                    <a class="text-primary" href="/dang-nhap">Đăng nhập để đánh giá! </a>
                @endif
                <div class="comment-body">
                   @foreach ($comment as $cmt)
                   <div class="form-group div-comment" >
                       <p class="name text-primary">{{$cmt->name}}</p>
                       <span class="blockquote-footer">
                        {{$cmt->created_at}}
                       </span>
                       <p class="content ml-3 text-muted">{{$cmt->body}}</p>
                       @if (Auth::check())
                            @if ( Auth::user()->name == $cmt->name)
                            <span class="text-danger delete" id="" style="cursor: pointer" data-id="{{$cmt->id}}">Xóa</span>
                                @else
                                    
                                @endif
                       @else
                           
                       @endif
                       
                       <div style=" width:100%;height: .1px; background:rgb(246, 243, 243)"></div>
                   </div>
                   @endforeach
                </div>     
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script>
   $(document).ready(function(){
        $('.add').click(function(){
            var id=$('.id').val();
            var qty=$('.qty').val();
            $.post("/ajax/add-cart",
            {
                _token: '{{ csrf_token() }}',
                id:id,
                qty:qty,
            },
            function(data){
                $('.success').html(data['success']);
                $('.alert').delay(1000).hide(300);
                setTimeout(function() {
                $(".alert").remove();
                }, 2000);
                $('.amount-cart').html(data['amount']);
            });
        });

        //yêu thích
        $('.tim').click(function(){
            var id=$('.id').val();
            $.post("/ajax/add-wishlist",
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
                $('.amount-wishlist').html(data['amount']);
            });
        });
        // bình luận
        $('.comment').click(function(){
            var id=$('.id').val();
            var body=$('.body').val();
            var name=$('.name').val();
            if(body == '' && name==''){
                $('.error').html('<span class="text-danger"> Vui lòng nhập nội dung đánh giá!</span>');
                $('.error-name').html('<span class="text-danger"> Vui lòng nhập tên của bạn!</span>');
            }
            else{

                $.post("/comment",
                {
                    _token: '{{ csrf_token() }}',
                    id:id,
                    body:body
                },
                function(data){
                    $('.comment-body').append(data);
                    $('.error-name').remove();
                    $('.error').html('<span class="text-success"> Cảm ơn bạn đã đánh giá về sản phẩm của chúng tôi!</span>');                   
                });
            }

        });

        $(".delete").click(function(){
            var id= $(this).attr("data-id");
            var view =  $(this).parents('.div-comment').remove();
            
            $.get("/comment/"+id,
                function(data){
                   
             });
        });

        $(".like").click(function(){
            var id=$('.id').val();
            $.post("/ajax/product-like",
            {
                _token: '{{ csrf_token() }}',
                id:id,
            },
            function(data){
                $('.count-like').html(data['count']); 
                $('.icon-like').html(data['icon']);
                $('.like').html(data['success']);
            });
        });
    });
</script>
@endsection
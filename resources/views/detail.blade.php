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
                    @if (Auth::check())
                        
                    <button type="button" class="btn btn-danger mt-3 ml-3 tim">Thêm vào yêu thích</button>
                    @else
                        
                    @endif
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
                    <div class="ratting d-flex justify-content-around">
                        <div class="d-block">

                            <div class="ratting-item">
                                <i class="far fa-frown text-warning"></i> <span>{{count($level_1)}} đánh giá</span>
                            </div>
                            <div class="ratting-item">
                                <i class="far fa-meh text-warning"></i> <span>{{count($level_2)}} đánh giá</span>
                            </div>
                            <div class="ratting-item">
                                <i class="far fa-smile text-warning"></i> <span>{{count($level_3)}} đánh giá</span>
                            </div>
                            <div class="ratting-item">
                                <i class="far fa-kiss-wink-heart text-warning"></i> <span>{{count($level_4)}} đánh giá</span>
                            </div>

                            <div class="d-block">
                                @if (count($level_2) ==0 && count($level_3) ==0 && count($level_1) ==0 && count($level_4)==0 )
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            @else
                                
                            @if (count($level_4) > count($level_3) && count($level_4) > count($level_2)  && count($level_4) > count($level_1) )
                                 
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                              @endif
                              @if (count($level_3) > count($level_4) && count($level_3) > count($level_2)  && count($level_3) > count($level_1))
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="far fa-star"></i>

                              @endif
  
                              @if (count($level_2) > count($level_4) && count($level_2) > count($level_3)  && count($level_2) > count($level_1))
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>

                              @endif
                              
                              @if (count($level_1) > count($level_4) && count($level_1) > count($level_3)  && count($level_1) > count($level_2))
                                  <i class="fa fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                              @endif
                              @if (count($level_3) < count($level_4) && count($level_3) > count($level_2)  && count($level_3) > count($level_1))
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                              @endif
                              @if (count($level_3) == count($level_4) && count($level_3) > count($level_2)  && count($level_3) > count($level_1))
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                              @endif
                              
                              @if (count($level_1) == count($level_4) && count($level_1) == count($level_2) && count($level_1) == count($level_3))
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                              @endif
                              @if (count($level_1) == count($level_2) && count($level_1) == count($level_3) && count($level_1) > count($level_4))
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                              @endif
                              @if (count($level_2) == count($level_3) && count($level_2) == count($level_4) && count($level_2) > count($level_1))
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                              @endif
                            @endif
                            </div>
                        </div>
                        @if (count($rat)==1)
                            @foreach ($rat as $rat)
                            <div class="d-block">

                                <h6 class="text-success">Vui lòng đánh giá về sản phẩm của chúng tôi!</h6>
                                    <div class="star-body d-flex justify-content-center">
                                        <div class="star pr-2" data-value="1" data-id="{{$rat->id}}" title="Không hài lòng">
                                            @if ($rat->level==1)
                                                <i class="fa fa-frown rat "></i>
                                            @else
                                                <i class="far fa-frown"></i>
                                            @endif
                                        </div>
                                        <div class="star pr-2"  data-value="2" data-id="{{$rat->id}}" title="Bình thường">
                                            @if ($rat->level==2)
                                                <i class="fa fa-meh rat"></i>  
                                            @else
                                                <i class="far fa-meh"></i>
                                            @endif
                                        </div>
                                        <div class="star pr-2"  data-value="3" data-id="{{$rat->id}}" title="Hài lòng">
                                            @if ($rat->level==3)
                                            <i class="fa fa-smile rat"></i>
                                            @else                                        
                                            <i class="far fa-smile"></i>
                                            @endif
                                        </div>
                                        <div class="star pr-2"  data-value="4" data-id="{{$rat->id}}" title="Rất hài lòng">
                                            @if ($rat->level==4)
                                                <i class="fa fa-kiss-wink-heart rat"></i>
                                            @else
                                                <i class="far fa-kiss-wink-heart"></i>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            
                            @else
                            
                            <div class="star-body d-flex justify-content-center">
                                <div class="star pr-2" data-value="1" data-id="{{$product->id}}" title="Không hài lòng">
                                    <i class="far fa-frown"></i>
                                </div>
                                <div class="star pr-2"  data-value="2" data-id="{{$product->id}}" title="Bình thường">
                                    <i class="far fa-meh"></i>
                                </div>
                                <div class="star pr-2"  data-value="3" data-id="{{$product->id}}" title="Hài lòng">
                                    <i class="far fa-smile"></i>
                                </div>
                                <div class="star pr-2"  data-value="4" data-id="{{$product->id}}" title="Rất hài lòng">
                                    <i class="far fa-kiss-wink-heart"></i>
                                </div>
                            </div>
                                
                            @endif
                            </div>
                    </div>

                    <div class="success-ratting text-success"></div>
                    <h2 class="text-success text-uppercase mt-3">Bình luận</h2>
                    <div class="form-group">
                        <label for="" class="form-lable">Nội dung:</label>
                    <textarea name="body" id="" placeholder="Nhập nội dung..." class="form-control body"></textarea>
                    <div class="error"></div>
                    <button class="btn btn-success mt-3 comment">Bình luận</button>
                    </div>
                @else
                    <a class="text-primary" href="/dang-nhap">Đăng nhập để đánh giá và bình luận! </a>
                    <div class="ratting d-flex justify-content-around">
                        <div class="d-block">

                            <div class="ratting-item">
                                <i class="far fa-frown text-warning"></i> <span>{{count($level_1)}} đánh giá</span>
                            </div>
                            <div class="ratting-item">
                                <i class="far fa-meh text-warning"></i> <span>{{count($level_2)}} đánh giá</span>
                            </div>
                            <div class="ratting-item">
                                <i class="far fa-smile text-warning"></i> <span>{{count($level_3)}} đánh giá</span>
                            </div>
                            <div class="ratting-item">
                                <i class="far fa-kiss-wink-heart text-warning"></i> <span>{{count($level_4)}} đánh giá</span>
                            </div>
                        </div>

                        <div class="d-block">
                            @if (count($level_2) ==0 && count($level_3) ==0 && count($level_1) ==0 && count($level_4)==0 )
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            @else
                                
                            @if (count($level_4) > count($level_3) && count($level_4) > count($level_2)  && count($level_4) > count($level_1) )
                                 
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                              @endif
                              @if (count($level_3) > count($level_4) && count($level_3) > count($level_2)  && count($level_3) > count($level_1))
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="far fa-star"></i>

                              @endif
  
                              @if (count($level_2) > count($level_4) && count($level_2) > count($level_3)  && count($level_2) > count($level_1))
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>

                              @endif
                              
                              @if (count($level_1) > count($level_4) && count($level_1) > count($level_3)  && count($level_1) > count($level_2))
                                  <i class="fa fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                              @endif
                              @if (count($level_3) < count($level_4) && count($level_3) > count($level_2)  && count($level_3) > count($level_1))
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                              @endif
                              @if (count($level_3) == count($level_4) && count($level_3) > count($level_2)  && count($level_3) > count($level_1))
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                              @endif
                              
                              @if (count($level_1) == count($level_4) && count($level_1) == count($level_2) && count($level_1) == count($level_3))
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="far fa-star"></i>
                              <i class="far fa-star"></i>
                              <i class="far fa-star"></i>
                              @endif
                              @if (count($level_1) == count($level_2) && count($level_1) == count($level_3) && count($level_1) > count($level_4))
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fas fa-star-half-alt"></i>
                              <i class="far fa-star"></i>
                              <i class="far fa-star"></i>
                              @endif
                              @if (count($level_2) == count($level_3) && count($level_2) == count($level_4) && count($level_2) > count($level_1))
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="far fa-star"></i>
                              <i class="far fa-star"></i>
                              @endif
                            @endif
                        </div>
                    </div>
                @endif
                <div class="comment-body mt-3">
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
            if(body == ""){
                $('.error').html('<span class="text-danger"> Vui lòng nhập nội dung bình luận!</span>');
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
                    $('.error').html('<span class="text-success"> Cảm ơn bạn đã bình luận về sản phẩm của chúng tôi!</span>');                   
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

        //star
        $(".star").click(function(e) {
            var id = $(this).data('id');
            var icon = $(this).data('value');
            var product_id=$('.id').val();

            $.post("/ajax/ratting",
                {
                    _token: '{{ csrf_token() }}',
                    id:id,
                    icon:icon,
                    product_id:product_id,
                },
                function(data){
                    location.reload('san-pham/'+product_id);

                });
        });
    });
</script>
@endsection
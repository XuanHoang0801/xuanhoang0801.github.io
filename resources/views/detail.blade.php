@extends('home')
@section('title',''.$product->name.'')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="detail d-flex">
                <div class="body-image">
                    {{-- <img src="assets/img/{{$product->image}}" alt=""> --}}

                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active ">
                                    <img src="assets/img/product/{{$product->image}}" class="d-block " width="240" height="228" alt="...">
                                </div>
                                @foreach ($album as $album)
                                    
                                <div class="carousel-item ">
                                <img src="assets/img/product/{{$album->image}}" class="d-block " width="240" height="228" alt="...">
                                </div>
                                @endforeach
                            
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <i class="fas fa-chevron-left text-dark"></i>
                            </button>
                            <button class="carousel-control-next border-none" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <i class="fas fa-chevron-right text-dark"></i>
                            </button>
                      </div>
                      {{-- <div class="d-flex">
                        <div class="carousel-item active ">
                            <img src="assets/img/product/{{$product->image}}" class="d-block " width="240" height="228" alt="...">
                        </div>
                        @foreach ($album as $list)
                            
                        <div class="carousel-item ">
                        <img src="assets/img/product/{{$list->image}}" class="d-block " width="240" height="228" alt="...">
                        </div>
                        @endforeach
                      </div> --}}
                </div>
                <div class="body-form mt-3 ml-3">  
                    {{$product->categories->name}}/{{$product->nsx->name}}/<span class="text-bought">{{$product->name}}</span>
                    <h2>{{$product->name}}</h2>
                    <p class="text-primary price">{{number_format($product->price)}} &#8363</p>
                    <span>S??? l?????ng</span>
                    <input type="hidden" name="id" class="id" value="{{$product->id}}">
                    <input type="number" name="qty" id=""min="1" value="1" style="width:50px;text-align: center" class="qty"></br>
                    @if ($product->qty == 0)
                        <span class="text-danger">H???t h??ng</span></br>
                    @else
                        <span>Kho: </span><span class="text-primary">{{$product->qty}}</span></br>
                    @endif
                    @if ($product->buy > 0)
                        <span>???? b??n: </span><span class="text-primary">{{$product->buy}} </span> <span>s???n ph???m</span></br>  
                    @else  
                    @endif
                    <span>L?????t xem: </span><span class="text-success">{{$product->view}} <i class="fas fa-eye text-success"></i></span></br>

                    <button type="button" class="btn btn-warning mt-3 add">Th??m v??o gi??? h??ng</button>
                    @if (Auth::check())
                        
                    <button type="button" class="btn btn-danger mt-3 ml-3 tim">Th??m v??o y??u th??ch</button>
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
                <h6 class="h6 border-bottom border-dark text-uppercase text-center">Chi ti???t s???n ph???m</h6>
                {!!$product->body!!}
            </div>
            <div class="">
               @if (Auth::check())
                   
                @if ($checklike->isEmpty())
                    <button class="badge bg-primary text-white like">Th??ch</button>
                    <span class="icon-like"><i class="far fa-thumbs-up"></i>: </span>
                    <span class="count-like">{{count($like)}}</span>
                @else
                   
                <button class="badge bg-primary text-white like">???? th??ch</button>
                <span class="icon-like"><i class="fas fa-thumbs-up text-primary"></i> </span>
                <span class="count-like">{{count($like)}}</span>
               @endif
               @else
               {{-- <a href="/dang-nhap"  class="badge bg-primary text-white like">Th??ch</a> --}}
               <span class="icon-like" title="L?????t th??ch"><i class="fas fa-thumbs-up text-primary"></i> </span>
               <span class="count-like text-primary">{{count($like)}}</span>
               @endif

            </div>
            <div style="border:2px solid rgb(195, 192, 192); padding:10px" class="col-6 mt-3">

                <h2 class="text-uppercase text-success">????nh gi?? s???n ph???m</h2>
                @if (Auth::check())
                    <div class="ratting d-flex justify-content-around">
                        <div class="d-block">
                            <div class='rating-stars text-center'>
                                @if (count($rat)==1)
                                    @foreach ($rat as $rat)
                                        @if ($rat->level==1) 
                                            <ul id='stars' class="d-flex justify-content-center">
                                                <li class='star selected' title='Poor' data-value='1' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw '></i>
                                                </li>
                                                <li class='star' title='Fair' data-value='2' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Good' data-value='3' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Excellent' data-value='4' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='WOW!!!' data-value='5' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                            </ul>
                                            <div class='success-boxed'>
                                                <div class='clearfix'></div>
                                                <div class='text-message'>
                                                    <i class="fas fa-check bg-success p-2 text-white mr-2" style="border-radius:1.5rem "; ></i><span>B???n ???? ????nh gi?? {{$rat->level}} sao cho s???n ph???m n??y</span>
                                                </div>
                                                <div class='clearfix'></div>
                                            </div>
                                           
                                        @endif
                                        @if ($rat->level==2) 
                                            <ul id='stars' class="d-flex justify-content-center">
                                                <li class='star selected' title='Poor' data-value='1' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw '></i>
                                                </li>
                                                <li class='star selected' title='Fair' data-value='2' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Good' data-value='3'data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Excellent' data-value='4'data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='WOW!!!' data-value='5'data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                            </ul>
                                            <div class='success-boxed'>
                                                <div class='clearfix'></div>
                                                <div class='text-message'>
                                                    <i class="fas fa-check bg-success p-2 text-white mr-2" style="border-radius:1.5rem "; ></i><span>B???n ???? ????nh gi?? {{$rat->level}} sao cho s???n ph???m n??y</span>

                                                </div>
                                                <div class='clearfix'></div>
                                            </div>
                                        @endif
                                        @if ($rat->level==3) 
                                            <ul id='stars' class="d-flex justify-content-center">
                                                <li class='star selected' title='Poor' data-value='1' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw '></i>
                                                </li>
                                                <li class='star selected' title='Fair' data-value='2' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star selected' title='Good' data-value='3' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Excellent' data-value='4' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='WOW!!!' data-value='5' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                            </ul>
                                            <div class='success-boxed'>
                                                <div class='clearfix'></div>
                                                <div class='text-message'>
                                                    <i class="fas fa-check bg-success p-2 text-white mr-2" style="border-radius:1.5rem "; ></i><span>B???n ???? ????nh gi?? {{$rat->level}} sao cho s???n ph???m n??y</span>

                                                </div>
                                                <div class='clearfix'></div>
                                            </div>
                                        @endif
                                        @if ($rat->level==4) 
                                            <ul id='stars' class="d-flex justify-content-center">
                                                <li class='star selected' title='Poor' data-value='1' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw '></i>
                                                </li>
                                                <li class='star selected' title='Fair' data-value='2' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star selected' title='Good' data-value='3' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star selected' title='Excellent' data-value='4' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='WOW!!!' data-value='5' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                            </ul>
                                            <div class='success-boxed'>
                                                <div class='clearfix'></div>
                                                <div class='text-message'>
                                                    <i class="fas fa-check bg-success p-2 text-white mr-2" style="border-radius:1.5rem "; ></i><span>B???n ???? ????nh gi?? {{$rat->level}} sao cho s???n ph???m n??y</span>

                                                </div>
                                                <div class='clearfix'></div>
                                            </div>
                                        @endif
                                        @if ($rat->level==5) 
                                            <ul id='stars' class="d-flex justify-content-center">
                                                <li class='star selected' title='Poor' data-value='1' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw '></i>
                                                </li>
                                                <li class='star selected' title='Fair' data-value='2' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star selected' title='Good' data-value='3' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star selected' title='Excellent' data-value='4' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star selected' title='WOW!!!' data-value='5' data-id="{{$rat->id}}">
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                            </ul>
                                            <div class='success-boxed '>
                                                <div class='clearfix'></div>
                                                <div class='text-message'>
                                                    <i class="fas fa-check bg-success p-2 text-white mr-2" style="border-radius:1.5rem "; ></i><span>B???n ???? ????nh gi?? {{$rat->level}} sao cho s???n ph???m n??y</span>

                                                </div>
                                                <div class='clearfix'></div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <ul id='stars' class="d-flex">
                                        <li class='star' title='Poor' data-value='1'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Fair' data-value='2'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Good' data-value='3'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Excellent' data-value='4'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='WOW!!!' data-value='5'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                    </ul>
                                    <div class='success-boxing'>
                                        <div class='clearfix'></div>
                                        <div class='text-message'>
                                            <i class="fas fa-check bg-success p-2 text-white mr-2" style="border-radius:1.5rem "; ></i><span>Vui l??ng ????nh gi?? cho s???n ph???m n??y!</span>
                                        </div>
                                        <div class='clearfix'></div>
                                    </div>
                                   
                                @endif
                                <div class='success-box'>
                                    <div class='clearfix'></div>
                                    <div class='text-message'></div>
                                    <div class='clearfix'></div>
                               
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="success-ratting text-success"></div>
                    <h2 class="text-success text-uppercase mt-3">B??nh lu???n</h2>
                    <div class="form-group">
                        <label for="" class="form-lable">N???i dung:</label>
                    <textarea name="body" id="" placeholder="Nh???p n???i dung..." class="form-control body"></textarea>
                    <div class="error"></div>
                    <button class="btn btn-success mt-3 comment">B??nh lu???n</button>
                    </div>
                @else
                    <a class="text-primary" href="/dang-nhap">????ng nh???p ????? ????nh gi?? v?? b??nh lu???n! </a>
                @endif

                
                <div class="comment-body mt-3">
                   @foreach ($comment as $cmt)
                   <div class="form-group div-comment" >
                       <p class="name text-primary">{{$cmt->users->fullname}}</p>
                       <div class="d-flex justify-content-between">
                           <p class="content ml-3 text-muted">{{$cmt->body}}</p>
                           <span class="text-secondary text-xxs">{{$cmt->created_at}}</span>
                        </div>
                        @if (Auth::check())
                             @if ( Auth::user()->id == $cmt->user_id)
                             <span class="text-danger delete" id="" style="cursor: pointer" data-id="{{$cmt->id}}">X??a</span>
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
    //add cart
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

        //y??u th??ch
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
        // b??nh lu???n
        $('.comment').click(function(){
            var id=$('.id').val();
            var body=$('.body').val();
            if(body == ""){
                $('.error').html('<span class="text-danger"> Vui l??ng nh???p n???i dung b??nh lu???n!</span>');
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
                    $('.error').html('<span class="text-success"> C???m ??n b???n ???? b??nh lu???n v??? s???n ph???m c???a ch??ng t??i!</span>');                   
                });
            }

        });
        //delete comment
        $(".delete").click(function(){
            var id= $(this).attr("data-id");
            var view =  $(this).parents('.div-comment').remove();
            
            $.get("/comment/"+id,
                function(data){
                   
             });
        });

        //like
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
        /* 1. Visualizing things on Hover - See next part for action on click */
        $('#stars li').on('mouseover', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
        
            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e){
            if (e < onStar) {
                $(this).addClass('hover');
            }
            else {
                $(this).removeClass('hover');
            }
            });
            
        }).on('mouseout', function(){
            $(this).parent().children('li.star').each(function(e){
            $(this).removeClass('hover');
            });
        });
        
        
        /* 2. Action to perform on click */
        $('#stars li').on('click', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');
            
            for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
            }
            
            for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
            }
            
            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            var id = $('.id').val();
            var rat_id = parseInt($('#stars li.star').last().data('id'), 10);
            $.post("/ajax/ratting",
            {
                _token: '{{ csrf_token() }}',
                id:id,
                ratingValue:ratingValue,
                rat_id:rat_id,
            },
            function(data){
                location.reload('/san-pham/'+id);
            });
            // console.log(ratingValue,id,rat_id);
            var msg = "";
            if (ratingValue > 1) {
                msg = "C???m ??n! B???n ???? ????nh gi?? " + ratingValue + " sao.";
            }
            else {
                msg = "Ch??ng t??i s??? c???i thi???n s???n ph???m. B???n ???? ????nh gi?? " + ratingValue + " sao.";
            }
            responseMessage(msg);
            
        });
   
    });
    function responseMessage(msg) {
        $('.success-box').fadeIn(200); 
        $('.success-box div.text-message').html('<i class="fas fa-check bg-success p-2 text-white mr-2" style="border-radius:1.5rem "; ></i><span>' + msg + '</span>');
        $('.success-boxed').remove();
        $('.success-boxing').remove();
    }
</script>
@endsection
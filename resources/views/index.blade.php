@extends('home')
@section('title' ,'HitShop')
@section('banner')
      <!-- banner -->
      <section class="banner_main">
        <div class="container">
           <div class="row">
              <div class="col-md-8">
                 <div class="text-bg">
                    <h1> <span class="blodark"> HitShop </span> <br>Trends 2022</h1>
                    <p>A huge fashion collection for ever </p>
                    <a class="read_more" href="#">Shop now</a>
                 </div>
              </div>
                            
           </div>
        </div>
     </section>
     <!-- end banner -->
     <!-- six_box section -->
     <div class="six_box">
        <div class="container-fluid">
           <div class="row">
              <div class="col-md-2 col-sm-4 pa_left">
                 <div class="six_probpx yellow_bg">
                    <i><img src="assets/images/shoes.png" alt="#"/></i>
                    <span>Shoes</span>
                 </div>
              </div>
              <div class="col-md-2 col-sm-4 pa_left">
                 <div class="six_probpx bluedark_bg">
                    <i><img src="assets/images/underwear.png" alt="#"/></i>
                    <span>underwear</span>
                 </div>
              </div>
              <div class="col-md-2 col-sm-4 pa_left">
                 <div class="six_probpx yellow_bg">
                    <i><img src="assets/images/pent.png" alt="#"/></i>
                    <span>Pante & socks</span>
                 </div>
              </div>
              <div class="col-md-2 col-sm-4 pa_left">
                 <div class="six_probpx bluedark_bg">
                    <i><img src="assets/images/t_shart.png" alt="#"/></i>
                    <span>T-shirt & tankstop</span>
                 </div>
              </div>
              <div class="col-md-2 col-sm-4 pa_left">
                 <div class="six_probpx yellow_bg">
                    <i><img src="assets/images/jakit.png" alt="#"/></i>
                    <span>cardigans & jumpers</span>
                 </div>
              </div>
              <div class="col-md-2 col-sm-4 pa_left">
                 <div class="six_probpx bluedark_bg">
                    <i><img src="assets/images/helbet.png" alt="#"/></i>
                    <span>Top & hat</span>
                 </div>
              </div>
           </div>
        </div>
     </div>

     <!-- project section -->
<div id="project" class="project">
    <div class="container">
    
        <div id="project" class="project">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="titlepage">
                        <h2>Sản phẩm nổi bật</h2>
                     </div>
                  </div>
               </div>
                  <div class="row">
                    <div class="product_main">
                     @foreach ($product as $item)
                     
                     <div class="project_box" data-id="{{$item->id}}">
                           <a href="/san-pham/{{$item->id}}">
                              
                               <div class="dark_white_bg" >
                                   <img  src="assets/img/{{$item->image}}" alt="#"/>
                               </div>
                               <h3 class="text-center" style="text-transform: uppercase;"><b>{{$item->name}}</b></h3>
   
                               <p class="text-warning">{{number_format($item->price)}} &#8363</p>
                           </a>
                              <button class="btn btn-success mb-2 mx-1 add-cart">Thêm vào giỏ hàng</button>

                              <div class="success" style="position: fixed;right: 0;top: 0;"> 
                                 <div class="alert"  ></div>
                              </div>
                        </div>
                        @endforeach
                        {{-- <div class="col-md-12">
                            <a class="read_more" href="#">See More</a>
                        </div> --}}
                     </div>
                    </div>
                  </div>
               </div>

 <!-- end project section -->
 <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
 <script>
   $(document).ready(function(){
      
      $('.add-cart').click(function(){
         var id = $(this).parents('.project_box').attr('data-id');
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
                  $('.amount-cart').html(data['amount']);
            });
      });

   });
 </script>
@endsection
@extends('home')
@section('title' ,'HitShop')
@section('banner')
      <!-- banner -->
      <section class="banner_main">
        <div class="container d-flex">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
               <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" style="height:2px;background:#000" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2" style="height:2px;background:#000"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3" style="height:2px;background:#000"></button>
               </div>
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <img src="/assets/img/banner/{{$show->image}}" class="d-block " alt="..." width="800">
                  </div>
                     @foreach ($banner as $banner)
                        @if ($banner->id == $show->id)
                           
                        @else
                           
                        <div class="carousel-item">
                           <img src="/assets/img/banner/{{$banner->image}}" class="d-block  " alt="..." width="800">
                        </div>
                        @endif
                     @endforeach
               </div>
            </div>

            <div class="show-product ml-3">
             
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
                        <h2>S???n ph???m n???i b???t</h2>
                     </div>
                  </div>
               </div>
                  <div class="row">
                    <div class="product_main">
                     @foreach ($product as $item)
                     
                     <div class="project_box" data-id="{{$item->id}}" title="{{$item->name}}">
                           <a href="/san-pham/{{$item->id}}">
                              
                               <div class="dark_white_bg" >
                                   <img  src="assets/img/product/{{$item->image}}" alt="#"/>
                               </div>
                               <h3 class="text-center" style="text-transform: uppercase;"><b>{{$item->name}}</b></h3>
   
                               <p class="text-warning">{{number_format($item->price)}} &#8363</p>
                           </a>
                              <button class="btn btn-success mb-2 mx-1 add-cart">Th??m v??o gi??? h??ng</button>

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
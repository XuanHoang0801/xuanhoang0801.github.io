@extends('home')
@section('title','Sản phẩm')
@section('content')
    
<!-- project section -->
<div id="project" class="project">
   <div class="container">
      <div class="d-flex">
         <div class="dropdown">
            <select class="form-select fill mb-3" aria-label="Default select example">
               <option value="all">Thể loại</option>
               @foreach ($fillter as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
               @endforeach
               
            </select>
         </div>
         {{-- producer --}}
         <div class="dropdown ml-3">
            <select class="form-select fill-producer mb-3" aria-label="Default select example">
               <option value="all">Hãng</option>
               @foreach ($producer as $producer)
               <option value="{{$producer->id}}">{{$producer->name}}</option>
               @endforeach
               
             </select>
         </div>
         {{-- price --}}
         <div class="dropdown ml-3">
            <select class="form-select fill-price mb-3" aria-label="Default select example">
               <option value="all">Giá</option>
               <option value="up">Tăng dần</option>
               <option value="down">Giảm dần</option>
            </select>
         </div>
      </div>
      <h1 class="text-center title">Điện thoại</h1>
      <div class="row">
         <div class="product_main">
            @foreach ($phone as $p)
            <div class="project_box" data-id="{{$p->id}}">
               <a href="/san-pham/{{$p->id}}">
                  <div class="dark_white_bg" >
                     <img  src="assets/img/{{$p->image}}" alt="#" width="500">
                  </div>
                  <h3  class="text-center" style="text-transform: uppercase;"><b>{{$p->name}}</b></h3>
      
                  <p class="text-warning">{{number_format($p->price)}} &#8363</p>
               </a>
      
               <button class="btn btn-success mb-2 add-cart">Thêm vào giỏ hàng</button>
                  <div class="success" style="position: fixed;right: 0;top: 0;"> 
                     <div class="alert"></div>
                  </div>
            </div>               
            @endforeach
         </div>
      </div>
   <div class="mt-3"></div>
   <div class="container title">
      <h1 class="text-center">Laptop</h1>
      <div class="row">
         <div class="product_main">
         @foreach ($laptop as $l)
         <div class="project_box" data-id="{{$l->id}}">
            <a href="/san-pham/{{$l->id}}">
                <div class="dark_white_bg" >
                    <img  src="assets/img/{{$l->image}}" alt="#" width="500"/>
                </div>
                <h3 class="text-center" style="text-transform: uppercase;"><b>{{$l->name}}</b></h3>
   
                <p class="text-warning">{{number_format($l->price)}} &#8363</p>
            </a>
            <button class="btn btn-success mb-2 add-cart">Thêm vào giỏ hàng</button>

            <div class="success" style="position: fixed;right: 0;top: 0;"> 
               <div class="alert"  ></div>
            </div>

         </div>             
         @endforeach
         
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

     $('.fill').change(function(){
         var id = $(this).val();
         $.post("/ajax/fill-product",
           {
               _token: '{{ csrf_token() }}',
               id:id,
           },
           function(data){
               $('.title').remove();
               $('.product_main').html(data);
         });
     });

     $('.fill-price').change(function(){
         var id = $(this).val();
         $.post("/ajax/fill-price",
           {
               _token: '{{ csrf_token() }}',
               id:id,
           },
           function(data){
               $('.title').remove();
               $('.product_main').html(data);
         });
     });

     $('.fill-producer').change(function(){
         var id = $(this).val();
         $.post("/ajax/fill-producer",
           {
               _token: '{{ csrf_token() }}',
               id:id,
           },
           function(data){
               $('.title').remove();
               $('.product_main').html(data);
         });
     });
  });
</script>
@endsection


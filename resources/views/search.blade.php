@extends('home')
@section('title','Từ khóa:" '.$key.'"' )
@section('content')
    
<!-- project section -->
<div id="project" class="project">
   <div class="container">
   
    @if (count($product)== 0)
            <div class="alert alert-danger">Không tìm thấy sản phẩm phù hợp với từ khóa mà bạn tìm kiếm. Vui lòng nhập lại!</div>
        @else
            
        <h1 class="text-center">Kết quả tìm kiếm của 
            <span class="text-primary">"{{$key}}" </span>
        </h1> 
        <p class="text-center text-warning mb-3">Tìm thấy: ({{count($product)}}) kết quả</p>
        <div class="row">
        <div class="product_main">
        @foreach ($product as $p)
        <div class="project_box" data-id="{{$p->id}}" 
            @if (count($product)== 1) 
            style="max-width:40%"
        @endif>
            <a href="/san-pham/{{$p->id}}">
                <div class="dark_white_bg" >
                    <img  src="assets/img/{{$p->image}}" alt="#"/ width="500">
                </div>
                <h3  class="text-center" style="text-transform: uppercase;"><b>{{$p->name}}</b></h3>
    
                <p class="text-warning">{{number_format($p->price)}} &#8363</p>
            </a>
    
            <button class="btn btn-success mb-2 add-cart">Thêm vào giỏ hàng</button>
                <div class="success" style="position: fixed;right: 0;top: 0;"> 
                    <div class="alert"  ></div>
                </div>
        </div>               
        @endforeach


        </div>
        </div>
        @endif
   </div>
   <div class="mt-3"></div>
  
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
           });

     });
  });
</script>
@endsection


@extends('home')
@section('title',''.$post->title.'')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="card-body">
                <h1 class="h1">{{$post->title}}</h1>
                <input type="hidden" name="" class="id" value="{{$post->id}}">
                <span>Ngày đăng: {{$post->updated_at->format('d-m-Y')}}</span> -  Tác giả:<span class="text-success"> {{$post->users->name}} </span> 
                 - <span>Lượt xem: </span><span class="text-primary">{{$post->view}} <i class="fas fa-eye text-primary"></i></span></br>

                <div class="">
                    @if (Auth::check())
                        
                    @if ($checklike->isEmpty())
                        <button class="badge bg-primary text-white like">Thích</button>
                        <span class="icon-like"><i class="far fa-thumbs-up"></i> </span>
                        <span class="count-like">{{count($like)}}</span>
                    @else
                        
                    <button class="badge bg-primary text-white like">Đã thích</button>
                    <span class="icon-like"><i class="fas fa-thumbs-up text-primary"></i> </span>
                    <span class="count-like">{{count($like)}}</span>
                    @endif
    
                    @else
                    <a href="/dang-nhap" class="badge bg-primary text-white like">Thích</a>
                    <span class="icon-like"><i class="far fa-thumbs-up"></i> </span>
                    <span class="count-like">{{count($like)}}</span>
                    @endif
                </div>
                <div class="content">{!! $post->body !!}</div>
                <div style="border:2px solid rgb(195, 192, 192); padding:10px" class="col-6 mt-5">
                    <h2 class="text-uppercase text-success">Bình luận bài viết</h2>
                    
                    @if (Auth::check())
                    <div class="form-group">
                        <label for="" class="form-lable">Nội dung:</label>
                      <textarea name="body" id="" placeholder="Nhập đánh giá sản phẩm..." class="form-control body"></textarea>
                      <div class="error"></div>
                      <button class="btn btn-success mt-3 comment">Bình luận</button>
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
</div>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script>
   $(document).ready(function(){
        $('.comment').click(function(){
            var id=$('.id').val();
            var body=$('.body').val();
            if(body == '' && name==''){
                $('.error').html('<span class="text-danger"> Vui lòng nhập nội dung đánh giá!</span>');
                $('.error-name').html('<span class="text-danger"> Vui lòng nhập tên của bạn!</span>');
            }
            else{
                $.post("/comment-post",
                {
                    _token: '{{ csrf_token() }}',
                    id:id,
                    body:body
                },
                function(data){
                    $('.comment-body').append(data);
                    $('.error-name').remove();
                    $('.error').html('<span class="text-success"> Bạn đã bình luận!</span>');
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
            $.post("/ajax/post-like",
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
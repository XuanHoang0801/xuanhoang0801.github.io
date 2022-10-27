@extends('home')
@section('title',''.$post->title.'')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="card-body">
                <h1 class="h1">{{$post->title}}</h1>
                <input type="hidden" name="" class="id" value="{{$post->id}}">
                <span>{{$post->updated_at->format('d-m-Y')}}</span> -  Tác giả:<span class="text-success"> {{$post->users->name}} </span> 
                <div class="">{!! $post->body !!}</div>
            </div>
            <div style="border:2px solid rgb(195, 192, 192); padding:10px" class="col-6">
                <h2 class="text-uppercase text-success">Bình luận</h2>
                <div class="form-group">
                    <label for="" class="form-lable">Tên của bạn:</label>
                    <input type="text" class="form-control name" placeholder="Nhập tên của bạn...">
                    <div class="error-name"></div>
                </div>
                <div class="form-group">
                    <label for="" class="form-lable">Nội dung:</label>
                  <textarea name="body" id="" placeholder="Nhập đánh giá sản phẩm..." class="form-control body"></textarea>
                  <div class="error"></div>
                  <button class="btn btn-success mt-3 comment">Bình luận</button>
                </div>
                <div class="comment-body">
                   @foreach ($comment as $cmt)
                   <div class="form-group  div-comment">
                       <p class="name text-primary">{{$cmt->name}}</p>
                       <span class="blockquote-footer">
                        {{$cmt->created_at}}
                       </span>
                       <p class="content ml-3 text-muted">{{$cmt->body}}</p>
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
        $('.comment').click(function(){
            var id=$('.id').val();
            var body=$('.body').val();
            var name=$('.name').val();
            if(body == '' && name==''){
                $('.error').html('<span class="text-danger"> Vui lòng nhập nội dung đánh giá!</span>');
                $('.error-name').html('<span class="text-danger"> Vui lòng nhập tên của bạn!</span>');
            }
            else{
                $.post("/comment-post",
                {
                    _token: '{{ csrf_token() }}',
                    id:id,
                    name:name,
                    body:body
                },
                function(data){
                    $('.comment-body').append(data);
                    $('.error-name').remove();
                    $('.error').html('<span class="text-success"> Bạn đã bình luận!</span>');
                });
                
            }
        });
   });
</script>
@endsection
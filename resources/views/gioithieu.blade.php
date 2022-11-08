@extends('home')
@section('title',''.$post->title.'')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="card-body">
                <h1 class="h1">{{$post->title}}</h1>
                <input type="hidden" name="" class="id" value="{{$post->id}}">
                <span class="text-primary">Ngày đăng: {{$post->updated_at->format('d-m-Y')}}</span> -  Tác giả:<span class="text-success"> {{$post->users->name}} </span> 
                <div class="">{!! $post->body !!}</div>
            </div>
        </div>
    </div>
</div>

@endsection
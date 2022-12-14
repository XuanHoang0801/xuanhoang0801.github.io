@extends('home')
@section('title',''.$post->title.'')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="card-body">
                <h1 class="h1 text-center">{{$post->title}}
                </h1>
                <div class="text-center">

                    <span class="text-secondary"> Ngày đăng:</span> <span class="text-primary">{{$post->updated_at->format('d-m-Y')}}</span> -  Tác giả:<span class="text-success"> {{$post->users->name}} </span> 
                </div>
                <input type="hidden" name="" class="id" value="{{$post->id}}">
                <div class="mt-4">{!! $post->body !!}</div>
            </div>
        </div>
    </div>
</div>

@endsection
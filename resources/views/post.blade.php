@extends('home')
@section('title', 'Bài viết')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            @foreach ($post as $item)
                
            <a href="bai-viet/{{$item->id}}" class="card mb-3">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="/assets/img/{{$item->image}}" class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">{{$item->title}}</h5>
                      {{-- <div class="card-text">{!!$item->body!!}</div> --}}
                      <p class="card-text"><small class="text-muted">{{$item->created_at}}</small></p>
                    </div>
                  </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
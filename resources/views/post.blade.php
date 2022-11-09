@extends('home')
@section('title', 'Bài viết')
@section('content')
<div class="container">
  {{-- <div class="d-flex justify-content-end">
    <input type="text" class="form-control col-4 mt-2">
    <i class="fas fa-search bg-warning p-3 mt-2"></i>
  </div> --}}
  
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            @foreach ($post as $item)
                
            <a href="bai-viet/{{$item->id}}" class="card mb-3">
                <div class="row">
                  <div class="col-md-2">
                    <img src="/assets/img/{{$item->image}}" class="img-fluid rounded-start m-auto" alt="..." width="240px">
                  </div>
                  <div class="col-md-6">
                    <div class="card-body">
                      <h5 class="card-title">{{$item->title}}</h5>
                      <div class="card-text">
                        {{-- {!!$item->body!!} --}}
                      </div>
                      <div class="card-text"><small class="text-muted">{{$item->created_at}}</small></div>
                    </div>
                  </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
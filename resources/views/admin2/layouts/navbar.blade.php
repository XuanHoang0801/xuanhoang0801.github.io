<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">admin @yield('url')</a></li>
          {{-- <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li> --}}
        </ol>
        {{-- <h6 class="font-weight-bolder mb-0">Dashboard</h6> --}}
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          
        </div>
        <ul class="navbar-nav  justify-content-end">
          
          <li class="nav-item d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
              <i class="fa fa-user me-sm-1"></i>
              <span class="d-sm-inline d-none">{{Auth::user()->name}}</span>
            </a>
          </li>
          <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </a>
          </li>
          <li class="nav-item px-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0">
              <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
            </a>
          </li>
          <li class="nav-item dropdown pe-2 d-flex align-items-center">
            <a href="" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-bell cursor-pointer"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{count($amount)}}</span>
            </a>
            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
              @foreach ($notify as $notify)
                  
              <li class="mb-2 notify" data-id="{{$notify->id}}" style="
              <?php
              if ($notify->status == 0) {
                echo 'background: #9999';
              }
              else {
                null;
              }
              ?>
            ">
                {{-- <input type="hidden" name="" class="id" value=""> --}}
                <a class="dropdown-item border-radius-md" href="
                <?php 
                  if ($notify->type == 0) {
                    echo '/admin/quan-ly-don-hang/'.$notify->order_id.'';
                  } 
                  if ($notify->type == 1){
                    echo '/admin/quan-ly-don-hang/don-huy';
                  }
                ?>
                ">
                  <div class="d-flex py-1">
                    <div class="my-auto">
                      <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                    </div>
                    <div class="d-flex flex-column justify-content-center" >
                      <h6 class="text-sm font-weight-normal mb-1">
                        <span class=" text-wrap" >{!!$notify->body!!}</span>
                      </h6>
                      <div class="text-xs text-secondary mb-0 ">
                        <i class="fa fa-clock me-1"></i>
                        <span>{{$notify->created_at->format('H:i:s - d-m-Y ')}}</span>
                      </div>
                    </div>
                  </div>
                </a>
              </li>
              @endforeach
              
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>


    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
    $('.notify').click(function(){
      var id= $(this).attr('data-id');
      $.post("/ajax/notify-status",
        {
          _token: '{{ csrf_token() }}',
          id:id,
        },
        function(data){
          $('.success').html(data['success']);
      }); 
    });
  });
</script>

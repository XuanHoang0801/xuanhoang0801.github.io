<!DOCTYPE html>
<html lang="vi">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>@yield('title')</title>
      <base href="{{asset("")}}">
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="assets/css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="assets/css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="assets/images/logo.png" type="image/gif" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

      <!-- Scrollbar Custom CSS -->
      {{-- <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]> --}}
      {{-- <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]--> --}}
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      {{-- <div class="loader_bg">
         <div class="loader"><img src="assets/images/loading.gif" alt="#" /></div>
      </div> --}}
      <!-- end loader -->
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header">
            <div class="header_top d_none1">
               <div class="container">
                  <div class="row">
                     <div class="col-md-4">
                        <ul class="conta_icon ">
                           <li><a href="#"><img src="assets/images/call.png" alt="#"/>Phone: 033 - 971 - 5404</a> </li>
                        </ul>
                     </div>
                     <div class="col-md-4">
                        <ul class="social_icon">
                           <li> <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i>
                              </a>
                           </li>
                           <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
                           <li> <a href="#"> <i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                           <li> <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i>
                              </a>
                           </li>
                        </ul>
                     </div>
                     <div class="col-md-4">
                        <div class="se_fonr1">
                           <form action="#" >
                              <div class="select-box">
                                 <label for="select-box1" class="label select-box1"><span class="label-desc">English</span> </label>
                                 <select id="select-box1" class="select">
                                    <option value="Choice 1">English</option>
                                    <option value="Choice 1">Falkla</option>
                                    <option value="Choice 2">Germa</option>
                                    <option value="Choice 3">Neverl</option>
                                 </select>
                              </div>
                           </form>
                           <span class="time_o">  
                            @if (Route::has('login'))
                            
                                @auth
                                <li class="nav-item dropdown">
                                 <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                     {{ Auth::user()->name }}
                                 </a>
 
                                 <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">  
                                     <div class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                         {{ __('Logout') }}
                                 </div>
 
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                         @csrf
                                     </form>
                                 </div>
                             </li>
                                @else
                                    <a href="/dang-nhap" class="text-sm text-gray-700 dark:text-gray-500 underline">Đăng nhập</a>
            
                                    <a href="dang-ky" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Đăng ký</a>
                                    
                                @endauth
                            
                        @endif</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="header_midil">
               <div class="container">
                  <div class="row d_flex">
                     <div class="col-md-4">
                        <ul class="conta_icon d_none1">
                           <li><a href="#"><img src="assets/images/email.png" alt="#"/> nxh@gmail.com</a> </li>
                        </ul>
                     </div>
                     <div class="col-md-4">
                        <a class="logo" href="#"><img src="assets/images/logo.png" alt="#"/></a>
                     </div>
                     <div class="col-md-4">
                        <ul class="right_icon d_none1">
                           <li>
                              <a href="/cart" class="mr-4">
                                 <i class="fas fa-shopping-cart text-larger position-relative" style="font-size: 26px; color:orange" title="Giỏ hàng"></i>
                                 <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger text-white amount-cart" style="transform: translate(-50%, -50%) !important;">{{$qty}}</span>
                              </a> 
                              
                           </li>
                           
                           <a href="/don-hang" class="order">Đơn hàng</a> 

                           <li>

                              <a class="ml-3" href="/yeu-thich" title="Yêu thích" >
                                 <i class="fas fa-heart" style="font-size: 26px;color: red;" ></i>
                                 @if (!(Auth::user()))

                                     
                                 <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger text-white" style="transform: translate(-50%, -50%) !important;">0</span>
                                 @else
                                 <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger text-white amount-wishlist" style="transform: translate(-50%, -50%) !important;">{{count($amount)}}</span>
                                     
                                 @endif

                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="header_bottom">
              @include('layouts.navbar')
            </div>
         </div>
      </header>
      <!-- end header inner -->
      <!-- end header -->
    @yield('banner')
      <!-- end six_box section -->
      <!-- project section -->
      
            @yield('content')
         </div>
      </div>
      <!-- end project section -->
      <!-- fashion section -->
      {{-- <div class="fashion">
         <img src="assets/images/fashion.jpg" alt="#"/>
      </div> --}}
      <!-- end fashion section -->
      <!-- news section -->
      {{-- <div class="news">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Letest News</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 margin_top40">
                  <div class="row d_flex">
                     <div class="col-md-5">
                        <div class="news_img">
                           <figure><img src="assets/images/news_img1.jpg"></figure>
                        </div>
                     </div>
                     <div class="col-md-7">
                        <div class="news_text">
                           <h3>Specimen book. It has survived not only five</h3>
                           <span>7 July 2019</span> 
                           <div class="date_like">
                              <span>Like </span><span class="pad_le">Comment</span>
                           </div>
                           <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-12 margin_top40">
                  <div class="row d_flex">
                     <div class="col-md-5">
                        <div class="news_img">
                           <figure><img src="assets/images/news_img2.jpg"></figure>
                        </div>
                     </div>
                     <div class="col-md-7">
                        <div class="news_text">
                           <h3>Specimen book. It has survived not only five</h3>
                           <span>7 July 2019</span> 
                           <div class="date_like">
                              <span>Like </span><span class="pad_le">Comment</span>
                           </div>
                           <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-12 margin_top40">
                  <div class="row d_flex">
                     <div class="col-md-5">
                        <div class="news_img">
                           <figure><img src="assets/images/news_img3.jpg"></figure>
                        </div>
                     </div>
                     <div class="col-md-7">
                        <div class="news_text">
                           <h3>Specimen book. It has survived not only five</h3>
                           <span>7 July 2019</span> 
                           <div class="date_like">
                              <span>Like </span><span class="pad_le">Comment</span>
                           </div>
                           <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div> --}}
      <!-- end news section -->
      <!-- three_box section -->
      <div class="three_box mt-5">
         <div class="container">
            <div class="row">
               <div class="col-md-4">
                  <div class="gift_box">
                     <i><img src="assets/images/icon_mony.png"></i>
                     <span>Money Back</span>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="gift_box">
                     <i><img src="assets/images/icon_gift.png"></i>
                     <span>Special Gift</span>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="gift_box">
                     <i><img src="assets/images/icon_car.png"></i>
                     <span>Free Shipping</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end three_box section -->

      <!--  footer -->
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-md-3">
                     <div class="inror_box">
                        <h3>INFORMATION </h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</p>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="inror_box">
                        <h3>MY ACCOUNT </h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</p>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="inror_box">
                        <h3>ABOUT  </h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</p>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="inror_box">
                        <h3>CONTACTS  </h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <p>© 2022 All Rights Reserved. Design by NXH</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      {{-- <script src="assets/js/jquery.min.js"></script> --}}
      {{-- <script src="assets/js/popper.min.js"></script> --}}
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      {{-- <script src="assets/js/jquery-3.0.0.min.js"></script> --}}
      <!-- sidebar -->
      {{-- <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script> --}}
      {{-- <script src="assets/js/custom.js"></script> --}}
   </body>
</html>

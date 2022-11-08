<div class="container">
    <div class="row">
       <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
         <nav class="navigation navbar navbar-expand-md navbar-dark ">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample04">
               <ul class="navbar-nav mr-auto">
                  <li class="nav-item 
                  <?php
                     if ($url == route('index')) {
                        echo 'active';
                     }
                     else{
                        null;
                     }
                  ?>">
                     <a class="nav-link" href="/">Trang chủ</a>
                  </li>
                  <li class="nav-item
                  <?php
                     if ($url == route('san-pham')) {
                        echo 'active';
                     }
                     else{
                        null;
                     }
                  ?>">
                     <a class="nav-link" href="san-pham">Sản phẩm</a>
                  </li>
                  <li class="nav-item 
                  <?php
                  if ($url == route('gio-hang.index')) {
                     echo 'active';
                  }
                  else{
                     null;
                  }
                  ?>">
                     <a class="nav-link" href="gio-hang">Giỏ hàng</a>
                  </li>
                  <li class="nav-item
                  <?php
                  if ($url == route('post')) {
                     echo 'active';
                  }
                  else{
                     null;
                  }
                   ?>">
                     <a class="nav-link" href="/bai-viet">Tin tức</a>
                  </li>
                  <li class="nav-item 
                  <?php
                     if ($url == route('gioi-thieu')) {
                        echo 'active';
                     }
                     else{
                        null;
                     }
                   ?>">
                     <a class="nav-link" href="/gioi-thieu">Về chúng tôi</a>
                  </li> 
               </ul>
            </div>
         </nav>
      </div>
      <div class="col-md-4">
         <div class="search">
            <form action="/tim-kiem/" method="get">
               <input class="form_sea" type="text" placeholder="Tìm kiếm sản phẩm..." name="key">
               <button type="submit" class="seach_icon"><i class="fa fa-search"></i></button>
            </form>
         </div>
      </div>
   </div>
 </div>
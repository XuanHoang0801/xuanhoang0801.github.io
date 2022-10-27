<div class="container">
    <div class="row">
       <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
          <nav class="navigation navbar navbar-expand-md navbar-dark ">
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav mr-auto">
                   <li class="nav-item active">
                      <a class="nav-link" href="/">Home</a>
                   </li>
                   <li class="nav-item">
                      <a class="nav-link" href="about.html">About</a>
                   </li>
                   <li class="nav-item">
                      <a class="nav-link" href="san-pham">Products</a>
                   </li>
                   <li class="nav-item">
                      <a class="nav-link" href="fashion.html">Fashion</a>
                   </li>
                   <li class="nav-item">
                      <a class="nav-link" href="/bai-viet">News</a>
                   </li>
                   <li class="nav-item">
                      <a class="nav-link" href="contact.html">Contact Us</a>
                   </li>
                </ul>
             </div>
          </nav>
       </div>
       <div class="col-md-4">
          <div class="search">
             <form action="/tim-kiem/" method="get">
               {{-- @csrf --}}
                <input class="form_sea" type="text" placeholder="Tìm kiếm sản phẩm..." name="key">
                <button type="submit" class="seach_icon"><i class="fa fa-search"></i></button>
             </form>
          </div>
       </div>
    </div>
 </div>
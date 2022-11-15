<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NsxController;
use App\Http\Controllers\OrderAdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\TestCheckController;
use App\Http\Controllers\WishlistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/dang-ky',[CustomerController::class,'register']);
Route::post('/dang-ky',[CustomerController::class,'postRegister']);
Route::get('/dang-nhap',[CustomerController::class,'login']);
Route::post('/dang-nhap',[CustomerController::class,'postlogin']);
Route::post('/dang-xuat',[CustomerController::class,'Logout'])->name('customer.logout');
Route::get('/',[CustomerController::class,'index'])->name('index');
Route::get('thong-tin',[CustomerController::class,'profile']);
Route::get('doi-mat-khau',[CustomerController::class,'changePassword'])->middleware('login');
Route::post('doi-mat-khau',[CustomerController::class,'changePasswordPost'])->middleware('login');
Route::get('quen-mat-khau',[CustomerController::class,'emailPassword']);
Route::post('quen-mat-khau',[CustomerController::class,'sendMail'])->name('send.reset');
Route::get('quen-mat-khau/{token}',[CustomerController::class,'resetPassword'])->name('reset.password.get');
Route::post('/update-user',[CustomerController::class,'updateUser']);
//Sản phẩm
Route::get('/san-pham',[CustomerController::class,'list'])->name('san-pham');
Route::get('/san-pham/{id}',[CustomerController::class,'detail']);
Route::get('/tim-kiem',[CustomerController::class,'search']);
Route::get('/comment/{id}',[CustomerController::class,'destroy']);
//bài viết
Route::get('/bai-viet',[CustomerController::class,'listpost'])->name('post');
Route::get('/bai-viet/{id}',[CustomerController::class,'detailpost']);
Route::get('/gioi-thieu',[CustomerController::class,'gioithieu'])->name('gioi-thieu');
Route::post('/comment-post',[CustomerController::class,'commentpost']);

Route::get('/dat-hang',[CustomerController::class,'DatHang']); 
Route::post('/dat-hang',[CustomerController::class,'DatHang']); 
Route::get('/cart/update', [AjaxController::class,'amount']);
Route::get('/cart/delete/{id}', [AjaxController::class,'delete']);
//ajax
Route::post('/ajax/add-cart',[ShoppingCartController::class, 'store']);
Route::post('/ajax/add-cart-index',[ShoppingCartController::class, 'add']);
Route::post('/ajax/add-wishlist',[WishlistController::class, 'store']) ;
Route::get('/ajax/wishlist-delete/{id}',[WishlistController::class, 'destroy']);
Route::post('/ajax/cart-update',[ShoppingCartController::class, 'amount']);
Route::get('/ajax/cart-delete/{id}',[ShoppingCartController::class, 'destroy']);
Route::post('/ajax/fill-product',[AjaxController::class, 'fill']);
Route::post('/ajax/fill-price',[AjaxController::class, 'fillPrice']);
Route::post('/ajax/fill-producer',[AjaxController::class, 'fillProducer']);
Route::post('/ajax/notify-status',[AjaxController::class, 'UpdateNotify']);
Route::post('/ajax/product-like',[AjaxController::class, 'likeProduct']);
Route::post('/ajax/post-like',[AjaxController::class, 'likePost']);
Route::post('/ajax/check-pass',[AjaxController::class, 'checkPass']);
Route::post('/ajax/delete-notify',[AjaxController::class, 'deleteNotify']);
Route::post('/ajax/ratting',[AjaxController::class, 'Ratting']);
//donhang
Route::get('/don-hang/{id}',[CustomerController::class,'detaiBill'])->middleware('login');
Route::get('/da-giao-hang',[CustomerController::class,'DaGiao'])->middleware('login');
//resource
Route::resource('/yeu-thich',WishlistController::class)->middleware('login');
Route::resource('/gio-hang',ShoppingCartController::class)->middleware('login');
Route::resource('/don-hang',OrderController::class)->middleware('login');
Route::resource('/comment',CommentController::class);

//admin
Route::group(['prefix'=>'/admin'], function(){
    Auth::routes();
});

Route::group(['prefix'=>'/admin','middleware'=>['checkUser']], function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/quan-ly-san-pham/da-xoa',[ProductController::class,'garbage'])->name('quan-ly-san-pham.da-xoa');
    Route::get('/quan-ly-san-pham/khoi-phuc/{id}',[ProductController::class,'khoiphuc']);
    Route::delete('/quan-ly-san-pham/xoa/{id}',[ProductController::class,'xoa']);
    Route::get('/quan-ly-bai-viet/da-xoa',[PostController::class,'garbage'])->name('quan-ly-bai-viet.da-xoa');
    Route::get('/quan-ly-bai-viet/khoi-phuc/{id}',[PostController::class,'khoiphuc']);
    Route::get('/quan-ly-bai-viet/xoa/{id}',[PostController::class,'xoa']);
    Route::get('/quan-ly-bai-viet/gioi-thieu',[PostController::class,'gioithieu']);
    Route::get('/quan-ly-don-hang/da-giao',[OrderAdminController::class,'delivered'])->name('quan-ly-don-hang.da-giao');
    Route::get('/quan-ly-don-hang/don-huy',[OrderAdminController::class,'garbage'])->name('quan-ly-don-hang.don-huy');
    Route::delete('/quan-ly-don-hang/xvv/{id}',[OrderAdminController::class,'force'])->name('quan-ly-don-hang.xoa');
    //resource
    Route::resource('/danh-muc', CategoriesController::class);
    Route::resource('/quan-ly-san-pham', ProductController::class);
    Route::resource('/nha-san-xuat', NsxController::class);
    Route::resource('/quan-ly-bai-viet', PostController::class);
    Route::resource('/quan-ly-don-hang',OrderAdminController::class);
    Route::resource('/khach-hang',ClientController::class);
    Route::resource('/trang-thai', StatusController::class);
});


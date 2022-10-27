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
Route::get('/admin2',function()
{
    return view('admin2.index');
});
Route::get('/dang-ky',[CustomerController::class,'register']);
Route::post('/dang-ky',[CustomerController::class,'postRegister']);
Route::get('/dang-nhap',[CustomerController::class,'login']);
Route::post('/dang-nhap',[CustomerController::class,'postlogin']);
Route::get('/',[CustomerController::class,'index']);
Route::get('/san-pham',[CustomerController::class,'list']);
Route::get('/san-pham/{id}',[CustomerController::class,'detail']);
Route::get('/tim-kiem',[CustomerController::class,'search']);
// Route::post('/add-card/{id}',[CustomerController::class,'card'])->middleware('login');
//bài viết
Route::get('/bai-viet',[CustomerController::class,'listpost']);
Route::get('/bai-viet/{id}',[CustomerController::class,'detailpost']);
Route::post('/comment-post',[CustomerController::class,'commentpost']);

Route::get('/dat-hang',[CustomerController::class,'DatHang']); 
Route::post('/dat-hang',[CustomerController::class,'DatHang']); 
Route::get('/cart/update', [AjaxController::class,'amount']);
Route::get('/cart/delete/{id}', [AjaxController::class,'delete']);
//ajax
Route::post('/ajax/add-cart',[ShoppingCartController::class, 'store']);
Route::post('/ajax/add-cart-index',[ShoppingCartController::class, 'add']);
Route::post('/ajax/add-wishlist',[WishlistController::class, 'store']);
Route::get('/ajax/wishlist-delete/{id}',[WishlistController::class, 'destroy']);
Route::post('/ajax/cart-update',[ShoppingCartController::class, 'amount']);
Route::get('/ajax/cart-delete/{id}',[ShoppingCartController::class, 'destroy']);
Route::post('/ajax/fill-product',[AjaxController::class, 'fill']);
Route::post('/ajax/fill-price',[AjaxController::class, 'fillPrice']);
Route::post('/ajax/fill-producer',[AjaxController::class, 'fillProducer']);

Route::resource('/test', TestCheckController::class);

// Route::resource('/gio-hang',CardController::class)->middleware('login');
Route::resource('/yeu-thich',WishlistController::class)->middleware('login');
Route::resource('/cart',ShoppingCartController::class)->middleware('login');
Route::resource('/don-hang',OrderController::class)->middleware('login');
Route::resource('/comment',CommentController::class);


//admin
Route::group(['prefix'=>'/admin'], function(){

    Auth::routes();
});

Route::group(['prefix'=>'/admin','middleware'=>['checkUser']], function(){

    Route::get('/', [HomeController::class, 'index'])->name('home');
    //ajax
    Route::group(['prefix'=>'/ajax'], function(){
     Route::get('/producer/{idTheLoai}', [AjaxController::class,'getLoaiTin']);
    });

    Route::get('/quan-ly-san-pham/da-xoa',[ProductController::class,'garbage']);
    Route::get('/quan-ly-san-pham/khoi-phuc/{id}',[ProductController::class,'khoiphuc']);
    Route::delete('/quan-ly-san-pham/xoa/{id}',[ProductController::class,'xoa']);
    Route::get('/quan-ly-bai-viet/da-xoa',[PostController::class,'garbage']);
    Route::get('/quan-ly-bai-viet/khoi-phuc/{id}',[PostController::class,'khoiphuc']);
    Route::get('/quan-ly-bai-viet/xoa/{id}',[PostController::class,'xoa']);
    Route::resource('/danh-muc', CategoriesController::class);
    // Route::resource('/nha-san-xuat', ProducerController::class);
    Route::resource('/quan-ly-san-pham', ProductController::class);
    Route::resource('/nha-san-xuat', NsxController::class);
    Route::resource('/quan-ly-bai-viet', PostController::class);
    Route::resource('/quan-ly-don-hang',OrderAdminController::class);

    Route::resource('/trang-thai', StatusController::class);
});


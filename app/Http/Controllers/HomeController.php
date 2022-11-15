<?php

namespace App\Http\Controllers;

use App\Models\Notify;
use App\Models\order;
use App\Models\Post;
use App\Models\product;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $product = product::all();
        $order = order::all();
        $user = User::all();
        $post = Post::all();
        $giao = order::where('status_id',4)->get();
        $notify = Notify::where('style',0)->orderBy('id', 'DESC')->get();
        $amount = Notify::where('status',0)->where('style',0)->get();
        $url = $request->url();
        return view('admin2.pages.dashboard',compact('product','order','user','post','giao','notify','amount','url'));
    }
}

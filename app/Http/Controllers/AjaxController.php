<?php

namespace App\Http\Controllers;

use App\Models\card;
use App\Models\Categories;
use App\Models\producer;
use App\Models\product;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function getLoaiTin($idTheLoai){
        $loaitin = producer::where('categories_id', $idTheLoai)->get();
        foreach($loaitin as $lt)
        {
            echo "<option value='".$lt->id."'>".$lt->name."</option>";
        }
   }

   public function amount(Request $request)
   {
        $id = $request->id;
        $amount = $request->amount;
        $card = card::find($id);
        $card->amount=$amount;
        $card->save();
    }

    public function delete($id)
    {
        card::find($id)->delete();
    }

    public function fill(Request $request)
    {
        $id = $request->id;
        $product = product::with('categories')->where('categories_id',$id)->orderBy('id','DESC')->get();
        foreach ($product as $list)
        {
            echo '
                <div class="project_box" data-id="'.$list->id.'">
                    <a href="/san-pham/'.$list->id.'">
                    <div class="dark_white_bg" >
                        <img  src="assets/img/'.$list->image.'" alt="#" width="500">
                    </div>
                    <h3  class="text-center" style="text-transform: uppercase;"><b>'.$list->name.'</b></h3>
        
                    <p class="text-warning">'.number_format($list->price).' &#8363</p>
                    </a>
        
                    <button class="btn btn-success mb-2 add-cart">Thêm vào giỏ hàng</button>
                    <div class="success" style="position: fixed;right: 0;top: 0;"> 
                        <div class="alert"></div>
                    </div>
                </div>               
            ';
        };

        if ($id == 'all') {
            $product = product::all()->orderBy('id','DESC');
            foreach ($product as $list)
            {
                echo '
                    <div class="project_box" data-id="'.$list->id.'">
                        <a href="/san-pham/'.$list->id.'">
                        <div class="dark_white_bg" >
                            <img  src="assets/img/'.$list->image.'" alt="#" width="500">
                        </div>
                        <h3  class="text-center" style="text-transform: uppercase;"><b>'.$list->name.'</b></h3>
            
                        <p class="text-warning">'.number_format($list->price).' &#8363</p>
                        </a>
            
                        <button class="btn btn-success mb-2 add-cart">Thêm vào giỏ hàng</button>
                        <div class="success" style="position: fixed;right: 0;top: 0;"> 
                            <div class="alert"></div>
                        </div>
                    </div>               
                ';
            };
        }
    }

    public function fillPrice(Request $request)
    {
        $id = $request->id;
        if ($id =='up') {
            $product = product::orderBy('price','ASC')->get();
            foreach ($product as $list)
            {
                echo '
                    <div class="project_box" data-id="'.$list->id.'">
                        <a href="/san-pham/'.$list->id.'">
                        <div class="dark_white_bg" >
                            <img  src="assets/img/'.$list->image.'" alt="#" width="500">
                        </div>
                        <h3  class="text-center" style="text-transform: uppercase;"><b>'.$list->name.'</b></h3>
            
                        <p class="text-warning">'.number_format($list->price).' &#8363</p>
                        </a>
            
                        <button class="btn btn-success mb-2 add-cart">Thêm vào giỏ hàng</button>
                        <div class="success" style="position: fixed;right: 0;top: 0;"> 
                            <div class="alert"></div>
                        </div>
                    </div>               
                ';
            };
        } 
        if($id == 'down')
        {
            $product = product::orderBy('price','DESC')->get();
            foreach ($product as $list)
            {
                echo '
                    <div class="project_box" data-id="'.$list->id.'">
                        <a href="/san-pham/'.$list->id.'">
                        <div class="dark_white_bg" >
                            <img  src="assets/img/'.$list->image.'" alt="#" width="500">
                        </div>
                        <h3  class="text-center" style="text-transform: uppercase;"><b>'.$list->name.'</b></h3>
            
                        <p class="text-warning">'.number_format($list->price).' &#8363</p>
                        </a>
            
                        <button class="btn btn-success mb-2 add-cart">Thêm vào giỏ hàng</button>
                        <div class="success" style="position: fixed;right: 0;top: 0;"> 
                            <div class="alert"></div>
                        </div>
                    </div>               
                ';
            };

        }

        if ($id == 'all') {
            $product = product::all()->orderBy('id','DESC');
            foreach ($product as $list)
            {
                echo '
                    <div class="project_box" data-id="'.$list->id.'">
                        <a href="/san-pham/'.$list->id.'">
                        <div class="dark_white_bg" >
                            <img  src="assets/img/'.$list->image.'" alt="#" width="500">
                        </div>
                        <h3  class="text-center" style="text-transform: uppercase;"><b>'.$list->name.'</b></h3>
            
                        <p class="text-warning">'.number_format($list->price).' &#8363</p>
                        </a>
            
                        <button class="btn btn-success mb-2 add-cart">Thêm vào giỏ hàng</button>
                        <div class="success" style="position: fixed;right: 0;top: 0;"> 
                            <div class="alert"></div>
                        </div>
                    </div>               
                ';
            };
        }    
    }
    public function fillProducer(Request $request)
    {
        $id = $request->id;
        $product = product::where('producer_id',$id)->orderBy('id','DESC')->get();
        foreach ($product as $list)
            {
                echo '
                    <div class="project_box" data-id="'.$list->id.'">
                        <a href="/san-pham/'.$list->id.'">
                        <div class="dark_white_bg" >
                            <img  src="assets/img/'.$list->image.'" alt="#" width="500">
                        </div>
                        <h3  class="text-center" style="text-transform: uppercase;"><b>'.$list->name.'</b></h3>
            
                        <p class="text-warning">'.number_format($list->price).' &#8363</p>
                        </a>
            
                        <button class="btn btn-success mb-2 add-cart">Thêm vào giỏ hàng</button>
                        <div class="success" style="position: fixed;right: 0;top: 0;"> 
                            <div class="alert"></div>
                        </div>
                    </div>               
                ';
            };
    }

}

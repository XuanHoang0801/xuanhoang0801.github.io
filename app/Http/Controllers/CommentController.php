<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            $comment = new Comment();
            $comment->product_id=$request->id;
            $comment->user_id=$request->user()->id;
            $comment->body=$request->body;
            $comment->save();
            $body = $request->body;
    
            echo '
                <div class="form-group div-comment">
                    <p class="name text-primary">'.$request->user()->fullname.'</p>
                    <div class="d-flex justify-content-between">
                        <p class="content ml-3 text-muted">'.$body.'</p>
                        <span class="text-secondary text-xxs">Vừa xong</span>
                    </div>
                    <span class="text-danger delete" id="" style="cursor: pointer" data-id="'.$comment->id.'">Xóa</span>
                    <div style=" width:100%;height: .1px; background:rgb(246, 243, 243)"></div>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
                <script>
                $(document).ready(function(){
                    $(".delete").click(function(){
                        var id= $(this).attr("data-id");
                        var view =  $(this).parents(".div-comment").remove();
                        
                        $.get("/comment/"+id,
                            function(data){
                               
                         });
                    });
            
                });
                </script>
            ';
    }
        

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
    }
}

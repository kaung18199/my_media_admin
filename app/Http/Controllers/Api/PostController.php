<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //get all post
    public function getAllPost(){
        $post = Post::get();
        return response()->json([
            'post' => $post,
            'status' => 'success'
        ],200);
    }

    //search key
    public function postSearch(Request $request){
        $post = Post::where('title','like','%'.$request->key.'%')->get();
        return response()->json([
            'searchData' => $post
        ]);
    }

    //postDetails
    public function postDetails(Request $request){
        $id = $request->postId;
        $post = Post::where('post_id',$id)->first();
        return response()->json([
            'post' => $post
        ]);
    }
}

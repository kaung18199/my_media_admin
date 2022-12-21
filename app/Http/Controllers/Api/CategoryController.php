<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //get category
    public function getAllCategory(){
        $category = Category::select('category_id','title','description')->get();

        return response()->json([
            'category' => $category
        ],200);
    }

    //search category
    public function categorySearch(Request $request){
        $category = Category::select('posts.*')
                            ->join('posts','categories.category_id','posts.category_id')
                            -> where('categories.title','like','%'.$request->key.'%')->get();
        return response()->json([
            'result' => $category
        ]);
    }
}

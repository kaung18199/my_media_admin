<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category page
    public function index(){
        $category = Category::when(request('key'),function($q){
            $key = request('key');
            $q->orWhere('title','like','%'.$key.'%')
              ->orWhere('description','like','%'.$key.'%');
        })->get();
        return view('admin.category.index',compact('category'));
    }

    //create category
    public function createCategory(Request $request){
        $this->validationCheck($request);
        $data = $this->getDataCategory($request);
        Category::create($data);
        return back();
    }

    //delete category
    public function deleteCategory($id){
        Category::where('category_id',$id)->delete();
        return redirect()->route('admin#category')->with(['deleteSuccess' => 'Category delete Success']);
    }

    //edit category page
    public function editCategoryPage($id){
        $category = Category::when(request('key'),function($q){
            $key = request('key');
            $q->orWhere('title','like','%'.$key.'%')
              ->orWhere('description','like','%'.$key.'%');
        })->get();
        $data = Category::where('category_id',$id)->first();
        return view('admin.category.edit',compact('data','category'));
    }

    //update category data
    public function categoryUpdate(Request $request,$id){
        $this->validationCheck($request);
        $updateData = $this->getDataCategory($request);
        // Category::
        Category::where('category_id',$id)->update($updateData);
        return redirect()->route('admin#category')->with(['successUpdate'=>'update is success!']);
    }

    //category validation check
    private function validationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required',
            'description' => 'required'
        ])->validate();
    }

    //getData for category
    private function getDataCategory($request){
        return [
            'title' => $request->categoryName,
            'description' => $request->description
        ];
    }
}

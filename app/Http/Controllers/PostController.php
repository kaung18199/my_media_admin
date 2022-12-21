<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    //direct Post page
    public function index(){
        $category = Category::get();
        $post = Post::get();
        return view('admin.post.index',compact('category','post'));
    }

    //create post
    public function createPost(Request $request){
        $this->postValidationCheck($request);

        if(!empty($request->postImage)){
            $file = $request->file('postImage');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/postImage',$fileName);
            $data = $this->getDate($request,$fileName);
        }else{
            $data = $this->getDate($request,NULL);
        }

        Post::create($data);
        return redirect()->route('admin#post');
    }

    //delete post
    public function deletePost($id){
        $postData = Post::where('post_id',$id)->first();
        $dbImageName = $postData['image'];

        Post::where('post_id',$id)->delete();

        if(File::exists(public_path().'/postImage/'.$dbImageName)){
            File::delete(public_path().'/postImage/'.$dbImageName);
        };

        return redirect()->route('admin#post');
    }

    //update post pate
    public function editPage($id){
        $postData = Post::where('post_id',$id)->first();
        $post = Post::get();
        $category = Category::get();
        return view('admin.post.update',compact('postData','category','post'));
    }

    //update post
    public function updatePost(Request $request,$id){
        $this->postValidationCheck($request);
        $data = $this->getDateUpdate($request);

        if(isset($request->postImage)){
            $file = $request->file('postImage');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $data['image'] = $fileName;

            $postData = Post::where('post_id',$id)->first();
            $dbImageName = $postData['image'];

            if(File::exists(public_path().'/postImage/'.$dbImageName)){
                File::delete(public_path().'/postImage/'.$dbImageName);
            };

            $file->move(public_path().'/postImage',$fileName);

            Post::where('post_id',$id)->update($data);
        }else{
            Post::where('post_id',$id)->update($data);
        }

        return redirect()->route('admin#post');
    }

    //validation check
    private function postValidationCheck($request){
        Validator::make($request->all(),[
            'postTitle' => 'required',
            'description' => 'required',
            'postCategory' => 'required'
        ])->validate();
    }

    //get date for update
    private function getDateUpdate($request){
        return [
            'title' => $request->postTitle,
            'description' => $request->description,
            'category_id' => $request->postCategory
        ];
    }

    //get data for post
    private function getDate($request,$fileName){
        return [
            'title' => $request->postTitle,
            'description' => $request->description,
            'category_id' => $request->postCategory,
            'image' => $fileName
        ];
    }

}

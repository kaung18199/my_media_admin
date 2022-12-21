<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //direct list page
    public function index(){
        $userList = User::when(request('key'),function($q){
            $key = request('key');
            $q->orWhere('name','like','%'.$key.'%')
              ->orWhere('email','like','%'.$key.'%')
              ->orWhere('address','like','%'.$key.'%');
        })->get();
        return view('admin.list.index',compact('userList'));
    }

    //delete user list
    public function deleteAccount($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'User Account Deleted!']);
    }
}

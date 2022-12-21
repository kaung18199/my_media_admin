<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // usre login and release token
    public function login(Request $request){
        //email and password
        $user = User::where('email',$request->email)->first();
        if(isset($user)){
            if(Hash::check($request->password,$user->password)){
                return response()->json([
                    'status'=> true,
                    'user'=>$user,
                    'token' => $user->createToken(time())->plainTextToken
                ]);
            }else{
                return response()->json([
                    'user' => null,
                    'token' => null,
                    'status' => false
                ]);
            }
        }else{
            return response()->json([
                'user' => null,
                'token' => null,
                'status' => false
            ]);
        }
    }

    //register
    public function register(Request $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password'=>Hash::make($request->password)
        ];

        User::create($data);

        $user = User::where('email',$request->email)->first();

        return response()->json([
            'user' => $user,
            'token' => $user->createToken(time())->plainTextToken
        ],200);
    }

    public function categoryList(){
        $category = Category::get();
        return response()->json([
            'category' => $category
        ],200);
    }
}

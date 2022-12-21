<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //direct admin home page
    public function index(){
        $user = User::select('id','name','address','phone','gender','email')->where('id',Auth::user()->id)->first();
        // dd($user->toArray());
        return view('admin.profile.index',compact('user'));
    }

    //Update admin profile
    public function updateAdminAccount(Request $request){
        // dd($request->all());
        $this->validationCheckData($request);
        $userData = $this->getUserInfo($request);
        // dd($userData);
        User::where('id',Auth::user()->id)->update($userData);
        return redirect()->route('dashboard')->with(['success' => 'update data success']);
    }

    //Change Password Page
    public function changePassword(){
        return view('admin.profile.changePassword');
    }

    //change password
    public function change(Request $request){
        $this->validationCheckPassword($request);

        $dbPassword = User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword = $dbPassword->password;

        if(Hash::check($request->oldPassword,$dbPassword)){
            User::where('id',Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);
            return redirect()->route('dashboard');
        }else{
            return back()->with(['fail'=>'Old Password Do Not Match']);
        };
    }

    //profile page redirect
    // public function profilePage(){
    //     return view('admin.profilePage');
    // }

    //get user info
    private function getUserInfo($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'gender' => $request->gender
        ];
    }

    //check validator data
    private function validationCheckData($request){
        Validator::make($request->all(),[
            'name' => 'required|max:255',
            'email'=> 'required',
            'phone' => 'required',
            'address' => 'required',
        ])->validate();
    }

    //check password validation
    private function validationCheckPassword($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'comfirmPassword' => 'required|same:newPassword'
        ])->validate();
    }
}

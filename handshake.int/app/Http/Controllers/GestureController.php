<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;

class GestureController extends Controller
{
    use AuthenticatesUsers;


    public function registerGestures(Request $request){
        $validator = Validator::make($request->all(), [
            'gesture1' => 'required|json',
            'gesture2' => 'required|json',
            'gesture3' => 'required|json'
        ]);
        if(!$validator->fails()){
            $email = $request->session()->get('email');
            $name = $request->session()->get('name');
            $link = $request->session()->get('link');
            $user = $this->create(["email" => $email, "name" => $name]);
            $user->image_link = $link;
            $user->gesture1 = json_encode($request->input('gesture1'));
            $user->gesture2 = json_encode($request->input('gesture2'));
            $user->gesture3 = json_encode($request->input('gesture3'));
            $user->registration_complete = true;
            $user->save();
            $this->guard()->login($user);
            return redirect('/');
        }
        else{
            return redirect('/gestures')->withErrors($validator);
        }
    }

    public function checkGestures(Request $request){
        if($request->session()->has('user')){
            $user = $request->session()->get('user');
            $loginUser = User::where('name', $user)->first();
            Auth::loginUsingId($loginUser->id);
            return redirect('/');
        }
    }

    protected function guard()
    {
        return Auth::guard();
    }
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'name' => $data['name']
        ]);
    }
}

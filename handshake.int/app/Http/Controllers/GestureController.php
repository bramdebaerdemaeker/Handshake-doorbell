<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GestureController extends Controller
{
    public function registerGestures(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'gesture1' => 'required|json',
            'gesture2' => 'required|json',
            'gesture3' => 'required|json'
        ]);
        if(!$validator->fails()){
            $user->gesture1 = json_encode($request->input('gesture1'));
            $user->gesture2 = json_encode($request->input('gesture2'));
            $user->gesture3 = json_encode($request->input('gesture3'));
            $user->registration_complete = true;
            $user->save();
            return redirect('/');
        }
        else{
            return redirect('/gestures')->withErrors($validator);
        }
    }

    public function checkGestures(Request $request){
        return redirect('/');
    }
}

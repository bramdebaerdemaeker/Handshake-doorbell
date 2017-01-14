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
            $user->gesture1 = trim($request->input('gesture1'),'"');
            $user->gesture2 = trim($request->input('gesture2'), '"');
            $user->gesture3 = trim($request->input('gesture3'), '"');
            $user->save();
            var_dump($user->gesture1);
            var_dump($user->gesture2);
            var_dump($user->gesture3);

            return ("miauw");
        }
        else{
            return redirect('/gestures')->withErrors($validator);
        }
    }
}

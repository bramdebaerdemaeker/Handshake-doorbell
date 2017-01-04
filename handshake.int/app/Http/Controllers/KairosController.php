<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Kairos as Kairos;

class KairosController extends Controller
{
    public function kairosEnroll(Request $request){

        $image = $request->input('photo');
        $img = substr($image, 1+strrpos($image, ','));
        file_put_contents(public_path() . "/img/test.png", base64_decode($img));
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use App\Libraries\Kairos as Kairos;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login(Request $request)
    {
        $image = $request->input('photo');

        $img = substr($image, 1+strrpos($image, ','));

        $Kairos = new Kairos("fffb0acd","ecef1039e93e6d353f9180fc97ce6360");
        $gallery = 'gallery';
        $argumentArray = array(
            "image" => $img,
            "gallery_name" => $gallery
        );

        $response = json_decode($Kairos->recognize($argumentArray));
        var_dump($response->images[0]->transaction->subject_id);
        $user = User::where('name', '=', $response->images[0]->transaction->subject_id)->first();
        if($user && $response->images[0]->transaction->status == "success" && $response->images[0]->transaction->confidence >= 0.70){
            return view('gestures');
        }

    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'photo' => 'required|image'
        ]);
    }
}

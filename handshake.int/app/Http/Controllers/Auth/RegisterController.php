<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Libraries\Kairos as Kairos;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function register(Request $request)
    {
        $image = $request->input('photo');
        $email = $request->input('email');
        $name = $request->input('name');

        $this->validator($request->all())->validate();

        $img = substr($image, 1+strrpos($image, ','));

        $Kairos = new Kairos("fffb0acd","ecef1039e93e6d353f9180fc97ce6360");
        $gallery = 'gallery';
        $argumentArray = array(
            "image" => $img,
            "subject_id" => $name,
            "gallery_name" => $gallery
        );

        $response = json_decode($Kairos->enroll($argumentArray));
        if($response->images[0]->transaction->status == "success") {
            file_put_contents(public_path() . "/img/" . $name . '.png', base64_decode($img));
            $link = "/img/" . $name . '.png';
            $request->session()->put('link', $link);
            $request->session()->put('email', $email);
            $request->session()->put('name', $name);
            return view('gestures')->with('data', '');
        }
        else{
            redirect('/');
        }
    }



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'name' => 'required|max:30|unique:users',
            'photo' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'name' => $data['name']
        ]);
    }

    public function gestures(){
      return view ('gestures')->with('data', '');
    }
}

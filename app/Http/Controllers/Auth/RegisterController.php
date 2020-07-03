<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\r_affiliate_info;

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
    protected $redirectTo = '/dashboard';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $AFF_ID = \DB::Table('r_affiliate_infos')->insertGetId([
            'AFF_ID' => \DB::Table('r_affiliate_infos')->get()->count()+1,
            'AFF_CODE' => $data['code'],
        ]);
        $request = \Request::capture();
        $businesspermit = $request->file('file');

        if($businesspermit!=null)
        {
            $businesspermit->move(public_path('uploads/businesspermits'),$businesspermit->getClientOriginalName());  
            $businesspermit_name = $businesspermit->getClientOriginalName();
        }
        else
            $businesspermit_name = "";
        
        return User::create([
            'id' =>  r_affiliate_info::max('AFF_ID'),
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'AFF_ID' => r_affiliate_info::max('AFF_ID'),
            'profit' => $data['profit'],
            'businesspermit_path' => $businesspermit_name,
        ]);
        
    }

    
}

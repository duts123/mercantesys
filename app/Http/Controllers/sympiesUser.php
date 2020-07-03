<?php
namespace App\Http\Controllers;

use App\r_account_credential;
use App\r_account_notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;
use Illuminate\Support\Facades\Validator;
use Redirect;

class sympiesUser extends Controller
{
    
    public function loginUser(Request $request)
    {
     	$username = $request->username;
        $password = md5($request->password);
        $cred =  r_account_credential::where('rac_username', $username)->orWhere('rac_email',$username)
            ->where('rac_password', $password)->get();

        $isLogin = ($cred->count());
        $cred = $cred->first();

        if($isLogin){
            $account = Array(
                "ID" => $cred->rac_accountid,
                "NAME" => $cred->rac_fullname,
                "CONTACT_NO" => $cred->rac_pnumb,
                "HOME_ADDRESS" => "",
                "EMAIL" => $cred->rac_email,
            );
            $get = Session::get('sympiesAccount');
            Session::put('sympiesAccount', $account);
        }

        return $isLogin; 

          /* \DB::TABLE('users')
            ->WHERE('email', 'loyolapat04@gmail.com')
            ->UPDATE([
                 'password' => bcrypt('admin')
             ]);
            return "sucess";	
	*/
    }

    public function createUser(Request $request)
    {
        // $validatedData = $request->validate([
            
        // ]);
        
        $validator = Validator::make($request->all(), [
            'fullname' => ['required', 'max:255'],
            'password' => ['required', 'max:255'],
            'email' => ['required'],
            'contact' => ['required'],
            'houseno' => ['required'],
            'street' => ['required'],
            'brgy' => ['required'],
            'city' => ['required'],
        ]);
        if($validator->fails()){
            return Redirect::back()->withInput()->withErrors(['errors' => $validatedData]);    
        }else{
            \DB::select("call sp_addmercante_user(?,?,?,?,?,?,?,?)",
                [
                    $request->fullname,
                    $request->password,
                    $request->email,
                    $request->contact,
                    $request->houseno,
                    $request->street,
                    $request->brgy,
                    $request->city,
                ]);
            $email = $request->email;
            $password = md5($request->password);
            $cred = r_account_credential::where('rac_username', $email)->orWhere('rac_email',$email)
                ->where('rac_password', $password)->get();

            $isLogin = ($cred->count());
            $cred = $cred->first();

            if($isLogin){
                $account = Array(
                    "ID" => $cred->rac_accountid,
                    "NAME" => $cred->rac_fullname,
                    "CONTACT_NO" => $cred->rac_pnumb,
                    "HOME_ADDRESS" => "",
                    "EMAIL" => $cred->rac_email,
                );
                $get = Session::get('sympiesAccount');
                Session::put('sympiesAccount', $account);
              
            }
            return back()->with('success', 'Data inserted Successfully!');
        }
    }
}

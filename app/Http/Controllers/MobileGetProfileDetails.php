<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cryptor;
use App\Decryptor;
use App\Encryptor;
use DB;

class MobileGetProfileDetails extends Controller
{
    public function getProfileDetails()
    {
    	db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
    	$encactor = trim($_POST['actor']);

    	$cryptor = new Decryptor;
        $actor = $cryptor->decrypt($encactor, $keypassword);

    	$feedcontent = \DB::SELECT("select rac_fullname,rac_socialsignin,(select count(tafr_isfollowed) from t_account_friends WHERE tafr_friendlyuserid =(select rac_accountid from r_account_credentials where rac_username = ?) and tafr_isfollowed = 1 and tafd_isaccepted = 1) following, count(tafr_isfollowed) followers, rac_profilepicture,rac_password, rac_accountid,rac_shortbio,rac_accounttype, rac_email, rac_pnumb, rac_username from t_account_friends inner join r_account_credentials on r_account_credentials.rac_accountid = tafr_userprofileid where tafr_userprofileid =(select rac_accountid from r_account_credentials where rac_username = ?) and tafr_isfollowed = 1", [$actor,$actor]);

        $output = json_encode(array('profiledetails' => $feedcontent ));
        if($output == "") {
            echo "";
        }else {
            echo $output;    
        } 

    }
    public function updateAccount(){
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $cryptor = new Decryptor;
        $updatevalue = trim($_POST['updatevalue']);
        $updatevalue = $cryptor->decrypt($updatevalue, $keypassword);

        $updatewhat = trim($_POST['updatewhat']);
        $updatewhat = $cryptor->decrypt($updatewhat, $keypassword);


        $username = trim($_POST['username']);
        $username = $cryptor->decrypt($username, $keypassword);


        $oldvalue = trim($_POST['oldvalue']);
        $oldvalue = $cryptor->decrypt($oldvalue, $keypassword);
        
        $result =db::select("call sp_updateaccount(?,?,?,?)",[$updatevalue,$updatewhat,$username,$oldvalue]);
        $resultval;
        foreach ($result as $row) { $getresult = $row->result;
        $resultval = $getresult; }
        
        echo $resultval;
    }
}

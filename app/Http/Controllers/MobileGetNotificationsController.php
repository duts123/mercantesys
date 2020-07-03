<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cryptor;
use App\Decryptor;
use App\Encryptor;
use DB;

class MobileGetNotificationsController extends Controller
{
    public function getNotifications()
    {
    	db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $encusername = trim($_POST['username']);

        $cryptor = new Decryptor;
        $username = $cryptor->decrypt($encusername, $keypassword);
        
    	$feedcontent = \DB::SELECT("select ran_notificationid, ran_postid, ran_notificationbody , ran_activitydate ,UNIX_TIMESTAMP(ran_activitydate) unixdate, (select tafd_imotion from t_account_feeds where tafd_postid = ran_postid) imotion from r_account_notification  where ran_notifywho = (select rac_accountid from r_account_credentials where rac_username = ?) order by unixdate desc", [$username]);

    	$output = json_encode(array('notifications' => $feedcontent	));
		if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function getOtherProfile()
    {	
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");

        $encactor = trim($_POST['actor']);
        $encpeople = trim($_POST['people']);

        $cryptor = new Decryptor;
        $actor = $cryptor->decrypt($encactor, $keypassword);
    	$people = $cryptor->decrypt($encpeople, $keypassword);

    	$feedcontent = \DB::SELECT("call  sp_getotherprofiledetails(?,?)",
    		[$people, $actor]);	

    	$output = json_encode(array('otherprofiledetails' => $feedcontent));
		if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function LiveNotification()
    {
        $ran_notifywho = trim($_POST['ran_notifywho']);
        $feedcontent = \DB::SELECT("call  sp_livenotifications(?)",[$ran_notifywho]);     
        $output = json_encode(array('livenotifications' => $feedcontent ));
        if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cryptor;
use App\Decryptor;
use App\Encryptor;
use DB;

class MobileFindController extends Controller
{
    public function find_mycircles()
    {	
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $encusername = trim($_POST['username']);
        
        $cryptor = new Decryptor;
        $username = $cryptor->decrypt($encusername, $keypassword);
        
    	$feedcontent = \DB::SELECT("select rac_accountid, rac_username, rac_profilepicture, rac_fullname from  r_account_credentials where  rac_accountid in (select rmmc_circlepoint from r_messages_mycircle where rmmc_circlecenter = (select rac_accountid from r_account_credentials where rac_username = ? ) )",[$username]);

    	$output = json_encode(array('searchvalue' => $feedcontent ));
		
		if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function findfollowers()
    {	
    	db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $encusername = trim($_POST['username']);
        
        $cryptor = new Decryptor;
        $username = $cryptor->decrypt($encusername, $keypassword);
    	$feedcontent = \DB::SELECT("select rac_accountid, rac_username, rac_profilepicture, rac_fullname from t_account_friends inner join r_account_credentials on r_account_credentials.rac_accountid = t_account_friends.tafr_friendlyuserid where tafr_userprofileid = (select rac_accountid from r_account_credentials where rac_username = ?) and tafr_isfollowed = 1 and tafd_isaccepted = 1 ",
            [$username]);

    	$output = json_encode(array('searchvalue' => $feedcontent ));
		
		if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function findfollowers_mycirles()
    {	
    	db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $encusername = trim($_POST['username']);
        
        $cryptor = new Decryptor;
        $username = $cryptor->decrypt($encusername, $keypassword);
    	
        $feedcontent = \DB::SELECT("select rac_accountid, rac_username, rac_profilepicture, rac_fullname from t_account_friends 

inner join r_account_credentials on r_account_credentials.rac_accountid = t_account_friends.tafr_friendlyuserid

where tafr_userprofileid  = (select rac_accountid from r_account_credentials where rac_username = ?) and tafr_isfollowed = 1 and tafd_isaccepted = 1
and tafr_friendlyuserid not in (select rmmc_circlepoint from r_messages_mycircle where rmmc_circlecenter = (select rac_accountid from r_account_credentials where rac_username = ?))

",[$username,$username]);

    	$output = json_encode(array('searchvalue' => $feedcontent ));

		if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function findfollowing() 
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $encusername = trim($_POST['username']);
        
        $cryptor = new Decryptor;
        $username = $cryptor->decrypt($encusername, $keypassword);

        $feedcontent = \DB::SELECT("select rac_accountid, rac_username, rac_profilepicture, rac_fullname from t_account_friends inner join r_account_credentials on r_account_credentials.rac_accountid = t_account_friends.tafr_userprofileid where tafr_friendlyuserid = (select rac_accountid from r_account_credentials where rac_username = ?) and tafr_isfollowed = 1 and tafd_isaccepted = 1",
            [$username]);

        $output = json_encode(array('searchvalue' => $feedcontent ));

        if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function findgetyouer() 
    {

        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $encusername = trim($_POST['username']);
        $encpostid = trim($_POST['postid']);

         $cryptor = new Decryptor;
        $username = $cryptor->decrypt($encusername, $keypassword);
         $postid = $cryptor->decrypt($encpostid, $keypassword);


        $feedcontent = \DB::SELECT("select rac_username,rac_fullname,rac_profilepicture,rac_accounttype , rac_shortbio, (select tafr_isfollowed from t_account_friends where tafr_friendlyuserid = (select rac_accountid from r_account_credentials where rac_username = ?) and tafr_userprofileid in (select rac_accountid from r_account_credentials where rac_username = rac.rac_username)) isfollowed from r_account_credentials as rac inner join r_post_getyou on r_post_getyou.rpg_actormakeget = rac.rac_accountid where rpg_postrelate = ?",[$username, $postid]);
        
        $output = json_encode(array('searchvalue' => $feedcontent ));

       if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }
    
    public function getFriendRequest() 
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $cryptor = new Decryptor;
        
        $encusername = trim($_POST['username']);
        $username = $cryptor->decrypt($encusername, $keypassword);

        $feedcontent = \DB::SELECT("select rac_username, rac_fullname, rac_profilepicture from t_account_friends inner join r_account_credentials on r_account_credentials.rac_accountid = t_account_friends.tafr_friendlyuserid where tafr_userprofileid = (select rac_accountid from r_account_credentials where rac_username = ?) and tafd_isaccepted = 0", [$username]);
        
        $output = json_encode(array('friendrequest' => $feedcontent ));
        if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

     public function addfriends()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $cryptor = new Decryptor;


        $usertoadd = trim($_POST['usertoadd']);
        $friendlyuserid = trim($_POST['friendlyuserid']);

        $encusertoadd = $cryptor->decrypt($usertoadd, $keypassword);
        $encfriendlyuserid = $cryptor->decrypt($friendlyuserid, $keypassword);

        db::select("call sp_addfriends(?,?)",[$encusertoadd, $encfriendlyuserid]);
        echo "added";
        //return "siccess";
    }

  public function unfollow()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $cryptor = new Decryptor;


        $username = trim($_POST['username']);
        $unfollowho = trim($_POST['unfollowho']);

        $username = $cryptor->decrypt($username, $keypassword);
        $unfollowho = $cryptor->decrypt($unfollowho, $keypassword);

        db::select("call sp_unfollow(?,?)",[$username, $unfollowho]);
        echo "unfolowed";
        //return "siccess";
    }


public function searchpost()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $encsearchvalue = trim($_POST['searchvalue']);

        $cryptor = new Decryptor;
        $searchvalue = $cryptor->decrypt($encsearchvalue, $keypassword);

        $feedcontent =  db::select("call  sp_search(?,?,?)",["", $searchvalue,2]);
        $output = json_encode(array('searchvalue' => $feedcontent ));

        if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function searchpeople()
    {

        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $encusername = trim($_POST['username']);
        $encsearchvalue = trim($_POST['searchvalue']);

        $cryptor = new Decryptor;
        $username = $cryptor->decrypt($encusername, $keypassword);
        $searchvalue = $cryptor->decrypt($encsearchvalue, $keypassword);

       $feedcontent =  db::select("call  sp_search(?,?,?)",[$username, $searchvalue,1]);
        $output = json_encode(array('searchvalue' => $feedcontent ));

        if($output == "") {
            echo "";
        }else {
            echo $output;    
        } 
    }

    public function searchimotion()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $asearchvalue = $_POST['searchvalue'];

        $cryptor = new Decryptor;
        $searchvalue = $cryptor->decrypt($asearchvalue, $keypassword);


       $feedcontent =  db::select("call  sp_search(?,?,?)",["", $searchvalue,4]);
        $output = json_encode(array('searchvalue' => $feedcontent ));

        if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function findthrucontact() 
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
          $enumbers = $_POST['numbers'];
          $eusername = $_POST['username'];

        $cryptor = new Decryptor;
        $numbers = $cryptor->decrypt($enumbers, $keypassword);
        $username = $cryptor->decrypt($eusername, $keypassword);

        $numbers = str_replace(' ', '', $numbers);
        $numbers = str_replace('*', '', $numbers);
        $numbers = str_replace('#', '', $numbers);
        $numbers = str_replace('+', '', $numbers);
        $numbers = str_replace('(', '', $numbers);
        $numbers = str_replace(')', '', $numbers);
        $numbers = str_replace('[', '', $numbers);
        $numbers = str_replace(']', '', $numbers);

        $number = explode(".", $numbers);
        $number = implode(",", $number);




$feedcontent = DB::select( DB::raw("select rac_username,rac_fullname,rac_profilepicture,rac_accounttype , (select tafr_isfollowed from t_account_friends where tafr_friendlyuserid = (select rac_accountid from r_account_credentials where rac_username = '".$username."') and tafr_userprofileid in (select rac_accountid from r_account_credentials where rac_username = rac.rac_username)) isfollowed from r_account_credentials as rac where rac_pnumb in (".$number.")
    "));

        $output = json_encode(array('searchvalue' => $feedcontent ));

        if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
        echo "select rac_username,rac_fullname,rac_profilepicture,rac_accounttype , (select tafr_isfollowed from t_account_friends where tafr_friendlyuserid = (select rac_accountid from r_account_credentials where rac_username = ".$username.") and tafr_userprofileid in (select rac_accountid from r_account_credentials where rac_username = rac.rac_username)) isfollowed from r_account_credentials as rac where rac_pnumb in (".$number.")";


    }

    public function searchpeopleexact() 
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $encusername = trim($_POST['username']);
        $encsearchvalue = trim($_POST['searchvalue']);

        $cryptor = new Decryptor;
        $username = $cryptor->decrypt($encusername, $keypassword);
        $searchvalue = $cryptor->decrypt($encsearchvalue, $keypassword);

        $feedcontent = \DB::SELECT("select rac_username,rac_fullname,rac_profilepicture,rac_accounttype , rac_shortbio, (select tafr_isfollowed from t_account_friends where tafr_friendlyuserid = (select rac_accountid from r_account_credentials where rac_username = ? ) and tafr_userprofileid in (select rac_accountid from r_account_credentials where rac_username = rac.rac_username)) isfollowed from r_account_credentials as rac where rac_username = ?",
            [$username, $searchvalue ]);

        $output = json_encode(array('searchvalue' => $feedcontent ));

        if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function followpublicaccount()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");


        $encusertoadd = trim($_POST['usertoadd']);
        $encfriendlyuserid = trim($_POST['friendlyuserid']);

        $cryptor = new Decryptor;
        $usertoadd = $cryptor->decrypt($encusertoadd, $keypassword);
        $friendlyuserid = $cryptor->decrypt($encfriendlyuserid, $keypassword);

        db::select("call sp_publicaccount(?,?)",[$usertoadd, $friendlyuserid]);
        echo "added";
    }


    public function makefriends()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");

        $enctafr_userprofileid = trim($_POST['tafr_userprofileid']);
        $enctafr_friendlyuserid = trim($_POST['tafr_friendlyuserid']);
        $encaction = trim ($_POST['action']);

        $cryptor = new Decryptor;

        $tafr_userprofileid = $cryptor->decrypt($enctafr_userprofileid, $keypassword);
        $tafr_friendlyuserid = $cryptor->decrypt($enctafr_friendlyuserid, $keypassword);
        $action = $cryptor->decrypt($encaction, $keypassword);

        db::select("call sp_makefriends(?,?,?)", [$tafr_userprofileid, $tafr_friendlyuserid, $action]);
        if ($action  == "accept") {
            echo("You are now friends with ".$tafr_friendlyuserid.".");
        } else 
        echo("Request Deleted");
    }
  

    public function searchbypost()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        
        $encsearchvalue = trim($_POST['searchvalue']);

        $cryptor = new Decryptor;
        
        $searchvalue = $cryptor->decrypt($encsearchvalue, $keypassword);
        $feedcontent =  db::select("call  sp_search(?,?,?)",["",$searchvalue,2]);
        $output = json_encode(array('searchvalue' => $feedcontent ));

        if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }
    
     
}

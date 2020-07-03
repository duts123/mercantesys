<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cryptor;
use App\Decryptor;
use App\Encryptor;
use DB;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MobileGetFeedController extends Controller
{
    public function survey(Request $request){

$ua = $request->server('User-Agent');
Log::channel('survey')->info('Something happened!'); 
          return view('pages.survey.survey');
    }
    
    public function getfeed()
    {

        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $encusername = trim($_POST['username']);
        //$username = trim($_GET['username']);
        $cryptor = new Decryptor;
        $username = $cryptor->decrypt($encusername, $keypassword);
        $feedcontent = \DB::SELECT("call sp_getfeed(?)",[$username]);
    	$output = json_encode(array('feedcontent' => $feedcontent ));

		if($output == "") {
            echo "";
        } else {
            echo $output;    
        }  
     }

    public function getfeedSpecuser()
    {

        
        $username = trim($_POST['username']);
        $finduser = trim($_POST['finduser']);
        
    	$feedcontent =  db::select("call  sp_getotherprofilefeed(?,?)",[$username, $finduser]);;
        $output = json_encode(array('feedcontent' => $feedcontent ));
        if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
  }

    public function getHashTags()
    {
    	
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $encsearchhashtag = trim($_POST['searchvalue']);
        
        $cryptor = new Decryptor;
        $searchhashtag = $cryptor->decrypt($encsearchhashtag, $keypassword);

       $feedcontent =  db::select("call  sp_search(?,?,?)",["", $searchhashtag,3]);;
    	$output = json_encode(array('searchvalue' => $feedcontent ));
		if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function getImotions()
    {
    	
    	$feedcontent = \DB::SELECT("select rid_imotionname, rid_imotionimagepath from r_imotions_details");
    	$output = json_encode(array('imotionarray' => $feedcontent ));

		if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }


    public function mydays_feed()
    {
        $encusername = trim($_POST['username']);
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");

        $cryptor = new Decryptor;
        $username = $cryptor->decrypt($encusername, $keypassword);

        $feedcontent = \DB::SELECT("call sp_mydaysfeed(?)", [$username]);

        $output = json_encode(array('mydaysvalue' => $feedcontent));
       if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function getSameFeed()
    {
        $encaccountusername = trim($_POST['accountusername']);
        $encimotionname = trim($_POST['imotionname']);

        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");

        $cryptor = new Decryptor;
        $accountusername = $cryptor->decrypt($encaccountusername, $keypassword);
        $imotionname = $cryptor->decrypt($encimotionname, $keypassword);

        $feedcontent = \DB::SELECT("select rac_username,rac_fullname, rac_profilepicture, tafd_postid, tafd_postcontent, tafd_postimage_source,tafd_mediatype, DATE_FORMAT(tafd_postadded,'%M %d, %Y') tafd_postadded,tafd_imotion,(select rid_imotionname from r_imotions_details where rid_imotionimagepath = tafd_imotion) feeling, (select count(rpg_actormakeget) from r_post_getyou where rpg_postrelate = tafd_postid and rpg_isremoved = 0) as tafd_igetyoucount, (select count(rpg_postrelate) from r_post_getyou where rpg_postrelate = tafd_postid and rpg_actormakeget = (select rac_accountid from r_account_credentials where rac_username = ? )) as isliked, (select count(rfc_commentid) from r_feeds_comments where rfc_feedparent = tafd_postid) rfc_commentcount,(select rac_username from r_account_credentials where rac_accountid = (select rfc_commentcreator from r_feeds_comments where rfc_feedparent = tafd_postid limit 1)) commentcreator, (select rfc_commentbody from r_feeds_comments where rfc_feedparent = tafd_postid limit 1) commentbody,(select DATE_FORMAT(rfc_dateadded,'%M %d, %Y') from r_feeds_comments where rfc_feedparent = tafd_postid limit 1) commentdate from t_account_feeds inner join r_account_credentials on r_account_credentials.rac_accountid = t_account_feeds.tafd_postcreator where tafd_imotion = ? and tafd_isremoved = 0 and r_account_credentials.rac_accounttype = 'public' order by tafd_postadded asc",[$accountusername, $imotionname]);


        $output = json_encode(array('feedcontent' => $feedcontent ));
        if($output == "") {
            echo "";
        } else {
            echo $output;    
        }
    }

    public function mydays_viewpost()
    {
        $encusername = trim($_POST['username']);
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $cryptor = new Decryptor;
        $username = $cryptor->decrypt($encusername, $keypassword);
        $feedcontent = \DB::SELECT("select rmd_postid, rmd_imageid, DATE_FORMAT(rmd_postcreated,'%M %d, %Y') rmd_postcreated,rac_profilepicture, rac_username from r_my_day INNER join r_account_credentials on r_account_credentials.rac_accountid = r_my_day.rmd_creator where rac_username = ?",[$username]);

        $output = json_encode(array('mydaysvalue' => $feedcontent ));
        if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }
  
     public function igetyoumakeprocess()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $cryptor = new Decryptor;
        
        $encpostid = trim($_POST['postid']);
        $encigetyouer = trim($_POST['igetyouer']);
        $encisOwnPost = trim ($_POST['isOwnPost']);

        $postid = $cryptor->decrypt($encpostid, $keypassword);
        $igetyouer = $cryptor->decrypt($encigetyouer, $keypassword);
        $isOwnPost = $cryptor->decrypt($encisOwnPost, $keypassword);

        $findid = db::select("select rpg_getyoudateadded from r_post_getyou where rpg_postrelate = ? and rpg_actormakeget = (select rac_accountid from r_account_credentials where rac_username = ? )",[$postid, $igetyouer]);


        $idfetched = 0;
        foreach ($findid as $row) {
            $idfetched = $row->rpg_getyoudateadded;
        }
        if ($idfetched == 0) 
        {
            if($isOwnPost != 1) 
            {
                db::select("insert into r_post_getyou VALUES (?,(select rac_accountid from r_account_credentials where rac_username = ?), CURRENT_TIMESTAMP, 0,null)", [$postid, $igetyouer]);
             

                db::select("insert into r_account_notification values (null,(select tafd_postid from t_account_feeds where tafd_postid = ?),(select rac_accountid from r_account_credentials where rac_accountid = (select tafd_postcreator from t_account_feeds where tafd_postid = ?)),(select rac_accountid from r_account_credentials where rac_username = ?),'".$igetyouer." ,Relates to your post.' , CURRENT_TIMESTAMP)", [$postid,$postid,$igetyouer]);
            }
            else{
           db::select("insert into r_post_getyou VALUES (?,(select rac_accountid from r_account_credentials where rac_username = ?), CURRENT_TIMESTAMP, 0,null)", [$postid, $igetyouer]);
             

            }
            echo "i get you!";  
        }
        else 
        {
            db::select("delete from r_post_getyou where rpg_postrelate = ? and rpg_actormakeget = (select rac_accountid from r_account_credentials where rac_username = ?)", [$postid,$igetyouer]);

            db::select("DELETE FROM r_account_notification where  ran_postid = ? and ran_notifyby = (select rac_accountid from r_account_credentials where rac_username = ? )", [$postid, $igetyouer]);
            echo "";
        } 

        
    }
}   

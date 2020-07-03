<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cryptor;
use App\Decryptor;
use App\Encryptor;
use DB;

class MobileGetPostController extends Controller
{
    public function getPostComments() 
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");

        $encpostidsonfeed = trim($_POST['postidsonfeed']);
   
     
//	$postidsonfeed = 36;
    	$cryptor = new Decryptor;
     
         $postidsonfeed = $cryptor->decrypt($encpostidsonfeed, $keypassword);

        $feedcontent = \DB::SELECT("select rfc_commentid,rfc_commentbody, rfc_commentcreator,  rfc_dateadded, rac_username, rac_profilepicture from r_feeds_comments inner join r_account_credentials on r_account_credentials.rac_accountid = rfc_commentcreator where rfc_feedparent = (select tafd_postid from t_account_feeds where tafd_postid = ?) and rfc_deleted = 0 order by rfc_dateadded asc",[$postidsonfeed]);

    	$output = json_encode(array('feedComments' => $feedcontent));
		if($output == "") {
            echo "";
        }else {
            echo $output;    
        } 

    }

    public function getPostwithComments() 
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
       

	 $encpostidsonfeed = trim($_POST['postidsonfeed']);
        $encaccountusername = trim($_POST['accountusername']);

        $cryptor = new Decryptor;
         $postidsonfeed = $cryptor->decrypt($encpostidsonfeed, $keypassword);
         $accountusername = $cryptor->decrypt($encaccountusername, $keypassword);

/*
        $postidsonfeed = 36;
        $accountusername = "playhouse";
*/
    	$feedcontent = \DB::SELECT("select rac_username, rac_profilepicture, tafd_postid, tafd_postcontent, tafd_postimage_source, tafd_postadded,tafd_imotion, tafd_mediatype,(select count(rpg_actormakeget) from r_post_getyou where rpg_postrelate = tafd_postid and rpg_isremoved = 0) as tafd_igetyoucount, (select count(rpg_postrelate) from r_post_getyou where rpg_postrelate = tafd_postid and rpg_actormakeget = (select rac_accountid from r_account_credentials where rac_username = ? )) as isliked, (select count(rfc_commentid) from r_feeds_comments where rfc_feedparent = tafd_postid and rfc_deleted = 0) rfc_commentcount,(select rac_username from r_account_credentials where rac_accountid = (select rfc_commentcreator from r_feeds_comments where rfc_feedparent = tafd_postid and rfc_deleted limit 1)) commentcreator, (select rfc_commentbody from r_feeds_comments where rfc_feedparent = tafd_postid and rfc_deleted limit 1) commentbody,(select DATE_FORMAT(rfc_dateadded,'%M %d, %Y') from r_feeds_comments where rfc_feedparent = tafd_postid  and rfc_deleted limit 1) commendate from t_account_feeds inner join r_account_credentials on r_account_credentials.rac_accountid = t_account_feeds.tafd_postcreator where tafd_postid = ? order by tafd_postadded", [$accountusername, $postidsonfeed]);

    	$output = json_encode(array('feedcontent' => $feedcontent));
		if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
        
    }

	public function deletepost()
    {
        
db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $cryptor = new Decryptor;
        $enctafd_postid = trim($_POST['tafd_postid']);
        $tafd_postid = $cryptor->decrypt($enctafd_postid, $keypassword);
        
        db::select("call sp_archivepost(?)",[$tafd_postid]);
        echo $tafd_postid;
    }

public function uploadimage(){
         


db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $cryptor = new Decryptor;
        $imotionname = trim($_POST['imotionname']);
        $postcontent = trim($_POST['postcontent']);
        $postcreator = trim($_POST['postcreator']);
        $mediatype = trim($_POST['mediatype']);
        $mediatype = trim($_POST['mediatype']);
        $imagename = trim($_POST['imagename']);

        $eimotionname = $cryptor->decrypt($imotionname, $keypassword);
        $epostcontent = $cryptor->decrypt($postcontent, $keypassword);
        $epostcreator = $cryptor->decrypt($postcreator, $keypassword);
        $emediatype = $cryptor->decrypt($mediatype, $keypassword);
        $eimagename = $cryptor->decrypt($imagename, $keypassword);
        $intemediatype = (int)$emediatype;

$path = public_path()."/uploads/images/".$eimagename;
$image = $_POST['image'];
file_put_contents($path,base64_decode($image));

        db::select("call  sp_addtomediauploads(?,?,?,?)",[$epostcreator,$eimagename,1,"feedpostimage"]);

        db::select("call sp_createpost(?,?,?,?,?)",[$eimotionname,$epostcontent,$epostcreator,$eimagename,$intemediatype]);
        echo "posted";


}

public function createspotlight()
{

db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $cryptor = new Decryptor;
        $imagename = trim($_POST['imagename']);
        $postcreator = trim($_POST['postcreator']);

        $eimagename = $cryptor->decrypt($imagename, $keypassword);
        $epostcreator = $cryptor->decrypt($postcreator, $keypassword);

        $path = public_path()."/uploads/spotlights/".$eimagename;
        $image = $_POST['image'];
        file_put_contents($path,base64_decode($image));

        db::select("call sp_createspotlight(?,?)",[$eimagename,$epostcreator]);
        db::select("call  sp_addtomediauploads(?,?,?,?)",[$epostcreator,$eimagename,1,"spotlight"]);
        echo "posted";


}

public function uploadvideo(){
    
db::select("CALL insert_enckey();");
             $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $cryptor = new Decryptor;
        $imotionname = trim($_POST['imotionname']);
        $postcontent = trim($_POST['postcontent']);
        $postcreator = trim($_POST['postcreator']);
        $mediatype = trim($_POST['mediatype']);
        $mediatype = trim($_POST['mediatype']);
        $imagename = trim($_POST['imagename']);

        $eimotionname = $cryptor->decrypt($imotionname, $keypassword);
        $epostcontent = $cryptor->decrypt($postcontent, $keypassword);
        $epostcreator = $cryptor->decrypt($postcreator, $keypassword);
        $emediatype = $cryptor->decrypt($mediatype, $keypassword);
        $eimagename = $cryptor->decrypt($imagename, $keypassword);
        $intemediatype = (int)$emediatype;

$path = public_path()."/uploads/videos/".$eimagename;
$image = $_POST['image'];
file_put_contents($path,base64_decode($image));
        db::select("call sp_createpost(?,?,?,?,?)",[$eimotionname,$epostcontent,$epostcreator,$eimagename,2]);
        db::select("call  sp_addtomediauploads(?,?,?,?)",[$epostcreator,$eimagename,2,"feedpostvideo"]);
        echo "posted";


}
public function uploadaudio(){
       db::select("CALL insert_enckey();");
             $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $cryptor = new Decryptor;
        $imotionname = trim($_POST['imotionname']);
        $postcontent = trim($_POST['postcontent']);
        $postcreator = trim($_POST['postcreator']);
        $mediatype = trim($_POST['mediatype']);
        $mediatype = trim($_POST['mediatype']);
        $audioname = trim($_POST['audioname']);

        $eimotionname = $cryptor->decrypt($imotionname, $keypassword);
        $epostcontent = $cryptor->decrypt($postcontent, $keypassword);
        $epostcreator = $cryptor->decrypt($postcreator, $keypassword);
        $emediatype = $cryptor->decrypt($mediatype, $keypassword);
        $audioname = $cryptor->decrypt($audioname, $keypassword);
        $intemediatype = (int)$emediatype;

$path = public_path()."/uploads/audios/".$audioname;
$image = $_POST['audio'];
file_put_contents($path,base64_decode($image));
        db::select("call sp_createpost(?,?,?,?,?)",[$eimotionname,$epostcontent,$epostcreator,$audioname,3]);
        db::select("call  sp_addtomediauploads(?,?,?,?)",[$epostcreator,$audioname,3,"feedpostaudio"]);
        echo "posted";

}

    public function createpost()
    {
        
db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $cryptor = new Decryptor;
        $imotionname = trim($_POST['imotionname']);
        $postcontent = trim($_POST['postcontent']);
        $postcreator = trim($_POST['postcreator']);
        $postmedia = trim($_POST['postmedia']);
        $mediatype = trim($_POST['mediatype']);

        $eimotionname = $cryptor->decrypt($imotionname, $keypassword);
        $epostcontent = $cryptor->decrypt($postcontent, $keypassword);
        $epostcreator = $cryptor->decrypt($postcreator, $keypassword);
        $epostmedia = $cryptor->decrypt($postmedia, $keypassword);
        $emediatype = $cryptor->decrypt($mediatype, $keypassword);
        $intemediatype = (int)$emediatype;
        db::select("call sp_createpost(?,?,?,?,?)",[$eimotionname,$epostcontent,$epostcreator,$epostmedia,$intemediatype]);
        echo "posted";
    }
}


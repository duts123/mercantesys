<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cryptor;
use App\Decryptor;
use App\Encryptor;
use DB;

class MobileGetCommentController extends Controller
{
    public function getCommentator()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $encpostid = trim($_POST['postid']);
        $cryptor = new Decryptor;

        $postid = $cryptor->decrypt($encpostid, $keypassword);

    	$feedcontent = \DB::SELECT("select rfc_commentcreator, rfc_feedparent, rfc_dateadded,rfc_deleted, r_account_credentials.rac_username from r_feeds_comments INNER join r_account_credentials on r_account_credentials.rac_accountid = r_feeds_comments.rfc_commentcreator where rfc_feedparent = ? and rfc_deleted !=1  order by rfc_dateadded desc", [$postid]);

    	$output = json_encode(array('comments' => $feedcontent ));
		
		if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function getCommentBody()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $encpostid = trim($_POST['postid']);
        $cryptor = new Decryptor;

        $postid = $cryptor->decrypt($encpostid, $keypassword);
    	$feedcontent = \DB::SELECT("select rfc_commentbody, rfc_dateadded, rac_username, rac_profilepicture from r_feeds_comments inner join r_account_credentials on r_account_credentials.rac_accountid = rfc_commentcreator where rfc_feedparent = (select tafd_postid from t_account_feeds where tafd_postid = ?) and rfc_deleted = 0", [$postid]);

    	$output = json_encode(array('comments' => $feedcontent ));
		if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }	

        public function postComment()
        {

        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $cryptor = new Decryptor;
        $ecommentor = trim($_POST['commentor']);
        $ecommentparent = trim($_POST['commentparent']);
        $ecommentbody = trim($_POST['commentbody']);

        $commentor = $cryptor->decrypt($ecommentor, $keypassword);
        $commentparent = $cryptor->decrypt($ecommentparent, $keypassword);
        $commentbody = $cryptor->decrypt($ecommentbody, $keypassword);
        db::select("call sp_postcomment(?,?,?)",[$commentor, $commentparent,$commentbody]);
        echo "Comment Posted";
        
     }

         public function deletecomment()
        {

        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $cryptor = new Decryptor;
        $ecommentid = trim($_POST['commentid']);
        $commentid = $cryptor->decrypt($ecommentid, $keypassword);

        db::select("call sp_deletecomment(?)",[$commentid]);
        echo "deleted";
     }


    public function getTopComments()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $encpostid = trim($_POST['postid']);
        $cryptor = new Decryptor;

        $postid = $cryptor->decrypt($encpostid, $keypassword);
        $feedComments = \DB::SELECT("select rfc_commentid,rfc_commentbody, rfc_commentcreator, DATE_FORMAT(rfc_dateadded,'%M %d, %Y') rfc_dateadded, rac_username, rac_profilepicture from r_feeds_comments inner join r_account_credentials on r_account_credentials.rac_accountid = rfc_commentcreator where rfc_feedparent = (select tafd_postid from t_account_feeds where tafd_postid = ?) and rfc_deleted = 0 order by rfc_dateadded desc",[$postid]);

        $comments = json_encode(array('feedComments' => $feedComments ));
       if($output == "") {
            echo "";
        } else {
            echo $output;    
        }
    }

    public function updatecomment()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $cryptor = new Decryptor;

        $enccommentid = trim($_POST['commentid']);
        $enccommentcontent = trim($_POST['commentcontent']);

        $commentid = $cryptor->decrypt($enccommentid, $keypassword);
        $commentcontent = $cryptor->decrypt($enccommentcontent, $keypassword);
        db::select("update r_feeds_comments set rfc_commentbody = '".$commentcontent."' where rfc_commentid = '".$commentid."'");
        echo "updated";
    }

}

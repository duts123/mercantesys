<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cryptor;
use App\Decryptor;
use App\Encryptor;
use DB;


class MobileReportTypeController extends Controller
{
    public function getReportTypes()
    {
    	$feedComments = \DB::SELECT("select rrt_reporttypeid, rrt_reportvalue, rrt_reporticon from r_report_types");

    	$comments = json_encode(array('reportTypes' => $feedComments));
    	if($comments == "") {
            echo "";
        }else {
            echo $comments;    
        }
    }

     public function reportpost()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $cryptor = new Decryptor;


        $username = trim($_POST['username']);
        $tafd_postid = trim($_POST['tafd_postid']);
    $reportcontent = trim($_POST['reportcontent']);

        $erac_username = $cryptor->decrypt($username, $keypassword);
        $etafd_postid = $cryptor->decrypt($tafd_postid, $keypassword);
    $ereportcontent = $cryptor->decrypt($reportcontent, $keypassword);

        db::select("call sp_reportpost(?,?,?)",[$erac_username, $etafd_postid,$ereportcontent]);
        echo "report posted";
        //return "siccess";
    }
}

<?php

namespace App\Http\Controllers;


use Pusher\Pusher;
use Illuminate\Http\Request;
use App\Cryptor;
use App\Decryptor;
use App\Encryptor;
use DB;

class MobileGetMessagesController extends Controller
{
    public function getMessageList()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $encusername = trim($_POST['username']);
        $cryptor = new Decryptor;
        $username = $cryptor->decrypt($encusername, $keypassword);
    	$feedcontent = COLLECT(\DB::SELECT("call  sp_messagelist(?)",[$username,$username]));
    	$output = json_encode(array('messagelist' => $feedcontent ));
		if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function getChatTopImotions(){
        $chatImotions = \DB::SELECT("call  sp_getchatTopImotions()");
        $output = json_encode(array('chatImotions_report' => $chatImotions ));
        echo $output;

    }

       public function insertChatUserImotion(){
        $username = $_POST['username'];
        $imotionname =$_POST['imotionname'];
        $insertChatUserImotion = \DB::SELECT("call  sp_insertChatUserImotion(?,?)",[$imotionname,$username]);
        $output = json_encode(array('insertChatUserImotion_report' => $insertChatUserImotion ));
        echo $output;

    }

public function searchtoMessage()
    {
        $username = $_POST['username'];
        $txtquery = $_POST['txtquery'];
        $messagesearch_report = COLLECT(\DB::SELECT("call  sp_message_search_people(?,?)",[$txtquery,$username]));
        $output = json_encode(array('messagesearch_report' => $messagesearch_report ));
            echo $output;   
    }
public function searchtoMessageGroup()
    {
        $username = $_POST['username'];
        $txtquery = $_POST['txtquery'];
        $messagesearch_report = COLLECT(\DB::SELECT("call   sp_message_search_people_group(?,?)",[$txtquery,$username]));
        $output = json_encode(array('messagesearch_report' => $messagesearch_report ));
            echo $output;   
    }

    public function getMessages()
    {


        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
       
        $cryptor = new Decryptor;
        $chatroomid = $cryptor->decrypt(trim($_POST['chatroomid']), $keypassword);
    	$feedcontent = COLLECT(\DB::SELECT("call sp_fetchmessages(?)",[$chatroomid]));
        $output = json_encode(array('messagecontent' => $feedcontent	));
            echo $output;    
    }

    public function postMessage(){
   
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $senderuname = trim($_POST['senderuname']);
        $reciveruname = trim($_POST['reciveruname']);
        $messagecontent = trim($_POST['messagecontent']);
        $groupmember = trim($_POST['groupmember']);
        $cryptor = new Decryptor;
        $chatroomid = $cryptor->decrypt(trim($_POST['chatroomid']), $keypassword);
        $esenderuname = $cryptor->decrypt($senderuname, $keypassword);
        $ereciveruname = $cryptor->decrypt($reciveruname, $keypassword);
        $emessagecontent = $cryptor->decrypt($messagecontent, $keypassword);
        $egroupmember = $cryptor->decrypt($groupmember, $keypassword);
	
	$array['s4nd4r'] = $esenderuname;
	$array['m3ss3g3'] = $emessagecontent;
	$message = json_encode(array('report' => $array ));

	$pusher = new Pusher("611bff45b6cc772cd44d", "8294eaa000a2ca66266e", "970363", array('cluster' => 'us2'));
        $chatroomid_event = $chatroomid."_event";

        $pusher->trigger("chats_",'event_', $message);

        $postmessage =  db::select("call  sp_postmessage(?,?,?,?,?)",[$esenderuname, $ereciveruname,
            $emessagecontent,$egroupmember,$chatroomid]);
        $output = json_encode(array('postmessage' => $postmessage ));
        echo $output;

    }

       public function postigetyouMessage(){
   
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $messageid = trim($_POST['messageid']);
        $igetyouer = trim($_POST['igetyouer']);
        $cryptor = new Decryptor;

        $messageid = $cryptor->decrypt($messageid, $keypassword);
        $igetyouer = $cryptor->decrypt($igetyouer, $keypassword);
        $postmessage =  db::select("call sp_messagegetyou(?,?)",[$messageid, $igetyouer]);
        $output = json_encode(array('getyoumessage' => $postmessage ));
        echo $output;

    }

     public function addtocircle(){
   
        
        
        $circlecenter = trim($_POST['circlecenter']);
        $circlepoint = trim($_POST['circlepoint']);
        $result = \DB::SELECT("call  sp_addtocircle(?,?)", [$circlepoint,$circlecenter]);
    }

    

    public function findNearby(){
   
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $actor = trim($_POST['actor']);
        $lat = trim($_POST['lat']);
        $long = trim($_POST['long']);
        $cryptor = new Decryptor;

        $eactor = $cryptor->decrypt($actor, $keypassword);
        $elat = $cryptor->decrypt($lat, $keypassword);
        $elong = $cryptor->decrypt($long, $keypassword);
        $result = \DB::SELECT("select count(rac_accountid) as COUNT_ID from r_social_nearby INNER JOIN r_account_credentials on r_account_credentials.rac_accountid = rsn_userid  where rac_username= ?", [$eactor]);
        if($result != 0) {
          $result = \DB::SELECT("update r_social_nearby INNER JOIN r_account_credentials on r_account_credentials.rac_accountid = rsn_userid  set rsn_latitude = ? , rsn_longhitude = ? where rac_username = ?", [$elat, $elong, $eactor]);
        }
        else {
            $result = \DB::SELECT("INSERT INTO r_social_nearby(rsn_userid,rsn_latitude,rsn_longhitude) VALUES((SELECT  rac_accountid from r_account_credentials where rac_username = ?),?,?)", [$eactor, $elat, $elong]);
        }

        $feedcontent = \DB::SELECT("select rsn_latitude, rsn_longhitude,  rsn_userid ,rac_username, rac_profilepicture, ROUND( (6371 * acos( cos( radians(?) ) * cos( radians(rsn_latitude) ) * cos( radians(rsn_longhitude) - radians(?)) + sin(radians(?)) * sin( radians(rsn_latitude)))), 3) AS distance from r_social_nearby INNER JOIN r_account_credentials on r_account_credentials.rac_accountid = rsn_userid where (select ROUND( (6371 * acos( cos( radians(?) ) * cos( radians(rsn_latitude) ) * cos( radians(rsn_longhitude) - radians(?)) + sin(radians(?)) * sin( radians(rsn_latitude)))), 3)) < 5 and rac_username != ? limit 8 ", [$elat, $elong, $elat,$elat,$elong,$elat,$eactor]);

        $feedcontent = \DB::SELECT("select rsn_latitude, rsn_longhitude, rsn_userid ,rac_username, rac_profilepicture, ROUND( (6371 * acos( cos( radians(?) ) * cos( radians(rsn_latitude) ) * cos( radians(rsn_longhitude) - radians(?)) + sin(radians(?)) * sin( radians(rsn_latitude)))), 3) AS distance from r_social_nearby INNER JOIN r_account_credentials on r_account_credentials.rac_accountid = rsn_userid where (select ROUND( (6371 * acos( cos( radians(?) ) * cos( radians(rsn_latitude) ) * cos( radians(rsn_longhitude) - radians(?)) + sin(radians(?)) * sin( radians(rsn_latitude)))), 3)) < 5 and rac_username != ? limit 8 ", [$elat, $elong, $elat,$elat,$elong,$elat,$eactor]);

     
     $output = json_encode(array('nearbylist' => $feedcontent   ));
        if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    

}


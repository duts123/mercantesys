<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\r_account_credential;
use App\Cryptor;
use App\Decryptor;
use App\Encryptor;
use DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Log;

//$submit = DB::select(" EXEC ReturnIdExample ?,?", array( $paramOne ,$paramTwo ) );
class MobileLoginController extends Controller
{

    public function getTermsandCondition()
    
    {
        $info;
        $result = db::select("select rd_detail from r_defaults where rd_itemname = 'termsandpolicy'");
        if(count($result) > 0) {
            foreach($result as $row) { $info = $row->rd_detail; }
        } else {
            $info = "none";
        }
        echo $info; 
    }
    


    public function SendMail(){
$emailcontent = trim($_POST['emailcontent']);
$recadd = trim($_POST['recadd']);
$recname = trim($_POST['recname']);
$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("admin@sympies.co", "Sympies 360 Degrees of Kindness");
$email->setSubject("You're special! You received a gift via Sympies!");
$email->addTo($recadd, "Sympies Receiver");
$email->addContent(
        "text/html", $emailcontent
);
$sendgrid = new \SendGrid('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');
try {
    $response = $sendgrid->send($email);
    echo "success";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";  
}
}

     public function SendMailSubs(){
$recadd = trim($_GET['recadd']);
$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("admin@sympies.co", "Sympies 360 Degrees of Kindness");
$email->setSubject("Thank you for subscribing!");
$email->addTo($recadd, "Future Sympies User");
$email->addContent(
        "text/html", "<p>&nbsp;</p>
<h3>Thank you for subscribing to us!</h3>
<p>&nbsp;</p>
<p>We&#39;ll look forward for you using our <strong>Sympies App</strong>!</p>
<p>&nbsp;</p>
"
);
$sendgrid = new \SendGrid('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');
try {
    $response = $sendgrid->send($email);
    echo "<h3>Thank you for subscribing!</h3>";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";  
}
}

    public function getLogin()
    {


  
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        
        $cryptor = new Decryptor;
        $username = $cryptor->decrypt(trim($_POST['username']), $keypassword);
        $password = $cryptor->decrypt(trim($_POST['password']), $keypassword);
        $info= "";
        $result =  db::select("call  sp_login(?,?)",[$username,$password]);       
        if(count($result) > 0) {
            foreach($result as $row) { $info = $row->result; }
        }
        echo $info;
        
 


    }

     public function updatepassword()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");

        $cryptor = new Decryptor;

        $erac_username = trim($_POST['rac_username']);
        $erac_password = trim($_POST['rac_password']);

        $rac_username = $cryptor->decrypt($erac_username, $keypassword);
        $rac_password = $cryptor->decrypt($erac_password, $keypassword);
        db::select("update r_account_credentials set rac_password = (select md5('".$rac_password."')) where rac_username = '".$rac_username."'");
        echo "updated";
    }

 public function verificationcodeget()
    
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();"); 
        $erac_username = trim($_POST['rac_username']);
        $cryptor = new Decryptor;
        $rac_username = $cryptor->decrypt($erac_username, $keypassword);
        $info = "";
        $result = db::select("select tv_codegenerated from t_verificationcodes where tv_generatewho = (select rac_accountid from r_account_credentials where rac_username = ?) order by tv_generateddate desc limit 1 
",[$rac_username]);
        if(count($result) > 0) {
            foreach($result as $row) { $info = $row->tv_codegenerated; }
        } else {
            $info = "none";
        }
        echo $info; 
    }

   public function verificationcodeinsert()
    
    {

        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();"); 
        $cryptor = new Decryptor;
        $erac_username = $_POST['rac_username'];
        $everificationcode = $_POST['verificationcode'];
        $rac_username = $cryptor->decrypt($erac_username, $keypassword);
        $verificationcode = $cryptor->decrypt($everificationcode, $keypassword);
                
        $result = db::select("INSERT INTO `t_verificationcodes` (`tv_id`, `tv_codegenerated`, `tv_generatewho`, `tv_generateddate`) VALUES (NULL, ?,(select rac_accountid from r_account_credentials where rac_username = ?), CURRENT_TIMESTAMP)",[$verificationcode,$rac_username]);
    
        if(count($result) > 0) {
            foreach($result as $row) { $info = $row->tv_codegenerated; }
        } else {
            $info = "none";
        }




    }

public function verifyemail(){
    $emailcontent = trim($_POST['emailcontent']);

$recadd = trim($_POST['email']);
$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("admin@sympies.net", "Sympies 360 Degrees of Kindness");
$email->setSubject("Account Verification");
$email->addTo($recadd, "Account Verification");
$email->addContent(
        "text/html", $emailcontent
);
$sendgrid = new \SendGrid('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');
try {
    $response = $sendgrid->send($email);
    echo "success";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";  
}

}


 public function emailverified()
    {

        $username = $_POST['username'];
        $verify_email = \DB::SELECT("call sp_verifyemail(?)",[$username]);
        $output = json_encode(array('verify_email_report' => $verify_email ));
        echo "success";
       
    }


    public function checkEmail()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $encemail = trim($_POST['email']);
        $cryptor = new Decryptor;

        $email = $cryptor->decrypt($encemail, $keypassword);
        $result = \DB::SELECT("select rac_email from r_account_credentials where LOWER(rac_email) = LOWER(?)", [$email]);
               if(count($result) > 0) {
            foreach($result as $row) { $info = $row->rac_email; }
        } else {
            $info = "none";
        }


       echo ($info);
    }

    public function checkPnumb()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $encpnumb = trim($_POST['pnumb']);
        $cryptor = new Decryptor;

        $pnumb = $cryptor->decrypt($encpnumb, $keypassword);
        
        $result = \DB::SELECT("select rac_pnumb from r_account_credentials where rac_pnumb = ?", [$pnumb]);
        if ($result > 0) {
            $info = "true";
        } else {
            $info = "false";
        }
        
        echo ($info);
    }

    public function loginwithfacebook()
    {

        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();"); 
        $encrac_email = trim($_POST['rac_email']);
        $cryptor = new Decryptor;

        $rac_email = $cryptor->decrypt($encrac_email, $keypassword);
        $info = "";
        $result = db::select("select rac_accountid, rac_username from r_account_credentials where LOWER(rac_email) = LOWER(?)",[$rac_email]);
        if(count($result) > 0) {
            foreach($result as $row) { $info = $row->rac_username; }
        } else {
            $info = "none";
        }

        echo $info; 
    }

public function saveimage(){
     $file_path= "uploads/profilepictures/";
     
    $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
        echo "success";
    } else{
        echo "fail";
    }


}
public function updateprofilepicture(){

       
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();"); 
        $cryptor = new Decryptor;
        
        $eusername = $_POST['username'];
       $username = $cryptor->decrypt($eusername, $keypassword);
        

        $erac_profilepicture = $_POST['rac_profilepicture'];
        $rac_profilepicture = $cryptor->decrypt($erac_profilepicture, $keypassword);
    
            $filename = $rac_profilepicture;

$path = public_path()."/uploads/profilepictures/".$filename;
$image = $_POST['image'];
file_put_contents($path,base64_decode($image));


        db::select("call  sp_addtomediauploads(?,?,?,?)",[$username,$filename,1,"profilepicture"]);
        db::select("call  sp_updateprofilepicture(?,?)",[$username,$filename,1,"profilepicture"]);
        echo "success";

}

     public function createaccount()
    {

        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();"); 
        $cryptor = new Decryptor;

        $esocialsignin = $_POST['socialsignin'];
        $eemail = $_POST['email'];
        $epnumb = $_POST['pnumb'];
        $eusername = $_POST['username'];
        $epassword = $_POST['password'];
        $efullname = $_POST['fullname'];
        $eaccounttype = $_POST['accounttype'];
        $ebio = $_POST['bio'];
        $eskippic = $_POST['skippic'];
        
        $socialsignin = $cryptor->decrypt($esocialsignin, $keypassword);
        $email = $cryptor->decrypt($eemail, $keypassword);
        $pnumb = $cryptor->decrypt($epnumb, $keypassword);
        $username = $cryptor->decrypt($eusername, $keypassword);
        $password = $cryptor->decrypt($epassword, $keypassword);
        $fullname = $cryptor->decrypt($efullname, $keypassword);
        $accounttype = $cryptor->decrypt($eaccounttype, $keypassword);
        $bio = $cryptor->decrypt($ebio, $keypassword);
        $skippic = $cryptor->decrypt($eskippic, $keypassword);
        $filename = str_replace('@', '', $username);
        $filename = str_replace('.', '', $filename);
        if($socialsignin ==1)
        {
        $password = substr(md5(mt_rand()), 0, 15);
        $socialimage = $_POST['socialimage'];
        $filename = $cryptor->decrypt($socialimage, $keypassword);
        }
        $cryptor = new Decryptor;

        $info = "";
        if($skippic == 1)
            $filename = "";
        else{

        $erac_profilepicture = $_POST['rac_profilepicture'];
        $rac_profilepicture = $cryptor->decrypt($erac_profilepicture, $keypassword);
    
            $filename = $rac_profilepicture;

$path = public_path()."/uploads/profilepictures/".$filename;
$image = $_POST['image'];
file_put_contents($path,base64_decode($image));

        }
        
        $idfetched = 0;
        
        $result = db::select("select rac_accountid, rac_username from r_account_credentials where rac_username = ? or rac_email = ?",[$username,$email]);
        if(count($result) > 0) {
            $info;
            foreach($result as $row) {           
                     $idfetched = $row->rac_accountid;
                    $info = $row->rac_username; 

                }
                    echo "Username ".$info." already exist.";
    
        } else {
      
  $result = db::select("INSERT INTO r_account_credentials (rac_username,rac_fullname,rac_accounttype,rac_profilepicture, rac_password, rac_email, rac_pnumb,rac_shortbio,rac_socialsignin, rac_credentialsadded, rac_credentialsmodified) 
            
  VALUES (?,?,?,?,(select md5(?)),LOWER(?),?,?,?,
              CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
              ",[$username,$fullname,$accounttype,$filename,$password, $email,$pnumb,$bio, $socialsignin]);
        
        db::select("call  sp_addtomediauploads(?,?,?,?)",[$username,$filename,1,"profilepicture"]);
        echo $username;
      
        }
}
}

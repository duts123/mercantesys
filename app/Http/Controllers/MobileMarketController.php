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

class MobileMarketController extends Controller
{
    public function getFlashSales()
    {
    	$feedcontent = \DB::SELECT("SELECT rmf_itemtosale, rmf_less, rmf_saleid, PROD_IMG rmf_saleimagesource ,PROD_MY_PRICE rmf_price,
        PROD_NAME rmf_productname   FROM `r_market_flashsales` INNER join r_product_infos on r_product_infos.PROD_ID = rmf_itemtosale");
    	$output = json_encode(array('marketsales' => $feedcontent ));
		if($output == "") {
            echo "";
        } else {
            echo $output;    
        }
    }


     public function SendPaymentGatewayReceipt(){

        $emailcontent = trim($_POST['emailcontent']);
$recadd = trim($_POST['recadd']);
$recname = trim($_POST['recname']);
$subject = $_POST['subject'];
$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("admin@sympies.co", "Sympies 360 Degrees of Kindness");
$email->setSubject($subject);
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

 public function getorderdetails()
    {


        $tapid = $_POST['tapid'];

        $orderdetails = \DB::SELECT("call sp_getorderdetails(?)",[$tapid]);
        $output = json_encode(array('orderdetails' => $orderdetails ));
        
        if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }


 public function getEmailDetails()
    {

        $username = $_POST['username'];
        $verify_email = \DB::SELECT("call sp_getemaildetails(?)",[$username]);
        $output = json_encode(array('verify_email_report' => $verify_email ));
        if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function addToOrders(){

        $username = $_POST['username'];
        $symp_transcode = $_POST['symp_transcode'];
        $transcode = $_POST['transcode'];
        $paycode = $_POST['paycode'];
        $sendername = $_POST['sendername'];
        $receivername = $_POST['receivername'];
        $emailfrom = $_POST['emailfrom'];
        $emailto = $_POST['emailto'];
        $sendercontact = $_POST['sendercontact'];
        $receivercontact = $_POST['receivercontact'];
        $receiveraddress = $_POST['receiveraddress'];
        $paymentmethod = $_POST['paymentmethod'];
        $discount = $_POST['discount'];
        $orderstatus = $_POST['orderstatus'];
        $vouchercode = $_POST['vouchercode'];
        $prodname = $_POST['prodname'];
        $ordernote = $_POST['ordernote'];
        $orderprice = $_POST['orderprice'];
        $ordersummary = $_POST['ordersummary'];
        $paymentreceipt = $_POST['paymentreceipt'];
        $gatewayreceipt = $_POST['gatewayreceipt'];
        $receiversusername = $_POST['receiversusername'];

        echo $username.$symp_transcode.$transcode.$paycode.$sendername.$receivername.$emailfrom.$emailto.$sendercontact.
        $receivercontact.$receiveraddress.$paymentmethod.$discount.$orderstatus.$vouchercode.$prodname.$ordernote.
        $orderprice;

        $result =  db::select("call  sp_addtoorders(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",[$username,$symp_transcode,
                        $transcode, $paycode, $sendername, $receivername, $emailfrom, $emailto,$sendercontact,$receivercontact,$receiveraddress, $paymentmethod, $discount, $orderstatus, $vouchercode,$prodname,
                        $ordernote, $orderprice,$ordersummary,$paymentreceipt,$gatewayreceipt,$receiversusername
        ]); 

        echo "success";
    }
    public function sendEmail(Request $request){

        

    } 
    public function getItemCategories()
    {
    	$feedcontent = \DB::SELECT("SELECT parent.PRODT_TITLE category
			,SUM(((SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE (INV.INV_TYPE='CAPITAL' OR INV.INV_TYPE='ADD') AND INV.PROD_ID=PROD.PROD_ID)
			+(SELECT -IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='DISPOSE' AND INV.PROD_ID=PROD.PROD_ID)
			+(SELECT -IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='ORDER' AND INV.PROD_ID=PROD.PROD_ID)
			+(SELECT IFNULL(SUM(PRODV.PRODV_INIT_QTY),0) FROM t_product_variances PRODV WHERE PRODV.PROD_ID = PROD.PROD_ID)
			+(SELECT IFNULL(SUM(PROD_INIT_QTY),0) FROM r_product_infos t_infos WHERE PROD_ID = PROD.PROD_ID))) quantity
			,parent.PRODT_ICON categoryimage
			FROM r_product_types parent
			INNER JOIN r_product_types child ON parent.PRODT_ID = child.PRODT_PARENT
			INNER JOIN r_product_infos PROD ON child.PRODT_ID = PROD.PRODT_ID
			GROUP BY parent.PRODT_TITLE,parent.PRODT_ICON");

    	$output = json_encode(array('feedcontent' => $feedcontent ));
		//$jsonData = json_encode($app);
		if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function getItemsonMarket()
    {
    	$feedcontent = \DB::SELECT("select rmd_itemname, r_marketitem_types.rmt_itemtypename, rmd_itemid, rmd_itemdesc, rmd_itemimage, r_affiliates_details.rad_affiliatename, rmd_baseprice+rmd_topup  as 'final price' from r_marketitems_details inner join r_affiliates_details on r_marketitems_details.rmd_affiliateid = r_affiliates_details.rad_affiliateid inner join r_marketitem_types on r_marketitem_types.rmt_itemtypeid = r_marketitems_details.rmd_itemtype where rmd_isbought = 0 and rmd_itemtype = 1");

    	$output = json_encode(array('feedcontent' => $feedcontent ));
		
		if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function getItemsonMarketCart()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $encbuyername = (trim($_POST['buyername']));

        $cryptor = new Decryptor;
        $buyername = $cryptor->decrypt($encbuyername, $keypassword);

    	$feedcontent = \DB::SELECT("select r_marketitems_details.rmd_itemname,count(r_marketitems_details.rmd_itemname) qty,tci_cartitemid,r_marketitems_details.rmd_itemdesc, r_marketitems_details.rmd_itemimage, r_marketitems_details.rmd_baseprice + r_marketitems_details.rmd_topup as 'final price' from t_cart_items inner join r_marketitems_details on r_marketitems_details.rmd_itemid = t_cart_items.tci_cartitemid  where t_cart_items.tci_cartholder = (select rac_accountid from r_account_credentials where rac_username = ? ) group by r_marketitems_details.rmd_itemname",
            [$buyername]);

    	$output = json_encode(array('feedcontent' => $feedcontent ));
		//$jsonData = json_encode($app);
		if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function getItemsonMarketChocolate()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");

        $enccategorytype = trim($_POST['categorytype']);
        $cryptor = new Decryptor;
        $categorytype = $cryptor->decrypt($enccategorytype, $keypassword);

    	$topitems = \DB::SELECT("SELECT PROD_IMG rmd_itemimage,PROD_DESC rmd_itemdesc, PROD_MY_PRICE  final_price, PROD_NAME rmd_itemname FROM `r_product_infos` where PRODT_ID in (SELECT PRODT_ID FROM `sympies`.`r_product_types` WHERE PRODT_TITLE = ? or PRODT_PARENT = (select PRODT_ID from r_product_types where PRODT_TITLE = ?))",[$categorytype,$categorytype]);

    	$output = json_encode(array('feedcontent' => $topitems ));
		
		if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function getItemsonMarketFlower()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");

        $enccategorytype = trim($_POST['categorytype']);
        $cryptor = new Decryptor;
        $categorytype = $cryptor->decrypt($enccategorytype, $keypassword);
    	$feedcontent = \DB::SELECT("SELECT PROD_IMG rmd_itemimage,PROD_DESC rmd_itemdesc, PROD_MY_PRICE  final_price, PROD_NAME rmd_itemname FROM `r_product_infos` where PRODT_ID in (SELECT PRODT_ID FROM `r_product_types` WHERE PRODT_TITLE LIKE 
            '%".$categorytype."%' )");

    	$output = json_encode(array('feedcontent' => $feedcontent ));

		if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function getItemsonMarketStuffToys()
    {
    	$feedcontent = \DB::SELECT("select rmd_itemname, r_marketitem_types.rmt_itemtypename, rmd_itemid, rmd_itemdesc, rmd_itemimage, r_affiliates_details.rad_affiliatename, rmd_baseprice+rmd_topup  as 'final price' from r_marketitems_details inner join r_affiliates_details on r_marketitems_details.rmd_affiliateid = r_affiliates_details.rad_affiliateid inner join r_marketitem_types on r_marketitem_types.rmt_itemtypeid = r_marketitems_details.rmd_itemtype where rmd_isbought = 0 and rmd_itemtype = 1");
    	$output = json_encode(array('feedcontent' => $feedcontent ));
		if($output == "") {
            echo "";
        } else {
            echo $output;    
        }
    }

    public function getProductDetails()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        
        $encproductname =trim($_POST['productname']);
        $cryptor = new Decryptor;
        $productname = $cryptor->decrypt($encproductname, $keypassword);

        $feedcontent = \DB::SELECT("SELECT AFF_NAME,PROD_NOTE rmd_itemdesc, PROD_MY_PRICE itemprice FROM r_product_infos inner join r_affiliate_infos on r_affiliate_infos.AFF_ID = r_product_infos.AFF_ID where PROD_NAME = ?", 
            [$productname]);

        $output = json_encode(array('proddetails' => $feedcontent ));

        if($output == "") {
            echo "";
        } else {
            echo $output;    
        }
    }

    public function getTopGiftedPerson()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $encusername = trim($_POST['username']);
        $cryptor = new Decryptor;
        $username = $cryptor->decrypt($encusername, $keypassword);

        $gitftedperson = \DB::SELECT("select count(tct_recieverid) id , tct_recieverid, r_account_credentials.rac_username username, r_account_credentials.rac_profilepicture userpic from t_cart_transact INNER JOIN r_account_credentials ON r_account_credentials.rac_accountid = t_cart_transact.tct_recieverid where t_cart_transact.tct_userid = (select rac_accountid from r_account_credentials where rac_username = ?) GROUP by tct_recieverid limit 3", [$username]);

        $output = json_encode(array('gitftedperson' => $giftedperson));
        if($output == "") {
            echo "";
        } else {
            echo $output;    
        }
    }

    public function gettopitemsonmarket()
    {
        $topitems = \DB::SELECT("select PROD_NAME itemname, PROD_MY_PRICE itemprice ,PROD_IMG  itemimage from r_product_infos limit 3");
        $output = json_encode(array('topitems' => $topitems));
        if($output == "") {
            echo "";
        } else {
            echo $output;    
        }

    }

    public function getTopItemsUserProvide()
    {   
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $encusername = trim($_POST['username']);
        $cryptor = new Decryptor;
        $username = $cryptor->decrypt($encusername, $keypassword);

        $feedcontent = \DB::SELECT("select r_marketitems_details.rmd_itemname,r_marketitems_details.rmd_itemimage, count(t_cart_transact.tct_iteminclude) from t_cart_transact inner join r_marketitems_details on t_cart_transact.tct_iteminclude = r_marketitems_details.rmd_itemid WHERE t_cart_transact.tct_userid = (select r_account_credentials.rac_accountid from r_account_credentials where r_account_credentials.rac_username = ?) GROUP by r_marketitems_details.rmd_itemname limit 1",[$username]);
        $output = json_encode(array('userdetails' => $feedcontent));
        if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }

    public function getUserDetailsinMarket()
    {
        db::select("CALL insert_enckey();");
        $keypasswordres = db::select("CALL get_enckey();");
        foreach ($keypasswordres as $row) { $keypassword = $row->key_password; }
        db::select("CALL drop_enckey();");
        $encusername = trim($_POST['username']);
        $cryptor = new Decryptor;
        $username = $cryptor->decrypt($encusername, $keypassword);
        $feedcontent = \DB::SELECT("select count(t_account_friends.tafr_friendlyuserid) as totfriend,r_account_credentials.rac_email, r_account_credentials.rac_profilepicture from r_account_credentials INNER join t_account_friends on t_account_friends.tafr_friendlyuserid = r_account_credentials.rac_accountid where r_account_credentials.rac_username = ?",
            [$username]);

        $output = json_encode(array('userdetails' => $feedcontent ));
        if($output == "") {
            echo "";
        }else {
            echo $output;    
        }
    }
}

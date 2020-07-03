<?php


use App\Mail\MailtrapExample;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


 Route::post('/verifyemail','MobileLoginController@verifyemail');
 Route::post('/searchtoMessage','MobileGetMessagesController@searchtoMessage');
 Route::post('/searchtoMessageGroup','MobileGetMessagesController@searchtoMessageGroup');
 Route::post('/getEmailDetails','MobileMarketController@getEmailDetails');
 Route::post('/emailverified','MobileLoginController@emailverified');
 Route::post('/getChatTopImotions','MobileGetMessagesController@getChatTopImotions');
 Route::post('/insertChatUserImotion','MobileGetMessagesController@insertChatUserImotion');


 Route::post('/evaluate', 'manageOrder@evaluateReceipt')->name('order-evaluate');

Route::get('/proceedpayment',function(){
	return view('paymentsuccess');
});
Route::get('/pay/{price}/{recname}/{product}', function ($price,$recname,$productname) {


Session::put('productprice',$price);
    return view('welcome')->withAmount($price)->withProduct($productname)->withReceiver($recname);

});

/*
Route::get('/payment/make/{request}/{amount}',function(Request $request,$amount ){

$payload = $request->input('payload', false);
    $nonce = $payload['nonce'];
    $status = Braintree_Transaction::sale([
                            'amount' => $amount,
                            'paymentMethodNonce' => $nonce,
                            'options' => [
                                       'submitForSettlement' => True
                                         ]
              ]);


\Log::error($status->transaction->id);
error_log($status->transaction->id);
    return response()->json($status);


})->name('payment.make');
*/
Route::get('/payment/make', 'PaymentsController@make')->name('payment.make');
Route::get('/createCustomer', 'PaymentsController@createCustomer');
Route::get('/saveCard', 'PaymentsController@saveCard');
Route::get('/getSavedCard', 'PaymentsController@getSavedCard');
Route::get('/getPaymentToken', 'PaymentsController@getPaymentToken');
Route::get('/deleteCard', 'PaymentsController@deleteCard');

/*

Route Group for Users Signup Functions

    list includes

    Check Email  [ mobilecheckemail ] -  Verify if email for signup use is already in use
    Check Pnumb  [ mobilecheckpnumb ] -  Verify if number for signup use is already in use
    Insert Verification Code  [ verificationcodeinsert ] -  insert verification code for account retrieval
    Get Verification Code [ verificationcodeget ] - fetch verification code for account retrieval
    Create Account [ mobilecreateaccount ] - Route for insertion of user credetials in database
    Update Profile Picture [ mobileupdateprofpic ] - Route for updating user profile picture
        -- updating of user profile picture doesnt mean to delete the previous image in [ /public/uploads/profilepicture ] but updating the profile picture location in the database. 


*/
Route::group(['prefix' => '/api/v1/users/signup'], function()  
{ 

        //test route
        Route::get('/testroute',function(){  
           echo "Successful creation of /api/v1/users/signup route group for USERS SIGNUP";  
        });  

        /* BEGIN ROUTE LIST */
        Route::post('/mobilecheckemail','MobileLoginController@checkEmail');
        Route::post('/mobilecheckpnumb','MobileLoginController@checkPnumb');
        Route::post('/verificationcodeinsert','MobileLoginController@verificationcodeinsert');
        Route::post('/verificationcodeget','MobileLoginController@verificationcodeget');
        Route::post('/mobilecreateaccount','MobileLoginController@createaccount');
        Route::post('/mobileupdateprofpic','MobileLoginController@updateprofilepicture');
        Route::post('/mobilesaveimage','MobileLoginController@saveimage');



});  


/*

Route Group for Users Login Functions

    list includes

    Login [ mobilelogin ] - Check Login Credentials
    Login with facebook [ mobileloginwithfacebook ] - Check if email received from facebook callback has a corresponding
        valid account from database that marked with social signin = 1 

*/

Route::group(['prefix' => '/api/v1/users/login'], function()  
{ 
        //test route
        Route::get('/testroute',function(){  
           echo "Successful creation of /api/v1/users/login route group for USERS LOGIN";  
        });  

        /* BEGIN ROUTE LIST */
        Route::post('/mobilelogin','MobileLoginController@getLogin');
        Route::post('/mobileloginwithfacebook','MobileLoginController@loginwithfacebook');

});  


/*

Route Group for Posts Functions

    list includes 

    Get Imotion List [ mobilegetimotions ] - Fetch imotion list 
    Create Post Text [ mobilecreatepost ] - Create post with no media included [ images/videos ]
    Save Image [ mobilesaveimage ] - Create post with media [ image ], then store image in [ /public/uploads/images ]
    Save Video [ mobileuploadvideo ] -  Create post with media [ video ], then store video in [ /public/uploads/videos ]
    Report Post [ mobilereportpost ] - Report post or alert authorities
    Delete Post [ mobiledeletepost ] - Mark post as deleted, doensnt delete media if post include media attachments.     
    Post with Comments [ mobilegetpostwithcomments ] - Get post details with comments

*/

Route::group(['prefix' => '/api/v1/users/posts'], function()  
{ 

        //test route
        Route::get('/testroute',function(){  
           echo "Successful creation of /api/v1/users/post route group for USERS POSTS";  
        });  

        /* BEGIN ROUTE LIST */

                
        Route::post('/mobilegetimotions','MobileGetFeedController@getImotions');
        Route::post('/mobilecreatepost','MobileGetPostController@createpost');
        Route::post('/mobilesaveimage','MobileLoginController@saveimage');
        Route::post('/mobileuploadvideo','MobileGetPostController@uploadvideo');
        Route::post('/mobilereportpost','MobileReportTypeController@reportpost');
        Route::post('/mobiledeletepost','MobileGetPostController@deletepost');
        Route::post('/mobilegetpostwithcomments','MobileGetPostController@getPostwithComments');

});  


/*

Route Group for Comments Function

    list includes
    Post Comment [ mobilepostcomment ] - Posting of comments
    Get Comments  [ mobilegetcommentator ] - Fetch Comments to a post
    Get CommentBody [ mobilegetcommentbody ] - Fetch Comments to a post ( route not used anymore -- ready for archieving )
    Delete Comment [ mobiledeletecomment ] - Delete comment , tag commment as deleted = 1 in database
    Get Top Comments [ mobilegettopcomments ] - Function for retrieving only top comments ( route not usesd anymore -- ready for archieving)


*/

Route::group(['prefix' => '/api/v1/users/comments'], function()  
{ 

        //test route
        Route::get('/testroute',function(){  
           echo "Successful creation of /api/v1/users/comments route group for USERS POSTS COMMENTS";  
        });  

        /* BEGIN ROUTE LIST */

        Route::post('/mobilepostcomment','MobileGetCommentController@postComment');
        Route::post('/mobilegetcommentator','MobileGetCommentController@getCommentator');
        Route::post('/mobilegetcommentbody','MobileGetCommentController@getCommentBody');
        Route::post('/mobiledeletecomment','MobileGetCommentController@deletecomment');
        Route::post('/mobilegettopcomments','MobileGetCommentController@getTopComments');

});  




Route::group(['prefix' => '/api/v1/users/feed'], function()  
{ 

        //test route
        Route::get('/testroute',function(){  
           echo "Successful creation of /api/v1/users/feed route group for USERS FEED";  
        });  

        /* BEGIN ROUTE LIST */
        Route::post('/mobileigetyoumakeprocess','MobileGetFeedController@igetyoumakeprocess');
        Route::post('/mobilegetfeedspecuser','MobileGetFeedController@getfeedSpecuser');
        Route::post('/mobilegetfeed','MobileGetFeedController@getfeed');
        Route::post('/mobilegetmydaysfeed','MobileGetFeedController@mydays_feed');
        Route::post('/mobilegetsamefeed','MobileGetFeedController@getSameFeed');

});  


Route::group(['prefix' => '/api/v1/users/notification'], function()  
{ 

        //test route
        Route::get('/testroute',function(){  
        echo "Successful creation of /api/v1/users/notification route group for USERS NOTIFICATION";  
        }); 

        Route::post('/mobilegetnotifications','MobileGetNotificationsController@getNotifications');
        Route::post('/mobilelivenotification','MobileGetNotificationsController@LiveNotification');

});  


Route::group(['prefix' => '/api/v1/users/search'], function()  
{ 

        //test route
        Route::get('/testroute',function(){  
           echo "Successful creation of /api/v1/users/notification route group for USERS SEARCH";  
        }); 

        Route::post('/mobilesearchbypost','MobileFindController@searchbypost');
        Route::post('/mobilesearchpeople','MobileFindController@searchpeople');
        Route::post('/mobilesearchimotion','MobileFindController@searchimotion');
        Route::post('/mobilegethashtags','MobileGetFeedController@getHashTags'); 



});  


Route::group(['prefix' => '/api/v1/users/profile'], function()  
{ 

        //test route
        Route::get('/testroute',function(){  
           echo "Successful creation of /api/v1/users/profile route group for USERS PROFILE";  
        }); 

        Route::post('/mobilegetotherprofile','MobileGetNotificationsController@getOtherProfile');
        Route::post('/mobilegetprofiledetails','MobileGetProfileDetails@getProfileDetails');




});  



Route::get('/send-mail', function () {

    Mail::to('newuser@example.com')->send(new MailtrapExample()); 

    return 'A message has been sent to Mailtrap!';

});

 Route::post('/mobilegetyoumessage','MobileGetMessagesController@postigetyouMessage');
 Route::post('/mobiletermsandpolicy','MobileLoginController@getTermsandCondition');
 Route::post('/mobilegetorderdetails','MobileMarketController@getorderdetails');
 Route::get('/SendMailSubs','MobileLoginController@SendMailSubs');
Route::post('/mobileSendPaymentGatewayReceipt','MobileMarketController@SendPaymentGatewayReceipt');
Route::post('/mobileupdateaccount','MobileGetProfileDetails@updateAccount');
Route::post('/mobileunfollow','MobileFindController@unfollow');
Route::post('/mobilegetotherprofile','MobileGetNotificationsController@getOtherProfile');
Route::post('/mobilesendshopmail','MobileLoginController@SendMail');
Route::post('/mobileaddtoorders','MobileMarketController@addToOrders');
Route::post('/mobilegetprofiledetails','MobileGetProfileDetails@getProfileDetails');
Route::post('/mobileigetyoumakeprocess','MobileGetFeedController@igetyoumakeprocess');
Route::post('/mobilegetfeedspecuser','MobileGetFeedController@getfeedSpecuser');
Route::post('/mobilegetfeed','MobileGetFeedController@getfeed');
Route::post('/mobilegetmydaysfeed','MobileGetFeedController@mydays_feed');
Route::post('/mobilegetsamefeed','MobileGetFeedController@getSameFeed');

Route::post('/mobilegetnotifications','MobileGetNotificationsController@getNotifications');
Route::post('/mobilelivenotification','MobileGetNotificationsController@LiveNotification');

Route::post('/mobilesearchbypost','MobileFindController@searchbypost');
Route::post('/mobilesearchpeople','MobileFindController@searchpeople');
Route::post('/mobilesearchimotion','MobileFindController@searchimotion');
Route::post('/mobilegethashtags','MobileGetFeedController@getHashTags'); 


Route::post('/mobilelogin','MobileLoginController@getLogin');
Route::post('/mobileloginwithfacebook','MobileLoginController@loginwithfacebook');

        Route::post('/updatepassword','MobileLoginController@updatepassword');
        
Route::post('/verificationcodeinsert','MobileLoginController@verificationcodeinsert');
Route::post('/verificationcodeget','MobileLoginController@verificationcodeget');
Route::post('/mobilecheckemail','MobileLoginController@checkEmail');
Route::post('/mobilecheckpnumb','MobileLoginController@checkPnumb');

        Route::post('/mobileaddfriends','MobileFindController@addfriends');
        Route::post('/mobilefindthrucontacts','MobileFindController@findthrucontact');


        Route::post('/mobilefindcircles','MobileFindController@find_mycircles');
        Route::post('/mobileaddtocircle','MobileGetMessagesController@addtocircle');
        Route::post('/mobilefindNearby','MobileGetMessagesController@findNearby');

        Route::post('/mobilefindfollowers','MobileFindController@findfollowers');
        Route::post('/mobilecreateaccount','MobileLoginController@createaccount');

        Route::post('/mobilefindfollowersmycircle','MobileFindController@findfollowers_mycirles');

        Route::post('/mobilefindfollowing','MobileFindController@findfollowing');

        Route::post('/mobilefindgetyou','MobileFindController@findgetyouer');

        Route::post('/mobilegetfriendrequest','MobileFindController@getFriendRequest');

        Route::post('/mobilefollowpublicaccount','MobileFindController@followpublicaccount');

        Route::post('/mobilemakefriends','MobileFindController@makefriends');


        Route::post('/mobilegetcommentator','MobileGetCommentController@getCommentator');

        Route::post('/mobilesearchpeopleexact','MobileFindController@searchpeopleexact');
        Route::post('/mobilesearchpost','MobileFindController@searchpost');



        Route::post('/mobilegetimotions','MobileGetFeedController@getImotions');
        Route::get('/survey','MobileGetFeedController@survey');

        Route::post('/mobilegetcommentbody','MobileGetCommentController@getCommentBody');
        Route::post('/mobilepostcomment','MobileGetCommentController@postComment');
        Route::post('/mobiledeletecomment','MobileGetCommentController@deletecomment');

        Route::post('/mobilegettopcomments','MobileGetCommentController@getTopComments');

        Route::post('/mobileviewspotlight','MobileGetFeedController@mydays_viewpost');
        Route::post('/mobilereportpost','MobileReportTypeController@reportpost');





        Route::post('/mobilegetmessageslist','MobileGetMessagesController@getMessageList');

        Route::post('/mobilegetmessages','MobileGetMessagesController@getMessages');
        Route::post('/mobilepostMessage','MobileGetMessagesController@postMessage');




        Route::post('/mobilegetpost','MobileGetPostController@getPostComments');

        Route::post('/mobiledeletepost','MobileGetPostController@deletepost');
        Route::post('/mobilecreatepost','MobileGetPostController@createpost');

        Route::post('/mobileuploadimage','MobileGetPostController@uploadimage');
        Route::post('/mobilecreatespotlight','MobileGetPostController@createspotlight');

        Route::post('/mobileuploadvideo','MobileGetPostController@uploadvideo');
        Route::post('/mobileuploadaudio','MobileGetPostController@uploadaudio');
        Route::post('/mobilesaveimage','MobileLoginController@saveimage');

        Route::post('/mobileupdatecomment','MobileGetCommentController@updatecomment');
        Route::post('/mobileupdateprofpic','MobileLoginController@updateprofilepicture');


        Route::post('/mobilegetpostwithcomments','MobileGetPostController@getPostwithComments');

        Route::post('/mobilegetflashsales','MobileMarketController@getFlashSales');

        Route::post('/mobilegetitemcategories','MobileMarketController@getItemCategories');

        Route::post('/mobilegetitemsonmarket','MobileMarketController@getItemsonMarket');

        Route::post('/mobilegetitemsonmarketcart','MobileMarketController@getItemsonMarketCart');

        Route::post('/mobilegetitemsonmarketchocolate','MobileMarketController@getItemsonMarketChocolate');

        Route::post('/mobilegetitemsonmarketflower','MobileMarketController@getItemsonMarketFlower');

        Route::post('/mobilegetitemsonmarketstufftoys','MobileMarketController@getItemsonMarketStuffToys');

        Route::post('/mobilegetproductdetails','MobileMarketController@getProductDetails');

        Route::post('/mobilegettopgiftedperson','MobileMarketController@getTopGiftedPerson');

        Route::post('/mobilegettopitems','MobileMarketController@gettopitemsonmarket');

        Route::post('/mobilegettopitemsuserprovide','MobileMarketController@getTopItemsUserProvide');

        Route::post('/mobilegetuserdetailsinmarket','MobileMarketController@getUserDetailsinMarket');

        Route::post('/mobilegetreporttypes','MobileReportTypeController@getReportTypes');



        Auth::routes();
        Route::group(['middleware' => ['authenticate']], function() {

        Route::group(['middleware' => ['isAdmin']], function(){

            Route::resource('/product/category', 'manageProductCategory',['names'=>['index'=>'prodCat','create'=>'prodCat','edit'=>'prodCat']]);
            Route::resource('/tax', 'manageTax',['names'=>['index'=>'tax','create'=>'tax','edit'=>'tax']]);
            Route::resource('/users', 'manageUsers',['names'=>['index'=>'users','create'=>'users','edit'=>'users']]);
            Route::resource('/affiliates', 'manageAffiliates',['names'=>['index'=>'affiliates','create'=>'affiliates','edit'=>'affiliates']]);
            Route::get('/product/category/create/{type}','manageProductCategory@create')->name('prodCat');
            Route::post('/tax/actDeact','manageTax@actDeact');
            Route::resource('/currency','manageCurrency',['names'=>['index'=>'currency','create'=>'currency','edit'=>'currency']]);

        });


        Route::post('/product/actDeact','manageProduct@actDeact');
        Route::post('/product/appDisapprove','manageProduct@appDisapprove');
        Route::post('/product/ProductVar','manageProduct@ProductVar');
        Route::get('/product/showProductVar/{id}','manageProduct@showProductVar');
        Route::post('/product/discount','manageProduct@updateDiscount');
        Route::post('/product/deleteAllProductVar','manageProduct@deleteAllProductVar');
        Route::post('/category/actDeact','manageProductCategory@actDeact');
        Route::post('/affiliate/actDeact','manageAffiliates@actDeact');
        Route::post('/user/actDeact','manageUsers@actDeact');


        Route::resource('/dashboard', 'manageDashboard',['names'=>['index'=>'dashboard','create'=>'dashboard','edit'=>'dashboard']]);
        Route::resource('/product/list', 'manageProduct',['names'=>['index'=>'prodList','create'=>'prodList','edit'=>'prodList']]);
        Route::resource('/order','manageOrder',['names'=>['index'=>'order','create'=>'order','edit'=>'order']]);

        Route::get('/sales','manageSales@sales');
        Route::get('/grossSalesJSON','manageSales@grossSalesJSON');
        Route::get('/salesJSON','manageSales@SalesJSON');


        //    Route::get('order-pending','manageOrder@index');
        //    Route::get('order-complete','manageOrder@index');
        //    Route::get('order-cancel','manageOrder@index');
        //    Route::get('order-refund','manageOrder@index');
        //    Route::get('order-void','manageOrder@index');



        Route::get('orders','manageOrder@index');

        Route::get('inventory-remaining','manageInventory@index');
        Route::get('inventory-manage','manageInventory@manageInventory');
        Route::get('inventory-remaining/{sku}','manageInventory@skuInventory')->name('sku');

        Route::post('inventory-acquire/product','manageInventory@productAcquire');
        Route::post('inventory-dispose/product','manageInventory@productDispose');

        Route::post('inventory-acquire/variance','manageInventory@productVAcquire');
        Route::post('inventory-dispose/variance','manageInventory@productVDispose');




        });
        Route::post('getProd/Affiliates','frontProductsController@getProdAffiliates')->name('prodAffiliates');

        //Route::get('getProd/Affiliates/{id}','frontProductsController@getProdAffiliates')->name('prodAffiliates');
        Route::post('getProd/Category','frontProductsController@getProdCategory')->name('getCategory');
        Route::get('/product/details/{id}','frontProductsController@getProdDetails');
        Route::get('/summary-orders','frontProductsController@getOrders')->name('summary-orders');

        Route::get('/invoice/details/{id}','manageOrder@userInvoice')->name('userInvoice');
        Route::group(['middleware'=> ['isSympiesUser']],function(){

        // route for processing payment
        Route::post('/checkout/execute', 'paymentController@payWithpaypal');

        Route::post('/checkout/addORder', 'manageOrder@addOrders')->name('addOrders');

        Route::post('/order/upload', 'manageOrder@uploadPaymentReceipt')->name('upload');

        
        // route for check status of the payment
        Route::get('/checkout/finished', 'paymentController@getPaymentStatus');
        //route for ordering process
        Route::post('/makeOrder', 'orderingFunctions@makeOrder');

        Route::get('/checkout/details', 'manageOrder@checkoutView')->name('checkoutView');

        });

        // Route::get('/get/user-invoice/{id}',function($id){
        // $order = \App\t_order::where('ORD_ID',$id)
        // ->first();

        // $order_items = \App\t_order_item::with('tOrder','rProductInfo')
        // ->where('ORD_ID',$order->ORD_ID)
        // ->get();

        // $invoice = \App\t_invoice::with('tOrder')
        // ->where('ORD_ID',$order->ORD_ID)
        // ->first();

        // $shipment = \App\t_shipment::with('tInvoice','tOrder')
        // ->where('ORD_ID',$order->ORD_ID)
        // ->first();

        // $payment = \App\t_payment::with('tInvoice')
        // ->where('INV_ID',$invoice->INV_ID)
        // ->first();

        // // return view('pages.invoices.user-invoice'
        // //     ,compact('order','order_items','invoice','shipment','payment','product','product_variances'));
        // return view('pages.invoices.user-invoice'
        // ,compact('order','order_items','invoice','shipment','payment'));


        // });


        Route::resource('/','frontProductsController');
        Route::post('/loginSympiesAccount','sympiesUser@loginUser')->name('loginuser');
        Route::post('/registerSympiesAccount','sympiesUser@createUser')->name('createUser');


        Route::get('/logoutSympiesAccount/{id}',function($id){
            $get = Session::get('sympiesAccount');
            if($get['ID']==$id)
            Session::forget('sympiesAccount');
            return redirect()->back();
        });

        Route::get('/mail','mailer@sendEmailReminder');


        Route::get('/getAllCategories',function(){
        $prodcat = \Illuminate\Support\Facades\DB::SELECT('SELECT parent.PRODT_TITLE category
        ,SUM(((SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE (INV.INV_TYPE=\'CAPITAL\' OR INV.INV_TYPE=\'ADD\') AND INV.PROD_ID=PROD.PROD_ID)
        +(SELECT -IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE=\'DISPOSE\' AND INV.PROD_ID=PROD.PROD_ID)
        +(SELECT -IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE=\'ORDER\' AND INV.PROD_ID=PROD.PROD_ID)
        +(SELECT IFNULL(SUM(PRODV.PRODV_INIT_QTY),0) FROM t_product_variances PRODV WHERE PRODV.PROD_ID = PROD.PROD_ID)
        +(SELECT IFNULL(SUM(PROD_INIT_QTY),0) FROM r_product_infos t_infos WHERE PROD_ID = PROD.PROD_ID))) quantity
        ,parent.PRODT_ICON categoryimage
        FROM r_product_types parent
        INNER JOIN r_product_types child ON parent.PRODT_ID = child.PRODT_PARENT
        INNER JOIN r_product_infos PROD ON child.PRODT_ID = PROD.PRODT_ID
        GROUP BY parent.PRODT_TITLE,parent.PRODT_ICON');


        return json_encode(array('feedcontent'=>$prodcat));
        });

        Route::get('/getAllProducts',function (){
        return \App\Providers\sympiesProvider::filterAvailable(\App\r_product_info::with('rAffiliateInfo', 'rProductType')
        ->where('PROD_IS_APPROVED', '1')
        ->where('PROD_DISPLAY_STATUS', 1)->get());
        });

        Route::get('/search','frontProductsController@search');

        Auth::routes();

        Route::get('/home', 'HomeController@index')->name('home');

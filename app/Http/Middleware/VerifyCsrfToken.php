<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
    	
                '/searchtoMessage',
                '/mobilesendshopmail',
                '/mobilegetorderdetails',
                '/SendMailSubs',
                '/mobileSendPaymentGatewayReceipt',
        		'/mobileaddtoorders',
        		'/mobileuploadaudio',
        		'/mobilegetyoumessage',
                '/mobiletermsandpolicy',
                '/searchtoMessageGroup',

    			//new API Routes

    			// [ Signup ]
                '/api/v1/users/signup/mobilecheckemail',
                '/api/v1/users/signup/mobilecheckpnumb',
                '/api/v1/users/signup/verificationcodeinsert',
                '/api/v1/users/signup/verificationcodeget',
                '/api/v1/users/signup/mobilecreateaccount',
                '/api/v1/users/signup/mobileupdateprofpic',
                '/api/v1/users/signup/mobilesaveimage',


                // [ Login ] /api/v1/users/login
                '/api/v1/users/login/mobilelogin',
                '/api/v1/users/login/mobileloginwithfacebook',

                // [ Post ] /api/v1/users/posts
                '/api/v1/users/posts/mobilegetimotions',
                '/api/v1/users/posts/mobilecreatepost',
                '/api/v1/users/posts/mobilesaveimage',
                '/api/v1/users/posts/mobileuploadvideo',
                '/api/v1/users/posts/mobilereportpost',
                '/api/v1/users/posts/mobiledeletepost',
                '/api/v1/users/posts/mobilegetpostwithcomments',

                // [ Comments ] /api/v1/users/comments
                '/api/v1/users/comments/mobilepostcomment',
                '/api/v1/users/comments/mobilegetcommentator',
                '/api/v1/users/comments/mobilegetcommentbody',
                '/api/v1/users/comments/mobiledeletecomment',
                '/api/v1/users/comments/mobilegettopcomments',


                // [ Feed ] /api/v1/users/feed
                '/api/v1/users/feed/mobileigetyoumakeprocess',
                '/api/v1/users/feed/mobilegetfeedspecuser',
                '/api/v1/users/feed/mobilegetfeed',
                '/api/v1/users/feed/mobilegetmydaysfeed',
                '/api/v1/users/feed/mobilegetsamefeed',
		
				// [ Notifications ] /api/v1/users/notification
				'/api/v1/users/notification/mobilegetnotifications',
				'/api/v1/users/notification/mobilelivenotification',

				// [ Search ] /api/v1/users/search
				'/api/v1/users/search/mobilesearchbypost',
				'/api/v1/users/search/mobilesearchpeople',
				'/api/v1/users/search/mobilesearchimotion',
				'/api/v1/users/search/mobilegethashtags',
				
				// [ Profile ] /api/v1/users/profile
				'/api/v1/users/profile/mobilegetotherprofile',
				'/api/v1/users/profile/mobilegetprofiledetails',
        		
        		'/mobileaddtoorders',
                '/mobileupdateaccount',
        		'/mobileunfollow',
		        '/mobilelogin',
                '/updatepassword',
                '/verificationcodeinsert',
                '/verificationcodeget',
                '/mobilecheckemail',
                '/mobilecreatespotlight',
                '/mobilecheckpnumb',
                '/mobileloginwithfacebook',
                '/mobileaddfriends',
	      		'/mobilegetsamefeed',
				'/mobilegethashtags',
				'/mobilefindcircles',
				'/mobilefindfollowers',
				'/mobilefindfollowersmycircle',
				'/mobileaddtocircle',
				'/mobilefindNearby',
				'/mobilefindfollowing',
				'/mobilefindgetyou',
				'/mobilefindthrucontacts',
				'/mobilegetfriendrequest',
				'/mobileupdateprofpic',
				'/mobilesaveimage',
                '/mobilemakefriends',
                '/mobilecreateaccount',
                '/mobileuploadimage',
                '/mobileuploadvideo',
                '/mobilesearchimotion',
                '/mobilesearchpeopleexact',
                '/mobilesearchbypost',
                '/mobilesearchpeople',
                '/mobilegetimotions',
                '/api/v1/users/posts/mobilegetimotions',
                '/api/v1/users/search/mobilesearchbypost',
                '/mobilecreatepost',
                '/mobilefollowpublicaccount',
				'/mobilegetcommentator',
				'/mobilegetcommentbody',
				'/mobilepostcomment',
				'/mobilegettopcomments',
				'/mobilegetfeed',
				'/mobilereportpost',
				'/mobileigetyoumakeprocess',
				'/mobilegetfeedspecuser',
		        '/mobilegetmydaysfeed',
		        '/mobileviewspotlight',
				'/mobilegetmessageslist',
				'/mobiledeletecomment',
				'/mobilegetmessages',
				'/mobilepostMessage',
				'/mobilegetnotifications',
				'/mobilegetotherprofile',
				'/mobilelivenotification',
				'/mobilegetprofiledetails',
				'/mobilegetpost',
				'/mobilegetpostwithcomments',
		        '/mobiledeletepost',
				'/mobileupdatecomment',
				'/mobilegetflashsales',
				'/mobilegetitemcategories',
				'/mobilegetitemsonmarket',
				'/mobilegetitemsonmarketcart',
				'/mobilegetitemsonmarketchocolate',
				'/mobilegetitemsonmarketflower',
				'/mobilegetitemsonmarketstufftoys',
				'/mobilegetproductdetails',
				'/mobilegettopgiftedperson',
				'/mobilegettopitems',
				'/mobilegettopitemsuserprovide',
				'/mobilegetuserdetailsinmarket',
				'/mobilegetreporttypes',
                '/verifyemail',
                '/getEmailDetails',
                '/emailverified',
                '/getChatTopImotions',
                '/insertChatUserImotion',

    ];
}

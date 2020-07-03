<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $rac_accountid
 * @property string $rac_username
 * @property string $rac_profilepicture
 * @property string $rac_userbackgroundcover
 * @property string $rac_password
 * @property string $rac_email
 * @property string $rac_pnumb
 * @property string $rac_shortbio
 * @property string $rac_credentialsadded
 * @property string $rac_mobileverification
 * @property string $rac_credentialsmodified
 * @property string $rac_useraddress
 * @property RAccountNotification[] $rAccountNotifications
 * @property RAccountNotification[] $rAccountNotifications1
 * @property RCommentReply[] $rCommentReplies
 * @property RFeedsComment[] $rFeedsComments
 * @property RPostGetyou[] $rPostGetyous
 * @property TAccountFeed[] $tAccountFeeds
 * @property TAccountFriend[] $tAccountFriends
 * @property TAccountFriend[] $tAccountFriends1
 * @property TChatRoom[] $tChatRooms
 * @property TChatRoom[] $tChatRooms1
 * @property TChatRoomsMessage[] $tChatRoomsMessages
 * @property TChatRoomsMessage[] $tChatRoomsMessages1
 * @property TReportQuery[] $tReportQueries
 */
class r_account_credential extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'rac_accountid';

    /**
     * @var array
     */
    protected $fillable = ['rac_username', 'rac_profilepicture', 'rac_userbackgroundcover', 'rac_password', 'rac_email', 'rac_pnumb', 'rac_shortbio', 'rac_credentialsadded', 'rac_mobileverification', 'rac_credentialsmodified', 'rac_useraddress'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rAccountNotifications()
    {
        return $this->hasMany(r_account_notification::class, 'ran_notifywho', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rAccountNotifications1()
    {
        return $this->hasMany(r_account_notification::class, 'ran_notifyby', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rCommentReplies()
    {
        return $this->hasMany(r_comment_reply::class, 'rcr_replyactor', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rFeedsComments()
    {
        return $this->hasMany(r_comment_reply::class, 'rfc_commentcreator', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rPostGetyous()
    {
        return $this->hasMany(r_post_getyou::class, 'rpg_actormakeget', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tAccountFeeds()
    {
        return $this->hasMany(t_account_feed::class, 'tafd_postcreator', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tAccountFriends()
    {
        return $this->hasMany(t_account_friend::class, 'tafr_userprofileid', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tAccountFriends1()
    {
        return $this->hasMany(t_account_friend::class, 'tafr_friendlyuserid', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tChatRooms()
    {
        return $this->hasMany(t_chat_room::class, 'tcr_creator', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tChatRooms1()
    {
        return $this->hasMany(t_chat_room::class, 'tcr_pairtowho', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tChatRoomsMessages()
    {
        return $this->hasMany(t_chat_rooms_message::class, 'tcrm_messenger', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tChatRoomsMessages1()
    {
        return $this->hasMany(t_chat_rooms_message::class, 'tcrm_reciver', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tReportQueries()
    {
        return $this->hasMany(t_report_queries::class, 'trq_sender', 'rac_accountid');
    }
}

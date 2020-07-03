<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $tcrm_messageid
 * @property int $tcrm_chatroomid
 * @property int $tcrm_messenger
 * @property int $tcrm_reciver
 * @property string $tcrm_messagecontent
 * @property string $tcrm_messagetimestamp
 * @property int $tcrm_isarchived
 * @property TChatRoom $tChatRoom
 * @property RAccountCredential $rAccountCredential
 * @property RAccountCredential $rAccountCredential1
 */
class t_chat_rooms_message extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'tcrm_messageid';

    /**
     * @var array
     */
    protected $fillable = ['tcrm_chatroomid', 'tcrm_messenger', 'tcrm_reciver', 'tcrm_messagecontent', 'tcrm_messagetimestamp', 'tcrm_isarchived'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tChatRoom()
    {
        return $this->belongsTo('App\TChatRoom', 'tcrm_chatroomid', 'tcr_chatroomid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rAccountCredential()
    {
        return $this->belongsTo(r_account_credential::class, 'tcrm_messenger', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rAccountCredential1()
    {
        return $this->belongsTo(r_account_credential::class, 'tcrm_reciver', 'rac_accountid');
    }
}

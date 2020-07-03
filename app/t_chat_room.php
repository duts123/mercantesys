<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $tcr_chatroomid
 * @property int $tcr_creator
 * @property int $tcr_pairtowho
 * @property int $tcr_roomtype
 * @property string $tcr_chatroomname
 * @property string $tcr_dateadded
 * @property RAccountCredential $rAccountCredential
 * @property RAccountCredential $rAccountCredential1
 * @property TChatRoomsType $tChatRoomsType
 * @property TChatRoomsMessage[] $tChatRoomsMessages
 */
class t_chat_room extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'tcr_chatroomid';

    /**
     * @var array
     */
    protected $fillable = ['tcr_creator', 'tcr_pairtowho', 'tcr_roomtype', 'tcr_chatroomname', 'tcr_dateadded'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rAccountCredential()
    {
        return $this->belongsTo(r_account_credential::class, 'tcr_creator', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rAccountCredential1()
    {
        return $this->belongsTo(r_account_credential::class, 'tcr_pairtowho', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tChatRoomsType()
    {
        return $this->belongsTo(t_chat_rooms_type::class, 'tcr_roomtype', 'tcrt_roomtypeid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tChatRoomsMessages()
    {
        return $this->hasMany(t_chat_rooms_message::class, 'tcrm_chatroomid', 'tcr_chatroomid');
    }
}

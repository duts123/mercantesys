<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $tcrt_roomtypeid
 * @property string $tcrt_roomtypevalue
 * @property string $tcrt_dateadded
 * @property TChatRoom[] $tChatRooms
 */
class t_chat_rooms_type extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_chat_rooms_type';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'tcrt_roomtypeid';

    /**
     * @var array
     */
    protected $fillable = ['tcrt_roomtypevalue', 'tcrt_dateadded'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tChatRooms()
    {
        return $this->hasMany(t_chat_room::class, 'tcr_roomtype', 'tcrt_roomtypeid');
    }
}

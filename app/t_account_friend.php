<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $tafr_makefriendtranscationid
 * @property int $tafr_userprofileid
 * @property int $tafr_friendlyuserid
 * @property string $tafr_dateaccompanied
 * @property int $tafr_isfollowed
 * @property int $tafd_isaccepted
 * @property RAccountCredential $rAccountCredential
 * @property RAccountCredential $rAccountCredential1
 */
class t_account_friend extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'tafr_makefriendtranscationid';

    /**
     * @var array
     */
    protected $fillable = ['tafr_userprofileid', 'tafr_friendlyuserid', 'tafr_dateaccompanied', 'tafr_isfollowed', 'tafd_isaccepted'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rAccountCredential()
    {
        return $this->belongsTo(r_account_credential::class, 'tafr_userprofileid', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rAccountCredential1()
    {
        return $this->belongsTo(r_account_credential::class, 'tafr_friendlyuserid', 'rac_accountid');
    }
}

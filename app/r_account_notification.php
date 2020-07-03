<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ran_notificationid
 * @property int $ran_postid
 * @property int $ran_notifywho
 * @property int $ran_notifyby
 * @property string $ran_notificationbody
 * @property string $ran_activitydate
 * @property TAccountFeed $tAccountFeed
 * @property RAccountCredential $rAccountCredential
 * @property RAccountCredential $rAccountCredential1
 */
class r_account_notification extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'r_account_notification';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'ran_notificationid';

    /**
     * @var array
     */
    protected $fillable = ['ran_postid', 'ran_notifywho', 'ran_notifyby', 'ran_notificationbody', 'ran_activitydate'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tAccountFeed()
    {
        return $this->belongsTo(t_account_feed::class, 'ran_postid', 'tafd_postid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rAccountCredential()
    {
        return $this->belongsTo(r_account_credential::class, 'ran_notifywho', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rAccountCredential1()
    {
        return $this->belongsTo(r_account_credential::class, 'ran_notifyby', 'rac_accountid');
    }
}

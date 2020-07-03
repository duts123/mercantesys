<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $rpg_postrelate
 * @property int $rpg_actormakeget
 * @property string $rpg_getyoudateadded
 * @property int $rpg_isremoved
 * @property TAccountFeed $tAccountFeed
 * @property RAccountCredential $rAccountCredential
 */
class r_post_getyou extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'r_post_getyou';

    /**
     * @var array
     */
    protected $fillable = ['rpg_postrelate', 'rpg_actormakeget', 'rpg_getyoudateadded', 'rpg_isremoved'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tAccountFeed()
    {
        return $this->belongsTo(t_account_feed::class, 'rpg_postrelate', 'tafd_postid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rAccountCredential()
    {
        return $this->belongsTo(r_account_credential::class, 'rpg_actormakeget', 'rac_accountid');
    }
}

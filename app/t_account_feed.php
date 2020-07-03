<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $tafd_postid
 * @property int $tafd_postcreator
 * @property string $tafd_postcontent
 * @property string $tafd_postimage_source
 * @property string $tafd_postadded
 * @property string $tafd_imotion
 * @property int $tafd_igetyoucount
 * @property int $tafd_giftcount
 * @property int $tafd_commentcount
 * @property int $tafd_postaudience
 * @property RAccountCredential $rAccountCredential
 * @property RAccountNotification[] $rAccountNotifications
 * @property RFeedsComment[] $rFeedsComments
 * @property RPostGetyou[] $rPostGetyous
 * @property TReportQuery[] $tReportQueries
 */
class t_account_feed extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'tafd_postid';

    /**
     * @var array
     */
    protected $fillable = ['tafd_postcreator', 'tafd_postcontent', 'tafd_postimage_source', 'tafd_postadded', 'tafd_imotion', 'tafd_igetyoucount', 'tafd_giftcount', 'tafd_commentcount', 'tafd_postaudience'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rAccountCredential()
    {
        return $this->belongsTo(r_account_credential::class, 'tafd_postcreator', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rAccountNotifications()
    {
        return $this->hasMany(r_account_notification::class, 'ran_postid', 'tafd_postid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rFeedsComments()
    {
        return $this->hasMany(r_feeds_comment::class, 'rfc_feedparent', 'tafd_postid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rPostGetyous()
    {
        return $this->hasMany(r_post_getyou::class, 'rpg_postrelate', 'tafd_postid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tReportQueries()
    {
        return $this->hasMany(t_report_queries::class, 'trq_reportedpost', 'tafd_postid');
    }
}

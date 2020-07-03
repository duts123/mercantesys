<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $trq_queryid
 * @property int $trq_sender
 * @property int $trq_reportedpost
 * @property int $trq_reporttype
 * @property string $trq_reportstamp
 * @property RAccountCredential $rAccountCredential
 * @property TAccountFeed $tAccountFeed
 * @property RReportType $rReportType
 */
class t_report_queries extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'trq_queryid';

    /**
     * @var array
     */
    protected $fillable = ['trq_sender', 'trq_reportedpost', 'trq_reporttype', 'trq_reportstamp'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rAccountCredential()
    {
        return $this->belongsTo(r_account_credential::class, 'trq_sender', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tAccountFeed()
    {
        return $this->belongsTo(t_account_feed::class, 'trq_reportedpost', 'tafd_postid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rReportType()
    {
        return $this->belongsTo(r_report_type::class, 'trq_reporttype', 'rrt_reporttypeid');
    }
}

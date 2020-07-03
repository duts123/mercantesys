<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $rcr_replyid
 * @property int $rcr_replyparent
 * @property int $rcr_replyactor
 * @property string $rcr_replybody
 * @property string $rcr_replydate
 * @property int $rcr_isdeleted
 * @property RFeedsComment $rFeedsComment
 * @property RAccountCredential $rAccountCredential
 */
class r_comment_reply extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'rcr_replyid';

    /**
     * @var array
     */
    protected $fillable = ['rcr_replyparent', 'rcr_replyactor', 'rcr_replybody', 'rcr_replydate', 'rcr_isdeleted'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rFeedsComment()
    {
        return $this->belongsTo(r_feeds_comment::class, 'rcr_replyparent', 'rfc_commentid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rAccountCredential()
    {
        return $this->belongsTo(r_account_credential::class, 'rcr_replyactor', 'rac_accountid');
    }
}

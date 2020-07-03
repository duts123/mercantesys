<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $rfc_commentid
 * @property int $rfc_feedparent
 * @property int $rfc_commentcreator
 * @property string $rfc_commentbody
 * @property int $rfc_reported
 * @property string $rfc_dateadded
 * @property int $rfc_deleted
 * @property TAccountFeed $tAccountFeed
 * @property RAccountCredential $rAccountCredential
 * @property RCommentReply[] $rCommentReplies
 */
class r_feeds_comment extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'rfc_commentid';

    /**
     * @var array
     */
    protected $fillable = ['rfc_feedparent', 'rfc_commentcreator', 'rfc_commentbody', 'rfc_reported', 'rfc_dateadded', 'rfc_deleted'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tAccountFeed()
    {
        return $this->belongsTo(t_account_feed::class, 'rfc_feedparent', 'tafd_postid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rAccountCredential()
    {
        return $this->belongsTo(r_account_credential::class, 'rfc_commentcreator', 'rac_accountid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rCommentReplies()
    {
        return $this->hasMany(r_comment_reply::class, 'rcr_replyparent', 'rfc_commentid');
    }
}

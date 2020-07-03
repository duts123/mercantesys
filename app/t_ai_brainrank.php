<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $tab_airelationid
 * @property int $tab_imotionidtorel
 * @property string $tab_value
 * @property string $tab_dateadded
 * @property RImotionsDetail $rImotionsDetail
 */
class t_ai_brainrank extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_ai_brainrank';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'tab_airelationid';

    /**
     * @var array
     */
    protected $fillable = ['tab_imotionidtorel', 'tab_value', 'tab_dateadded'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rImotionsDetail()
    {
        return $this->belongsTo(r_imotions_detail::class, 'tab_imotionidtorel', 'rid_imotionid');
    }
}

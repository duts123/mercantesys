<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $rid_imotionid
 * @property string $rid_imotionname
 * @property string $rid_imotionimagepath
 * @property string $rid_imotionadded
 * @property string $rid_imotionremove
 * @property TAiBrainrank[] $tAiBrainranks
 */
class r_imotions_detail extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'rid_imotionid';

    /**
     * @var array
     */
    protected $fillable = ['rid_imotionname', 'rid_imotionimagepath', 'rid_imotionadded', 'rid_imotionremove'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tAiBrainranks()
    {
        return $this->hasMany(t_ai_brainrank::class, 'tab_imotionidtorel', 'rid_imotionid');
    }
}

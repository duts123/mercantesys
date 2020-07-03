<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $SET_ID
 * @property int $CURR_ID
 * @property float $SET_DEL_CHARGE
 * @property float $SET_SERVICE_FEE
 * @property string $created_at
 * @property string $updated_at
 * @property RCurrency $rCurrency
 */
class t_setup extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_setups';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'SET_ID';

    /**
     * @var array
     */
    protected $fillable = ['CURR_ID', 'SET_DEL_CHARGE', 'SET_SERVICE_FEE', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rCurrency()
    {
        return $this->belongsTo(r_currencies::class, 'CURR_ID', 'CURR_ID');
    }
}

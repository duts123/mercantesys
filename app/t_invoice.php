<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $INV_ID
 * @property int $ORD_ID
 * @property string $INV_NO
 * @property string $INV_STATUS
 * @property string $INV_DETAILS
 * @property string $INV_TYPE
 * @property string $created_at
 * @property string $updated_at
 * @property TOrder $tOrder
 */
class t_invoice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_invoices';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'INV_ID';

    /**
     * @var array
     */
    protected $fillable = ['ORD_ID', 'INV_NO', 'INV_STATUS', 'INV_DETAILS','INV_TYPE', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tOrder()
    {
        return $this->belongsTo(t_order::class, 'ORD_ID', 'ORD_ID');
    }
}

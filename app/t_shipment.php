<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $SHIP_ID
 * @property int $ORD_ID
 * @property int $INV_ID
 * @property string $SHIP_TRACKING_NO
 * @property string $SHIP_DESC
 * @property string $created_at
 * @property string $updated_at
 * @property TInvoice $tInvoice
 * @property TOrder $tOrder
 */
class t_shipment extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 't_shipments';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'SHIP_ID';

    /**
     * @var array
     */
    protected $fillable = ['ORD_ID', 'INV_ID', 'SHIP_TRACKING_NO','SHIP_STATUS', 'SHIP_DESC', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tInvoice()
    {
        return $this->belongsTo(t_invoice::class, 'INV_ID', 'INV_ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tOrder()
    {
        return $this->belongsTo(t_order::class, 'ORD_ID', 'ORD_ID');
    }
}

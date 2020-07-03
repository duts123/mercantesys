<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $SHIPORDI_ID
 * @property int $SHIP_ID
 * @property int $ORDI_ID
 * @property string $created_at
 * @property string $updated_at
 * @property TOrderItem $tOrderItem
 * @property TShipment $tShipment
 */
class t_shipment_orderitem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_shipment_orderitems';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'SHIPORDI_ID';

    /**
     * @var array
     */
    protected $fillable = ['SHIPORDI_ID','SHIP_ID', 'ORDI_ID', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tOrderItem()
    {
        return $this->belongsTo(t_order_item::class, 'ORDI_ID', 'ORDI_ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tShipment()
    {
        return $this->belongsTo(t_shipment::class, 'SHIP_ID', 'SHIP_ID');
    }
}

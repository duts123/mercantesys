<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $INV_ID
 * @property int $PROD_ID
 * @property int $PRODV_ID
 * @property int $INV_QTY
 * @property int $ORDI_ID
 * @property string $INV_TYPE
 * @property string $created_at
 * @property string $updated_at
 * @property TOrderItem $tOrderItem
 * @property RProductInfo $rProductInfo
 * @property TProductVariance $tProductVariance
 */
class r_inventory_info extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'r_inventory_infos';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'INV_ID';

    /**
     * @var array
     */
    protected $fillable = ['PROD_ID', 'PRODV_ID', 'INV_QTY', 'ORDI_ID', 'INV_TYPE', 'created_at', 'updated_at'];

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
    public function rProductInfo()
    {
        return $this->belongsTo(r_product_info::class, 'PROD_ID', 'PROD_ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tProductVariance()
    {
        return $this->belongsTo(t_product_variance::class, 'PRODV_ID', 'PRODV_ID');
    }
}

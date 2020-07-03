<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $PRODV_ID
 * @property int $PROD_ID
 * @property int $PRODV_INIT_QTY
 * @property string $PRODV_NAME
 * @property string $PRODV_SKU
 * @property string $PRODV_DESC
 * @property float $PRODV_ADD_PRICE
 * @property string $PRODV_IMG
 * @property string $created_at
 * @property string $updated_at
 * @property RProductInfo $rProductInfo
 */
class t_product_variance extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_product_variances';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'PRODV_ID';

    /**
     * @var array
     */
    protected $fillable = ['PROD_ID', 'PRODV_NAME','PRODV_SKU', 'PRODV_DESC', 'PRODV_INIT_QTY','PRODV_ADD_PRICE', 'PRODV_IMG', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rProductInfo()
    {
        return $this->belongsTo(r_product_info::class, 'PROD_ID', 'PROD_ID');
    }
}

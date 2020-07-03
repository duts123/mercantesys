<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $PROD_ID
 * @property int $PRODT_ID
 * @property int $AFF_ID
 * @property string $PROD_DESC
 * @property string $PROD_NOTE
 * @property string $PROD_IMG
 * @property string $PROD_CODE
 * @property string $PROD_NAME
 * @property int $PROD_INIT_QTY
 * @property int $PROD_DISCOUNT
 * @property int $PROD_CRITICAL
 * @property float $PROD_BASE_PRICE
 * @property float $PROD_MY_PRICE
 * @property string $PROD_AVAILABILITY
 * @property boolean $PROD_IS_APPROVED
 * @property string $PROD_APPROVED_AT
 * @property boolean $PROD_DISPLAY_STATUS
 * @property string $created_at
 * @property string $updated_at
 * @property RAffiliateInfo $rAffiliateInfo
 * @property RProductType $rProductType
 */
class r_product_info extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'r_product_infos';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'PROD_ID';

    /**
     * @var array
     */
    protected $fillable = ['PRODT_ID', 'AFF_ID', 'PROD_DESC', 'PROD_NOTE', 'PROD_IMG', 'PROD_CODE', 'PROD_NAME', 'PROD_INIT_QTY', 'PROD_DISCOUNT', 'PROD_CRITICAL', 'PROD_BASE_PRICE', 'PROD_MY_PRICE', 'PROD_AVAILABILITY', 'PROD_IS_APPROVED', 'PROD_APPROVED_AT', 'PROD_DISPLAY_STATUS', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rAffiliateInfo()
    {
        return $this->belongsTo(r_affiliate_info::class, 'AFF_ID', 'AFF_ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rProductType()
    {
        return $this->belongsTo(r_product_type::class, 'PRODT_ID', 'PRODT_ID');
    }
}

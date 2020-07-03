<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ORD_ID
 * @property int $ORD_TO_SYMPIES_ID
 * @property int $ORD_FROM_SYMPIES_ID
 * @property string $ORD_SYMP_TRANS_CODE
 * @property string $ORD_TRANS_CODE
 * @property string $ORD_PAY_CODE
 * @property string $ORD_FROM_NAME
 * @property string $ORD_TO_NAME
 * @property string $ORD_FROM_EMAIL
 * @property string $ORD_TO_EMAIL
 * @property string $ORD_FROM_CONTACT
 * @property string $ORD_TO_CONTACT
 * @property string $ORD_TO_ADDRESS
 * @property string $ORD_FUNDING
 * @property float $ORD_DISCOUNT
 * @property float $ORD_STATUS
 * @property string $ORD_COMPLETE
 * @property string $ORD_CANCELLED
 * @property boolean $ORD_DISPLAY_STATUS
 * @property string $created_at
 * @property string $updated_at
 */
class t_order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_orders';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'ORD_ID';

    /**
     * @var array
     */
    protected $fillable = ['ORD_TO_SYMPIES_ID','ORD_FROM_SYMPIES_ID', 'ORD_SYMP_TRANS_CODE','ORD_PAY_CODE','ORD_STATUS', 'ORD_TRANS_CODE', 'ORD_FROM_NAME', 'ORD_TO_NAME', 'ORD_FROM_EMAIL', 'ORD_TO_EMAIL', 'ORD_FROM_CONTACT', 'ORD_TO_CONTACT', 'ORD_TO_ADDRESS', 'ORD_FUNDING', 'ORD_DISCOUNT', 'ORD_VOUCHER_CODE', 'ORD_COMPLETE', 'ORD_CANCELLED', 'ORD_DISPLAY_STATUS', 'created_at', 'updated_at'];

}

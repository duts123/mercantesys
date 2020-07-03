<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $AFF_ID
 * @property string $AFF_CODE
 * @property string $AFF_NAME
 * @property string $AFF_DESC
 * @property string $AFF_PAYMENT_INSTRUCTION
 * @property string $AFF_PAYMENT_MODE
 * @property boolean $AFF_DISPLAY_STATUS
 * @property string $created_at
 * @property string $updated_at
 */
class r_affiliate_info extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */

    protected $table = 'r_affiliate_infos';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'AFF_ID';

    /**
     * @var array
     */
    protected $fillable = ['AFF_CODE', 'AFF_NAME', 'AFF_DESC', 'AFF_PAYMENT_INSTRUCTION', 'AFF_PAYMENT_MODE', 'AFF_DISPLAY_STATUS', 'created_at', 'updated_at'];

}

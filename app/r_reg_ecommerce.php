<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $REG_ID
 * @property string $REG_ACCRE_CODE
 * @property string $REG_SERIAL_CODE
 * @property string $created_at
 * @property string $updated_at
 */
class r_reg_ecommerce extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'R_REG_ECOMMERCE';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'REG_ID';

    /**
     * @var array
     */
    protected $fillable = ['REG_ACCRE_CODE', 'REG_SERIAL_CODE', 'created_at', 'updated_at'];

}

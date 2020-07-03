<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $TAXP_ID
 * @property string $TAXP_NAME
 * @property string $TAXP_DESC
 * @property string $TAXP_RATE
 * @property boolean $TAXP_TYPE
 * @property boolean $TAXP_DISPLAY_STATUS
 * @property string $created_at
 * @property string $updated_at
 */
class r_tax_table_profile extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'r_tax_table_profiles';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'TAXP_ID';

    /**
     * @var array
     */
    protected $fillable = ['TAXP_ID','TAXP_NAME', 'TAXP_DESC', 'TAXP_RATE', 'TAXP_TYPE', 'TAXP_DISPLAY_STATUS', 'created_at', 'updated_at'];

}

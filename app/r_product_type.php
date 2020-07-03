<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $PRODT_ID
 * @property string $PRODT_TITLE
 * @property string $PRODT_DESC
 * @property int $PRODT_PARENT
 * @property boolean $PRODT_DISPLAY_STATUS
 * @property string $created_at
 * @property string $updated_at
 * @property RProductType $rProductType
 */
class r_product_type extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'r_product_types';
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'PRODT_ID';

    /**
     * @var array
     */
    protected $fillable = ['PRODT_TITLE', 'PRODT_DESC', 'PRODT_PARENT','PRODT_ICON', 'PRODT_DISPLAY_STATUS', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rProductType()
    {
        return $this->belongsTo(r_product_type::class, 'PRODT_PARENT', 'PRODT_ID');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $PAY_ID
 * @property int $INV_ID
 * @property string $PAY_RECIEVED_BY
 * @property float $PAY_AMOUNT_DUE
 * @property float $PAY_SUB_TOTAL
 * @property float $PAY_SALES_TAX
 * @property float $PAY_DELIVERY_CHARGE
 * @property string $PAY_CAPTURED_AT
 * @property string $created_at
 * @property string $updated_at
 * @property TInvoice $tInvoice
 */
class t_payment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_payments';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'PAY_ID';

    /**
     * @var array
     */
    protected $fillable = ['INV_ID', 'PAY_SUB_TOTAL','PAY_SALES_TAX','PAY_DELIVERY_CHARGE', 'PAY_RECIEVED_BY', 'PAY_AMOUNT_DUE', 'PAY_CAPTURED_AT', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tInvoice()
    {
        return $this->belongsTo(t_invoice::class, 'INV_ID', 'INV_ID');
    }
}

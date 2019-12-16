<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'payment_estimated_date',
        'payment_estimated_amount',
        'transaction_id',
        'payment_actual_date',
        'payment_actual_amount',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    /**
     * ---------------------------------
     *  Payment "BelongsTo" Transaction
     * ---------------------------------
     */
    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }
}

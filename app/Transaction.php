<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'transaction_detail',
        'user_id',
        'transaction_status',
        'transaction_sales_date',
        'transaction_sales_price',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    /**
     * ------------------------------
     *  Transaction "BelongsTo" User
     * ------------------------------
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * ------------------------------
     * Transaction "hasMany" Payment
     * ------------------------------
     */
    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaction_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'transaction_id', 'name', 'quantity', 'price', 'discount', 'ppn', 'updated_at', 'created_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at',
    ];

    public function transaction()
    {
        return $this->belongsTo('App\Models\TransactionDetail', 'transaction_id');
    }
}

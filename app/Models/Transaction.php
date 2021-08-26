<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';
    protected $items = null;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'channel_order_id', 'channel_name', 'order_date', 'total', 'updated_at', 'created_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at',
    ];

    public function details()
    {
        return $this->hasMany("App\Models\TransactionDetail");
    }
}

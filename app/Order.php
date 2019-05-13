<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['customer_id','total','shipped'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

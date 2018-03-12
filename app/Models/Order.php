<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['transaction', 'name', 'total', 'customer_id', 'status_id'];

    public function customer() {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
    public function status() {
        return $this->belongsTo('App\Models\Statu', 'status_id');
    }
}

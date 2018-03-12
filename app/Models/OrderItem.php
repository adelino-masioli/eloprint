<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $fillable = ['product', 'price', 'subtotal', 'amount', 'order_id', 'product_id'];

    public function order() {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
    public function products() {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'description', 'price', 'status_id'];

    public function status() {
        return $this->belongsTo('App\Models\Statu', 'status_id');
    }
}

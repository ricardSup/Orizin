<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart_item extends Model
{
    public function Cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}

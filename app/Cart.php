<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Cart_items()
    {
        return $this->hasMany(Cart_item::class);
    }
}

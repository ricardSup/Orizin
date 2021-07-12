<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}

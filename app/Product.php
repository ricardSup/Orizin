<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'products';

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function Rates(){
        return $this->hasMany(Rate::class);
    }

    public function rate_calc($id){
        $rate = DB::select('select ceil(sum(r.rate)/count(p.id)) as rate from rates r
            join products p on(r.product_id = p.id) 
            where p.id = :id', ['id' => $id]);
        foreach ($rate as $rt){
            foreach ($rt as $r){
                $rate = $r;
            }
        }
        return $rate;
    }
}

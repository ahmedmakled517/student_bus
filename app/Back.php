<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Back extends Model
{
    protected $fillable = [
        'bill_number','item_id','unite_id','qtn','price','tottal',"store_id"
    ];
}

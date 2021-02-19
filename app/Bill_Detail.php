<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill_Detail extends Model
{
    protected $fillable = [
        'bill_id','item_id','unite_id','qtn','price','tottal',"store_id"
    ];
}

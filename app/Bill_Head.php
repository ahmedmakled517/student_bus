<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill_Head extends Model
{
    protected $fillable = [
        'client_id','date','tottal','paid','roamin','safe_id',"bill_number","discount"
    ];
}

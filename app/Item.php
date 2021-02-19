<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name','main_unite','m_buy_price','m_sell_price','sup_unite','s_buy_price','s_sell_price','sup_count_main','stamp'
    ];
}

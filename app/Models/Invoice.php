<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'menu_id',
        'submenu_id',
        'price',
        'grandtotal',
        'state_id',
        'city_id',
    ];
}

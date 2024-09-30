<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
       'product_id', 'name', 'price','quantity','city', 'category_id', 'description',
        'subcategory_id', 'menu_id', 'submenu_id', 'created_by'
    ];

}

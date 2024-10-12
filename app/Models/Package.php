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

<<<<<<< HEAD
=======
    public function productdata()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
>>>>>>> 0c852a3875ed29744674d07e140907a1bd8825fa
}

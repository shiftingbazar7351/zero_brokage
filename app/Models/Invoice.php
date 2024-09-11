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
        'hsn',
        'product_id',
        'quantity',
        'total_ammount',
        'gst',
        'grand_total',
        'state',
        'city',
    ];


    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }
    public function cityName()
    {
        return $this->belongsTo(City::class, 'city', 'id');
    }

    public function stateName()
    {
        return $this->belongsTo(State::class, 'state', 'id');
    }

    public function submenu()
    {
        return $this->belongsTo(Submenu::class, 'submenu_id', 'id');
    }
}

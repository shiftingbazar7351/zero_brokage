<?php

namespace App\Models;

use App\Models\Category;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SubMenu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'subcategory_id', 'image', 'city_id', 'menu_id'];
    protected $casts = [
        'images' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }
    public function cityName()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function vendors()
    {
        return $this->hasMany(Vendor::class, 'submenu_id', 'id');
    }
    public function getImageUrlAttribute()
    {
        // Construct the full URL for the icon
        return url(Storage::url('submenu/' . $this->image));
    }

}

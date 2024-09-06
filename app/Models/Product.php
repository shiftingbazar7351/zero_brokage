<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'gst', 'hsn', 'state', 'city', 'category_id', 
        'subcategory_id', 'menu_id', 'submenu_id', 'created_by'
    ];

    // Many-to-Many Relationship with Category
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    // Many-to-Many Relationship with SubCategory
    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'product_subcategory', 'product_id', 'subcategory_id');
    }

    // Many-to-Many Relationship with Menu
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_product', 'product_id', 'menu_id');
    }

    // Many-to-Many Relationship with City
    public function cities()
    {
        return $this->belongsToMany(City::class, 'city_product', 'product_id', 'city_id');
    }

    // Many-to-Many Relationship with State (if applicable)
    public function states()
    {
        return $this->belongsToMany(State::class, 'state_product', 'product_id', 'state_id');
    }

    // Submenu relationship if you have it
    public function subMenus()
    {
        return $this->belongsToMany(SubMenu::class, 'submenu_product', 'product_id', 'submenu_id');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use App\Models\Menu;
use App\Models\City;
use App\Models\Category;
use App\Models\State;
use App\Models\SubMenu;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'gst', 'hsn', 'state', 'city', 'category_id', 'description',
        'subcategory_id', 'menu_id', 'submenu_id', 'created_by'
    ];

    // Many-to-Many Relationship with Category
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category', 'id');
    }

    // Many-to-Many Relationship with SubCategory
    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'subcategory_id', 'id');
    }

    // Many-to-Many Relationship with Menu
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_id', 'id');
    }

    // Many-to-Many Relationship with City
    public function cities()
    {
        return $this->belongsToMany(City::class, 'city', 'id');
    }

    // Many-to-Many Relationship with State (if applicable)
    public function states()
    {
        return $this->belongsToMany(State::class, 'state',  'id');
    }

    // Submenu relationship if you have it
    public function subMenus()
    {
        return $this->belongsToMany(SubMenu::class, 'submenu_id', 'id');
    }
}


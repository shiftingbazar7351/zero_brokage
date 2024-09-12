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

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories', 'id', 'category_id');
    }
    
    public function subcategories()
    {
        return $this->belongsToMany(SubCategory::class, 'subcategories', 'id', 'subcategory_id');
    }
    

    public function menu()
    {
        return $this->belongsToMany(Menu::class,'menus','id', 'menu_id');
    }

    public function submenu()
    {
        return $this->belongsToMany(Submenu::class,'submenus','id' , 'submenu_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(user::class,'created_by','id');
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
}


<?php

namespace App\Models;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;
    protected $fillable = [
        'subcategory_id',
        'move_from_origin',
        'move_from_destination',
        'date_time',
        'name',
        'category',
        'menu_id',
        'submenu_id',
        'type',
        'created_by',
        'email',
        'mobile_number',
        'otp',
        'otp_verified_at',
        'country_code'
    ];

    public function categoryName()
    {
        return $this->belongsTo(Category::class,'category','id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'subcategory_id','id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class,'menu_id','id');
    }

    public function submenu()
    {
        return $this->belongsTo(Submenu::class,'submenu_id','id');
    }
}

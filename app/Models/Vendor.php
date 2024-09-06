<?php

namespace App\Models;
use App\Models\SubCategory;
use App\Models\Menu;
use App\Models\City;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'manager_id',
        'employee_id',
        'sub_category',
        'company_name',
        'legal_company_name',
        'city',
        'pincode',
        'address',
        'otp',
        'experience',
        'email',
        'whatsapp',
        'number',
        'website',
        'verified',
        'submenu_id',
        'logo',
        'owner_name',
        'vendor_image',
        'gst_image',
        'gst_number',
        'pan_image',
        'pan_number',
        'adhar_image',
        'adhar_numbere',
        'visiting_card',
        'client_sign',
        'video',
        'location_lat',
        'location_lang',
        'vendor_name',
        'menu_id',
        'review_count',
        'status',
        'created_by',
        'price',
        'description',
    ];


    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category', 'id');
    }
    public function cityName()
    {
        return $this->belongsTo(City::class, 'city', 'id');
    }
    public function verified()
    {
        return $this->belongsTo(Verified::class, 'verified','id');
    }

    public function submenu()
{
    return $this->belongsTo(Submenu::class, 'submenu_id', 'id');
}

}

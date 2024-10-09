<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndiaServiceDescription extends Model
{
    use HasFactory;

    protected $fillable=[
        'description',
        'created_by',
        'category_id',
        'sub_category_id',
        'menu_id',
        'submenu_id',
        'status',
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }
    // public function city()
    // {
    //     return $this->belongsTo(City::class,'city','id');
    // }
 }

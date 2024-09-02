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
        'status',
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }
 }

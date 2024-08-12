<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'subcategory_id',
        'description',
        'summery',
        'created_by',
        'status',
    ];
    public function subCategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id','id');
    }
}

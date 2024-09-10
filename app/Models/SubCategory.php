<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'icon',
        'background_image',
        'status',
        'created_by'
    ];

    public function categoryName()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }


    public function getIconUrlAttribute()
    {
        // Construct the full URL for the icon
        return url(Storage::url('icon/' . $this->icon));
    }

    public function getBackgroundImageUrlAttribute()
    {
        // Construct the full URL for the background image
        return url(Storage::url('background_image/' . $this->background_image));
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug', 'subcategory_id', 'image','status'];

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'subcategory_id','id');
    }
    public function getIconUrlAttribute()
    {
        // Construct the full URL for the icon
        return url(Storage::url('menu/' . $this->image));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'name','profession', 'status','created_by','created_by'];

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
}

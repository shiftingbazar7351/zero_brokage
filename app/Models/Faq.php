<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'answer',
        'status',
        'created_by'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
}

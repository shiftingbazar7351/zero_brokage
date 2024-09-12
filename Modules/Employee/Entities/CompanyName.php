<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyName extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'created_by'
    ];
    

}

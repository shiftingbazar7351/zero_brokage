<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HeadOffice extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'number',
        'address',
        'status',
    ];

}

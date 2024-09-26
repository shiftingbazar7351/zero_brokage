<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HrName extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',
        'name',
        'status',
    ];


}

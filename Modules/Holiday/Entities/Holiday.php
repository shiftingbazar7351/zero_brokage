<?php

namespace Modules\Holiday\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'festival_name',
        'start_date',
        'end_date',
        'festival_types',
        'Number_of_days',
        'status',
        'created_by'
    ];


}

<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'hoffice_id',
        'company_id',
        'name',
        'image',
        'address',
        'status',
        'created_by'
    ];
}

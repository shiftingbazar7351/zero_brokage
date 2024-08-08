<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;
    protected $fillable = ['subcategory_id','move_from_origin','move_from_destination','date_time',
    'name','email','mobile_number','otp'
    ];
}

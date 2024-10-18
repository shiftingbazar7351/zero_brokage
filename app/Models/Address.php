<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
        'enquiries_id',
        'type',
        'house_number',    // Newly added column
        'building_name',   // Newly added column
        'road_name',       // Newly added column
        'area_colony',     // Newly added column
        'address1',
        'address2',
        'landmark',
        'district',
        'city',
        'state',
        'country',
        'pincode',
        'latitude',
        'longitude',
        'phone_number',
        'address_note',
        'created_by',
        'updated_by',
    ];

    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }
}

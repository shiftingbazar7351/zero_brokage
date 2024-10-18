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
        'address1',
        'address2',
    ];

    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }
}

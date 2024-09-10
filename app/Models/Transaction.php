<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'transaction_id',
        'price',
        'status',
        'created_by',
        'utr',
        'screenshot',
        'reason',
        'is_used',
        'payment_time',
        'payment_method',
        'payment_status',
        'created_by'

    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
}

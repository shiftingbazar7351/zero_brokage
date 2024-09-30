<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorTask extends Model
{
    use HasFactory;

    protected $table = 'vendor_tasks';
    protected $fillable = [
        'is_task',
        'comments',
        'note',
        'next_followup_date_time',
        'tags',
        'call_record',
        'call_history_img',
        'client_type',
        'task_status',
        'employee_id',
        'vendor_id',
        'status',
        'created_by'
    ];

    public function employeeId()
    {
        return $this->belongsTo(User::class,'employee_id','id');
    }

    public function vendorDetail()
    {
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }
    public function userName()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
}

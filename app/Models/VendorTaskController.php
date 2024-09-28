<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorTaskController extends Model
{
    use HasFactory;
    protected $fillable = [
    'is_task',
    'comments',
    'note',
    'next_followup_date_time_am_pm',
    'tags',
    'call_record',
    'call_history_img',
    'client_type',
    'task_status',
    ];
}

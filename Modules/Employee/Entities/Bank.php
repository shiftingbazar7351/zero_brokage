<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_id',
        'account_number',
        'bank_name',
        'branch',
        'permanent_acc_number',
        'employee_type',
        'band',
        'uan',
        'created_by',
    ];

    public function usern(){
        return $this->belongsTo(User::class,'emp_id','id');
    }


}

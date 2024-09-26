<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Salary extends Model
{
    use HasFactory, SoftDeletes;

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'basic_salary',
        'employee_id',
        'house_rent_allowance',
        'conveyance_allowance',
        'other_allowance',
        'personal_pay',
        'food_allowance',
        'medical_allowance',
        'telephone_allowance',
        'provident_fund',
        'voluntary_provident_fund',
        'professional_tax',
        'personal_loan_principal',
        'personal_loan_interest',
        'food_relief',
        'status',
        'created_by'
    ];

    public function userdata(){
        return $this->belongsTo(User::class,'employee_id','id');
    }


}


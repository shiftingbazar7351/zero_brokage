<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employees extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'employee_code',
        'fname',
        'lname',
        'gender',
        'dob',
        'email',
        'user_type',
        'country',
        'number',
        'joining_date',
        'company',
        'no_of_experience',
        'department',
        'designation',
        'office_shift',
        'reporting_head',
        'hr_head',
        'hr_executive',
        'official_mobile',
        'official_email',
        'experience_type',
        'high_school_certificate',
        'intermediate_certificate',
        'graduation_certificate',
        'experience_letter',
        'relieving_letter',
        'offer_letter',
        'salary_slip',
        'bank_statement',
        'current_address',
        'permanent_address',
        'character_certificate',
        'medical_certificate',
        'previous_ref_name',
        'previous_ref_email',
        'previous_ref_number',
        'previous_ref_designation',
        'status',
        'created_by'
    ];

}

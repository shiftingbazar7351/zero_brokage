<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Employee\Entities\Companie;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'employee_code',
        'fname',
        'lname',
        'gender',
        'dob',
        'role',
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function roles()
    // {
    //     return $this->belongsTo(Role::class, '');
    // }

    public function companyName()
    {
        return $this->belongsTo(Companie::class,'company','id');
    }
}

@extends('backend.layouts.main')
@section('styles')
<style>
    .image-container {
        position: relative;
        display: inline-block;
    }

    .small-image {
        width: 100px;
        /* Adjust as needed */
        height: auto;
        transition: transform 0.3s ease;
        /* Smooth transition effect */
    }

    .image-container:hover .small-image {
        width: 200px;
        /* Adjust as needed for medium size */
    }
</style>
@endsection
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <h1 class="text-center">Employee Details</h1>
                    <div class="col-md-6">
                        <table class="table table-sm table-bordered table-striped">

                            <tbody>
                                <tr>
                                    <th scope="row">Name </th>
                                    <td class="text-wrap"> {{ $employee->name ?? '' }} </td>

                                </tr>
                                <tr>
                                    <th scope="row">Number </th>
                                    <td class="text-wrap"> {{ $employee->number ?? ''}} </td>
                                </tr>
                                <tr>
                                    <th scope="row">Current Adress</th>
                                    {{-- <td class="text-wrap">{{ $vendor->address  }}</td> --}}
                                    <td class="text-wrap">{{ $employee->current_address ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Permanent Adress</th>
                                    {{-- <td class="text-wrap">{{ $vendor->address  }}</td> --}}
                                    <td class="text-wrap">{{ $employee->permanent_address ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td class="text-wrap">{{ $employee->email ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Gender</th>
                                    <td class="text-wrap">{{ $employee->gender ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Birthday</th>
                                    <td class="text-wrap">{{ $employee->dob ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Office shift</th>
                                    <td class="text-wrap">{{ $employee->office_shift ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Experience</th>
                                    <td class="text-wrap">{{ $employee->no_of_experience ?? '0' }}</td>
                                </tr>

                                <tr>
                                    <th scope="row"> High School Certificate</th>
                                    <td style="text-align: center">
                                        <img src="{{ asset('storage/employee/high_school_certificate/' . $employee->high_school_certificate ?? '') }}" alt="" style="width: 120px; height: 110px;">
                                        <a href="{{ asset('storage/employee/high_school_certificate/' . $employee->high_school_certificate ?? '' ) }}" target="_blank" style="display: block">High School Certificate</a>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row"> Experience latter</th>
                                    <td style="text-align: center">
                                        <img src="{{ asset('storage/employee/experience_letter/' . $employee->experience_letter ?? '') }}" alt="" style="width: 120px; height: 110px;">
                                        <a href="{{ asset('storage/employee/experience_letter/' . $employee->experience_letter ?? '') }}" target="_blank" style="display: block"> Experience latter</a>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row"> Relieving latter</th>
                                    <td style="text-align: center">
                                        <img src="{{ asset('storage/employee/relieving_letter/' . $employee->relieving_letter ?? '') }}" alt="" style="width: 120px; height: 110px;">
                                        <a href="{{ asset('storage/employee/relieving_letter/' . $employee->relieving_letter ?? '') }}" target="_blank" style="display: block"> Relieving latter</a>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row"> Character Certificate</th>
                                    <td style="text-align: center">
                                        <img src="{{ asset('storage/employee/character_certificate/' . $employee->character_certificate ?? '') }}" alt="" style="width: 120px; height: 110px;">
                                        <a href="{{ asset('storage/employee/character_certificate/' . $employee->character_certificate ?? '') }}" target="_blank" style="display: block"> Character Certificate </a>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row"> Medical Certificate</th>
                                    <td style="text-align: center">
                                        <img src="{{ asset('storage/employee/medical_certificate/' . $employee->medical_certificate ?? '') }}" alt="" style="width: 120px; height: 110px;">
                                        <a href="{{ asset('storage/employee/medical_certificate/' . $employee->medical_certificate ?? '') }}" target="_blank" style="display: block"> Medical Certificate </a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm table-bordered table-striped">

                            <tbody>
                                <tr>
                                    <th scope="row">H.R. Head </th>
                                    <td class="text-wrap"> {{ $employee->hrName->name ?? ''}} </td>

                                </tr>
                                <tr>
                                    <th scope="row">H.R. Executive </th>
                                    <td class="text-wrap"> {{ $employee->hrExecutive->name ?? ''}} </td>
                                </tr>
                                <tr>
                                    <th scope="row">Official Number</th>
                                    <td class="text-wrap">{{ $employee->official_mobile ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Official Email</th>
                                    <td class="text-wrap">{{ $employee->official_email ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Experience Type</th>
                                    <td class="text-wrap">{{ $employee->experience_type ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Designation</th>
                                    <td class="text-wrap">{{ $employee->designation ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Department</th>
                                    <td class="text-wrap">{{ $employee->department ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Date of Joining</th>
                                    <td class="text-wrap">{{ $employee->joining_date ?? '' }}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Role</th>
                                    <td class="text-wrap">{{ $employee->user_type ?? '' }}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Intermediate Certificate</th>
                                    <td style="text-align: center">
                                        <img src="{{ asset('storage/employee/intermediate_certificate/' . $employee->intermediate_certificate ?? '') }}" alt="" style="width: 120px; height: 110px;">
                                        <a href="{{ asset('storage/employee/intermediate_certificate/' . $employee->intermediate_certificate ?? '') }}" target="_blank" style="display: block">Intermediate Certificate</a>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">Graduation Certificate</th>
                                    <td style="text-align: center">
                                        <img src="{{ asset('storage/employee/graduation_certificate/' . $employee->graduation_certificate ?? '') }}" alt="" style="width: 120px; height: 110px;">
                                        <a href="{{ asset('storage/employee/graduation_certificate/' . $employee->graduation_certificate ?? '') }}" target="_blank" style="display: block">Graduation Certificate</a>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row"> Offer latter</th>
                                    <td style="text-align: center">
                                        <img src="{{ asset('storage/employee/offer_letter/' . $employee->offer_letter ?? '') }}" alt="" style="width: 120px; height: 110px;">
                                        <a href="{{ asset('storage/employee/offer_letter/' . $employee->offer_letter ?? '') }}" target="_blank" style="display: block"> Offer latter</a>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row"> Salary slip</th>
                                    <td style="text-align: center">
                                        <img src="{{ asset('storage/employee/salary_slip/' . $employee->salary_slip ?? '') }}" alt="" style="width: 120px; height: 110px;">
                                        <a href="{{ asset('storage/employee/salary_slip/' . $employee->salary_slip ?? '') }}" target="_blank" style="display: block"> Salary slip </a>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row"> Bank Statement</th>
                                    <td style="text-align: center">
                                        <img src="{{ asset('storage/employee/bank_statement/' . $employee->bank_statement ?? '') }}" alt="" style="width: 120px; height: 110px;">
                                        <a href="{{ asset('storage/employee/bank_statement/' . $employee->bank_statement ?? '') }}" target="_blank" style="display: block"> Bank Statement</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@extends('backend.layouts.main')

@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="row">
                <div class="container border p-2 shadow-sm my-3">
                    <h4> Create Employee</h4>
                </div>
                <div>
                    <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data"
                        data-parsley-validate="true">
                        @csrf

                        <div class="row">
                            <!-- First Name -->
                            <div class="mb-3 col-md-6">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname"
                                    value="{{ old('fname') }}" placeholder="Enter first name" required>
                            </div>

                            <!-- Last Name -->
                            <div class="mb-3 col-md-6">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname"
                                    value="{{ old('lname') }}" placeholder="Enter last name" required>
                            </div>

                            <!-- Gender -->
                            <div class="mb-3 col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <!-- Date of Birth -->
                            <div class="mb-3 col-md-6">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob"
                                    value="{{ old('dob') }}" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="Enter email" required>
                            </div>

                            <!-- Role -->
                            <div class="mb-3 col-md-6">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" class="form-control" id="role" name="role"
                                    value="{{ old('role') }}" placeholder="Enter role" required>
                            </div>

                            <!-- Password -->
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter password">
                            </div>

                            <!-- Country -->
                            <div class="mb-3 col-md-6">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control" id="country" name="country"
                                    value="{{ old('country') }}" placeholder="Enter country">
                            </div>

                            <!-- Phone Number -->
                            <div class="mb-3 col-md-6">
                                <label for="number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="number" name="number"
                                    value="{{ old('number') }}" placeholder="Enter phone number">
                            </div>

                            <!-- Joining Date -->
                            <div class="mb-3 col-md-6">
                                <label for="joining_date" class="form-label">Joining Date</label>
                                <input type="date" class="form-control" id="joining_date" name="joining_date"
                                    value="{{ old('joining_date') }}">
                            </div>

                            <!-- Company -->
                            <div class="mb-3 col-md-6">
                                <label for="company" class="form-label">Company</label>
                                <input type="text" class="form-control" id="company" name="company"
                                    value="{{ old('company') }}" placeholder="Enter company name">
                            </div>

                            <!-- No of Experience -->
                            <div class="mb-3 col-md-6">
                                <label for="no_of_experience" class="form-label">Years of Experience</label>
                                <input type="text" class="form-control" id="no_of_experience" name="no_of_experience"
                                    value="{{ old('no_of_experience') }}" placeholder="Enter years of experience">
                            </div>

                            <!-- Department -->
                            <div class="mb-3 col-md-6">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" class="form-control" id="department" name="department"
                                    value="{{ old('department') }}" placeholder="Enter department">
                            </div>

                            <!-- Designation -->
                            <div class="mb-3 col-md-6">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" class="form-control" id="designation" name="designation"
                                    value="{{ old('designation') }}" placeholder="Enter designation">
                            </div>

                            <!-- Office Shift -->
                            <div class="mb-3 col-md-6">
                                <label for="office_shift" class="form-label">Office Shift</label>
                                <input type="text" class="form-control" id="office_shift" name="office_shift"
                                    value="{{ old('office_shift') }}" placeholder="Enter office shift">
                            </div>

                            <!-- Reporting Head -->
                            <div class="mb-3 col-md-6">
                                <label for="reporting_head" class="form-label">Reporting Head</label>
                                <input type="text" class="form-control" id="reporting_head" name="reporting_head"
                                    value="{{ old('reporting_head') }}" placeholder="Enter reporting head">
                            </div>

                            <!-- HR Head -->
                            <div class="mb-3 col-md-6">
                                <label for="hr_head" class="form-label">HR Head</label>
                                <input type="text" class="form-control" id="hr_head" name="hr_head"
                                    value="{{ old('hr_head') }}" placeholder="Enter HR head">
                            </div>

                            <!-- HR Executive -->
                            <div class="mb-3 col-md-6">
                                <label for="hr_executive" class="form-label">HR Executive</label>
                                <input type="text" class="form-control" id="hr_executive" name="hr_executive"
                                    value="{{ old('hr_executive') }}" placeholder="Enter HR executive">
                            </div>

                            <!-- Official Mobile -->
                            <div class="mb-3 col-md-6">
                                <label for="official_mobile" class="form-label">Official Mobile</label>
                                <input type="text" class="form-control" id="official_mobile" name="official_mobile"
                                    value="{{ old('official_mobile') }}" placeholder="Enter official mobile">
                            </div>

                            <!-- Official Email -->
                            <div class="mb-3 col-md-6">
                                <label for="official_email" class="form-label">Official Email</label>
                                <input type="email" class="form-control" id="official_email" name="official_email"
                                    value="{{ old('official_email') }}" placeholder="Enter official email">
                            </div>

                            <!-- Certificates and Documents -->
                            <div class="mb-3 col-md-6">
                                <label for="high_school_certificate" class="form-label">High School Certificate</label>
                                <input type="file" class="form-control" id="high_school_certificate"
                                    name="high_school_certificate">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="intermediate_certificate" class="form-label">Intermediate Certificate</label>
                                <input type="file" class="form-control" id="intermediate_certificate"
                                    name="intermediate_certificate">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="graduation_certificate" class="form-label">Graduation Certificate</label>
                                <input type="file" class="form-control" id="graduation_certificate"
                                    name="graduation_certificate">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="experience_letter" class="form-label">Experience Letter</label>
                                <input type="file" class="form-control" id="experience_letter"
                                    name="experience_letter">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="relieving_letter" class="form-label">Relieving Letter</label>
                                <input type="file" class="form-control" id="relieving_letter"
                                    name="relieving_letter">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="offer_letter" class="form-label">Offer Letter</label>
                                <input type="file" class="form-control" id="offer_letter" name="offer_letter">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="salary_slip" class="form-label">Salary Slip</label>
                                <input type="file" class="form-control" id="salary_slip" name="salary_slip">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="bank_statement" class="form-label">Bank Statement</label>
                                <input type="file" class="form-control" id="bank_statement" name="bank_statement">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
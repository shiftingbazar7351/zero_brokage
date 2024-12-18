@extends('backend.layouts.main')

@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="row">
                <div class="container border p-2 shadow-sm my-3">
                    <h4> Edit Employee</h4>
                </div>
                <div>
                    <form action="{{ route('employee.update', $employee->id ?? '') }}" method="POST"
                        enctype="multipart/form-data" data-parsley-validate="true">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- First Name -->
                            <div class="mb-3 col-md-3">
                                <label for="fname" class="form-label">First Name</label><b style="color: red;">*</b>
                                <input type="text" class="form-control" id="fname" name="name"
                                    value="{{ old('name', $employee->name ?? '') }}" placeholder="Enter first name"
                                    required>
                                @error('fname')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div class="mb-3 col-md-3">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname"
                                    value="{{ old('lname', $employee->lname ?? '') }}" placeholder="Enter last name"
                                    required>
                                @error('lname')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div class="mb-3 col-md-3">
                                <label for="gender" class="form-label">Gender</label><b style="color: red;">*</b>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date of Birth -->
                            <div class="mb-3 col-md-3">
                                <label for="dob" class="form-label">Date of Birth</label><b style="color: red;">*</b>
                                <input type="date" class="form-control" id="dob" name="dob"
                                    value="{{ old('dob', $employee->dob ?? '') }}" required>
                                @error('dob')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3 col-md-3">
                                <label for="email" class="form-label">Email</label><b style="color: red;">*</b>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $employee->email ?? '') }}" placeholder="Enter email" required>
                                @error('email')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- Role --}}
                            {{-- <div class="mb-3 col-md-3">
                                <label for="role" class="form-label">Role</label><b
                                    style="color: red;">*</b>
                                <select class="form-control" id="role" name="user_type" required>
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->user_type }}</option>
                                    @endforeach
                                </select>
                                @error('user_type')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            <!-- Phone Number -->
                            <div class="mb-3 col-md-3">
                                <label for="number" class="form-label">Phone Number</label><b style="color: red;">*</b>
                                <input type="text" class="form-control" id="number" name="number"
                                    value="{{ old('number', $employee->number ?? '') }}" placeholder="Enter phone number"
                                    required>
                                @error('number')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Joining Date -->
                            <div class="mb-3 col-md-3">
                                <label for="joining_date" class="form-label">Joining Date</label><b
                                    style="color: red;">*</b>
                                <input type="date" class="form-control" id="joining_date" name="joining_date"
                                    value="{{ old('joining_date', $employee->joining_date ?? '') }}" required>
                                @error('joining_date')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Company -->
                            <div class="mb-3 col-md-3">
                                <label for="company" class="form-label">Company</label><b style="color: red;">*</b>
                                <input type="text" class="form-control" id="company" name="company"
                                    value="{{ old('company', $employee->company ?? '') }}"
                                    placeholder="Enter company name" required>
                                @error('company')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- No of Experience -->
                            <div class="mb-3 col-md-3">
                                <label for="no_of_experience" class="form-label">Years of Experience</label><b
                                    style="color: red;">*</b>
                                <input type="text" class="form-control" id="no_of_experience" name="no_of_experience"
                                    value="{{ old('no_of_experience', $employee->no_of_experience ?? '') }}"
                                    placeholder="Enter years of experience" required>
                                @error('no_of_experience')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Department -->
                            <div class="mb-3 col-md-3">
                                <label for="department" class="form-label">Department</label><b style="color: red;">*</b>
                                <input type="text" class="form-control" id="department" name="department"
                                    value="{{ old('department', $employee->department ?? '') }}"
                                    placeholder="Enter department" required>
                                @error('department')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Designation -->
                            <div class="mb-3 col-md-3">
                                <label for="designation" class="form-label">Designation</label><b
                                    style="color: red;">*</b>
                                <input type="text" class="form-control" id="designation" name="designation"
                                    value="{{ old('designation', $employee->designation ?? '') }}"
                                    placeholder="Enter designation" required>
                                @error('designation')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Office Shift -->

                            <div class="mb-3 col-md-3">
                                <label for="office_shift" class="form-label">Office Shift</label><b
                                    style="color: red;">*</b>
                                <select class="form-control" id="office_shift" name="office_shift" required>
                                    <option value="9:30am-6:30pm" {{ old('office_shift') == 'hr1' ? 'selected' : '' }}>9:30am-6:30pm
                                    </option>
                                </select>
                                @error('office_shift')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Reporting Head -->
                            <div class="mb-3 col-md-3">
                                <label for="reporting_head" class="form-label">Reporting Head</label><b style="color: red;">*</b>
                                <select name="reporting_head" class="form-select">
                                    <option value="" selected disabled>Select Employee</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->name }}"
                                            {{ old('reporting_head', $employee->name ?? '') == $employee->name ? 'selected' : '' }}>
                                            {{ $employee->name ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('reporting_head')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- HR Head -->
                            <div class="mb-3 col-md-3">
                                <label for="hr_head" class="form-label">HR Head</label><b style="color: red;">*</b>
                                <select class="form-control" id="hr_head" name="hr_head">
                                    <option value="" selected disabled>Select HR Head</option>
                                    @foreach ($hr_names as $hr_name)
                                        <option value="{{ $hr_name->id }}">{{ $hr_name->name ?? '' }}</option>
                                    @endforeach
                                </select>
                                @error('hr_head')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- HR Executive -->
                            <div class="mb-3 col-md-3">
                                <label for="hr_executive" class="form-label">HR Executive</label><b
                                    style="color: red;">*</b>
                                <select class="form-control" id="hr_executive" name="hr_executive">
                                    <option value="" selected disabled>Select HR Executive</option>
                                    @foreach ($hr_exe as $hr_name)
                                    <option value="{{ $hr_name->id }}">{{ $hr_name->name ?? '' }}</option>
                                @endforeach
                                </select>
                                @error('hr_executive')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Official Mobile -->
                            <div class="mb-3 col-md-3">
                                <label for="official_mobile" class="form-label">Official Mobile</label><b
                                    style="color: red;">*</b>
                                <input type="text" class="form-control" id="official_mobile" name="official_mobile"
                                    value="{{ old('official_mobile', $employee->official_mobile ?? '') }}"
                                    placeholder="Enter official mobile" required>
                                @error('official_mobile')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Official Email -->
                            <div class="mb-3 col-md-3">
                                <label for="official_email" class="form-label">Official Email</label><b
                                    style="color: red;">*</b>
                                <input type="email" class="form-control" id="official_email" name="official_email"
                                    value="{{ old('official_email', $employee->official_email ?? '') }}"
                                    placeholder="Enter official email" required>
                                @error('official_email')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="current_address" class="form-label text-dark">Current Address<b
                                        style="color: red;">*</b></label>
                                <textarea name="current_address" class="form-control" placeholder="Enter current address" id="current_address"
                                    rows="3" required>{{ $employee->current_address ?? '' }}</textarea>
                                @error('current_address')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="permanent_address" class="form-label text-dark">Permanent Address<b
                                        style="color: red;">*</b></label>
                                <textarea name="permanent_address" class="form-control" placeholder="Enter permanent address" id="permanent_address"
                                    rows="3" required>{{ $employee->permanent_address ?? '' }}</textarea>
                                @error('permanent_address')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Certificates and Documents -->
                            <div class="mb-3 col-md-3">
                                <label for="high_school_certificate" class="form-label">High School Certificate</label><b
                                    style="color: red;">*</b>
                                <input type="file" class="form-control" id="high_school_certificate"
                                    name="high_school_certificate">
                                @error('high_school_certificate')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror

                                @if ($employee && $employee->high_school_certificate)
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/employee/high_school_certificate/' . $employee->high_school_certificate) }}"
                                            target="_blank">
                                            View High School Certificate
                                        </a>
                                        <br>
                                        <img src="{{ asset('storage/employee/high_school_certificate/' . $employee->high_school_certificate) }}"
                                            width="100" alt="High School Certificate">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3 col-md-3">
                                <label for="intermediate_certificate" class="form-label">Intermediate
                                    Certificate</label><b style="color: red;">*</b>
                                <input type="file" class="form-control" id="intermediate_certificate"
                                    name="intermediate_certificate">
                                @error('intermediate_certificate')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror

                                @if ($employee && $employee->intermediate_certificate)
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/employee/intermediate_certificate/' . $employee->intermediate_certificate) }}"
                                            target="_blank">
                                            View Intermediate Certificate
                                        </a>
                                        <br>
                                        <img src="{{ asset('storage/employee/intermediate_certificate/' . $employee->intermediate_certificate) }}"
                                            width="100" alt="Intermediate Certificate">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3 col-md-3">
                                <label for="graduation_certificate" class="form-label">Graduation Certificate</label><b
                                    style="color: red;">*</b>
                                <input type="file" class="form-control" id="graduation_certificate"
                                    name="graduation_certificate">
                                @error('graduation_certificate')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror

                                @if ($employee && $employee->graduation_certificate)
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/employee/graduation_certificate/' . $employee->graduation_certificate) }}"
                                            target="_blank">
                                            View Graduation Certificate
                                        </a>
                                        <br>
                                        <img src="{{ asset('storage/employee/graduation_certificate/' . $employee->graduation_certificate) }}"
                                            width="100" alt="Graduation Certificate">
                                    </div>
                                @endif
                            </div>

                            {{-- checkbox of experience --}}
                            <div class="mb-3 col-md-3">
                                <label for="experience" class="form-label">Experience</label><b
                                    style="color: red;">*</b><br>
                                <input type="radio" id="fresher" name="experience_type" value="fresher" checked>
                                Fresher
                                <input type="radio" id="experienced" name="experience_type" value="experienced">
                                Experienced
                            </div>

                            <!-- Experience-Related Fields -->
                            <div class="row" id="experience-fields" style="display: none;">
                                <div class="mb-3 col-md-3">
                                    <label for="experience_letter" class="form-label">Experience Letter</label><b
                                        style="color: red;">*</b>
                                    <input type="file" class="form-control" id="experience_letter"
                                        name="experience_letter">
                                    @error('experience_letter')
                                        <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="relieving_letter" class="form-label">Relieving Letter</label>
                                    <input type="file" class="form-control" id="relieving_letter"
                                        name="relieving_letter">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="offer_letter" class="form-label">Offer Letter</label>
                                    <input type="file" class="form-control" id="offer_letter" name="offer_letter">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="salary_slip" class="form-label">Salary Slip</label>
                                    <input type="file" class="form-control" id="salary_slip" name="salary_slip">
                                </div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="bank_statement" class="form-label">Bank Statement</label>
                                <input type="file" class="form-control" id="bank_statement" name="bank_statement">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fresherRadio = document.getElementById('fresher');
            const experiencedRadio = document.getElementById('experienced');
            const experienceFields = document.getElementById('experience-fields');

            // Function to toggle experience-related fields
            function toggleExperienceFields() {
                if (experiencedRadio.checked) {
                    experienceFields.style.display = 'flex';
                } else {
                    experienceFields.style.display = 'none';
                }
            }

            // Add event listeners to checkboxes
            fresherRadio.addEventListener('change', toggleExperienceFields);
            experiencedRadio.addEventListener('change', toggleExperienceFields);

            // Initial check on page load
            toggleExperienceFields();
        });
    </script>
@endsection

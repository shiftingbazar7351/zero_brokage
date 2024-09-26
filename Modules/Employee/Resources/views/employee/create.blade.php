@extends('backend.layouts.main')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
@endsection

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
                            <div class="mb-3 col-md-3">
                                <label for="name" class="form-label">First Name</label><b style="color: red;">*</b>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" placeholder="Enter first name">
                                @error('name')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div class="mb-3 col-md-3">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname"
                                    value="{{ old('lname') }}" placeholder="Enter last name">
                                @error('lname')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div class="mb-3 col-md-3">
                                <label for="gender" class="form-label">Gender</label><b style="color: red;">*</b>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="" selected disabled>Select Gender</option>
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
                                    value="{{ old('dob') }}">
                                @error('dob')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3 col-md-3">
                                <label for="email" class="form-label">Email</label><b style="color: red;">*</b>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="Enter email">
                                @error('email')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Role -->
                            {{-- <div class="mb-3 col-md-3">
                                <label for="role" class="form-label">Role</label><b style="color: red;">*</b>
                                <select class="form-control" id="role" name="user_type">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            <!-- Phone Number -->
                            <div class="mb-3 col-md-3">
                                <label for="number" class="form-label">Phone Number</label><b style="color: red;">*</b>
                                <input type="text" class="form-control" id="phoneNumVender" name="number"
                                    value="{{ old('number') }}" placeholder="Enter phone number" maxlength="10">
                                @error('number')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Joining Date -->
                            <div class="mb-3 col-md-3">
                                <label for="joining_date" class="form-label">Joining Date</label><b
                                    style="color: red;">*</b>
                                <input type="date" class="form-control" id="joining_date" name="joining_date"
                                    value="{{ old('joining_date') }}">
                                @error('joining_date')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Company -->
                            <div class="mb-3 col-md-3">
                                <label for="company" class="form-label">Company</label><b style="color: red;">*</b>
                                {{-- <input type="text" class="form-control" id="company" name="company"
                                    value="{{ old('company') }}" placeholder="Enter company name"> --}}
                                <select name="company" class="form-select">
                                    <option value="" selected disabled>Select Company</option>
                                    @foreach ($companies as $comapny)
                                        <option value="{{ $comapny->id }}">{{ $comapny->legel_name ?? '' }}</option>
                                    @endforeach
                                </select>
                                @error('company')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>



                            <!-- Department Dropdown -->
                            <div class="mb-3 col-md-3">
                                <label for="department">Department Name</label>
                                <select class="form-control" id="department" name="department">
                                    <option value="" selected disabled>Select Department</option>
                                    <option value="IT Department">IT Department</option>
                                    <option value="HR Department">HR Department</option>
                                    <option value="Sales Department">Sales Department</option>
                                    <option value="Support Department">Support Department</option>
                                    <option value="Account Department">Account Department</option>
                                    <option value="Management Department">Management Department</option>
                                </select>
                                <div id="department_id_error" class="text-danger"></div>
                            </div>

                            <!-- Designation Dropdown -->
                            <div class="mb-3 col-md-3">
                                <label for="designation">Designation</label>
                                <select class="form-control" id="designation" name="designation">
                                    <option value="" selected disabled>Select Designation</option>
                                </select>
                                <div id="designation_id_error" class="text-danger"></div>
                            </div>


                            {{-- <div class="mb-3 col-md-3">
                                <label for="sub-designation">Sub-Designation</label>
                                <select class="form-control" id="sub-designation" name="sub_designation_id">
                                    <option value="">Select Sub-Designation</option>
                                </select>
                                <div id="sub_designation_id_error" class="text-danger"></div>
                            </div> --}}


                            <!-- Office Shift -->
                            <div class="mb-3 col-md-3">
                                <label for="office_shift" class="form-label">Office Shift</label><b
                                    style="color: red;">*</b>
                                <select class="form-control" id="office_shift" name="office_shift">
                                    <option value="hr1"
                                        {{ old('office_shift') == '9:30am - 6:30pm' ? 'selected' : '' }}>9:30am - 6:30pm
                                    </option>
                                </select>
                                @error('office_shift')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Reporting Head -->
                            <div class="mb-3 col-md-3">
                                <label for="reporting_head" class="form-label">Reporting Head</label><b
                                    style="color: red;">*</b>
                                <input type="text" class="form-control" id="reporting_head" name="reporting_head"
                                    value="{{ old('reporting_head') }}" placeholder="Enter reporting head">
                                @error('reporting_head')
                                    <div class="error text-danger ">{{ $message }}</div>
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
                                    value="{{ old('official_mobile') }}" placeholder="Enter official mobile">
                                @error('official_mobile')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Official Email -->
                            <div class="mb-3 col-md-3">
                                <label for="official_email" class="form-label">Official Email</label><b
                                    style="color: red;">*</b>
                                <input type="email" class="form-control" id="official_email" name="official_email"
                                    value="{{ old('official_email') }}" placeholder="Enter official email">
                                @error('official_email')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="current_address" class="form-label text-dark">Current Address<b
                                        style="color: red;">*</b></label>
                                <textarea name="current_address" class="form-control" placeholder="Enter current address" id="current_address"
                                    rows="3">{{ old('current_address') }}</textarea>
                                @error('current_address')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="permanent_address" class="form-label text-dark">Permanent Address<b
                                        style="color: red;">*</b></label>
                                <textarea name="permanent_address" class="form-control" placeholder="Enter permanent address" id="permanent_address"
                                    rows="3">{{ old('permanent_address') }}</textarea>
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
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="intermediate_certificate" class="form-label">Intermediate
                                    Certificate</label><b style="color: red;">*</b>
                                <input type="file" class="form-control" id="intermediate_certificate"
                                    name="intermediate_certificate">
                                @error('intermediate_certificate')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="graduation_certificate" class="form-label">Graduation Certificate</label><b
                                    style="color: red;">*</b>
                                <input type="file" class="form-control" id="graduation_certificate"
                                    name="graduation_certificate">
                                @error('graduation_certificate')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="bank_statement" class="form-label">Bank Statement</label>
                                <input type="file" class="form-control" id="bank_statement" name="bank_statement">
                            </div>
                            {{-- checkbox of experience --}}
                            <div class="mb-3 col-md-4">
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
                                <div class="mb-3 col-md-3">
                                    <label for="no_of_experience" class="form-label">Years of Experience</label><b
                                        style="color: red;">*</b>
                                    <input type="text" class="form-control" id="no_of_experience"
                                        name="no_of_experience" value="{{ old('no_of_experience') }}"
                                        placeholder="Enter years of experience">
                                    @error('no_of_experience')
                                        <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- No of Experience -->


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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        const whatsappvender = document.querySelector("#phoneNumVender");
        window.intlTelInput(whatsappvender, {
            initialCountry: "in",
            separateDialCode: true
        });
    </script>


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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get department and designation dropdown elements
            const departmentDropdown = document.getElementById('department');
            const designationDropdown = document.getElementById('designation');

            // Department change event handler
            departmentDropdown.addEventListener('change', function() {
                const department = this.value;

                // Clear existing options in the designation dropdown
                designationDropdown.innerHTML = '<option value="" selected disabled>Select Designation</option>';

                // Populate designations based on selected department
                let designations = [];
                switch (department) {
                    case 'IT Department':
                        designations = [{
                                value: 'Frontend Developer',
                                text: 'Frontend Developer'
                            },
                            {
                                value: 'Backend Developer',
                                text: 'Backend Developer'
                            },
                            {
                                value: 'Mobile Application Developer',
                                text: 'Mobile Application Developer'
                            },
                            {
                                value: 'System Administrator',
                                text: 'System Administrator'
                            },
                            {
                                value: 'Digital Marketing Intern',
                                text: 'Digital Marketing Intern'
                            },

                            {
                                value: 'SEO Manager',
                                text: 'SEO Manager'
                            },
                             {
                                value: 'SEO Intern',
                                text: 'SEO Intern'
                            },
                        ];
                        break;
                    case 'HR Department':
                        designations = [{
                                value: 'HR Manager',
                                text: 'HR Manager'
                            },
                            {
                                value: 'HR Executive',
                                text: 'HR Executive'
                            },
                            {
                                value: 'HR Intern',
                                text: 'HR Intern'
                            },
                        ];
                        break;
                    case 'Sales Department':
                        designations = [{
                                value: 'Branch Manager',
                                text: 'Branch Manager'
                            },
                            {
                                value: 'Assistant Branch Manager',
                                text: 'Assistant Branch Manager'
                            },
                            {
                                value: 'Territory Manager',
                                text: 'Territory Manager'
                            },
                            {
                                value: 'Regional Sales Manager',
                                text: 'Regional Sales Manager'
                            },
                            {
                                value: 'Area Sales Manager',
                                text: 'Area Sales Manager'
                            },
                            {
                                value: 'Relationship Manager',
                                text: 'Relationship Manager'
                            },
                            {
                                value: 'Sr. Business Consultant',
                                text: 'Sr. Business Consultant'
                            },
                        ];
                        break;
                    case 'Support Department':
                        designations = [{
                                value: 'Customer Support',
                                text: 'Customer Support'
                            },
                            {
                                value: 'SEO Manager',
                                text: 'SEO Manager'
                            },
                            {
                                value: 'Sr. Key Account Manager',
                                text: 'Sr. Key Account Manager'
                            },
                        ];
                        break;
                    case 'Account Department':
                        designations = [{
                                value: 'Account Manager',
                                text: 'Account Manager'
                            },
                            {
                                value: 'Account Executive',
                                text: 'Account Executive'
                            },
                        ];
                        break;
                    case 'Management Department':
                        designations = [{
                                value: 'Director',
                                text: 'Director'
                            },
                            {
                                value: 'CEO',
                                text: 'CEO'
                            },
                            {
                                value: 'HR',
                                text: 'HR'
                            },
                        ];
                        break;
                }
                // Add new designation options to the dropdown
                designations.forEach(designation => {
                    const option = document.createElement('option');
                    option.value = designation.value;
                    option.textContent = designation.text;
                    designationDropdown.appendChild(option);
                });
            });
        });
    </script>
@endsection

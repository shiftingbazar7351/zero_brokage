@extends('backend.layouts.main')


@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="row">
                <div class="container border p-2 shadow-sm my-3">
                    <h4> Edit Bank Details</h4>
                </div>
                <div>
                    <form action="{{ route('employee-bank.update', $bank->id ?? '') }}" method="POST"
                        enctype="multipart/form-data" data-parsley-validate="true">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-4">
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
                            <div class="mb-3 col-md-4">
                                <label for="designation">Designation</label>
                                <select class="form-control" id="designation" name="designation">
                                    <option value="" selected disabled>Select Designation</option>
                                </select>
                                <div id="designation_id_error" class="text-danger"></div>
                            </div>

                            <!-- Employee Name Dropdown -->
                            <div class="mb-3 col-md-4">
                                <label for="employee_name">Employee Name</label>
                                <select class="form-control" id="employee_name" name="emp_id">
                                    <option value="" selected disabled>Select Employee</option>
                                </select>
                                <div id="employee_name_error" class="text-danger"></div>
                            </div>

                            <!-- Account Number -->
                            <div class="mb-3 col-md-4">
                                <label for="bank_name">Bank Name</label>
                                <input type="text" class="form-control" id="bank_name" name="bank_name"
                                    placeholder="Enter Bank Name" value="{{ old('bank_name', $bank->bank_name ?? '') }}" required>
                                @error('bank_name')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Account Number -->
                            <div class="mb-3 col-md-4">
                                <label for="account_number">Account Number</label>
                                <input type="text" class="form-control" id="account_number" name="account_number"
                                    placeholder="Enter Account Number" value="{{ old('account_number', $bank->account_number ?? '') }}" required>
                                @error('account_number')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Branch -->
                            <div class="mb-3 col-md-4">
                                <label for="branch">Branch</label>
                                <input type="text" class="form-control" id="branch" name="branch"
                                    placeholder="Enter Branch" value="{{ old('bankbranch_name', $bank->branch ?? '') }}" required>
                                @error('branch')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Permanent Account Number -->
                            <div class="mb-3 col-md-4">
                                <label for="permanent_acc_number">Permanent Account Number</label>
                                <input type="text" class="form-control" id="permanent_acc_number"
                                    name="permanent_acc_number" placeholder="Enter Permanent Account Number"
                                    value="{{ old('permanent_acc_number', $bank->permanent_acc_number ?? '') }}" required>
                                @error('permanent_acc_number')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Employee Type -->
                            {{-- <div class="mb-3 col-md-4">
                                <label for="employee_type">Employee Type</label>
                                <input type="text" class="form-control" id="employee_type" name="employee_type"
                                    placeholder="Enter Employee Type" value="{{ old('employee_type') }}" required>
                                @error('employee_type')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            <!-- Band -->
                            <div class="mb-3 col-md-4">
                                <label for="band">Band</label>
                                <input type="text" class="form-control" id="band" name="band"
                                    placeholder="Enter Band" value="{{ old('band', $bank->band ?? '') }}" required>
                                @error('band')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- UAN -->
                            <div class="mb-3 col-md-4">
                                <label for="uan">UAN</label>
                                <input type="text" class="form-control" id="uan" name="uan"
                                    placeholder="Enter UAN" value="{{ old('uan', $bank->uan ?? '') }}" required>
                                @error('uan')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
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
            // Get department and designation dropdown elements
            const departmentDropdown = document.getElementById('department');
            const designationDropdown = document.getElementById('designation');

            // Department change event handler
            departmentDropdown.addEventListener('change', function() {
                const department = this.value;

                // Clear existing options in the designation dropdown
                designationDropdown.innerHTML =
                    '<option value="" selected disabled>Select Designation</option>';

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const departmentDropdown = document.getElementById('department');
            const designationDropdown = document.getElementById('designation');
            const employeeNameDropdown = document.getElementById('employee_name');

            function fetchEmployees(department, designation) {
                // Make AJAX request to fetch employees
                fetch(`/employees?department=${department}&designation=${designation}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing options
                        employeeNameDropdown.innerHTML =
                            '<option value="" selected disabled>Select Employee</option>';

                        // Populate employee options
                        data.forEach(employee => {
                            const option = document.createElement('option');
                            option.value = employee.id;
                            option.textContent = employee.name;
                            employeeNameDropdown.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Department and Designation change event
            departmentDropdown.addEventListener('change', function() {
                const department = this.value;
                const designation = designationDropdown.value;
                if (designation) {
                    fetchEmployees(department, designation);
                }
            });

            designationDropdown.addEventListener('change', function() {
                const designation = this.value;
                const department = departmentDropdown.value;
                if (department) {
                    fetchEmployees(department, designation);
                }
            });
        });
    </script>
@endsection

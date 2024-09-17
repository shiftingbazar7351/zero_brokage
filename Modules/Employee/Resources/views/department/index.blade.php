@extends('backend.layouts.main')
@section('styles')
    <style>
        .preview-img{
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
    </style>
@endsection
@section('content')

    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Departments</h5>
                <div class="list-btn">
                    <ul>
                        <li>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#add_department"><i class="fa fa-plus me-2"></i>Add Department</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="table-responsive table-div">
                        <table class="table datatable table-striped text-center table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Department Name </th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($departments->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($departments as $department)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="table-imgname">
                                                    @if ($department->image)
                                                        <img src="{{ Storage::url('employee/departments/' . $department->image) }}"
                                                            class="me-2 preview-img" alt="img">
                                                    @else
                                                        No Image
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $department->department_id ?? '' }}</td>
                                            <td>
                                                <div class="active-switch">
                                                    <label class="switch">
                                                        <input type="checkbox" class="status-toggle"
                                                            data-id="{{ $department->id }}"
                                                            onclick="return confirm('Are you sure want to change status?')"
                                                            {{ $department->status ? 'checked' : '' }}>
                                                        <span class="sliders round"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="table-actions d-flex justify-content-center">
                                                    <button class="btn delete-table me-2"
                                                        onclick="editdepartment({{ $department->id }})" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#edit-department">
                                                        <i class="fe fe-edit"></i>
                                                    </button>

                                                    <form
                                                        action="{{ route('employee-department.destroy', $department->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn delete-table" type="submit"
                                                            onclick="return confirm('Are you sure want to delete this?')">
                                                            <i class="fe fe-trash-2"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Company Modal -->
    <div class="modal fade" id="add_department" tabindex="-1" aria-labelledby="addCompanyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCompanyLabel">Add Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="addDepartmentForm" action="{{ route('employee-department.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="branch">Branch Name</label>
                            <select class="form-control" id="branch" name="branch_id">
                                <option value="">Select Branch</option>
                                @foreach ($branchs as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                            <div id="branch_id_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label for="department">Department Name</label>
                            <select class="form-control" id="department" name="department_id">
                                <option value=""> Select Department </option>
                                <option value="IT Department"> IT Department </option>
                                <option value="HR Department"> HR Department </option>
                                <option value="Sales Department"> Sales Department</option>
                                <option value="Support Department"> Support Department </option>
                                <option value="Account Department"> Account Department </option>
                                <option value="Managenment Department"> Managenment Department </option>
                            </select>
                            <div id="department_id_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="designation">Designation</label>
                            <select class="form-control" id="designation" name="designation_id">
                                <option value="">Select IT Designation</option>
                            </select>
                            <div id="designation_id_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="sub-designation">Sub-Designation</label>
                            <select class="form-control" id="sub-designation" name="sub_designation_id">
                                <option value="">Select Sub-Designation</option>
                            </select>
                            <div id="sub_designation_id_error" class="text-danger"></div>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Image </label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="image-preview-icon" src="{{ asset('admin/assets/img/icons/upload.svg') }}"
                                        alt="img" class="default-img">
                                    <div class="file-browse">
                                        <h6>Drag & drop image or </h6>
                                        <div class="file-browse-path">
                                            <input type="file" name="image" id="image-input-icon" accept="image/*">
                                            <a href="javascript:void(0);"> Browse</a>
                                        </div>
                                    </div>
                                    <h5>Supported formats: JPEG, PNG, PDF Etc.</h5>
                                </div>
                            </div>
                            <div id="image_error" class="text-danger"></div>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Company Modal -->
    <div class="modal fade" id="edit-department" tabindex="-1" aria-labelledby="editCompanyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCompanyLabel">Edit Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="editDepartmentForm" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <input type="hidden" id="editDepartmentId" name="id">

                        <div class="mb-3">
                            <label for="branch">Branch Name</label>
                            <select class="form-control" id="editbranch" name="branch_id">
                                <option value="">Select Branch</option>
                                @foreach ($branchs as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                            <div id="editbranch_id_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label for="department">Department Name</label>
                            <select class="form-control" id="editdepartment" name="department_id">
                                <option value=""> Select Department </option>
                                <option value="IT Department"> IT Department </option>
                                <option value="HR Department"> HR Department </option>
                                <option value="Sales Department"> Sales Department</option>
                                <option value="Support Department"> Support Department </option>
                                <option value="Account Department"> Account Department </option>
                                <option value="Managenment Department"> Managenment Department </option>
                            </select>
                            <div id="editdepartment_id_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="designation">Designation</label>
                            <select class="form-control" id="editdesignation" name="designation_id">
                                <option value="">Select IT Designation</option>
                            </select>
                            <div id="editdesignation_id_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="sub-designation">Sub-Designation</label>
                            <select class="form-control" id="editsub-designation" name="sub_designation_id">
                                <option value="">Select Sub-Designation</option>
                            </select>
                            <div id="editsub_designation_id_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Image </label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="edit-image-preview-icon"
                                        src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img"
                                        class="default-img prev">
                                    <div class="file-browse">
                                        <h6>Drag & drop image or </h6>
                                        <div class="file-browse-path">
                                            <input type="file" name="image" id="edit-image-input-icon"
                                                accept="image/*">
                                            <a href="javascript:void(0);"> Browse</a>
                                        </div>
                                    </div>
                                    <h5>Supported formats: JPEG, PNG, PDF Etc.</h5>
                                </div>
                            </div>
                            <div id="editimage_error" class="text-danger"></div>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('admin/assets/js/status-update.js') }}"></script>
    <script src="{{ asset('admin/assets/js/preview-img.js') }}"></script>
    <script>
        // Helper function to populate dropdown
        function populateDropdown(dropdown, options) {
            dropdown.innerHTML = '<option value="">Select</option>';
            options.forEach(option => {
                dropdown.innerHTML += `<option value="${option.value}">${option.text}</option>`;
            });
        }

        // Handle Department Dropdown Change
        function handleDepartmentChange(departmentDropdownId, designationDropdownId, subDesignationDropdownId) {
            const departmentDropdown = document.getElementById(departmentDropdownId);
            const designationDropdown = document.getElementById(designationDropdownId);
            const subDesignationDropdown = document.getElementById(subDesignationDropdownId);

            departmentDropdown.addEventListener('change', function() {
                const department = this.value;

                // Clear existing options
                designationDropdown.innerHTML = '<option value="">Select Designation</option>';
                subDesignationDropdown.innerHTML = '<option value="">Select Sub-Designation</option>';

                // Populate Designations based on selected department
                let designations = [];
                if (department === 'IT Department') {
                    designations = [{
                            value: 'Software Engineer',
                            text: 'Software Engineer'
                        },
                        {
                            value: 'System Administrator',
                            text: 'System Administrator'
                        },
                        {
                            value: 'Digital Marketing',
                            text: 'Digital Marketing'
                        }
                    ];
                } else if (department === 'HR Department') {
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
                        }
                    ];
                } else if (department === 'Sales Department') {
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
                        }
                    ];
                } else if (department === 'Support Department') {
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
                        }
                    ];
                } else if (department === 'Account Department') {
                    designations = [{
                            value: 'Account Manager',
                            text: 'Account Manager'
                        },
                        {
                            value: 'Account Executive',
                            text: 'Account Executive'
                        }
                    ];
                } else if (department === 'Management Department') {
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
                        }
                    ];
                }

                populateDropdown(designationDropdown, designations);
            });
        }

        // Handle Designation Dropdown Change
        function handleDesignationChange(designationDropdownId, subDesignationDropdownId) {
            const designationDropdown = document.getElementById(designationDropdownId);
            const subDesignationDropdown = document.getElementById(subDesignationDropdownId);

            designationDropdown.addEventListener('change', function() {
                const designation = this.value;

                // Clear existing options
                subDesignationDropdown.innerHTML = '<option value="">Select Sub-Designation</option>';

                // Populate Sub-Designations based on selected designation
                let subDesignations = [];
                if (designation === 'Software Engineer') {
                    subDesignations = [{
                            value: 'Frontend Developer',
                            text: 'Frontend Developer'
                        },
                        {
                            value: 'Backend Developer',
                            text: 'Backend Developer'
                        },
                        {
                            value: 'Android Developer',
                            text: 'Android Developer'
                        }
                    ];
                } else if (designation === 'Digital Marketing') {
                    subDesignations = [{
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
                        }
                    ];
                }

                populateDropdown(subDesignationDropdown, subDesignations);
            });
        }

        // Initialize for Add Modal
        handleDepartmentChange('department', 'designation', 'sub-designation');
        handleDesignationChange('designation', 'sub-designation');

        // Initialize for Edit Modal
        handleDepartmentChange('editdepartment', 'editdesignation', 'editsub-designation');
        handleDesignationChange('editdesignation', 'editsub-designation');
    </script>

    <script>
        // Function to preview the image
        function previewImage(input, previewId) {
            var file = input.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + previewId).attr('src', e.target.result)
                        .css({
                            'width': '150px',
                            'height': '150px'
                        }); // Set the preview image size to 50px
                };
                reader.readAsDataURL(file);
            }
        }

        // Event listener for icon image preview
        $('#edit-image-input-icon').on('change', function() {
            previewImage(this, 'edit-image-preview-icon');
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#addDepartmentForm').off('submit').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            location.reload(); // Refresh page to show new data
                        }
                    },
                    error: function(xhr) {
                        $('#branch_id_error').text(xhr.responseJSON.errors
                            .branch_id ? xhr
                            .responseJSON.errors.branch_id[0] : '');

                        $('#department_id_error').text(xhr.responseJSON.errors
                            .department_id ? xhr
                            .responseJSON.errors.department_id[0] : '');
                        $('#name_error').text(xhr.responseJSON.errors.name ? xhr
                            .responseJSON
                            .errors.name[0] : '');
                        $('#designation_id_error').text(xhr.responseJSON.errors.designation_id ?
                            xhr
                            .responseJSON
                            .errors.designation_id[0] : '');
                        $('#sub_designation_id_error').text(xhr.responseJSON.errors
                            .sub_designation_id ? xhr
                            .responseJSON
                            .errors.sub_designation_id[0] : '');
                        $('#image_error').text(xhr.responseJSON.errors.image ? xhr
                            .responseJSON
                            .errors.image[0] : '');
                    }
                });
            });

            window.editdepartment = function(id) {
                $.ajax({
                    url: `/employee-department/${id}/edit`,
                    method: 'GET',
                    success: function(response) {
                        // Set form values
                        $('#editDepartmentId').val(response.department.id);
                        $('#editbranch').val(response.department.branch_id).trigger('change');

                        if (response.department.image) {
                            $('#edit-image-preview-icon').attr('src',
                                `/storage/employee/departments/${response.department.image}`);
                        }
                        // Clear and populate department dropdown
                        const departmentDropdown = $('#editdepartment');
                        departmentDropdown.val(response.department.department_id).trigger('change');

                        // Clear and populate designation dropdown
                        const designationDropdown = $('#editdesignation');
                        designationDropdown.empty().append(
                            '<option value="" disabled>Select Designation</option>');

                        let designations = [];
                        if (response.department.department_id === 'IT Department') {
                            designations = [{
                                    value: 'Software Engineer',
                                    text: 'Software Engineer'
                                },
                                {
                                    value: 'System Administrator',
                                    text: 'System Administrator'
                                },
                                {
                                    value: 'Digital Marketing',
                                    text: 'Digital Marketing'
                                }
                            ];
                        } else if (response.department.department_id === 'HR Department') {
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
                                }
                            ];
                        } else if (response.department.department_id === 'Sales Department') {
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
                                }
                            ];
                        } else if (response.department.department_id === 'Support Department') {
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
                                }
                            ];
                        } else if (response.department.department_id === 'Account Department') {
                            designations = [{
                                    value: 'Account Manager',
                                    text: 'Account Manager'
                                },
                                {
                                    value: 'Account Executive',
                                    text: 'Account Executive'
                                }
                            ];
                        } else if (response.department.department_id === 'Management Department') {
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
                                }
                            ];
                        }

                        // Populate designation dropdown
                        designations.forEach(option => {
                            designationDropdown.append(
                                `<option value="${option.value}">${option.text}</option>`
                            );
                        });

                        // Set selected designation
                        designationDropdown.val(response.department.designation_id).trigger(
                            'change');

                        // Clear and populate sub-designation dropdown if needed
                        const subDesignationDropdown = $('#editsub-designation');
                        subDesignationDropdown.empty().append(
                            '<option value="" disabled>Select Sub-Designation</option>');

                        let subDesignations = [];
                        if (response.department.designation_id === 'Software Engineer') {
                            subDesignations = [{
                                    value: 'Frontend Developer',
                                    text: 'Frontend Developer'
                                },
                                {
                                    value: 'Backend Developer',
                                    text: 'Backend Developer'
                                },
                                {
                                    value: 'Android Developer',
                                    text: 'Android Developer'
                                }
                            ];
                        } else if (response.department.designation_id === 'Digital Marketing') {
                            subDesignations = [{
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
                                }
                            ];
                        }

                        // Populate sub-designation dropdown
                        subDesignations.forEach(option => {
                            subDesignationDropdown.append(
                                `<option value="${option.value}">${option.text}</option>`
                            );
                        });

                        // Set selected sub-designation
                        subDesignationDropdown.val(response.department.sub_designation_id);
                    },
                    error: function(xhr) {
                        console.error('Error fetching the department data:', xhr);
                    }
                });
            };

            $('#editDepartmentForm').off('submit').on('submit', function(e) {
                e.preventDefault();

                // Clear previous errors
                $('#editbranch_id_error').text('');
                $('#editdepartment_id_error').text('');
                $('#editdesignation_id_error').text('');
                $('#editsub_designation_id_error').text('');
                $('#editimage_error').text('');

                // Prepare the form data
                let formData = new FormData(this);
                let id = $('#editDepartmentId').val(); // Get the ID of the department being edited

                $.ajax({
                    type: 'POST',
                    url: `/employee-department/${id}`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            // Optionally show a success message
                            alert('Department updated successfully!');

                            // Update UI dynamically or refresh the table if needed, e.g.:
                            // $('#departmentRow-' + id).replaceWith(response.updatedHtml);

                            // Reload page to show the updated data (if dynamic updates aren't used)
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        // Handle errors
                        let errors = xhr.responseJSON.errors;

                        if (errors) {
                            // Display validation errors
                            $('#editbranch_id_error').text(errors.branch_id ? errors.branch_id[
                                0] : '');
                            $('#editdepartment_id_error').text(errors.department_id ? errors
                                .department_id[
                                    0] : '');
                            $('#editdesignation_id_error').text(errors.designation_id ? errors
                                .designation_id[0] : '');
                            $('#editsub_designation_id_error').text(errors.sub_designation_id ?
                                errors
                                .sub_designation_id[0] : '');
                            $('#editimage_error').text(errors.image ? errors.image[0] : '');
                        } else {
                            // Generic error handling (e.g., if validation is missing on the server)
                            alert(
                                'An error occurred while updating the department. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
@endsection

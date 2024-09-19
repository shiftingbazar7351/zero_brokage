@extends('backend.layouts.main')
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Users</h5>
                <div class="list-btn d-flex gap-3">
                    <div class="page-headers">
                        <div class="search-bar">
                            <span><i class="fe fe-search"></i></span>
                            <input type="text" id="search" placeholder="Search" class="form-control">
                        </div>
                    </div>
                    <ul>
                        <li>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#add-category">
                                <i class="fa fa-plus me-2"></i>Add User
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-12">
                    <div class="table-responsive table-div">
                        {{-- Users Table --}}
                        <div id="usersTable">
                            @include('backend.user.partials.users_list') {{-- Load the users list initially --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Category Modal -->
    <div class="modal fade" id="add-category">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="addSubCategoryForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">User Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name">
                            <div id="name_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter Email">
                            <div id="email_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" placeholder="Enter Phone Number">
                            <div id="phone_number_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-control" name="user_type" id="user_type">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ $role->name == 'employee' ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="role_error" class="text-danger"></div>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <div id="status_error" class="text-danger"></div>
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

    <!-- Edit Category Modal -->
    <!-- Edit User Modal -->
    <div class="modal fade" id="edit-user">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="editSubCategoryForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editSubCategoryId" name="id">

                        <div class="mb-3">
                            <label class="form-label">User Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name">
                            <div id="name_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter Email">
                            <div id="email_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number"
                                placeholder="Enter Phone Number">
                            <div id="phone_number_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-control" name="user_type" id="user_type">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ $role->id == old('user_type', $user->user_type ?? '') ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>

                            <div id="role_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="1" {{ old('status', $user->status ?? '') == 1 ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0" {{ old('status', $user->status ?? '') == 0 ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                            <div id="status_error" class="text-danger"></div>
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
@endsection
@section('scripts')
    <script>
        var statusRoute = `{{ route('user.status') }}`;
        var searchRoute = `{{ route('user.index') }}`;
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('admin/assets/js/status-update.js') }}"></script>
    <script src="{{ asset('admin/assets/js/search.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Handle Create User
            $('#addSubCategoryForm').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: '{{ route('user.store') }}', // Change to the correct route
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            // Use window.location.href for redirection to the provided URL
                            window.location.href = response
                                .redirectUrl; // Redirect to the URL provided in the response
                        } else {
                            alert('Failed to add user.');
                        }
                    },
                    error: function(response) {
                        displayErrors(response.responseJSON.errors); // Handle validation errors
                    }
                });
            });
            // Display validation errors
            function displayErrors(errors) {
                $('.text-danger').text(''); // Clear previous error messages
                if (errors.name) {
                    $('#name_error').text(errors.name[0]);
                }
                if (errors.email) {
                    $('#email_error').text(errors.email[0]);
                }
                if (errors.phone_number) {
                    $('#phone_number_error').text(errors.phone_number[0]);
                }
                if (errors.user_type) {
                    $('#role_error').text(errors.user_type[0]);
                }
                if (errors.status) {
                    $('#status_error').text(errors.status[0]);
                }
            }
        });
    </script>

    <!-- Your HTML content here -->

    <!-- Place the script at the end of the body -->
    <script>
        function editUser(id) {
            $.ajax({
                url: '/user/' + id + '/edit', // Assuming this route returns user data
                method: 'GET',
                success: function(user) {
                    // Populate the form fields with the user data
                    $('#editSubCategoryId').val(user.id); // Set user ID
                    $('#editSubCategoryForm input[name="name"]').val(user.name); // Set user name
                    $('#editSubCategoryForm input[name="email"]').val(user.email); // Set email
                    $('#editSubCategoryForm input[name="phone_number"]').val(user
                    .phone_number); // Set phone number

                    // Populate Role (select field)
                    $('#editSubCategoryForm select[name="user_type"]').val(user
                    .user_type); // Assuming user.user_type holds the role ID

                    // Populate Status (select field)
                    $('#editSubCategoryForm select[name="status"]').val(user
                    .status); // Assuming user.status holds the status (1 for Active, 0 for Inactive)

                    // Open the modal
                    $('#edit-user').modal('show');
                },
                error: function(response) {
                    alert('Failed to fetch user data.');
                }
            });
        }
    </script>

@endsection

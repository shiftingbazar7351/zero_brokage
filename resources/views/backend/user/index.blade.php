@extends('backend.layouts.main')
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Users</h5>
                <div class="list-btn">
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
                    <div class="table-resposnive table-div">
                        <table class="table datatable table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    @if ($user->user_type !== 'super_admin')
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name ?? '' }}</td>
                                            <td>{{ $user->email ?? '' }}</td>
                                            <td>{{ $user->user_type ?? '' }}</td>
                                            <td>
                                                <div class="active-switch">
                                                    <label class="switch">
                                                        <input type="checkbox" class="status-toggle"
                                                            data-id="{{ $user->id }}"
                                                            onclick="return confirm('Are you sure want to change status?')"
                                                            {{ $user->status ? 'checked' : '' }}>
                                                        <span class="sliders round"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="table-actions d-flex justify-content-center">
                                                    <button class="btn delete-table me-2"
                                                        onclick="edituser({{ $user->id }})" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#edit-category">
                                                        <i class="fe fe-edit"></i>
                                                    </button>
                                                    <form action="{{ route('subcategories.destroy', $user->id) }}"
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
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No data found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
                                    <option value="{{ $role->id }}" {{ $role->name == 'user' ? 'selected' : '' }}>
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
    <div class="modal fade" id="edit-category">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
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
                                    <option value="{{ $role->id }}" {{ $role->name == 'user' ? 'selected' : '' }}>
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
@endsection
@section('scripts')
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
                            alert('User added successfully!');
                            location.reload(); // Reload the page to show updated data
                        } else {
                            alert('Failed to add user.');
                        }
                    },
                    error: function(response) {
                        displayErrors(response.responseJSON.errors); // Handle validation errors
                    }
                });
            });

            // Handle Edit User
            $('#editSubCategoryForm').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let id = $('#editSubCategoryId').val();

                $.ajax({
                    url: '/user/' + id, // Assuming RESTful route for update
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            alert('User updated successfully!');
                            location.reload(); // Reload the page to show updated data
                        } else {
                            alert('Failed to update user.');
                        }
                    },
                    error: function(response) {
                        displayErrors(response.responseJSON.errors); // Handle validation errors
                    }
                });
            });

            // Function to populate the edit form
            window.edituser = function(id) {
                $.get('/user/' + id, function(user) { // Assuming RESTful route for fetching the user
                    $('#editSubCategoryId').val(user.id);
                    $('#editSubCategoryForm input[name="name"]').val(user.name);
                    $('#editSubCategoryForm input[name="email"]').val(user.email);
                    $('#editSubCategoryForm input[name="phone_number"]').val(user.phone_number);
                    $('#editSubCategoryForm select[name="user_type"]').val(user.user_type);
                    $('#editSubCategoryForm select[name="status"]').val(user.status);
                });
            };

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
@endsection

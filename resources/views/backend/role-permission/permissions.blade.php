@extends('backend.layouts.main')
@section('content')

    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Roles & Permissions</h5>
                <div class="list-btn">
                    <ul>
                        <li>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#addPermissions"><i class="fa fa-plus me-2"></i>Add Permissions</button>
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#addRoles"><i class="fa fa-plus me-2"></i>Add roles</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 ">
                    <div class="table-responsive shadow" style="overflow-x: auto;">
                        <form action="{{ route('role.permission.store') }}" method="POST">
                            @csrf
                            <table class="table table-bordered" style="min-width: 100%;">
                                <thead>
                                    <tr>
                                        <!-- Make the first column sticky -->
                                        <th class="text-center sticky-column" style="position: sticky; left: 0; background-color: #ebf3f9; z-index: 10;">
                                            Module
                                        </th>
                                        @foreach ($roles as $role)
                                            <th class="text-center table-bordered">{{ $role->title }}
                                                <input type="checkbox" class="form-check-input role-checkbox mx-2" data-role-id="{{ $role->id }}">
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr class="{{ !isset($permission->parent_id) ? 'bg-body' : '' }}">
                                            <!-- Make the first column sticky in the body as well -->
                                            <td style="position: sticky; left: 0; background-color: white; z-index: 1;">
                                                {{ $permission->title }}
                                            </td>
                                            @foreach ($roles as $role)
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="role-{{ $role->id }}-permission-{{ $permission->id }}"
                                                        name="permission[{{ $role->id }}][]"
                                                        value='{{ $permission->id }}'
                                                        {{ \App\Helpers\AuthHelper::checkRolePermission($role, $permission->name) ? 'checked' : '' }}>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="offset-md-3 col-md-8">
        <div class="mb-4 text-center">
            <button type="submit" class="btn btn-md btn-primary">Submit</button>
        </div>
    </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addRoles" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryLabel">Add Roles</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="addCategoryForm" action="{{ route('role.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Role Title</label>
                            <input type="text" class="form-control" id="addName" name="title"
                                placeholder="Enter Category title">
                            <span class="text-danger error-text title_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="status_yes" name="status" value="1">
                                <label class="form-check-label" for="status_yes">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="status_no" name="status" value="0">
                                <label class="form-check-label" for="status_no">Inactive</label>
                            </div>
                            <span class="text-danger error-text status_error"></span>
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

     <!-- Add Category Modal -->
     <div class="modal fade" id="addPermissions" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryLabel">Add Roles</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="addCategoryForm" action="{{ route('permission.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Permission Title</label>
                            <input type="text" class="form-control" id="addName" name="title"
                                placeholder="Enter Category title">
                            <span class="text-danger error-text title_error"></span>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Function to toggle all permission checkboxes for a given role
        function togglePermissionsForRole(roleId, isChecked) {
            document.querySelectorAll(`input[id^="role-${roleId}-permission-"]`).forEach(function(permissionCheckbox) {
                permissionCheckbox.checked = isChecked; // Set their checked state
            });
        }

        // Event listener for role checkboxes (main checkboxes that control all permissions)
        document.querySelectorAll('.role-checkbox').forEach(function(roleCheckbox) {
            roleCheckbox.addEventListener('change', function() {
                let roleId = this.getAttribute('data-role-id'); // Get the role ID from the data attribute
                let isChecked = this.checked; // Check if the role checkbox is checked or not
                togglePermissionsForRole(roleId, isChecked); // Toggle permissions accordingly
            });
        });

        // Update the role checkbox based on permissions
        function updateRoleCheckbox(roleId) {
            const allPermissions = document.querySelectorAll(`input[id^="role-${roleId}-permission-"]`);
            if (allPermissions.length === 0) return;
            const allChecked = Array.from(allPermissions).every(checkbox => checkbox.checked); // Check if all are selected
            const roleCheckbox = document.querySelector(`.role-checkbox[data-role-id="${roleId}"]`);
            if (roleCheckbox) {
                roleCheckbox.checked = allChecked; // Update the role checkbox state
            }
        }

        // Event listener for individual permission checkboxes
        document.querySelectorAll('input[id^="role-"][type="checkbox"]').forEach(function(permissionCheckbox) {
            permissionCheckbox.addEventListener('change', function() {
                let roleId = this.id.split('-')[1]; // Extract role ID from checkbox ID
                updateRoleCheckbox(roleId); // Update the main role checkbox
            });
        });

        // On page load, initialize role checkboxes based on permissions
        document.querySelectorAll('.role-checkbox').forEach(function(roleCheckbox) {
            let roleId = roleCheckbox.getAttribute('data-role-id');
            updateRoleCheckbox(roleId);
        });

        // Handle form submission to ensure unchecked values are excluded
        document.querySelector('form').addEventListener('submit', function() {
            // Remove unchecked checkboxes from the form data
            document.querySelectorAll('input[type="checkbox"]:not(:checked)').forEach(function(checkbox) {
                checkbox.name = ''; // Clear the name to exclude it from form submission
            });
        });
    });
    </script>

@endsection

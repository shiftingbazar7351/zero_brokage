@extends('backend.layouts.main')
@section('content')

<div class="page-wrapper page-settings">
    <div class="content">
        <div class="content-page-header content-page-headersplit mb-0">
            <h5>Categories</h5>
            <div class="list-btn">
                <ul>
                    <li>
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#add_category"><i class="fa fa-plus me-2"></i>Add Category</button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12 ">
                <div class="table-responsive table-div">
                    <form action="{{ route('role.permission.store') }}" method="POST">
                    @csrf
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                @foreach ($roles as $role)
                                    <th class="text-center">{{ $role->title }}
                                        <input type="checkbox" class="form-check-input role-checkbox"
                                            data-role-id="{{ $role->id }}"
                                            style="float:right; margin-right: 10px;">

                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr class="{{ !isset($permission->parent_id) ? 'bg-body' : '' }}">
                                    <td>{{ $permission->title }}

                                    </td>
                                    @foreach ($roles as $role)
                                        <td class="text-center">
                                            <input class="form-check-input" type="checkbox"
                                                id="role-{{ $role->id }}-permission-{{ $permission->id }}"
                                                name="permission[{{ $role->id }}][]"
                                                value='{{ $permission->id }}'
                                                {{-- {{ AuthHelper::checkRolePermission($role, $permission->name) ? 'checked' : '' }} --}}
                                                >
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        <button type="submit" class="btn btn-md btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateRoleCheckbox(roleId) {
            const allPermissions = document.querySelectorAll(`input[id^="role-${roleId}-permission-"]`);
            const allChecked = Array.from(allPermissions).every(checkbox => checkbox.checked);
            const roleCheckbox = document.querySelector(`.role-checkbox[data-role-id="${roleId}"]`);
            roleCheckbox.checked = allChecked;
        }

        document.querySelectorAll('.role-checkbox').forEach(function(checkbox) {
            checkbox.addEventListener('click', function() {
                let roleId = this.getAttribute('data-role-id');
                let isChecked = this.checked;
                document.querySelectorAll(`input[id^="role-${roleId}-permission-"]`).forEach(
                    function(permissionCheckbox) {
                        permissionCheckbox.checked = isChecked;
                    });
            });
        });

        document.querySelectorAll('input[id^="role-"][type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                let roleId = this.id.split('-')[1]; // Extract role ID from checkbox ID
                updateRoleCheckbox(roleId);
            });
        });

        document.querySelectorAll('.role-checkbox').forEach(function(checkbox) {
            let roleId = checkbox.getAttribute('data-role-id');
            updateRoleCheckbox(roleId);
        });
    });
</script>

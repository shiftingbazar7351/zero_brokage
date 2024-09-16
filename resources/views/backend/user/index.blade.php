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
                                @if($user->user_type !== 'super_admin')
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name ??'' }}</td>
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
                        <form id="addSubCategoryForm" action="{{ route('subcategories.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">User Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name">
                                <div id="name_error" class="text-danger"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter Email">
                                <div id="name_error" class="text-danger"></div>
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
                                <input type="text" class="form-control" id="editName" name="name" placeholder="Enter Name">
                                <div id="name_error_edit" class="text-danger"></div>
                            </div>


                            <div class="text-end">
                                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

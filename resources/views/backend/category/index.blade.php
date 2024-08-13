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
                                data-bs-target="#add-category"><i class="fa fa-plus me-2"></i>Add Category</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="table-resposnive table-div">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($categories->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="table-imgname">
                                                    <span>{{ $category->name }}</span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="active-switch">
                                                    <label class="switch">
                                                        <input type="checkbox" class="status-toggle"
                                                            data-id="{{ $category->id }}" onclick="return confirm('Are you sure want to change status')"
                                                            {{ $category->status ? 'checked' : '' }}>
                                                        <span class="sliders round"></span>
                                                    </label>
                                                </div>
                                            </td>


                                            <td>
                                                <div class="table-actions d-flex justify-content-center">
                                                    <button class="btn delete-table me-2"
                                                        onclick="editCategory({{ $category->id }}, '{{ $category->name }}')"
                                                        type="button" data-bs-toggle="modal"
                                                        data-bs-target="#edit-category">
                                                        <i class="fe fe-edit"></i>
                                                    </button>

                                                    <form action="{{ route('categories.destroy', $category->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn delete-table" type="submit" onclick="return confirm('Are you sure want to delete this?')"
                                                            data-bs-toggle="modal" data-bs-target="#delete-category">
                                                            <i class="fe fe-trash-2"></i>
                                                        </button>
                                                        <!-- <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button> -->
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
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="add-category">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Category Name"
                                value="{{ old('name') }}">
                            <span style="color: red">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
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
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editCategoryId" name="category_id">
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="editName" value="{{ $category->name ?? '' }}"
                                name="name">
                            <span style="color: red">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
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
<script>
    var statusRoute = `{{ route('categories.status') }}`;
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('admin/assets/js/status-update.js') }}"></script>
<script>
    function editCategory(categoryId, categoryName) {
        const form = document.getElementById('editCategoryForm');
        form.action = `/categories/${categoryId}`; // Ensure this matches your route
        document.getElementById('editCategoryId').value = categoryId;
        document.getElementById('editName').value = categoryName;
    }
</script>

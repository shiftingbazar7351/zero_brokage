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
                            data-bs-target="#add-category"><i class="fa fa-plus me-2"></i>Add Category</a>
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
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($categories->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center">No data found</td>
                                </tr>
                            @else
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="table-imgname">
                                                @if ($category->icon)
                                                    <img src="{{ Storage::url('assets/icon/' . $category->icon) }}" class="me-2"
                                                        alt="img">
                                                @else
                                                    No Image
                                                @endif
                                                <span>{{ $category->name }}</span>
                                            </div>
                                        </td>
                                        
                                        <!-- <button type="submit" class="fa-toggle-btn">
                                            <input type="hidden" name="status" value="{{ $category->status ? 0 : 1 }}">
                                            @if($category->status)
                                                <i class="fa fa-toggle-on"></i>
                                            @else
                                                <i class="fa fa-toggle-off"></i>
                                            @endif
                                        </button> -->

                                        <div class="active-switch">
            <label class="switch">
                <input type="checkbox" 
                       onchange="toggleStatus(this, {{ $category->id }})"
                       {{ $category->status ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </div>

                                        <td>
                                            <div class="table-actions d-flex justify-content-center">
                                                <button class="btn delete-table me-2"
                                                    onclick="editCategory({{ $category->id }})" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#edit-category">
                                                    <i class="fe fe-edit"></i>
                                                </button>

                                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn delete-table"
                                                        onclick="return confirm('Are you sure you want to delete this sub-category?');">
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
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category Image</label>
                        <div class="form-uploads">
                            <div class="form-uploads-path">
                                <img src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img">
                                <div class="file-browse">
                                    <h6>Drag & drop image or </h6>
                                    <div class="file-browse-path">
                                        <input type="file" name="icon">
                                        <a href="javascript:void(0);"> Browse</a>
                                    </div>
                                </div>
                                <h5>Supported formats: JPEG, PNG</h5>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category Background-Image</label>
                        <div class="form-uploads">
                            <div class="form-uploads-path">
                                <img src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img">
                                <div class="file-browse">
                                    <h6>Drag & drop image or </h6>
                                    <div class="file-browse-path">
                                        <input type="file" name="image">
                                        <a href="javascript:void(0);"> Browse</a>
                                    </div>
                                </div>
                                <h5>Supported formats: JPEG, PNG</h5>
                            </div>
                        </div>
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
                        <input type="text" class="form-control" id="editName" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category Image</label>
                        <div class="form-uploads">
                            <div class="form-uploads-path">
                                <img src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img">
                                <div class="file-browse">
                                    <h6>Drag & drop image or </h6>
                                    <div class="file-browse-path">
                                        <input type="file" id="editIcon" name="icon">
                                        <a href="javascript:void(0);"> Browse</a>
                                    </div>
                                </div>
                                <h5>Supported formats: JPEG, PNG</h5>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category Background-Image</label>
                        <div class="form-uploads">
                            <div class="form-uploads-path">
                                <img src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img">
                                <div class="file-browse">
                                    <h6>Drag & drop image or </h6>
                                    <div class="file-browse-path">
                                        <input type="file" id="editImage" name="image">
                                        <a href="javascript:void(0);"> Browse</a>
                                    </div>
                                </div>
                                <h5>Supported formats: JPEG, PNG</h5>
                            </div>
                        </div>
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



<div class="modal fade" id="delete-category">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <div class="text-center">
                    <i class="fe fe-trash-2 text-danger fs-1"></i>
                    <div class="mt-4">
                        <h4>Delete Category?</h4>
                        <p class="text-muted mb-0">Are you sure want to delete this?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="button" class="btn w-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger">Yes, Delete It!</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function editCategory(id) {
        $.ajax({
            url: '/categories/' + id + '/edit',
            method: 'GET',
            success: function (response) {
                $('#editCategoryId').val(response.category.id);
                $('#editName').val(response.category.name);
                $('#editCategoryModal').modal('show');
                $('#editCategoryForm').attr('action', '/categories/' + id);
            }
        });
    }

function toggleStatus(checkbox, categoryId) {
    var form = checkbox.closest('form');
    var hiddenInput = form.querySelector('.status-input');
    
    hiddenInput.value = checkbox.checked ? 1 : 0;
    
    form.submit();
}
</script>

@endsection
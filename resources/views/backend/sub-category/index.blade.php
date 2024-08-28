@extends('backend.layouts.main')

@section('styles')
    <style>
        .preview-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Categories</h5>
                <div class="list-btn">
                    <ul>
                        <li>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#add-category">
                                <i class="fa fa-plus me-2"></i>Add Sub-Category
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-resposnive table-div">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Category Name</th>
                                    <th>Sub Category Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subcategories as $subcategory)
                                    <tr>
                                        <td>{{ $subcategory->id }}</td>
                                        <td>
                                            <div class="table-imgname">
                                                @if ($subcategory->icon)
                                                    <img src="{{ Storage::url('icon/' . $subcategory->icon) }}"
                                                        class="me-2 preview-img" alt="img">
                                                @else
                                                    No Image
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $subcategory->categoryName->name ?? '' }}</td>
                                        <td>{{ $subcategory->name ?? '' }}</td>
                                        <td>
                                            <div class="active-switch">
                                                <label class="switch">
                                                    <input type="checkbox" class="status-toggle"
                                                        data-id="{{ $subcategory->id }}"
                                                        onclick="return confirm('Are you sure want to change status?')"
                                                        {{ $subcategory->status ? 'checked' : '' }}>
                                                    <span class="sliders round"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-actions d-flex justify-content-center">
                                                <button class="btn delete-table me-2"
                                                    onclick="editSubCategory({{ $subcategory->id }})" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#edit-category">
                                                    <i class="fe fe-edit"></i>
                                                </button>
                                                <form action="{{ route('subcategories.destroy', $subcategory->id) }}"
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
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="addSubCategoryForm" action="{{ route('subcategories.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="category">Category Name</label>
                            <select class="form-control" id="category" name="category_id">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div id="category_id_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sub Category Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Category Name">
                            <div id="name_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="trending" id="trending"
                                    value="1">
                                <label class="form-check-label" for="trending">Is Trending</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="featured" id="featured"
                                    value="1">
                                <label class="form-check-label" for="featured">Is Featured</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sub Category Image</label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="image-preview-icon" src="{{ asset('admin/assets/img/icons/upload.svg') }}"
                                        alt="img" class="default-img">
                                    <div class="file-browse">
                                        <input type="file" name="icon" id="image-input-icon"
                                            accept="image/jpeg, image/png">
                                        <a href="javascript:void(0);"> Browse</a>
                                    </div>
                                    <div id="icon_error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sub Category Background Image</label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="image-preview-bg" src="{{ asset('admin/assets/img/icons/upload.svg') }}"
                                        alt="img" class="default-img">
                                    <div class="file-browse">
                                        <input type="file" name="background_image" id="image-input-bg"
                                            accept="image/jpeg, image/png">
                                        <a href="javascript:void(0);"> Browse</a>
                                    </div>
                                    <div id="background_image_error" class="text-danger"></div>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="editSubCategoryForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editSubCategoryId" name="id">
                        <div class="mb-3">
                            <label for="categoryName">Category Name</label>
                            <select class="form-control" id="categoryName" name="category_id">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div id="category_id_error_edit" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sub Category Name</label>
                            <input type="text" class="form-control" id="editName" name="name">
                            <div id="name_error_edit" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="trending" id="is_trending"
                                    value="">
                                <label class="form-check-label" for="is_trending">Is Trending</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="featured" id="is_featured"
                                    value="">
                                <label class="form-check-label" for="is_featured">Is Featured</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sub Category Image</label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="edit-image-preview-icon"
                                        src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img"
                                        class="default-img preview-img">
                                    <div class="file-browse">
                                        <input type="file" name="icon" id="edit-image-input-icon"
                                            accept="image/jpeg, image/png">
                                        <a href="javascript:void(0);"> Browse</a>
                                    </div>
                                    <div id="icon_error_edit" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sub Category Background Image</label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="edit-image-preview-bg"
                                        src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img"
                                        class="default-img preview-img">
                                    <div class="file-browse">
                                        <input type="file" name="background_image" id="edit-image-input-bg"
                                            accept="image/jpeg, image/png">
                                        <a href="javascript:void(0);"> Browse</a>
                                    </div>
                                    <div id="background_image_error_edit" class="text-danger"></div>
                                </div>
                            </div>
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

@section('scripts')
    <script>
        var statusRoute = `{{ route('subcategories.status') }}`;
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('admin/assets/js/status-update.js') }}"></script>
    <script src="{{ asset('admin/assets/js/preview-img.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#addSubCategoryForm').off('submit').on('submit', function(e) {
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
                        $('#category_id_error').text(xhr.responseJSON.errors.category_id ? xhr
                            .responseJSON.errors.category_id[0] : '');
                        $('#name_error').text(xhr.responseJSON.errors.name ? xhr.responseJSON
                            .errors.name[0] : '');
                        $('#icon_error').text(xhr.responseJSON.errors.icon ? xhr.responseJSON
                            .errors.icon[0] : '');
                        $('#background_image_error').text(xhr.responseJSON.errors
                            .background_image ? xhr.responseJSON.errors.background_image[
                            0] : '');
                    }
                });
            });
        });



        // Edit Subcategory
        window.editSubCategory = function(id) {
            $.ajax({
                url: `/subcategories/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    console.log(response)
                    $('#editSubCategoryId').val(response.subcategory.id);
                    $('#categoryName').val(response.subcategory.category_id);
                    $('#editName').val(response.subcategory.name);
                    $('#is_trending').prop('checked', response.subcategory.trending);
                    $('#is_featured').prop('checked', response.subcategory.featured);
                    if (response.subcategory.icon) {
                        $('#edit-image-preview-icon').attr('src',
                            `/storage/icon/${response.subcategory.icon}`);
                    }
                    if (response.subcategory.background_image) {
                        $('#edit-image-preview-bg').attr('src',
                            `/storage/background_image/${response.subcategory.background_image}`);
                    }
                }
            });
        }

        // Update Subcategory
        $('#editSubCategoryForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let id = $('#editSubCategoryId').val();
            // alert(id);
            // false
            $.ajax({
                type: 'POST',
                url: `/subcategories/${id}`,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        location.reload(); // Refresh page to show updated data
                    }
                },
                error: function(xhr) {
                    $('#category_id_error_edit').text(xhr.responseJSON.errors.category_id ? xhr
                        .responseJSON.errors.category_id[0] : '');
                    $('#name_error_edit').text(xhr.responseJSON.errors.name ? xhr.responseJSON.errors
                        .name[0] : '');
                    $('#icon_error_edit').text(xhr.responseJSON.errors.icon ? xhr.responseJSON.errors
                        .icon[0] : '');
                    $('#background_image_error_edit').text(xhr.responseJSON.errors.background_image ?
                        xhr.responseJSON.errors.background_image[0] : '');
                }
            });
        });
    </script>
@endsection

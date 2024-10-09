@extends('backend.layouts.main')

@section('styles')
    <style>
        .preview-img {
            width: 150px;
        }
    </style>
@endsection

@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Sub Categories</h5>
                <div class="list-btn d-flex gap-3">
                    <div class="page-headers">
                        <div class="search-bar">
                            <span><i class="fe fe-search"></i></span>
                            <input type="text" id="search" placeholder="Search" class="form-control">
                        </div>
                    </div>
                    @can('subcategory-create')
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
                    @endcan
                </div>
            </div>
            <div class="row text-center">
                <div class="col-12">
                    <div class="table-resposnive table-div">
                        
                        <div id="usersTable">
                            @include('backend.sub-category.partials.subcategory-index') {{-- Load the users list initially --}}
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
                    <h5 class="modal-title">Add Sub Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="addSubCategoryForm" action="{{ route('subcategories.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Sub Category Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Category Name">
                            <div id="name_error" class="text-danger"></div>
                        </div>
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
                            <label class="form-label">Image </label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="image-preview-icon" src="{{ asset('admin/assets/img/icons/upload.svg') }}"
                                        alt="img" class="default-img">
                                    <div class="file-browse">
                                        <h6>Drag & drop image or </h6>
                                        <div class="file-browse-path">
                                            <input type="file" name="icon" id="image-input-icon" accept="image/*">
                                            <a href="javascript:void(0);"> Browse</a>
                                        </div>
                                    </div>
                                    <h5>Supported formats: JPEG, PNG</h5>
                                </div>
                            </div>
                            <div id="icon_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Background Image</label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="image-preview-bg" src="{{ asset('admin/assets/img/icons/upload.svg') }}"
                                        alt="img" class="default-img">
                                    <div class="file-browse">
                                        <h6>Drag & drop image or </h6>
                                        <div class="file-browse-path">
                                            <input type="file" name="background_image" id="image-input-bg"
                                                accept="image/*">
                                            <a href="javascript:void(0);"> Browse</a>
                                        </div>
                                    </div>
                                    <h5>Supported formats: JPEG, PNG</h5>
                                </div>
                            </div>
                            <div id="background_image_error" class="text-danger"></div>
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
                            <label class="form-label">Sub Category Name</label>
                            <input type="text" class="form-control" id="editName" name="name">
                            <div id="name_error_edit" class="text-danger"></div>
                        </div>
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
                            <label class="form-label">Image</label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="edit-image-preview-icon"
                                        src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img"
                                        class="default-img prev">
                                    <div class="file-browse">
                                        <h6>Drag & drop image or </h6>
                                        <div class="file-browse-path">
                                            <input type="file" name="icon" id="edit-image-input-icon"
                                                accept="image/*">
                                            <a href="javascript:void(0);"> Browse</a>
                                        </div>
                                    </div>
                                    <h5>Supported formats: JPEG, PNG</h5>
                                </div>
                            </div>
                            <div id="icon_error_edit" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Background Image</label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="edit-image-preview-bg"
                                        src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img"
                                        class="default-img prev">
                                    <div class="file-browse">
                                        <h6>Drag & drop image or </h6>
                                        <div class="file-browse-path">
                                            <input type="file" name="background_image" id="edit-image-input-bg"
                                                accept="image/jpeg, image/png">
                                            <a href="javascript:void(0);"> Browse</a>
                                        </div>
                                    </div>
                                    <h5>Supported formats: JPEG, PNG</h5>
                                </div>
                            </div>
                            <div id="background_image_error_edit" class="text-danger"></div>
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
        var searchRoute = `{{ route('subcategories.index') }}`;
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('admin/assets/js/search.js') }}"></script>
    <script src="{{ asset('admin/assets/js/status-update.js') }}"></script>
    <script src="{{ asset('admin/assets/js/preview-img.js') }}"></script>
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

        // Event listener for background image preview
        $('#edit-image-input-bg').on('change', function() {
            previewImage(this, 'edit-image-preview-bg');
        });
    </script>
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

            // Check if 'icon' file input is empty, if so, remove it from FormData
            if (!$('#edit-image-input-icon').val()) {
                formData.delete('icon');
            }

            // Check if 'background_image' file input is empty, if so, remove it from FormData
            if (!$('#edit-image-input-bg').val()) {
                formData.delete('background_image');
            }

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

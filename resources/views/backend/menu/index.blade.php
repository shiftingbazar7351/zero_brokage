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
                <h5>Menus</h5>
                <div class="list-btn">
                    <ul>
                        <li>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#add-category">
                                <i class="fa fa-plus me-2"></i>Add Menu
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive table-div">
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
                                @if ($menusCat->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($menusCat as $menu)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="table-imgname">
                                                    @if ($menu->image)
                                                        <img src="{{ Storage::url('menu/' . $menu->image) }}"
                                                            class="me-2" alt="img">
                                                    @else
                                                        No Image
                                                    @endif
                                                    <span>{{ $menu->name }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="active-switch">
                                                    <label class="switch">
                                                        <input type="checkbox" class="status-toggle"
                                                            data-id="{{ $menu->id }}"
                                                            {{ $menu->status ? 'checked' : '' }}>
                                                        <span class="sliders round"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="table-actions d-flex justify-content-center">
                                                    <button class="btn delete-table me-2"
                                                        onclick="editCategory({{ $menu->id }})" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#edit-category">
                                                        <i class="fe fe-edit"></i>
                                                    </button>
                                                    <form action="{{ route('menus.destroy', $menu->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn delete-table" type="submit"
                                                            data-bs-toggle="modal" data-bs-target="#delete-category">
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
                    <h5 class="modal-title">Add Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Menu Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Menu Name">
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-control" id="category" name="category_id">
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger category-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="subcategory" class="form-label">Subcategory</label>
                            <select class="form-control" id="subcategory" name="subcategory">
                                <option value="" selected>Select Subcategory</option>
                            </select>
                            <div class="text-danger subcategory_id-error"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Menu Image</label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="image-preview-icon" src="{{ asset('admin/assets/img/icons/upload.svg') }}"
                                        alt="img" class="default-img">
                                    <div class="file-browse">
                                        <h6>Drag & drop image or </h6>
                                        <div class="file-browse-path">
                                            <input type="file" name="image" id="image-input-icon"
                                                accept="image/jpeg, image/png">
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
                    <h5 class="modal-title">Edit Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editCategoryId" name="category_id">
                        <input type="hidden" id="editSubcategoryId" name="subcategory_id">

                        <div class="mb-3">
                            <label class="form-label">Menu Name</label>
                            <input type="text" class="form-control" id="editName" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="editCategory" class="form-label">Category</label>
                            <select class="form-control" id="editCategorySelect" name="category_id">
                                <option value="" disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editSubcategory" class="form-label">Subcategory</label>
                            <select class="form-control" id="editSubcategorySelect" name="subcategory">
                                <option value="" selected>Select Subcategory</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Menu Image</label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="background-preview"
                                         src="{{ isset($menu->image) ? Storage::url('menu/' .$menu->image) : asset('admin/assets/img/icons/upload.svg') }}"
                                         alt="img" width="100px" height="100px">
                                    <div class="file-browse">
                                        <h6>Drag & drop image or </h6>
                                        <div class="file-browse-path">
                                            <input type="file" id="editImage" name="image"
                                                   accept="image/jpeg, image/png">
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

@endsection

@section('scripts')
    <script>
        var statusRoute = `{{ route('menu.status') }}`;
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('admin/assets/js/status-update.js') }}"></script>
    <script src="{{ asset('admin/assets/js/preview-img.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#category').off('change').on('change', function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: '/fetch-subcategory/' + categoryId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#subcategory').empty().append(
                                '<option value="" selected disabled>Select Subcategory</option>'
                            );

                            if (response.status === 1 && response.data.length > 0) {
                                var subcategory = response.data;
                                $.each(subcategory, function(key, subcateg) {
                                    $('#subcategory').append('<option value="' +
                                        subcateg.id + '">' + subcateg.name +
                                        '</option>');
                                });
                            }
                        },
                        error: function() {
                            // Handle the error scenario
                            $('#subcategory').empty().append(
                                '<option value="" disabled>Error loading subcategories</option>'
                            );
                        }
                    });
                } else {
                    $('#subcategory').empty().append(
                        '<option value="" selected disabled>Select Subcategory</option>');
                }
            });

            $('#addEnquiryModal').on('hidden.bs.modal', function() {
                $('#enquiryForm')[0].reset();
                $('#subcategory').empty().append(
                    '<option value="" selected disabled>Select Subcategory</option>');
            });


            // for store the data
            $('#enquiryForm').off('submit').on('submit', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                var url = $(this).attr('action');

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    success: function(response) {

                        var message = response.message === 'Submitted Successfully';
                        $('#addEnquiryModal').modal(message ? 'hide' : 'show');
                        $("#addEnquiryModal .success-msg").toggle(message).delay(3000).hide(0);
                        setTimeout(function() {
                            window.location.reload();
                        }, message ? 3000 : 0);
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        $('.text-danger').text('');

                        $.each(errors, function(key, value) {
                            var errorElement = $('.' + key + '-error');
                            errorElement.text(value[0]);

                        });
                    }
                });
            });
        });

        function editCategory(id) {
            $.ajax({
                url: `/menus/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    const {
                        id,
                        name,
                        category_id,
                        subcategory_id,
                        image
                    } = response.category;

                    $('#editCategoryId').val(id);
                    $('#editName').val(name);
                    $('#editCategoryForm').attr('action', `/menus/${id}`);

                    $('#editCategorySelect').val(category_id).trigger('change');
                    $('#editSubcategorySelect').empty().append(
                        '<option value="" selected>Select Subcategory</option>');

                    if (subcategory_id) {
                        $('#editSubcategorySelect').append(
                            `<option value="${subcategory_id}" selected>Selected Subcategory</option>`);
                    }

                    const updateImagePreview = (selector, filePath) => {
                        const imageUrl = filePath ? `{{ Storage::url('assets/menu/') }}/${filePath}` :
                            `{{ asset('admin/assets/img/icons/upload.svg') }}`;
                        $(selector).attr('src', imageUrl);
                    };

                    updateImagePreview('#icon-preview', image);

                    $('#edit-category').modal('show');
                }
            });
        }

        // Fetch subcategories based on category selection in the Edit form
        $('#editCategorySelect').on('change', function() {
            var categoryId = $(this).val();
            if (categoryId) {
                $.ajax({
                    url: '/fetch-subcategory/' + categoryId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 1) {
                            var subcategories = response.data;
                            $('#editSubcategorySelect').empty().append(
                                '<option value="" selected>Select Subcategory</option>');
                            $.each(subcategories, function(key, subcategory) {
                                $('#editSubcategorySelect').append('<option value="' +
                                    subcategory.id + '">' + subcategory.name + '</option>');
                            });
                        }
                    }
                });
            } else {
                $('#editSubcategorySelect').empty().append('<option value="">Select Subcategory</option>');
            }
        });
    </script>
@endsection

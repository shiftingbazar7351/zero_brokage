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
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#add-category">
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
                                                        <img src="{{ Storage::url('assets/menu/' . $menu->image) }}" class="me-2" alt="img">
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
                                                    <button class="btn delete-table me-2" onclick="editCategory({{ $menu->id }})" type="button" data-bs-toggle="modal" data-bs-target="#edit-category">
                                                        <i class="fe fe-edit"></i>
                                                    </button>
                                                    <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn delete-table" type="submit" data-bs-toggle="modal" data-bs-target="#delete-category">
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
                            <select class="form-control" id="category" name="category">
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
                                    <img id="image-preview-icon" src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img" class="default-img">
                                    <div class="file-browse">
                                        <h6>Drag & drop image or </h6>
                                        <div class="file-browse-path">
                                            <input type="file" name="image" id="image-input-icon" accept="image/jpeg, image/png">
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
                                    <img id="icon-preview" src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img" width="100px" height="100px" class="preview-img">
                                    <div class="file-browse">
                                        <h6>Drag & drop image or </h6>
                                        <div class="file-browse-path">
                                            <input type="file" id="editIcon" name="image" accept="image/jpeg, image/png">
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

$('#category').on('change', function() {
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
                                var subcategory = response.data;
                                $('#subcategory').empty().append(
                                    '<option value="" selected disabled>Select Subcategory</option>'
                                );
                                $.each(subcategory, function(key, subcateg) {
                                    $('#subcategory').append('<option value="' +
                                        subcateg.id + '">' + subcateg.name +
                                        '</option>');
                                });
                            }
                        }
                    });
                } else {
                    $('#subcategory').empty().append('<option value="">Select Subcategory</option>');
                }
            });
            $('#addEnquiryModal').on('hidden.bs.modal', function() {
                $('#enquiryForm')[0].reset();
                $('#subcategory').empty().append('<option value="">Select Subcategory</option>');
            });

        function editCategory(id) {
            $.ajax({
                url: `/menus/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    const { id, name, category_id, subcategory_id, image } = response.category;

                    $('#editCategoryId').val(id);
                    $('#editName').val(name);
                    $('#editCategoryForm').attr('action', `/menus/${id}`);

                    $('#editCategorySelect').val(category_id).trigger('change');
                    $('#editSubcategorySelect').empty().append('<option value="" selected>Select Subcategory</option>');

                    if (subcategory_id) {
                        $('#editSubcategorySelect').append(`<option value="${subcategory_id}" selected>Selected Subcategory</option>`);
                    }

                    const updateImagePreview = (selector, filePath) => {
                        const imageUrl = filePath ? `{{ Storage::url('assets/menu/') }}/${filePath}` : `{{ asset('admin/assets/img/icons/upload.svg') }}`;
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
                            $('#editSubcategorySelect').empty().append('<option value="" selected>Select Subcategory</option>');
                            $.each(subcategories, function(key, subcategory) {
                                $('#editSubcategorySelect').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                            });
                        }
                    }
                });
            } else {
                $('#editSubcategorySelect').empty().append('<option value="">Select Subcategory</option>');
            }
        });

        // Handle image preview for Add and Edit modals
        function handleImagePreview(inputId, previewId) {
            document.getElementById(inputId).addEventListener('change', function(event) {
                const file = event.target.files[0];
                const preview = document.getElementById(previewId);

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.add('preview-img');
                    }
                    reader.readAsDataURL(file);
                } else {
                    preview.src = "{{ asset('admin/assets/img/icons/upload.svg') }}";
                    preview.classList.remove('preview-img');
                }
            });
        }

        handleImagePreview('image-input-icon', 'image-preview-icon');
        handleImagePreview('editIcon', 'icon-preview');

        // Handle status toggle through AJAX
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.status-toggle').forEach(function(toggle) {
                toggle.addEventListener('change', function() {
                    const itemId = this.getAttribute('data-id');
                    const status = this.checked ? 1 : 0;

                    fetch('{{ route('update.subcategorystatus') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ id: itemId, status: status })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log(data.message);
                        } else {
                            console.error(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            });


            $('#editCategory').on('change', function() {
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
                                var subcategory = response.data;
                                $('#editSubcategory').empty().append(
                                    '<option value="" selected disabled>Select Subcategory</option>'
                                );
                                $.each(subcategory, function(key, subcateg) {
                                    $('#editSubcategory').append('<option value="' +
                                        subcateg.id + '">' + subcateg.name +
                                        '</option>');
                                });
                            }
                        }
                    });
                } else {
                    $('#editSubcategory').empty().append('<option value="">Select Subcategory</option>');
                }
            });

            // Handle Edit Menu form submission
            // $('#editMenuForm').on('submit', function(e) {
            //     e.preventDefault();

            //     var formData = new FormData(this);
            //     var menuId = $('#editMenuForm').data('menu-id');

            //     $.ajax({
            //         url: '/menus/' + menuId,
            //         type: 'POST',
            //         data: formData,
            //         processData: false,
            //         contentType: false,
            //         success: function(response) {
            //             if (response.status === 1) {
            //                 $('#edit-category').modal('hide');
            //                 location.reload(); // Reload the page to reflect the changes
            //             } else {
            //                 console.log(response.errors);
            //             }
            //         },
            //         error: function(response) {
            //             console.error(response);
            //             // Handle error
            //         }
            //     });
            // });

            // Open the edit modal with existing data
            $('.edit-subcategory').on('click', function() {
                var menuId = $(this).data('id');
                $.ajax({
                    url: '/menus/' + menuId + '/edit',
                    type: 'GET',
                    success: function(response) {
                        // Populate the modal with existing data
                        $('#editMenuForm').data('menu-id', response.menu.id);
                        $('#editMenuName').val(response.menu.name);
                        $('#editCategory').val(response.menu.category_id);
                        $('#editSubcategory').val(response.menu.subcategory_id);
                        $('#edit-category').modal('show');
                    }
                });
            });

            // Reset form when modal is closed
            $('#edit-category').on('hidden.bs.modal', function() {
                $('#editMenuForm')[0].reset();
            });
            // Reset form when modal is closed
            $('#add-category').on('hidden.bs.modal', function() {
                $('#menuForm')[0].reset();
                $('#menuForm').data('edit-mode', false).data('menu-id', '');
                $('#add-category .modal-title').text('Add Menu');
            });


            function toggleStatus(checkbox, categoryId) {
                var form = checkbox.closest('form');
                var hiddenInput = form.querySelector('.status-input');
                hiddenInput.value = checkbox.checked ? 1 : 0;
                form.submit();
            }

            // for updating the status through ajax request
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.status-toggle').forEach(function(toggle) {
                    toggle.addEventListener('change', function() {
                        const itemId = this.getAttribute('data-id');
                        const status = this.checked ? 1 : 0;

                        fetch('{{ route('update.subcategorystatus') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute(
                                        'content')
                                },
                                body: JSON.stringify({
                                    id: itemId,
                                    status: status
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    console.log(data.message);
                                } else {
                                    console.error(data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    });
                });
            });

        });
    </script>
@endsection

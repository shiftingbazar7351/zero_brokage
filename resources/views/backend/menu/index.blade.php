@extends('backend.layouts.main')
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Menu</h5>
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
                    <div class="table-resposnive table-div">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($menusCat->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($menusCat as $menu)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $menu->name }}</td>
                                            <td>
                                                @if ($menu->image)
                                                    <img src="{{ Storage::url('assets/menu/' . $menu->image) }}"
                                                        class="img-thumbnail" width="50px">
                                                @else
                                                    No Image
                                                @endif
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
                                                <div class="d-flex">
                                                    <!-- Edit Button -->
                                                    <a class="btn delete-table me-2 edit-category"
                                                        data-id="{{ $menu->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#editCategoryModal">
                                                        <i class="fe fe-edit"></i>
                                                    </a>


                                                    <!-- Delete Button -->
                                                    <form action="{{ route('menus.destroy', $menu->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn  delete-table"
                                                            onclick="return confirm('Are you sure you want to delete this menu?');">
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
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <form id="menuForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Menu Name</label>
                            <input type="text" class="form-control" id="menuName" name="name"
                                placeholder="Enter Category Name">
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
                            <select class="form-control" id="subcategory" name="subcategory_id">
                                <option value="" disabled selected>Select Subcategory</option>
                            </select>
                            <div class="text-danger subcategory_id-error"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Menu Image</label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="image-preview-icon" src="{{ asset('admin/assets/img/menu/upload.svg') }}"
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

    @extends('backend.menu.edit')

@endsection

<script src="{{ asset('admin/assets/js/preview-img.js') }}"></script>
@section('scripts')
    <script>
        $(document).ready(function() {
            // Fetch subcategories based on category selection
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


            // Handle Add/Edit Menu form submission
            $('#menuForm').off('submit').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let url = '{{ route('menus.store') }}';
                let method = 'POST';

                // If editing, modify the URL and method
                if ($('#menuForm').data('edit-mode')) {
                    let menuId = $('#menuForm').data('menu-id');
                    url = '/menus/' + menuId;
                    method = 'POST'; // Laravel doesn't directly support PUT/PATCH via form submission
                    formData.append('_method', 'PATCH');
                }

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status === 1) {
                            $('#add-category').modal('hide');
                            location.reload(); // Reload the page to reflect the changes
                        } else {
                            console.log(response.errors);
                        }
                    },
                    error: function(response) {
                        console.error(response);
                        // Handle error
                    }
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

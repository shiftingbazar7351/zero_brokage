@extends('backend.layouts.main')

@section('styles')
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/ckeditor4@4.25.0/ckeditor.js"></script> --}}

    <style>
        .default-img {
            width: auto;
        }

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
                <h5>Sub Menu</h5>
                <div class="list-btn">
                    <ul>
                        <li>
                            <a href="{{ route('india-services.index') }}" class="btn btn-primary mb-3"> <i class="fa fa-plus"
                                    title="Add India services description"></i></a>
                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                                data-target="#addCategoryModal">
                                Add Sub Menu
                            </button>

                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="table-resposnive table-div">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($submenus->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($submenus as $subcategory)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $subcategory->name }}</td>

                                            <td>
                                                @if ($subcategory->image)
                                                    <img src="{{ Storage::url('submenu/' . $subcategory->image) }}"
                                                        class="img-thumbnail" width="50px">
                                                @else
                                                    No Image
                                                @endif
                                            </td>

                                            <td>
                                                <div class="active-switch">
                                                    <label class="switch">
                                                        <input type="checkbox" class="status-toggle"
                                                            data-id="{{ $subcategory->id }}"
                                                            {{ $subcategory->status ? 'checked' : '' }}>
                                                        <span class="sliders round"></span>
                                                    </label>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <button class="btn delete-table me-2"
                                                        onclick="editCategory({{ $subcategory->id }})" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#edit-category">
                                                        <i class="fe fe-edit"></i>
                                                    </button>


                                                    <!-- Delete Button -->
                                                    <form action="{{ route('submenu.destroy', $subcategory->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn delete-table"
                                                            onclick="return confirm('Are you sure you want to delete this Sub Menu?');">
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
    <div class="modal fade" id="addCategoryModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Sub Menu</h5>
                    <button type="button" class="btn-close close-modal" data-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addSubMenuForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                                <div id="name-error" class="text-danger"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="">Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div id="category-error" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="subcategory">Sub Category</label>
                                <select class="form-control" id="subcategory" name="subcategory_id">
                                    <option value="">Select subcategory</option>
                                </select>
                                <div id="subcategory_id-error" class="text-danger"></div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="menu">Menu</label>
                                    <select class="form-control" id="menu" name="menu">
                                    <option value="">Select menu</option>
                                </select>
                                <div id="menu-error" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="category">State</label>
                                <select class="form-control" id="state" name="state">
                                    <option value="">Select state</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ ucwords($state->name) }}</option>
                                    @endforeach
                                </select>
                                <div id="state-error" class="text-danger"></div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="category">City</label>
                                <select  class="form-control" id="city" name="city">
                                    <option value="">Select City</option>
                                </select>
                                <div id="city-error" class="text-danger"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="price">Price(INR)</label>
                                    <input type="text" class="form-control" id="price" name="total_price"
                                    placeholder="Enter Ammount">
                                <div id="price-error" class="text-danger"></div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="price">Discount(%)</label>
                                <input type="text" class="form-control"    ass="form-control" id="discount" name="discount"
                                    placeholder="Enter Discount percentage">
                                <div id="discount-error" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="final-price">Final Price (INR)</label>
                            <input type="text" class="form-control" id="final-price" name="final_price" readonly disabled>
                            <div id="final_price-error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sub Menu Image</label>
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
                            <div id="image-error" class="text-danger"></div>
                        </div>

                        <div class="form-group">
                            <label for="details" class="col-form-label">Details <span class="text-danger">*</span></label>
                            <textarea class="f    orm-control" id="details" placeholder="Enter Details" name="details">{{ old('details') }}</textarea>
                            <div id="details-error" class="text-danger"></div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control" id="description" name="descript    ion" placeholder="Enter Ammount"></textarea>
                            <div id="description-error" class="text-danger"></div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize CKEditor for t    he Details and Description fields
        CKEDITOR.replace('details');
    </script>


    <div class="modal fade" id="edit-category" tabindex="-1" aria-labelledby="editCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-he    ader">
                    <h5 class="modal-title">Edit Sub-Menu</h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Hidden IDs -->
                        <input type="hidden" id="editCategoryId" name="category_id">
                        <input type="hidden" id="editSubcategoryId" name="subcategory_id">
                        <input type="hidden" id="editMenuId" name="menu_id">
                        <input type="hidden" id="editSubmenuId" name="id">

                        <!-- Name Field -->
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="editName">Name</label>
                                <input type="text" class="form-control" id="editName" name="name"
                                    placeholder="Enter Submenu-Name">
                                <div id="editname-error" class="text-danger"></div>
                            </div>

                            <!-- Category Field -->
                            <div class="form-group col-md-6">
                                <label for="editCategorySelect" class="form-label">Category</label>
                                <select class="form-control" id="editCategorySelect" name="category_id">
                                    <option value="" disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div id="category_id-error" class="text-danger"></div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Subcategory Field -->
                            <div class="form-group col-md-6">
                                <label for="editSubcategorySelect" class="form-label">Subcategory</label>
                                <select class="form-control" id="editSubcategorySelect" name="subcategory_id">
                                    <option value="" selected>Select Subcategory</option>
                                </select>
                                <div id="subcategory_id-error" class="text-danger"></div>
                            </div>

                            <!-- Menu Field -->
                            <div class="form-group col-md-6">
                                <label for="editMenuSelect" class="form-label">Menu</label>
                                <select class="form-control" id="editMenuSelect" name="menu">
                                    <option value="" selected>Select Menu</option>
                                </select>
                                <div id="menu_id-error" class="text-danger"></div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="editState">State</label>
                                <select class="form-control" id="edit-state" name="state">
                                    <option value="">Select state</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ ucwords($state->name) }}</option>
                                    @endforeach
                                </select>
                                <div id="state-error" class="text-danger"></div>
                            </div>

                            <!-- City Field -->
                            <div class="form-group col-md-6">
                                <label for="editCity">City</label>
                                <select class="form-control" id="edit-city" name="city">
                                    <option value="">Select City</option>
                                </select>
                                <div id="city-error" class="text-danger"></div>
                            </div>
                        </div>
                        <!-- State Field -->

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="editPrice">Price (INR)</label>
                                <input type="text" class="form-control" id="edit-price" name="total_price"
                                    placeholder="Enter Amount">
                                <div id="price-error" class="text-danger"></div>
                            </div>

                            <!-- Discount Field -->
                            <div class="form-group col-md-6">
                                <label for="editDiscount">Discount (%)</label>
                                <input type="text" class="form-control" id="edit-discount" name="discount"
                                    placeholder="Enter Discount percentage">
                                <div id="discount-error" class="text-danger"></div>
                            </div>
                        </div>
                        <!-- Price Field -->


                        <!-- Final Price Field -->
                        <div class="form-group">
                            <label for="editFinalPrice">Final Price (INR)</label>
                            <input type="text" class="form-control" id="edit-final-price" name="final_price" readonly
                                disabled>
                            <div id="final_price-error" class="text-danger"></div>
                        </div>

                        <!-- Image Upload Field -->
                        <div class="mb-3">
                            <label class="form-label">Sub Menu Image</label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="background-preview" src="{{ asset('admin/assets/img/icons/upload.svg') }}"
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
                            <div id="image-error" class="text-danger"></div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-form-label">Details <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="edit-details" placeholder="Enter Details" name="details">{{ old('details') }}</textarea>
                            <div id="details-error" class="text-danger"></div>
                        </div>

                        <script>
                            // Initialize CKEditor for the edit-details field
                            CKEDITOR.replace('edit-details');
                        </script>


                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" cl                        ass="form-control" id="edit-description" name="description" placeholder="Enter Ammount"></textarea>
                            <div id="description-error" class="text-danger"></div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        var statusRoute = `{{ route('submenu.status') }}`;
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('admin/assets/js/status-update.js') }}"></script>
    <script src="{{ asset('admin/assets/js/preview-img.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //----------------Add form final price ---------------------------------//
            function calculateFinalPrice() {
                const price = parseFloat($('#price').val());
                const discountPercentage = parseFloat($('#discount').val());

                if (!isNaN(price) && !isNaN(discountPercentage)) {
                    const discountAmount = (price * discountPercentage) / 100;
                    const finalPrice = price - discountAmount;

                    $('#final-price').val(finalPrice.toFixed(2)); // Update the final price field
                } else {
                    $('#final-price').val(''); // Clear the final price field if inputs are invalid
                }
            }

            $('#price').on('input', calculateFinalPrice);
            $('#discount').on('input', calculateFinalPrice);


            //----------------Edit form final price ---------------------------------//
            function editcalculateFinalPrice() {
                const price = parseFloat($('#edit-price').val());
                const discountPercentage = parseFloat($('#edit-discount').val());

                if (!isNaN(price) && !isNaN(discountPercentage)) {
                    const discountAmount = (price * discountPercentage) / 100;
                    const finalPrice = price - discountAmount;

                    $('#edit-final-price').val(finalPrice.toFixed(2));
                } else {
                    $('#edit-final-price').val('');
                }
            }

            $('#edit-price').on('input', editcalculateFinalPrice);
            $('#edit-discount').on('input', editcalculateFinalPrice);



        });

        $(document).ready(function() {

            // Handle Add-SubMenu-form submission
            $('#addSubMenuForm').off('submit').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('submenu.store') }}",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        // Clear previous error messages
                        $('#name-error').text('');
                        $('#category-error').text('');
                        $('#subcategory_id-error').text('');
                        $('#menu-error').text('');
                        $('#state-error').text('');
                        $('#city-error').text('');
                        $('#price-error').text('');
                        $('#discount-error').text('');
                        $('#final_price-error').text('');
                        $('#image-error').text('');
                        $('#details-error').text('');
                        $('#description-error').text('');

                        // Display new error messages
                        if (xhr.responseJSON.errors) {
                            $('#name-error').text(xhr.responseJSON.errors.name ? xhr
                                .responseJSON.errors.name[0] : '');
                            $('#category-error').text(xhr.responseJSON.errors.category ? xhr
                                .responseJSON.errors.category[0] : '');
                            $('#subcategory_id-error').text(xhr.responseJSON.errors
                                .subcategory_id ? xhr.responseJSON.errors.subcategory_id[
                                    0] : '');
                            $('#menu-error').text(xhr.responseJSON.errors.menu ? xhr
                                .responseJSON.errors.menu[0] : '');
                            $('#state-error').text(xhr.responseJSON.errors.state ? xhr
                                .responseJSON.errors.state[0] : '');
                            $('#city-error').text(xhr.responseJSON.errors.city ? xhr
                                .responseJSON.errors.city[0] : '');
                            $('#price-error').text(xhr.responseJSON.errors.total_price ? xhr
                                .responseJSON.errors.total_price[0] : '');
                            $('#discount-error').text(xhr.responseJSON.errors.discount ? xhr
                                .responseJSON.errors.discount[0] : '');
                            $('#final_price-error').text(xhr.responseJSON.errors.final_price ?
                                xhr.responseJSON.errors.final_price[0] : '');
                            $('#image-error').text(xhr.responseJSON.errors.image ? xhr
                                .responseJSON.errors.image[0] : '');
                            $('#details-error').text(xhr.responseJSON.errors.details ? xhr
                                .responseJSON.errors.details[0] : '');
                            $('#description-error').text(xhr.responseJSON.errors.description ?
                                xhr.responseJSON.errors.description[0] : '');
                        }
                    }
                });
            });
            // Populate Subcategories
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
                            $('#subcategory').empty().append(
                                '<option value="" selected disabled>Select Subcategory</option>'
                            );
                            if (response.status === 1 && response.data.length > 0) {
                                $.each(response.data, function(key, subcateg) {
                                    $('#subcategory').append(
                                        '<option value="' +
                                        subcateg.id + '">' + subcateg
                                        .name +
                                        '</option>');
                                });
                            } else {
                                $('#subcategory').append(
                                    '<option value="" disabled>No subcategories found</option>'
                                );
                            }
                        },
                        error: function() {
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

            // Populate Menus
            $('#subcategory').on('change', function() {
                var subcategoryId = $(this).val();
                if (subcategoryId) {
                    $.ajax({
                        url: '/getMenus/' + subcategoryId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#menu').empty().append(
                                '<option value="" selected disabled>Select Menu</option>'
                            );
                            if (response.status === 1 && response.data.length > 0) {
                                $.each(response.data, function(key, menu) {
                                    $('#menu').append('<option value="' +
                                        menu.id +
                                        '">' + menu.name + '</option>');
                                });
                            } else {
                                $('#menu').append(
                                    '<option value="" disabled>No menus available</option>'
                                );
                            }
                        },
                        error: function(xhr) {
                            console.error('Error loading menus:', xhr);
                            $('#menu').empty().append(
                                '<option value="" disabled>Error loading menus</option>'
                            );
                        }
                    });
                } else {
                    $('#menu').empty().append(
                        '<option value="" selected disabled>Select Menu</option>'
                    );
                }
            });


            // Populate Cities
            $('#state').on('change', function() {
                var stateId = $(this).val();
                if (stateId) {
                    $.ajax({
                        url: '/fetch-city/' + stateId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#city').empty().append(
                                '<option value="">Select city</option>');
                            if (response.status === 1) {
                                $.each(response.data, function(key, city) {
                                    $('#city').append("<option value='" +
                                        city.id +
                                        "'>" + city.name + "</option>");
                                });
                            }
                        },
                        error: function() {
                            $('#city').empty().append(
                                '<option value="" disabled>Error loading cities</option>'
                            );
                        }
                    });
                } else {
                    $('#city').empty().append('<option value="">Select city</option>');
                }
            });

            // Populate Subcategories in Edit Modal
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
                            // console.log(response)
                            $('#editSubcategorySelect').empty().append(
                                '<option value="" selected>Select Subcategory</option>'
                            );
                            if (response.status === 1) {
                                $.each(response.data, function(key, subcategory) {
                                    $('#editSubcategorySelect').append(
                                        '<option value="' + subcategory
                                        .id + '">' +
                                        subcategory.name + '</option>');
                                });
                            }
                        },
                        error: function() {
                            $('#editSubcategorySelect').empty().append(
                                '<option value="" disabled>Error loading subcategories</option>'
                            );
                        }
                    });
                } else {
                    $('#editSubcategorySelect').empty().append(
                        '<option value="">Select Subcategory</option>');
                }
            });

            // Event handler for changing subcategory
            $('#editSubcategorySelect').on('change', function() {
                var subcategory_id = $(this).val();
                if (subcategory_id) {
                    $.ajax({
                        url: '/getMenus/' + subcategory_id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log(response)
                            $('#editmenuSelect').empty().append(
                                '<option value="" selected>Select Menu</option>'
                            );
                            if (response.status === 1) {
                                $.each(response.data, function(key, menu) {
                                    $('#editmenuSelect').append(
                                        '<option value="' + menu.id +
                                        '">' +
                                        menu.name + '</option>'
                                    );
                                });
                            }
                        },
                        error: function() {
                            $('#editmenuSelect').empty().append(
                                '<option value="" disabled>Error loading menus</option>'
                            );
                        }
                    });
                } else {
                    $('#editmenuSelect').empty().append(
                        '<option value="">Select Menu</option>'
                    );
                }
            });

            // Function to handle editing a category
            window.editCategory = function(id) {
                $.ajax({
                    url: `/submenu/${id}/edit`,
                    method: 'GET',
                    success: function(response) {
                        $('#editSubmenuId').val(response.data.id);
                        $('#editName').val(response.data.name);
                        $('#edit-price').val(response.data.total_price);
                        $('#edit-discount').val(response.data.discount);
                        $('#edit-final-price').val(response.data.final_price);
                        $('#editCategorySelect').val(response.data.category_id).trigger(
                            'change');
                        $('#editSubcategory').val(response.data.subcategory_id).trigger(
                            'change');

                        // Fetch and populate subcategories based on the selected category
                        $.ajax({
                            url: `/fetch-subcategory/${response.data.category_id}`,
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(subResponse) {
                                $('#editSubcategorySelect').empty().append(
                                    '<option value="" selected>Select Subcategory</option>'
                                );
                                subResponse.data.forEach(sub => {
                                    $('#editSubcategorySelect')
                                        .append(
                                            `<option value="${sub.id}" ${sub.id == response.data.subcategory_id ? 'selected' : ''}>${sub.name}</option>`
                                        );
                                });

                            },
                            error: function(xhr) {
                                console.error(
                                    'Error fetching subcategories:', xhr
                                    .responseText);
                            }
                        });

                        // After fetching subcategories, fetch menus based on selected subcategory
                        $.ajax({
                            url: `/getMenus/${response.data.subcategory_id}`,
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(menuResponse) {
                                console.log(menuResponse)
                                $('#editmenuSelect').empty().append(
                                    '<option value="" selected>Select Menu</option>'
                                );
                                menuResponse.data.forEach(menu => {
                                    console.log(menu.name)
                                    $('#editmenuSelect')
                                        .append(
                                            `<option value="${menu.id}" ${menu.id == response.data.menu_id ? 'selected' : ''}>${menu.name}</option>`
                                        );
                                });
                            },
                            error: function(xhr) {
                                console.error(
                                    'Error fetching menus:', xhr
                                    .responseText);
                            }
                        });


                        // Set image preview
                        if (response.data.image) {
                            $('#background-preview').attr('src',
                                `/storage/submenu/${response.data.image}`);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error fetching the submenu data:', xhr
                            .responseText);
                    }
                });
            };



            $('#editCategoryForm').on('submit', function(e) {
                e.preventDefault();

                let id = $('#editSubmenuId').val();
                let formData = new FormData(this);

                $.ajax({
                    method: 'POST',
                    url: `/submenu/${id}`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            if (response.success) {
                                location.reload(); // Refresh page to show updated data
                            }
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        $('#editCategoryForm .name-error').text(errors.name ? errors.name[0] :
                            '');
                        $('#editCategoryForm .category_id-error').text(errors.category_id ?
                            errors.category_id[0] : '');
                        $('#editCategoryForm .subcategory-error').text(errors.subcategory ?
                            errors.subcategory[0] : '');
                        $('#editCategoryForm .image-error').text(errors.image ? errors.image[
                            0] : '');
                    }
                });
            });

            // Function to display validation errors (optional helper function)
            function displayErrors(errors) {
                for (let field in errors) {
                    $(`.${field}-error`).text(errors[field][0]);
                }
            }


        });
    </script>
@endsection

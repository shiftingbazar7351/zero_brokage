@extends('backend.layouts.main')
@section('content')
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
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Sub Menu</h5>
                <div class="list-btn">
                    <ul>
                        <li>
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
                                                    <form action="{{ route('subcategories.destroy', $subcategory->id) }}"
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
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('submenu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="">Select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="subcategory">Sub Category</label>
                            <select class="form-control" id="subcategory" name="subcategory_id" required>
                                <option value="">Select subcategory</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="menu">Menu</label>
                            <select class="form-control" id="menu" name="menu_id" required>
                                <option value="">Select menu</option>
                            </select>
                        </div>

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('#category').on('change', function() {
                                    var categoryId = $(this).val();
                                    if (categoryId) {
                                        $.ajax({
                                            url: '/getSubcategories/' + categoryId,
                                            type: 'GET',
                                            success: function(data) {
                                                $('#subcategory').empty();
                                                $('#subcategory').append(
                                                    '<option value="">Select subcategory</option>');
                                                $.each(data, function(key, value) {
                                                    $('#subcategory').append('<option value="' + value.id +
                                                        '">' + value.name + '</option>');
                                                });
                                            }
                                        });
                                    } else {
                                        $('#subcategory').empty();
                                        $('#subcategory').append('<option value="">Select subcategory</option>');
                                    }
                                });

                                $('#subcategory').on('change', function() {
                                    var subcategoryId = $(this).val();
                                    if (subcategoryId) {
                                        $.ajax({
                                            url: '/getMenus/' + subcategoryId,
                                            type: 'GET',
                                            success: function(data) {
                                                $('#menu').empty();
                                                $('#menu').append('<option value="">Select menu</option>');
                                                $.each(data, function(key, value) {
                                                    $('#menu').append('<option value="' + value.id + '">' +
                                                        value.name + '</option>');
                                                });
                                            }
                                        });
                                    } else {
                                        $('#menu').empty();
                                        $('#menu').append('<option value="">Select menu</option>');
                                    }
                                });
                            });
                        </script>


                        <div class="form-group">
                            <label for="category">State</label>
                            <select class="form-control" id="state" name="state">
                                <option value="">Select state</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ ucwords($state->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category">City</label>
                            <select class="form-control" id="city" name="city">
                                <option value="">Select City</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">Price(INR)</label>
                            <input type="text" class="form-control" id="price" name="price"
                                placeholder="Enter Ammount">
                        </div>

                        <div class="form-group">
                            <label for="price">Discount(%)</label>
                            <input type="text" class="form-control" id="discount" name="discount"
                                placeholder="Enter Discount percentage">
                        </div>

                        <div class="form-group">
                            <label for="final-price">Final Price (INR)</label>
                            <input type="text" class="form-control" id="final-price" name="final_price" readonly
                                disabled>
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
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-category" tabindex="-1" aria-labelledby="editCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Subcategory</h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editCategoryId" name="category_id">
                        <input type="hidden" id="editSubcategoryId" name="subcategory_id">
                        <input type="hidden" id="editMenuId" name="menu_id">

                        <div class="form-group">
                            <label for="edit-name">Name</label>
                            <input type="text" class="form-control" id="editName" name="name"
                                placeholder="Enter Submenu-Name">
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
                            <label for="editMenu" class="form-label">Menu</label>
                            <select class="form-control" id="editSubcategorySelect" name="menu">
                                <option value="" selected>Select Menu</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category">State</label>
                            <select class="form-control" id="state" name="state">
                                <option value="">Select state</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ ucwords($state->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category">City</label>
                            <select class="form-control" id="city" name="city">
                                <option value="">Select City</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="price">Price(INR)</label>
                            <input type="text" class="form-control" id="edit-price" name="price"
                                placeholder="Enter Ammount" value="{{ old('price', $subcategory->total_price ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label for="price">Discount(%)</label>
                            <input type="text" class="form-control" id="edit-discount" name="discount"
                                placeholder="Enter Discount percentage"
                                value="{{ old('discount', $subcategory->discount ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label for="final-price">Final Price (INR)</label>
                            <input type="text" class="form-control" id="edit-final-price" name="edit_final_price"
                                value="{{ old('edit_final_price', $subcategory->edit_final_price ?? '') }}" readonly
                                disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sub Menu Image</label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="background-preview"
                                        src="{{ isset($subcategory->image) ? Storage::url('submenu/' . $subcategory->image) : asset('admin/assets/img/icons/upload.svg') }}"
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
            // When the modal is shown, populate the form fields with the subcategory data
            $('#editCategoryModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                // Extract info from data-* attributes
                var id = button.data('id');
                var name = button.data('name');
                var category = button.data('category_id');
                var state = button.data('state');
                var city = button.data('city');
                var price = button.data('price');
                var discount = button.data('discount');
                var image = button.data('image');
                n
                // Update the modal's form action
                var formAction = '{{ url('subcategories') }}/' + id;
                $(this).find('form').attr('action', formAction);

                // Populate the form fields
                $(this).find('#edit-name').val(name);
                $(this).find('#edit-category').val(category);
                $(this).find('#editstate').val(state);
                $(this).find('#editcity').val(city);
                $(this).find('#edit-price').val(price);
                $(this).find('#edit-discount').val(discount);

                // Update the image preview
                if (image) {
                    $(this).find('#icon-preview').attr('src', image);
                } else {
                    $(this).find('#icon-preview').attr('src',
                        '{{ asset('admin/assets/img/icons/upload.svg') }}');
                }

                // Trigger change event on state dropdown to fetch cities (if applicable)
                $('#editstate').trigger('change');
            });

            // Function to calculate final price in the edit modal
            function calculateFinalPrice() {
                const price = parseFloat(document.getElementById('edit-price').value);
                const discountPercentage = parseFloat(document.getElementById('edit-discount').value);

                if (!isNaN(price) && !isNaN(discountPercentage)) {
                    const discountAmount = (price * discountPercentage) / 100;
                    const finalPrice = price - discountAmount;

                    document.getElementById('edit-final-price').value = finalPrice.toFixed(2);
                } else {
                    document.getElementById('edit-final-price').value = '';
                }
            }

            document.getElementById('edit-price').addEventListener('input', calculateFinalPrice);
            document.getElementById('edit-discount').addEventListener('input', calculateFinalPrice);
        });


        $(document).ready(function() {
            $('#editstate').on('change', function() {
                var stateId = $(this).val();
                if (stateId) {
                    $.ajax({
                        url: '/fetch-city/' + stateId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status === 1) {
                                var cities = response.data;
                                $('#editcity').find('option')
                                    .remove(); // Clear existing options
                                var options =
                                    '<option value="">Select city</option>'; // Default option
                                $.each(cities, function(key, city) {
                                    options += "<option value='" + city.id + "'>" + city
                                        .name + "</option>";
                                });
                                $('#editcity').append(options);
                                $('#editcity').val(city);
                            }
                        }
                    });
                } else {
                    $('#editcity').find('option').remove(); // Clear options if no state is selected
                    $('#editcity').append('<option value="">Select city</option>');
                }
            });

            // Trigger change event to load cities when the modal is shown
            $('#editCategoryModal').on('show.bs.modal', function(event) {
                $('#editstate').trigger('change');
            });
        });


        $(document).ready(function() {
            $('#state').on('change', function() {
                var stateId = $(this).val();
                if (stateId) {
                    $.ajax({
                        url: '/fetch-city/' + stateId, // Adjusted URL based on route
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}' // Include CSRF token for security
                        },
                        success: function(response) {
                            if (response.status === 1) {
                                var cities = response.data;
                                console.log(cities);
                                $('#city').find('option').remove(); // Clear existing options
                                var options =
                                    '<option value="">Select city</option>'; // Default option
                                $.each(cities, function(key, city) {
                                    options += "<option value='" + city.id + "'>" + city
                                        .name + "</option>";
                                });
                                $('#city').append(options);
                            }
                        }
                    });
                } else {
                    $('#city').find('option').remove(); // Clear options if no state is selected
                    $('#city').append('<option value="">Select city</option>');
                }
            });
        });

        function editCategory(id) {
            $.ajax({
                url: `/submenu/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    const {
                        id,
                        name,
                        category_id,
                        state_id,
                        city_id,
                        price,
                        discount,
                        final_price,
                        image_url
                    } = response;

                    // Populate the form fields in the edit modal
                    $('#editCategoryId').val(id);
                    $('#editName').val(name);
                    $('#editCategorySelect').val(category_id).trigger('change');
                    $('#edit-state').val(state_id).trigger('change');
                    $('#edit-city').val(city_id).trigger('change');
                    $('#edit-price').val(price);
                    $('#edit-discount').val(discount);
                    $('#edit-final-price').val(final_price);

                     $.ajax({
                        url: '/fetch-subcategory/' + category_id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#editSubcategorySelect').empty().append(
                                '<option value="" selected>Select Subcategory</option>'
                            );

                            if (response.status === 1 && response.data.length > 0) {
                                var subcategory = response.data;
                                $.each(subcategory, function(key, subcateg) {
                                    $('#editSubcategorySelect').append(
                                        `<option value="${subcateg.id}" ${subcateg.id == subcategory_id ? 'selected' : ''}>${subcateg.name}</option>`
                                    );
                                });
                            }
                        }
                    });

                    // Update the image preview
                    if (image) {
                        $('#background-preview').attr('src', `/storage/submenu/${image}`);
                    } else {
                        $('#background-preview').attr('src',
                            '{{ asset('admin/assets/img/icons/upload.svg') }}');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching category:', error);
                    alert('There was an error fetching the submenu details.');
                }
            });
        }

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

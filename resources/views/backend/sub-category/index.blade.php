@extends('backend.layouts.main')
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Sub Category</h5>
                <div class="list-btn">
                    <ul>
                        <li>
                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                                data-target="#addCategoryModal">
                                Add Sub-Category
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
                                @if ($subcategories->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($subcategories as $subcategory)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $subcategory->name }}</td>

                                            <td>
                                                @if ($subcategory->image)
                                                    @php
                                                        $images = json_decode($subcategory->image, true); // Decode the JSON string into an array
                                                    @endphp
                                                    @if (is_array($images) && !empty($images))
                                                        @foreach ($images as $image)
                                                            <img src="{{ Storage::url('assets/subcategory/' . $image) }}" class="img-thumbnail" width="50px" style="margin-right: 5px;">
                                                        @endforeach
                                                    @else
                                                        No Image
                                                    @endif
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
                                                    <a class="btn delete-table me-2 edit-subcategory"
                                                        data-id="{{ $subcategory->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#editCategoryModal">
                                                        <i class="fe fe-edit"></i>
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('subcategories.destroy', $subcategory->id) }}"
                                                        method="POST" style="display:inline;">
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
    <div class="modal fade" id="addCategoryModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Sub Category</h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('subcategories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category">State</label>
                            <select class="form-control" id="state" name="state">
                                <option value="">Select a state</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ ucwords($state->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category">City</label>
                            <select class="form-control" id="city" name="city">
                                <option value="">Select a category</option>
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
                            <label class="form-label">Sub Category Images</label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="image-preview-bg" src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img" class="default-img">
                                    <div class="file-browse">
                                        <h6>Drag & drop images or </h6>
                                        <div class="file-browse-path">
                                            <input type="file" name="images[]" id="image-input-bg" accept="image/jpeg, image/png" multiple>
                                            <a href="javascript:void(0);"> Browse</a>
                                        </div>
                                    </div>
                                    <h5>Supported formats: JPEG, PNG</h5>
                                </div>
                            </div>
                        </div>


                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Function to handle image preview
                                function handleImagePreview(inputId, previewId) {
                                    const input = document.getElementById(inputId);
                                    const preview = document.getElementById(previewId);

                                    input.addEventListener('change', function(event) {
                                        const file = event.target.files[0];

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

                                // Initialize the preview handler for the sub category image
                                handleImagePreview('image-input-bg', 'image-preview-bg');
                            });
                        </script>

                        <style>
                            .default-img {
                                width: auto;
                                /* Default width for the upload.svg icon */
                            }

                            .preview-img {
                                width: 100px;
                                /* Width for the preview image */
                                height: 100px;
                                /* Height for the preview image */
                                object-fit: cover;
                                /* Ensure the image fits within the dimensions */
                            }
                        </style>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
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
                    <form action="{{ route('subcategories.update', $subcategory->id ?? '') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="edit-name">Name</label>
                            <input type="text" class="form-control" id="edit-name" name="name"
                                value="{{ $subcategory->name ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-category">Category</label>
                            <select class="form-control" id="edit-category" name="category" required>
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ ($subcategory->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category">State</label>
                            <select class="form-control" id="edit-state" name="state">
                                <option value="">Select a state</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ ucwords($state->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category">City</label>
                            <select class="form-control" id="edit-city" name="city">
                                <option value="">Select a category</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">Price(INR)</label>
                            <input type="text" class="form-control" id="edit-price" name="price"
                                placeholder="Enter Ammount" value="{{ old('price') }}">
                        </div>

                        <div class="form-group">
                            <label for="price">Discount(%)</label>
                            <input type="text" class="form-control" id="edit-discount" name="discount"
                                placeholder="Enter Discount percentage" value="{{ old('discount') }}">
                        </div>

                        <div class="form-group">
                            <label for="final-price">Final Price (INR)</label>
                            <input type="text" class="form-control" id="edit-final-price" name="edit_final_price"
                                value="{{ old('edit_final_price') }}" readonly disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sub Category Image</label>
                            <div class="form-uploads">
                                <div class="form-uploads-path" style="position: relative; text-align: center;">

                                    <div id="edit-image-preview-container"
                                        style="border: 2px dashed #ccc; border-radius: 5px; padding: 10px; display: inline-block; width: 150px; height: 150px; overflow: hidden; position: relative;">
                                        <img id="edit-image-preview"
                                            src="{{ isset($subcategory->image) ? Storage::url('assets/subcategory/' . $subcategory->image) : asset('admin/assets/img/icons/upload.svg') }}"
                                            alt="Preview"
                                            style="width: 100%; height: 100%; object-fit: cover; display: block;">
                                    </div>

                                    <div class="file-browse" style="margin-top: 10px;">
                                        <h6 style="margin: 0;">Drag & drop image or</h6>
                                        <input type="file" id="edit-image-upload" name="image"
                                            accept="image/jpeg, image/png" style="display: none;">
                                        <a href="javascript:void(0);" id="edit-browse-btn"
                                            style="color: #007bff; text-decoration: underline; cursor: pointer;">Browse</a>
                                        <h5 style="margin-top: 10px;">Supported formats: JPEG, PNG</h5>
                                    </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            function handleImagePreview(inputId, previewId) {
                const input = document.getElementById(inputId);
                const preview = document.getElementById(previewId);

                input.addEventListener('change', function(event) {
                    const file = event.target.files[0];

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

            handleImagePreview('image-input-bg', 'image-preview-bg');

            // Function to calculate final price
            function calculateFinalPrice() {
                const price = parseFloat(document.getElementById('price').value);
                const discountPercentage = parseFloat(document.getElementById('discount').value);

                if (!isNaN(price) && !isNaN(discountPercentage)) {
                    const discountAmount = (price * discountPercentage) / 100;
                    const finalPrice = price - discountAmount;

                    document.getElementById('final-price').value = finalPrice.toFixed(2);
                } else {
                    document.getElementById('final-price').value = '';
                }
            }

            document.getElementById('price').addEventListener('input', calculateFinalPrice);
            document.getElementById('discount').addEventListener('input', calculateFinalPrice);

        });


        // Edit Function to calculate final price

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

        document.addEventListener('DOMContentLoaded', function() {
            const editFileInput = document.getElementById('edit-image-upload');
            const editImagePreview = document.getElementById('edit-image-preview');
            const editBrowseBtn = document.getElementById('edit-browse-btn');

            // Handle file input change event
            editFileInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file && (file.type === 'image/jpeg' || file.type === 'image/png')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        editImagePreview.src = e.target.result;
                    };

                    reader.readAsDataURL(file);
                } else {
                    alert('Please select a JPEG or PNG image.');
                    editFileInput.value = ''; // Clear the input
                }
            });

            // Trigger file input click when browse button is clicked
            editBrowseBtn.addEventListener('click', function() {
                editFileInput.click();
            });
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
                                    'meta[name="csrf-token"]').getAttribute('content')
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

        // -----------------------fetch city name--------------------------------------//

        // <script type="text/javascript" src="js/jquery.js">




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
                                '<option value="">Select a city</option>'; // Default option
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
                    $('#city').append('<option value="">Select a city</option>');
                }
            });
        });
    </script>
@endsection

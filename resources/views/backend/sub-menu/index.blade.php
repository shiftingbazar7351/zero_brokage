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
                                                    <img src="{{ Storage::url('assets/subcategory/' . $subcategory->image) }}"
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
                                                    <a class="btn delete-table me-2 edit-subcategory"
                                                        data-id="{{ $subcategory->id }}"
                                                        data-name="{{ $subcategory->name }}"
                                                        data-category="{{ $subcategory->category_id }}"
                                                        data-state="{{ $subcategory->state_id }}"
                                                        data-city="{{ $subcategory->city_id }}"
                                                        data-price="{{ $subcategory->price }}"
                                                        data-discount="{{ $subcategory->discount }}"
                                                        data-image="{{ Storage::url('assets/subcategory/' . $subcategory->image) }}"
                                                        data-bs-toggle="modal" data-bs-target="#editCategoryModal">
                                                        <i class="fe fe-edit"></i>
                                                    </a>


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
                                <option value="">Select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category">Sub Category</label>
                            <select class="form-control" id="subcategory" name="subcategory_id" required>
                                <option value="">Select category</option>
                                @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category">Menu</label>
                            <select class="form-control" id="menu" name="menu_id" required>
                                <option value="">Select category</option>
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                @endforeach
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
                                <option value="">Select category</option>
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

                        {{-- <div class="form-group">
                            <label for="category">State</label>
                            <select class="form-control" id="editstate" name="state">
                                <option value="">Select State</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ ucwords($state->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category">City</label>
                            <select class="form-control" id="editcity" name="city">
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ $city->id == $subcategory->city_id ? 'selected' : '' }}>
                                        {{ ucwords($city->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}

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
                                    <img id="icon-preview"
                                        src="{{ isset($subcategory->image) ? Storage::url('assets/subcategory/' . $subcategory->image) : asset('admin/assets/img/icons/upload.svg') }}"
                                        alt="img" width="100px" height="100px">
                                    <div class="file-browse">
                                        <h6>Drag & drop image or </h6>
                                        <div class="file-browse-path">
                                            <input type="file" id="editIcon" name="image"
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
            $('#editCategoryModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var id = button.data('id');
                var name = button.data('name');
                var category = button.data('category_id');
                var state = button.data('state');
                var city = button.data('city');
                var price = button.data('price');
                var discount = button.data('discount');
                var image = button.data('image');

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



    </script>
@endsection

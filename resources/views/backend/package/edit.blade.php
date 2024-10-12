@extends('backend.layouts.main')

@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="row">
                <div>
                    {{-- <h1> Paragraph</h1> --}}
                    <form action="{{ route('package.update', $package->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Use PUT method for updating the package -->

                        <div class="row">
                            <!-- Category Field -->
                            <div class="mb-3 col-md-3">
                                <label for="category">Category<b style="color: red;">*</b></label>
                                <select class="selectpickerr" multiple="multiple" data-live-search="true"
                                    data-selected-text-format="value" id="category" name="category_id[]">
                                    <option value="" selected disabled>Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3 col-md-3">
                                <label for="subcategory">Sub Category<b style="color: red;">*</b></label>
                                <select class="selectpickerr" multiple="multiple" data-live-search="true"
                                    data-selected-text-format="value" id="subcategory" name="subcategory_id[]" multiple>
                                    <option value="" selected disabled>Select subcategory</option>
                                </select>
                                @error('subcategory_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>




                            <div class=" mb-3 col-md-3">
                                <label for="menu">Menu<b style="color: red;">*</b></label>
                                <select class="selectpickerr" multiple="multiple" data-live-search="true"
                                    data-selected-text-format="value" id="menu" name="menu_id[]" multiple>
                                    <option value="" selected disabled>Select menu</option>
                                </select>
                                @error('menu_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="submenu" selected disabled>Sub-Menu<b style="color: red;">*</b></label>
                                <select class="selectpickerr" multiple="multiple" data-live-search="true"
                                    data-selected-text-format="value" id="submenu" name="submenu_id[]" multiple>
                                    <option value="">Select submenu</option>
                                </select>
                                @error('submenu_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Name Field -->
                            <div class="mb-3 col-md-3">
                                <label for="name">Name <b style="color: red;">*</b></label>
                                <input class="form-control" type="text" id="name" name="name"
                                    placeholder="Enter Name" value="{{ old('name', $package->name) }}">
                                @error('name')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Product Price Field -->
                            <div class="mb-3 col-md-3">
                                <label for="price">Product Price <b style="color: red;">*</b></label>
                                <input class="form-control" type="text" id="product_price" name="product_price"
                                    placeholder="Enter Product Price" oninput="calculateFinalPrice()"
                                    value="{{ old('product_price', $package->price) }}">
                                @error('product_price')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Quantity Field -->
                            <div class="mb-3 col-md-3">
                                <label for="quantity">Quantity <b style="color: red;">*</b></label>
                                <input class="form-control" type="text" id="quantity" name="quantity"
                                    placeholder="Enter Quantity" oninput="calculateFinalPrice()"
                                    value="{{ old('quantity', $package->quantity) }}">
                                @error('quantity')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Final Price Field (Calculated) -->
                            <div class="mb-3 col-md-3">
                                <label for="final_price">Final Price <b style="color: red;">*</b></label>
                                <input class="form-control" type="text" id="final_price" name="price"
                                    placeholder="Enter Final Price" readonly
                                    value="{{ old('price', $package->price * $package->quantity) }}">
                                @error('final_price')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- JavaScript for Calculating Final Price -->
                            <script>
                                function calculateFinalPrice() {
                                    let price = parseFloat(document.getElementById('product_price').value) || 0;
                                    let quantity = parseFloat(document.getElementById('quantity').value) || 0;
                                    let finalPrice = price * quantity;
                                    document.getElementById('final_price').value = finalPrice.toFixed(2); // Keep two decimal places
                                }
                            </script>

                            <!-- Description Field -->
                            <div class="mb-3 col-md-12">
                                <label for="description" class="col-form-label">Description <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="description" name="description">{{ old('description', $package->description) }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Save Button -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Full version of jQuery -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>

    <!-- Bootstrap-select CDN JS LINK -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#submenu').change(function() {
                var submenuIds = $(this).val(); // Get multiple submenu IDs (assuming it's a multi-select)

                if (submenuIds && submenuIds.length > 0) {
                    $.ajax({
                        url: "{{ route('fetch.product.data') }}", // Your route here
                        type: 'GET',
                        data: {
                            submenu_id: submenuIds // Send submenu IDs as an array
                        },
                        success: function(data) {
                            if (data.success) {
                                if (data.is_multiple) {

                                    // If multiple submenu IDs, display average price
                                    $('#product_price').val(data.average_price);
                                } else {

                                    $('#product_price').val(data.product.price);
                                }
                            } else {
                                console.log('No products found for the selected submenus.');
                            }
                        },
                        error: function() {
                            alert('Error retrieving data.');
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Initialize selectpicker

            $('.selectpickerr').selectpicker();

            // Category -> Subcategory
            $('#category').on('change', function() {
                var categoryIds = $(this).val(); // Get selected category IDs
                if (categoryIds && categoryIds.length > 0) {
                    $.ajax({
                        url: '/product-fetch-subcategory',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            category_ids: categoryIds
                        },
                        success: function(response) {
                            // Clear and populate the subcategory dropdown
                            $('#subcategory').empty().append(
                                '<option value="" disabled>Select Subcategory</option>');
                            if (response.status === 1 && response.data.subcategories.length >
                                0) {
                                $.each(response.data.subcategories, function(key, subcategory) {
                                    $('#subcategory').append('<option value="' +
                                        subcategory.id + '">' + subcategory.name +
                                        '</option>');
                                });
                            } else {
                                $('#subcategory').append(
                                    '<option value="" disabled>No subcategories found</option>'
                                    );
                            }
                            $('#subcategory').selectpicker(
                            'refresh'); // Refresh the selectpicker
                        },
                        error: function() {
                            $('#subcategory').empty().append(
                                '<option value="" disabled>Error loading subcategories</option>'
                                );

                            $('#subcategory').selectpicker(
                            'refresh'); // Refresh the selectpicker
                        }
                    });
                }
            });

            // Subcategory -> Menu
            $('#subcategory').on('change', function() {
                var subcategoryIds = $(this).val(); // Capture selected subcategory IDs
                if (subcategoryIds && subcategoryIds.length > 0) {
                    $.ajax({
                        url: '/product-fetch-menu',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            subcategory_ids: subcategoryIds
                        },
                        success: function(response) {
                            $('#menu').empty().append(
                                '<option value="" selected disabled>Select Menu</option>');
                            if (response.status === 1 && response.data.length > 0) {
                                $.each(response.data, function(key, menu) {
                                    $('#menu').append('<option value="' + menu.id +
                                        '">' + menu.name + '</option>');
                                });
                            } else {
                                $('#menu').append(
                                    '<option value="" disabled>No menus available</option>');
                            }
                            $('#menu').selectpicker('refresh'); // Refresh the selectpicker
                        },
                        error: function(xhr) {
                            $('#menu').empty().append(
                                '<option value="" disabled>Error loading menus</option>');
                            $('#menu').selectpicker('refresh'); // Refresh the selectpicker
                        }
                    });
                } else {
                    $('#menu').empty().append('<option value="" selected disabled>Select Menu</option>');
                    $('#menu').selectpicker('refresh'); // Refresh the selectpicker
                }
            });

            // Menu -> Submenu
            $('#menu').on('change', function() {
                var menuIds = $(this).val(); // Get selected menu IDs
                if (menuIds && menuIds.length > 0) {
                    $.ajax({
                        url: '/product-fetch-submenu',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            menu_ids: menuIds
                        },
                        success: function(response) {
                            $('#submenu').empty().append(
                                '<option value="" disabled>Select Submenu</option>');
                            if (response.status === 1 && response.data.submenus.length > 0) {
                                $.each(response.data.submenus, function(key, submenu) {
                                    $('#submenu').append('<option value="' + submenu
                                        .id + '">' + submenu.name + '</option>');
                                });
                            } else {
                                $('#submenu').append(
                                    '<option value="" disabled>No submenus found</option>');
                            }
                            $('#submenu').selectpicker('refresh'); // Refresh the selectpicker
                        },
                        error: function() {
                            $('#submenu').empty().append(
                                '<option value="" disabled>Error loading submenus</option>');
                            $('#submenu').selectpicker('refresh'); // Refresh the selectpicker
                        }
                    });
                }
            });

        });
    </script>
@endsection

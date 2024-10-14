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
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category_id">
                                    <option value="">Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $package->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Subcategory Field -->
                            <div class="mb-3 col-md-3">
                                <label for="subcategory">Sub Category</label>
                                <select class="form-control" id="subcategory" name="subcategory_id">
                                    <option value="">Select subcategory</option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}" {{ $subcategory->id == $package->subcategory_id ? 'selected' : '' }}>
                                            {{ $subcategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('subcategory_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Menu Field -->
                            <div class="mb-3 col-md-3">
                                <label for="menu">Menu</label>
                                <select class="form-control" id="menu" name="menu_id">
                                    <option value="">Select menu</option>
                                    @foreach ($menus as $menu)
                                        <option value="{{ $menu->id }}" {{ $menu->id == $package->menu_id ? 'selected' : '' }}>
                                            {{ $menu->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('menu_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submenu Field -->
                            <div class="mb-3 col-md-3">
                                <label for="submenu">Sub-Menu <b style="color: red;">*</b></label>
                                <select class="form-control" id="submenu" name="submenu_id">
                                    <option value="">Select submenu</option>
                                    @foreach ($submenus as $submenu)
                                        <option value="{{ $submenu->id }}" {{ $submenu->id == $package->submenu_id ? 'selected' : '' }}>
                                            {{ $submenu->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('submenu_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Name Field -->
                            <div class="mb-3 col-md-3">
                                <label for="name">Name <b style="color: red;">*</b></label>
                                <input class="form-control" type="text" id="name" name="name" placeholder="Enter Name" value="{{ old('name', $package->name) }}">
                                @error('name')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Product Price Field -->
                            <div class="mb-3 col-md-3">
                                <label for="price">Product Price <b style="color: red;">*</b></label>
                                <input class="form-control" type="text" id="product_price" name="product_price" placeholder="Enter Product Price" oninput="calculateFinalPrice()" value="{{ old('product_price', $package->price) }}">
                                @error('product_price')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Quantity Field -->
                            <div class="mb-3 col-md-3">
                                <label for="quantity">Quantity <b style="color: red;">*</b></label>
                                <input class="form-control" type="text" id="quantity" name="quantity" placeholder="Enter Quantity" oninput="calculateFinalPrice()" value="{{ old('quantity', $package->quantity) }}">
                                @error('quantity')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Final Price Field (Calculated) -->
                            <div class="mb-3 col-md-3">
                                <label for="final_price">Final Price <b style="color: red;">*</b></label>
                                <input class="form-control" type="text" id="final_price" name="price" placeholder="Enter Final Price" readonly value="{{ old('price', $package->price * $package->quantity) }}">
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
                                <label for="description" class="col-form-label">Description <span class="text-danger">*</span></label>
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
                var submenuId = $(this).val(); // Change to submenu ID
                if (submenuId) {
                    $.ajax({
                        url: "{{ route('fetch.product.data') }}", // Your route here
                        type: 'GET',
                        data: {
                            submenu_id: submenuId // Use submenu_id in the request
                        },
                        success: function(data) {
                            if (data.success) {
                                $('#product_id').val(data.product.id);
                                $('#product_price').val(data.product.price);

                            } else {
                                console.log('No data found for the selected submenu.');
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
            function fetchSubcategories(categoryId, subcategoryElement) {
                if (categoryId) {
                    $.ajax({
                        url: '/fetch-subcategory/' + categoryId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            subcategoryElement.empty().append(
                                '<option value="" selected disabled>Select Subcategory</option>'
                            );

                            if (response.status === 1 && response.data.length > 0) {
                                $.each(response.data, function(key, subcateg) {
                                    subcategoryElement.append('<option value="' +
                                        subcateg.id + '">' + subcateg.name +
                                        '</option>');
                                });
                            } else {
                                subcategoryElement.append(
                                    '<option value="" disabled>No subcategories available</option>'
                                );
                            }
                        },
                        error: function() {
                            subcategoryElement.empty().append(
                                '<option value="" disabled>Error loading subcategories</option>'
                            );
                        }
                    });
                } else {
                    subcategoryElement.empty().append(
                        '<option value="" selected disabled>Select Subcategory</option>');
                }
            }

            // Trigger fetch when editing enquiry
            $('#editCategory').off('change').on('change', function() {
                var categoryId = $(this).val();
                var subcategoryElement = $('#editSubcategory');
                fetchSubcategories(categoryId, subcategoryElement);
            });

            // Trigger fetch for another category element
            $('#category').off('change').on('change', function() {
                var categoryId = $(this).val();
                var subcategoryElement = $('#subcategory');
                fetchSubcategories(categoryId, subcategoryElement);
            });

            function fetchMenus(subcategoryId, menuElement) {
                if (subcategoryId) {
                    $.ajax({
                        url: '/getMenus/' + subcategoryId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            menuElement.empty().append(
                                '<option value="" selected disabled>Select Menu</option>'
                            );

                            if (response.status === 1 && response.data.length > 0) {
                                $.each(response.data, function(key, menu) {
                                    menuElement.append('<option value="' + menu.id +
                                        '">' + menu.name + '</option>');
                                });
                            } else {
                                menuElement.append(
                                    '<option value="" disabled>No menus available</option>'
                                );
                            }
                        },
                        error: function(xhr) {
                            console.error('Error loading menus:', xhr);
                            menuElement.empty().append(
                                '<option value="" disabled>Error loading menus</option>'
                            );
                        }
                    });
                } else {
                    menuElement.empty().append(
                        '<option value="" selected disabled>Select Menu</option>');
                }
            }

            // Event listener for editSubcategory
            $('#editSubcategory').on('change', function() {
                var subcategoryId = $(this).val();
                var menuElement = $('#editmenu');
                fetchMenus(subcategoryId, menuElement);
            });

            // Event listener for subcategory
            $('#subcategory').on('change', function() {
                var subcategoryId = $(this).val();
                var menuElement = $('#menu');
                fetchMenus(subcategoryId, menuElement);
            });

            function fetchSubMenus(menuId, submenuElement) {
                if (menuId) {
                    $.ajax({
                        url: '/getsubMenus/' + menuId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            submenuElement.empty().append(
                                '<option value="" selected disabled>Select SubMenu</option>'
                            );

                            if (response.status === 1 && response.data.length > 0) {
                                $.each(response.data, function(key, submenu) {
                                    submenuElement.append('<option value="' +
                                        submenu.id + '">' + submenu.name +
                                        '</option>');
                                });
                            } else {
                                submenuElement.append(
                                    '<option value="" disabled>No submenus available</option>'
                                );
                            }
                        },
                        error: function(xhr) {
                            console.error('Error loading submenus:', xhr);
                            submenuElement.empty().append(
                                '<option value="" disabled>Error loading submenus</option>'
                            );
                        }
                    });
                } else {
                    submenuElement.empty().append(
                        '<option value="" selected disabled>Select SubMenu</option>');
                }
            }

            // Event listener for editmenu
            $('#editmenu').on('change', function() {
                var menuId = $(this).val();
                var submenuElement = $('#editsubmenu');
                fetchSubMenus(menuId, submenuElement);
            });

            // Event listener for menu
            $('#menu').on('change', function() {
                var menuId = $(this).val();
                var submenuElement = $('#submenu');
                fetchSubMenus(menuId, submenuElement);
            });
        });
    </script>
@endsection

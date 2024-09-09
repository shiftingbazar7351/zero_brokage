@extends('backend.layouts.main')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="row">
                <div>
                    {{-- <h1> Paragraph</h1> --}}
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            {{-- <div class="mb-3 col-md-6">
                                <label for="category">Category<b style="color: red;">*</b></label>
                                <select class="form-control" id="category" name="category_id[]" multiple>
                                    <option value="">Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            <div class="mb-3 col-md-6">
                                <label for="category">Category<b style="color: red;">*</b></label>
                                <select name="fabric_color_en[]" id="fabric_color_en[]" multiple="multiple"
                                    class="form-control select2">
                                    <option value="Beige">
                                        Beige
                                    </option>

                                    <option value="Red">
                                        Red
                                    </option>

                                    <option value="Petrol">
                                        Petrol
                                    </option>

                                    <option value="Royal Blue">
                                        Royal Blue
                                    </option>

                                    <option value="Dark Blue">
                                        Dark Blue
                                    </option>

                                    <option value="Bottle Green">
                                        Bottle Green
                                    </option>

                                    <option value="Light Grey">
                                        Light Grey
                                    </option>
                                </select>
                                @error('category_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3 col-md-6">
                                <label for="subcategory">Sub Category<b style="color: red;">*</b></label>
                                {{-- <select class="form-control" id="subcategory" name="subcategory_id[]" multiple>
                                    <option value="">Select subcategory</option>
                                </select> --}}

                                <select name="fabric_color_enn[]" id="fabric_color_enn[]" multiple="multiplee"
                                    class="form-control select2">
                                    <option value="Beige">
                                        Beige
                                    </option>

                                    <option value="Red">
                                        Red
                                    </option>

                                    <option value="Petrol">
                                        Petrol
                                    </option>

                                    <option value="Royal Blue">
                                        Royal Blue
                                    </option>

                                    <option value="Dark Blue">
                                        Dark Blue
                                    </option>

                                    <option value="Bottle Green">
                                        Bottle Green
                                    </option>

                                    <option value="Light Grey">
                                        Light Grey
                                    </option>
                                </select>

                                @error('subcategory_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row">

                            <div class=" mb-3 col-md-6">
                                <label for="menu">Menu<b style="color: red;">*</b></label>
                                <select class="form-control" id="menu" name="menu_id[]" multiple>
                                    <option value="">Select menu</option>
                                </select>
                                @error('menu_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="submenu">Sub-Menu<b style="color: red;">*</b></label>
                                <select class="form-control" id="submenu" name="submenu_id[]" multiple>
                                    <option value="">Select submenu</option>
                                </select>
                                @error('submenu_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">

                            <div class=" mb-3 col-md-6">
                                <label for="state">State<b style="color: red;">*</b></label>
                                <select class="form-control" id="state" name="state[]" multiple>
                                    <option value="">Select state</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ ucwords($state->name) }}</option>
                                    @endforeach
                                </select>
                                @error('state')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="city">City<b style="color: red;">*</b></label>
                                <select class="form-control" id="city" name="city[]" multiple>
                                    <option value="">Select city</option>
                                </select>
                                @error('city')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class=" mb-3 col-md-6">
                                <label for="gst">GST<b style="color: red;">*</b></label>
                                <select class="form-control" id="gst" name="gst">
                                    <option value="">Select GST</option>
                                    <option value="0">0%</option>
                                    <option value="12">12%</option>
                                    <option value="18">18%</option>
                                    <option value="28">28%</option>
                                </select>
                                @error('gst')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="hcn">HSN/SAC<b style="color: red;">*</b></label>
                                <select class="form-control" id="hsn" name="hsn">
                                    <option value="">Select HSN/SAC</option>
                                    <option value="0">0</option>
                                    <option value="2">2</option>
                                    <option value="4">4</option>
                                </select>
                                @error('hsn')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name">Name<b style="color: red;">*</b></label>
                                <input class="form-control" type="text" id="name" name="name"
                                    placeholder="Enter Name">
                                @error('name')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="price">price<b style="color: red;">*</b></label>
                                <input class="form-control" type="text" id="price" name="price"
                                    placeholder="Enter Price">
                                @error('price')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="col-form-label">Desription <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="size">Size</label>
                            <select name="size[]" class="form-control selectpicker" multiple aria-label="Default select example" data-live-search="true">
                                <option value="">--Select any size--</option>
                                <option value="S">Small (S)</option>
                                <option value="M">Medium (M)</option>
                                <option value="L">Large (L)</option>
                                <option value="XL">Extra Large (XL)</option>
                                <option value="XXL"> XXL</option>
                                <option value="3XL"> 3XL</option>
                                <option value="4XL"> 4XL</option>
                            </select>
                        </div>

                        <div class="text-end">
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
        $(document).ready(function() {
            $('#category').on('change', function() {
                var categoryIds = $(this).val(); // Get selected category IDs
                if (categoryIds && categoryIds.length > 0) {
                    $.ajax({
                        url: '/product-fetch-subcategory', // Your route to fetch subcategories
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            category_ids: categoryIds // Send the selected category IDs as an array
                        },
                        success: function(response) {
                            // Clear the subcategory dropdown
                            $('#subcategory').empty().append(
                                '<option value="" disabled>Select Subcategory</option>');

                            // Display selected category names
                            $.each(response.data.categories, function(index, category) {
                                console.log("Selected Category: " + category
                                    .name); // Show selected categories in console
                            });

                            // Populate subcategories
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
                        },
                        error: function() {
                            $('#subcategory').empty().append(
                                '<option value="" disabled>Error loading subcategories</option>'
                            );
                        }
                    });
                }
            });

            $('#subcategory').on('change', function() {
                var subcategoryIds = $(this).val(); // Capture selected subcategory IDs
                if (subcategoryIds && subcategoryIds.length > 0) {
                    $.ajax({
                        url: '/product-fetch-menu', // Updated URL
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            subcategory_ids: subcategoryIds // Send the subcategory IDs as an array
                        },
                        success: function(response) {
                            $('#menu').empty().append(
                                '<option value="" selected disabled>Select Menu</option>'
                            );
                            if (response.status === 1 && response.data.length > 0) {
                                $.each(response.data, function(key, menu) {
                                    $('#menu').append(
                                        '<option value="' + menu.id + '">' + menu
                                        .name + '</option>'
                                    );
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


            // Similar logic for Menu and Submenu dropdowns
            $('#menu').on('change', function() {
                var menuIds = $(this).val(); // Get selected menu IDs

                if (menuIds && menuIds.length > 0) {
                    $.ajax({
                        url: '/product-fetch-submenu', // Your route to fetch submenus
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            menu_ids: menuIds // Send the selected menu IDs as an array
                        },
                        success: function(response) {
                            // Clear the submenu dropdown
                            $('#submenu').empty().append(
                                '<option value="" disabled>Select Submenu</option>');

                            // Display selected menu names
                            $.each(response.data.menus, function(index, menu) {
                                console.log("Selected Menu: " + menu
                                    .name); // Show selected menus in console
                            });

                            // Populate submenus
                            if (response.status === 1 && response.data.submenus.length > 0) {
                                $.each(response.data.submenus, function(key, submenu) {
                                    $('#submenu').append('<option value="' + submenu
                                        .id + '">' + submenu.name + '</option>');
                                });
                            } else {
                                $('#submenu').append(
                                    '<option value="" disabled>No submenus found</option>');
                            }
                        },
                        error: function() {
                            $('#submenu').empty().append(
                                '<option value="" disabled>Error loading submenus</option>');
                        }
                    });
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
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
@endsection

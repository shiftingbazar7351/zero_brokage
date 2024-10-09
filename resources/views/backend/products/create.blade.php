@extends('backend.layouts.main')

@section('content')

<!-- Bootstrap-select CDN CSS LINK -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/css/bootstrap-select.min.css">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {

            width: 100%;
        }
    </style>
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="row">
                <div>
                    {{-- <h1> Paragraph</h1> --}}
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        <div class="row">
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
                                    <option value=""  selected disabled>Select subcategory</option>
                                </select>
                                @error('subcategory_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>




                            <div class=" mb-3 col-md-3">
                                <label for="menu">Menu<b style="color: red;">*</b></label>
                                <select class="selectpickerr" multiple="multiple" data-live-search="true"
                                data-selected-text-format="value" id="menu" name="menu_id[]" multiple>
                                    <option value=""  selected disabled>Select menu</option>
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

                            <div class=" mb-3 col-md-3">
                                <label for="state">State<b style="color: red;">*</b></label>
                                <select class="selectpickerr" multiple="multiple" data-live-search="true"
                                data-selected-text-format="value" id="state" name="state[]" multiple>
                                    <option value=""  selected disabled>Select state</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ ucwords($state->name) }}</option>
                                    @endforeach
                                </select>
                                @error('state')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="city">City<b style="color: red;">*</b></label>
                                <select class="selectpickerr" multiple="multiple" data-live-search="true"
                                data-selected-text-format="value" id="city" name="city[]" multiple>
                                    <option value="" selected disabled>Select city</option>
                                </select>
                                @error('city')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class=" mb-3 col-md-3">
                                <label for="gst">GST<b style="color: red;">*</b></label>
                                <select class="form-control" id="gst" name="gst">
                                    <option value="" selected disabled>Select GST</option>
                                    <option value="0">0%</option>
                                    <option value="12">12%</option>
                                    <option value="18">18%</option>
                                    <option value="28">28%</option>
                                </select>
                                @error('gst')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="hcn">HSN/SAC<b style="color: red;">*</b></label>
                                <select class="form-control" id="hsn" name="hsn">
                                    <option value="" selected disabled>Select HSN/SAC</option>
                                    <option value="0">0</option>
                                    <option value="2">2</option>
                                </select>
                                @error('hsn')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-3">
                                <label for="name">Name<b style="color: red;">*</b></label>
                                <input class="form-control" type="text" id="name" name="name"
                                    placeholder="Enter Name">
                                @error('name')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-3">
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


                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('scripts')
    <!-- Full version of jQuery -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <!-- Bootstrap-select CDN JS LINK -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/js/bootstrap-select.min.js"></script>

    <!-- Bootstrap-Select Custom JS LINK-->
    <script type="text/javascript">
        $('.selectpicker').selectpicker('destroy').selectpicker();
    </script>
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
@endsection --}}


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
                            if (response.status === 1 && response.data.subcategories.length > 0) {
                                $.each(response.data.subcategories, function(key, subcategory) {
                                    $('#subcategory').append('<option value="' +
                                        subcategory.id + '">' + subcategory.name +
                                        '</option>');
                                });
                            } else {
                                $('#subcategory').append('<option value="" disabled>No subcategories found</option>');
                            }
                            $('#subcategory').selectpicker('refresh'); // Refresh the selectpicker
                        },
                        error: function() {
                            $('#subcategory').empty().append(
                                '<option value="" disabled>Error loading subcategories</option>');

                            $('#subcategory').selectpicker('refresh'); // Refresh the selectpicker
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
                                    $('#menu').append('<option value="' + menu.id + '">' + menu.name + '</option>');
                                });
                            } else {
                                $('#menu').append('<option value="" disabled>No menus available</option>');
                            }
                            $('#menu').selectpicker('refresh'); // Refresh the selectpicker
                        },
                        error: function(xhr) {
                            $('#menu').empty().append('<option value="" disabled>Error loading menus</option>');
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
                                    $('#submenu').append('<option value="' + submenu.id + '">' + submenu.name + '</option>');
                                });
                            } else {
                                $('#submenu').append('<option value="" disabled>No submenus found</option>');
                            }
                            $('#submenu').selectpicker('refresh'); // Refresh the selectpicker
                        },
                        error: function() {
                            $('#submenu').empty().append('<option value="" disabled>Error loading submenus</option>');
                            $('#submenu').selectpicker('refresh'); // Refresh the selectpicker
                        }
                    });
                }
            });

            // State -> City
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
                            $('#city').empty().append('<option value="">Select city</option>');
                            if (response.status === 1) {
                                $.each(response.data, function(key, city) {
                                    $('#city').append("<option value='" + city.id + "'>" + city.name + "</option>");
                                });
                            }
                            $('#city').selectpicker('refresh'); // Refresh the selectpicker
                        },
                        error: function() {
                            $('#city').empty().append('<option value="" disabled>Error loading cities</option>');
                            $('#city').selectpicker('refresh'); // Refresh the selectpicker
                        }
                    });
                } else {
                    $('#city').empty().append('<option value="">Select city</option>');
                    $('#city').selectpicker('refresh'); // Refresh the selectpicker
                }
            });
        });
    </script>

@endsection


@extends('backend.layouts.main')

@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="row">
                <div>
                    {{-- <h1> Paragraph</h1> --}}
                    <form id="addCategoryModal" action="{{ route('products.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="category">Category<b style="color: red;">*</b></label>
                                <select class="form-control" id="category" name="category_id">
                                    <option value="">Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3 col-md-6">
                                <label for="subcategory">Sub Category<b style="color: red;">*</b></label>
                                <select class="form-control" id="subcategory" name="subcategory_id">
                                    <option value="">Select subcategory</option>
                                </select>
                                @error('subcategory_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row">

                            <div class=" mb-3 col-md-6">
                                <label for="menu">Menu<b style="color: red;">*</b></label>
                                <select class="form-control" id="menu" name="menu_id">
                                    <option value="">Select menu</option>
                                </select>
                                @error('menu_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="submenu">Sub-Menu<b style="color: red;">*</b></label>
                                <select class="form-control" id="submenu" name="submenu_id">
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
                                <select class="form-control" id="state" name="state">
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
                                <select class="form-control" id="city" name="city">
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
                                    <option value="">0%</option>
                                    <option value="">12%</option>
                                    <option value="">18%</option>
                                    <option value="">28%</option>
                                </select>
                                @error('gst')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="hcn">HSN/SAC<b style="color: red;">*</b></label>
                                <select class="form-control" id="hsn" name="hsn">
                                    <option value="">Select HSN/SAC</option>
                                    <option value="">0</option>
                                    <option value="">2</option>
                                    <option value="">4</option>
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

            $('#menu').on('change', function() {
                var submenuId = $(this).val();
                if (submenuId) {
                    $.ajax({
                        url: '/getsubMenus/' + submenuId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#submenu').empty().append(
                                '<option value="" selected disabled>Select SubMenu</option>'
                            );
                            if (response.status === 1 && response.data.length > 0) {
                                $.each(response.data, function(key, submenu) {
                                    $('#submenu').append('<option value="' +
                                        submenu.id +
                                        '">' + submenu.name + '</option>');
                                });
                            } else {
                                $('#submenu').append(
                                    '<option value="" disabled>No menus available</option>'
                                );
                            }
                        },
                        error: function(xhr) {
                            console.error('Error loading menus:', xhr);
                            $('#submenu').empty().append(
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
        });
    </script>
@endsection

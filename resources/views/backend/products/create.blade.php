@extends('backend.layouts.main')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js"></script>

<style>
    body{
   color: black !important;
}

.select2-results__options[aria-multiselectable="true"] li {
    padding-left: 30px;
    position: relative
}

.select2-results__options[aria-multiselectable="true"] li:before {
    position: absolute;
    left: 8px;
    opacity: .6;
    top: 6px;
    font-family: "FontAwesome";
    content: "\f0c8";
}

.select2-results__options[aria-multiselectable="true"] li[aria-selected="true"]:before {
    content: "\f14a";
}
.select2-results__options {
    &[aria-multiselectable=true] {

        .select2-results__option {
            &[aria-selected=true]:before {
                content: '☑';
                padding: 0 0 0 4px;
            }

            &:before {
                content: '◻';
                padding: 0 0 0 4px;
            }
        }
    }
}
.select2-container--default .select2-results__option--selected {
    background-color: #5897fb !important;
    color: white;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #5897fb !important;
    border-color: #5897fb !important;
    color: white;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
    background: none !important;
    color: black !important;
    top: -3px !important;
}
.select2-results__options[aria-multiselectable="true"] li:before {

    opacity: 1 !important;
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
                                <select name="fabric_color_en[]" id="fabric_color_en[]" multiple="multiple" class="form-control select2">
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

                                <select name="fabric_color_enn[]" id="fabric_color_enn[]" multiple="multiplee" class="form-control select2">
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
                                <select class="form-control" id="gst" name="gst[]" multiple>
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
                                <select class="form-control" id="hsn" name="hsn[]" multiple>
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
    <script>
        $('.select2[multiple]').select2({
            width: '100%',
            closeOnSelect: false
        })
    </script>
    <script>
        $('.select2[multiplee]').select2({
            width: '100%',
            closeOnSelect: false
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"
></script>
@endsection

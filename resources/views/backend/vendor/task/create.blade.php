@extends('backend.layouts.main')

@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="main-wrapper">
                <div class="container border p-2 shadow-sm mt-2">
                    <h4>Create Task</h4>
                </div>
                <div class="container mt-4 border p-5 rounded shadow">
                    <form action="{{ route('vendor-task.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label for="category">Category<b style="color: red;">*</b></label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="" selected disabled>Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="subcategory">Sub Category<b style="color: red;">*</b></label>
                                <select class="form-control" id="subcategory" name="sub_category" required>
                                    <option value="" selected disabled>Select subcategory</option>
                                </select>
                                @error('sub_category')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="menu">Menu<b style="color: red;">*</b></label>
                                <select class="form-control" id="menu" name="menu_id" required>
                                    <option value="" selected disabled>Select menu</option>
                                </select>
                                @error('menu_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="submenu">Sub-Menu<b style="color: red;">*</b></label>
                                <select class="form-control" id="submenu" name="submenu_id" required>
                                    <option value="" selected disabled>Select submenu</option>
                                </select>
                                @error('submenu_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="company_name" class="form-label">Company Name</label>
                                <input type="text" class="form-control" id="company_name" value="{{ old('company_name') }}"
                                    name="company_name" placeholder="Enter company name">
                                    @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" value="{{ old('email') }}"
                                    name="email" placeholder="Enter Email">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3 col-md-4">
                                <label for="number" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" id="number" value="{{ old('number') }}" id="number" maxlength="10"
                                    name="number" placeholder="Enter number">

                                    @error('number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="status" class="form-label"> Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="" selected disabled>Select</option>
                                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    <option value="on_hold" {{ old('status') == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="tags" class="form-label">Tag</label>
                                <select class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags">
                                    <option value="" selected disabled>Select</option>
                                    <option value="dmu" {{ old('tags') == 'dmu' ? 'selected' : '' }}>DMU</option>
                                    <option value="pg" {{ old('tags') == 'pg' ? 'selected' : '' }}>pg</option>
                                    <option value="dmu_follow" {{ old('tags') == 'dmu_follow' ? 'selected' : '' }}>DMU Follow</option>
                                    <option value="not_dec" {{ old('tags') == 'not_dec' ? 'selected' : '' }}>rhe</option>
                                    <option value="not" {{ old('tags') == 'not' ? 'selected' : '' }}>Not</option>
                                </select>

                                @error('tags')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>





                            <!-- Next Follow-up Date -->
                            <div class="mb-3 col-md-4">
                                <label for="next_followup_date_time_am_pm" class="form-label">Next Follow-up</label>
                                <input type="datetime-local" class="form-control" id="next_followup_date_time_am_pm"
                                    name="next_followup_date_time_am_pm">
                                    @error('next_followup_date_time_am_pm')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Call Record -->
                            <div class="mb-3 col-md-4">
                                <label for="call_record" class="form-label">Call Record</label>
                                <input type="file" class="form-control" id="call_record" name="call_record">
                                @error('call_record')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>

                            <!-- Call History Image -->
                            <div class="mb-3 col-md-4">
                                <label for="call_history_img" class="form-label">Call History Image</label>
                                <input type="file" class="form-control" id="call_history_img" name="call_history_img">
                                @error('call_history_img')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>

                            <!-- Client Type -->
                            <div class="mb-3 col-md-4">
                                <label for="client_type" class="form-label">Client Type</label>
                                <select class="form-select" id="client_type" name="client_type">
                                    <option value="" selected disabled>Select Client Type</option>
                                    <option value="NC">NC</option>
                                    <option value="EC">EC</option>
                                    <option value="DC">DC</option>
                                </select>
                                @error('client_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="address" class="form-label">Address</label>
                                <textarea type="text" class="form-control" id="address" value="{{ old('address') }}"
                                    name="address" placeholder="Enter address">{{ old('address') }}</textarea>

                                    @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3 col-md-4">
                                <label for="comments" class="form-label">Any comment?</label>
                                <textarea type="text" class="form-control" id="comments" value="{{ old('comments') }}"
                                    name="comments" placeholder="Enter comments">{{ old('comments') }}</textarea>

                                    @error('comments')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="note" class="form-label">Any note?</label>
                                <textarea type="text" class="form-control" id="note" value="{{ old('note') }}"
                                    name="note" placeholder="Enter note">{{ old('note') }}</textarea>
                                    @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#state').on('change', function() {
                var stateId = $(this).val();
                if (stateId) {
                    $.ajax({
                        url: '/fetch-city-vendor/' + stateId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log(response);
                            $('#city').empty().append('<option value="" selected disabled>Select City</option>');
                            if (response.status === 1) {
                                $.each(response.data, function(key, city) {
                                    $('#city').append("<option value='" + city.id +
                                        "'>" + city.name + "</option>");
                                });
                            } else {
                                $('#city').append(
                                    '<option value="" selected disabled>No cities found</option>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                            $('#city').empty().append(
                                '<option value="" selected disabled>Error loading cities</option>');
                        }
                    });
                } else {
                    $('#city').empty().append('<option value="" selected disabled>Select City</option>');
                }
            });
        });

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
                                '<option value="" selected disabled>No subcategories found</option>'
                            );
                        }
                    },
                    error: function() {
                        $('#subcategory').empty().append(
                            '<option value="" selected disabled>Error loading subcategories</option>'
                        );
                    }
                });
            } else {
                $('#subcategory').empty().append(
                    '<option value="" selected disabled selected disabled>Select Subcategory</option>');
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
                                '<option value="" selected disabled>No menus available</option>'
                            );
                        }
                    },
                    error: function(xhr) {
                        console.error('Error loading menus:', xhr);
                        $('#menu').empty().append(
                            '<option value="" selected disabled>Error loading menus</option>'
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
                                '<option value="" selected disabled>No menus available</option>'
                            );
                        }
                    },
                    error: function(xhr) {
                        console.error('Error loading menus:', xhr);
                        $('#submenu').empty().append(
                            '<option value="" selected disabled>Error loading menus</option>'
                        );
                    }
                });
            } else {
                $('#menu').empty().append(
                    '<option value="" selected disabled>Select Menu</option>'
                );
            }
        });
    </script>
@endsection

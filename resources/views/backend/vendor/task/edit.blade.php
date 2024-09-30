@extends('backend.layouts.main')
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="main-wrapper">
                <div class="container border p-2 shadow-sm mt-2">
                    <h4>Edit Task</h4>
                </div>
                <div class="container mt-4 border p-5 rounded shadow">
                    <form action="{{ route('vendor-task.update', $task->id ?? '') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label for="category">Category<b style="color: red;">*</b></label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="" disabled>Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ (old('category', $vendor->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="subcategory">Sub Category<b style="color: red;">*</b></label>
                                <select class="form-control" id="subcategory" name="sub_category" required>
                                    <option value="" disabled>Select subcategory</option>
                                    <!-- Populate subcategories based on selected category -->
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}" {{ (old('sub_category', $vendor->sub_category_id ?? '') == $subcategory->id) ? 'selected' : '' }}>
                                            {{ $subcategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sub_category')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="menu">Menu<b style="color: red;">*</b></label>
                                <select class="form-control" id="menu" name="menu_id" required>
                                    <option value="" disabled>Select menu</option>
                                    <!-- Populate menus based on selected category or subcategory -->
                                    @foreach ($menus as $menu)
                                        <option value="{{ $menu->id }}" {{ (old('menu_id', $vendor->menu_id ?? '') == $menu->id) ? 'selected' : '' }}>
                                            {{ $menu->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('menu_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="submenu">Sub-Menu<b style="color: red;">*</b></label>
                                <select class="form-control" id="submenu" name="submenu_id" required>
                                    <option value="" disabled>Select submenu</option>
                                    <!-- Populate submenus based on selected menu -->
                                    @foreach ($submenus as $submenu)
                                        <option value="{{ $submenu->id }}" {{ (old('submenu_id', $vendor->submenu_id ?? '') == $submenu->id) ? 'selected' : '' }}>
                                            {{ $submenu->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('submenu_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="company_name" class="form-label">Company Name</label>
                                <input type="text" class="form-control" id="company_name"
                                    value="{{ old('company_name', $vendor->company_name ?? '') }}" name="company_name"
                                    placeholder="Enter company name" required>
                                @error('company_name')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email"
                                    value="{{ old('email', $vendor->email ?? '') }}" name="email"
                                    placeholder="Enter Email" required>
                                @error('email')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="hidden" name="vendor_id" value="{{ $vendor->id ?? '' }}">

                            <div class="mb-3 col-md-4">
                                <label for="number" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" id="number" value="{{ old('number', $vendor->number ?? '') }}"
                                    maxlength="10" name="number" placeholder="Enter number" required>
                                @error('number')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3 col-md-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="" disabled {{ !old('status') ? 'selected' : '' }}>Select</option>
                                    <option value="in_progress"
                                        {{ old('status') == 'in_progress' || $task->status == 'in_progress' ? 'selected' : '' }}>
                                        In Progress</option>
                                    <option value="cancelled"
                                        {{ old('status') == 'cancelled' || $task->status == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                    <option value="on_hold"
                                        {{ old('status') == 'on_hold' || $task->status == 'on_hold' ? 'selected' : '' }}>
                                        On Hold</option>
                                    <option value="completed"
                                        {{ old('status') == 'completed' || $task->status == 'completed' ? 'selected' : '' }}>
                                        Completed</option>
                                </select>
                                @error('status')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-3">
                                <label for="tags" class="form-label">Tag</label>
                                <select class="form-control" id="tags" name="tags">
                                    <option value="" disabled {{ !old('tags') ? 'selected' : '' }}>Select</option>
                                    <option value="dmu"
                                        {{ old('tags') == 'dmu' || $task->tags == 'dmu' ? 'selected' : '' }}>DMU</option>
                                    <option value="pg"
                                        {{ old('tags') == 'pg' || $task->tags == 'pg' ? 'selected' : '' }}>PG</option>
                                    <option value="dmu_follow"
                                        {{ old('tags') == 'dmu_follow' || $task->tags == 'dmu_follow' ? 'selected' : '' }}>
                                        DMU Follow</option>
                                    <option value="not_dec"
                                        {{ old('tags') == 'not_dec' || $task->tags == 'not_dec' ? 'selected' : '' }}>RHE
                                    </option>
                                    <option value="not"
                                        {{ old('tags') == 'not' || $task->tags == 'not' ? 'selected' : '' }}>Not</option>
                                </select>

                                @error('tags')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Next Follow-up Date -->
                            <div class="mb-3 col-md-3">
                                <label for="next_followup_date_time" class="form-label">Next Follow-up</label>
                                <input type="datetime-local" class="form-control"
                                    value="{{ old('next_followup_date_time', $task->next_followup_date_time ?? '') }}"
                                    id="next_followup_date_time" name="next_followup_date_time">
                                @error('next_followup_date_time')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Call Record -->
                            <div class="mb-3 col-md-3">
                                <label for="call_record" class="form-label">Call Record</label>
                                <input type="file" class="form-control" id="call_record" name="call_record"
                                    accept="audio/*">
                                @error('call_record')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Call History Image -->
                            <div class="mb-3 col-md-4">
                                <label for="call_history_img" class="form-label">Call History Image <span
                                        style="color:red">(Max: 3MB)</span></label>

                                @if (isset($task->call_history_img))
                                    <!-- Check if the image exists -->
                                    <img src="{{ Storage::url('call_history_images/' . $task->call_history_img) }}"
                                        alt="Call History Image" class="img-thumbnail mb-2" style="max-height: 50px;">
                                @else
                                    <p>No image uploaded.</p> <!-- Optional message if no image exists -->
                                @endif

                                <input type="file" class="form-control" id="imgInp" name="call_history_img"
                                    value="{{ old('call_history_img', $task->call_history_img ?? '') }}" accept="image/*">

                                @error('call_history_img')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Client Type -->
                            <div class="mb-3 col-md-4">
                                <label for="client_type" class="form-label">Client Type</label>
                                <select class="form-select" id="client_type" name="client_type">
                                    <option value="" disabled>Select Client Type</option>
                                    <option value="NC"
                                        {{ isset($task) && $task->client_type == 'NC' ? 'selected' : (old('client_type') == 'NC' ? 'selected' : '') }}>
                                        NC</option>
                                    <option value="EC"
                                        {{ isset($task) && $task->client_type == 'EC' ? 'selected' : (old('client_type') == 'EC' ? 'selected' : '') }}>
                                        EC</option>
                                    <option value="DC"
                                        {{ isset($task) && $task->client_type == 'DC' ? 'selected' : (old('client_type') == 'DC' ? 'selected' : '') }}>
                                        DC</option>
                                </select>
                                @error('client_type')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3 col-md-4">
                                <label for="employee">Employee <b style="color: red;">*</b></label>
                                <select class="form-control" id="employee" name="employee_id">
                                    <option value="" disabled>Select employee</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}"
                                            {{ isset($task) && $task->employee_id == $employee->id ? 'selected' : (old('employee_id') == $employee->id ? 'selected' : '') }}>
                                            {{ $employee->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3 col-md-4">
                                <label for="address" class="form-label">Address</label>
                                <textarea type="text" class="form-control" id="address" id="address"
                                    value="{{ old('address', $task->address ?? '') }}" name="address" placeholder="Enter address">{{ old('address', $task->address ?? '') }}</textarea>

                                @error('address')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3 col-md-4">
                                <label for="comments" class="form-label">Any comment?</label>
                                <textarea type="text" class="form-control" id="comments" value="{{ old('comments', $task->comments ?? '') }}"
                                    name="comments" placeholder="Enter comments">{{ old('comments', $task->comments ?? '') }}</textarea>

                                @error('comments')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="note" class="form-label">Any note?</label>
                                <textarea type="text" class="form-control" id="note" value="{{ old('note', $task->note ?? '') }}"
                                    name="note" placeholder="Enter note">{{ old('note', $task->note ?? '') }}</textarea>
                                @error('note')
                                    <div class="error text-danger">{{ $message }}</div>
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
    <script src="{{ asset('admin/assets/js/image-two-mb.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#submenu').change(function() {
                var submenuId = $(this).val(); // Change to submenu ID
                if (submenuId) {
                    $.ajax({
                        url: "{{ route('fetch.vendor.data') }}", // Your route here
                        type: 'GET',
                        data: {
                            submenu_id: submenuId // Use submenu_id in the request
                        },
                        success: function(data) {
                            if (data.success) {
                                // Populate fields with the vendor data
                                $('#vendor_id').val(data.vendor
                                    .id); // Change 'vendor_id' to 'id' if needed
                                $('#company_name').val(data.vendor.company_name);
                                $('#email').val(data.vendor.email);
                                $('#number').val(data.vendor.number);
                                $('#address').val(data.vendor.address);
                                // Add more fields as needed
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
                            $('#city').empty().append(
                                '<option value="" selected disabled>Select City</option>');
                            if (response.status === 1) {
                                $.each(response.data, function(key, city) {
                                    $('#city').append("<option value='" + city.id +
                                        "'>" + city.name + "</option>");
                                });
                            } else {
                                $('#city').append(
                                    '<option value="" selected disabled>No cities found</option>'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                            $('#city').empty().append(
                                '<option value="" selected disabled>Error loading cities</option>'
                            );
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

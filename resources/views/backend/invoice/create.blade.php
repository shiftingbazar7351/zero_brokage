@extends('backend.layouts.main')


@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">

            <div class="main-wrapper">

                <div class="container border shadow-sm mt-2">
                    <h4> CRUD Invoice</h4>
                </div>
                <div class="container mt-4 border rounded shadow">
                    <form id="addCategoryModal" action="{{ route('invoice.store') }}" method="POST"
                        enctype="multipart/form-data" data-parsley-validate="true">
                        @csrf
                        <div class="row mx-auto  mt-3">

                            <div class="col-md-3">
                                <label for="category">Category<b style="color: red;">*</b></label>
                                <select class="form-control" id="category" name="category_id" required>
                                    <option value="">Select category</option>
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
                                <select class="form-control" id="subcategory" name="subcategory_id" required>
                                    <option value="">Select subcategory</option>
                                </select>
                                @error('sub_category')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="menu">Menu<b style="color: red;">*</b></label>
                                <select class="form-control" id="menu" name="menu_id" required>
                                    <option value="">Select menu</option>
                                </select>
                                @error('menu_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="submenu">Sub-Menu<b style="color: red;">*</b></label>
                                <select class="form-control" id="submenu" name="submenu_id" required>
                                    <option value="">Select submenu</option>
                                </select>
                                @error('submenu_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row mx-auto mt-3">

                            <div class="col-md-3">
                                <label for="state" class="form-label">State<b style="color: red;">*</b></label>
                                <select id="state" name="state" class="form-select" required>
                                    <option selected disabled>Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ ucwords($state->name) }}</option>
                                    @endforeach
                                </select>
                                @error('state')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="city" class="form-label">City<b style="color: red;">*</b></label>
                                <select class="form-select" id="city" name="city" required>
                                    <option value="">Select City</option>
                                </select>
                                @error('city')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Product<b style="color: red;">*</b></label>
                                <select name="employee_id" class="form-select bg-light-subtle"
                                    aria-label="Default select example" required>
                                    <option value="" selected disabled>Select Option</option>
                                    <option value="1" {{ old('employee_id') == '1' ? 'selected' : '' }}>Product1
                                    </option>
                                    <option value="2" {{ old('employee_id') == '2' ? 'selected' : '' }}>Product2
                                    </option>
                                    <option value="3" {{ old('employee_id') == '3' ? 'selected' : '' }}>Product3
                                    </option>
                                </select>
                                @error('employee_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">HSN<b style="color: red;">*</b></label>
                                <select name="employee_id" class="form-select bg-light-subtle"
                                    aria-label="Default select example" required>
                                    <option value="" selected disabled>Select HSN</option>
                                    <option value="1" {{ old('employee_id') == '1' ? 'selected' : '' }}>Product1
                                    </option>
                                    <option value="2" {{ old('employee_id') == '2' ? 'selected' : '' }}>Product2
                                    </option>
                                    <option value="3" {{ old('employee_id') == '3' ? 'selected' : '' }}>Product3
                                    </option>
                                </select>
                                @error('employee_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mx-auto mt-3">

                            <div class="col-md-3">

                                <label class="form-label text-dark">Price<b style="color: red;">*</b></label>
                                <input name="price" class="form-control bg-light-subtle" placeholder="Enter price"
                                    required>{{ old('price') }}</input>

                                @error('price')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">GST<b style="color: red;">*</b></label>
                                <select name="employee_id" class="form-select bg-light-subtle"
                                    aria-label="Default select example" required>
                                    <option value="" selected disabled>Select GST</option>
                                    <option value="1" {{ old('employee_id') == '1' ? 'selected' : '' }}>0%
                                    </option>
                                    <option value="2" {{ old('employee_id') == '2' ? 'selected' : '' }}>12%
                                    </option>
                                    <option value="3" {{ old('employee_id') == '3' ? 'selected' : '' }}>18%
                                    </option>
                                </select>
                                @error('employee_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">

                                <label class="form-label text-dark">Quantity<b style="color: red;">*</b></label>
                                <input name="quantity" class="form-control bg-light-subtle" placeholder="Enter quantity"
                                    required>{{ old('quantity') }}</input>

                                @error('quantity')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">

                                <label class="form-label text-dark">Total Ammount<b style="color: red;">*</b></label>
                                <input name="total_ammount" class="form-control bg-light-subtle"
                                    placeholder="Enter total_ammount" required>{{ old('total_ammount') }}</input>

                                @error('total_ammount')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mx-auto my-3">

                            <div class="col-md-4">

                                <label class="form-label text-dark">Grand Total<b style="color: red;">*</b></label>
                                <input name="grand_total" class="form-control bg-light-subtle"
                                    placeholder="Enter grand total" required>{{ old('grand_total') }}</input>

                                @error('grand_total')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2 align-items-end d-flex">
                                <button type="submit" id="submitbutton" class="btn btn-success">Add Invoice</button>
                            </div>

                        </div>


                    </form>
                </div>
                <div class="col-12">
                    <div class="table-responsive table-div">
                        <table class="table datatable table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Menu</th>
                                    <th>Sub Menu</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Ammount</th>
                                    <th>Grand Total</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td> {{ $invoice->category->name ?? '' }} </td>
                                        <td> {{ $invoice->subcategory->name ?? '' }} </td>
                                        <td> {{ $invoice->menu->name ?? '' }} </td>
                                        <td> {{ $invoice->submenu->name ?? '' }} </td>
                                        <td> {{ $invoice->price ?? '' }} </td>
                                        <td> {{ $invoice->quantity ?? '' }} </td>
                                        <td> {{ $invoice->total_ammount ?? '' }} </td>
                                        <td> {{ $invoice->grand_total ?? '' }} </td>
                                        <td> {{ $invoice->city_name->name ?? '' }} </td>
                                        {{-- <td></td> --}}
                                        <td> {{ $invoice->state_name->name ?? '' }} </td>
                                        <td>
                                            <div class="table-actions d-flex justify-content-center">
                                                <button class="btn delete-table me-2" onclick="#" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#edit-category">
                                                    <i class="fe fe-edit"></i>
                                                </button>
                                                <form action="#" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn delete-table" type="submit"
                                                        onclick="return confirm('Are you sure want to delete this?')">
                                                        <i class="fe fe-trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No data found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- product data show fileds --}}
                <div class="container mt-4 border rounded shadow">
                    <form id="addCategoryModal" action="{{ route('invoice.store') }}" method="POST"
                        enctype="multipart/form-data" data-parsley-validate="true">
                        @csrf
                        <div class="row mx-auto">

                            <div class="col-md-4">

                                <label class="form-label text-dark">Company Name<b style="color: red;">*</b></label>
                                <input name="company_name" class="form-control bg-light-subtle" placeholder="Enter company name"
                                    required>{{ old('company_name') }}</input>

                                @error('company_name')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">

                                <label class="form-label text-dark">Min Lead<b style="color: red;">*</b></label>
                                <input name="min_lead" class="form-control bg-light-subtle" placeholder="Enter company name"
                                    required>{{ old('company_name') }}</input>

                                @error('company_name')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row mx-auto mt-3">

                            <div class="col-md-4">
                                <label for="submenu">Sub-Menu<b style="color: red;">*</b></label>
                                <select class="form-control" id="submenu" name="submenu_id" required>
                                    <option value="">Select submenu</option>
                                </select>
                                @error('submenu_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="state" class="form-label">State<b style="color: red;">*</b></label>
                                <select id="state" name="state" class="form-select" required>
                                    <option selected disabled>Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ ucwords($state->name) }}</option>
                                    @endforeach
                                </select>
                                @error('state')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="city" class="form-label">City<b style="color: red;">*</b></label>
                                <select class="form-select" id="city" name="city" required>
                                    <option value="">Select City</option>
                                </select>
                                @error('city')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mx-auto mt-3">
                            <div class="col-md-4">
                                <label class="form-label">Product<b style="color: red;">*</b></label>
                                <select name="employee_id" class="form-select bg-light-subtle"
                                    aria-label="Default select example" required>
                                    <option value="" selected disabled>Select Option</option>
                                    <option value="1" {{ old('employee_id') == '1' ? 'selected' : '' }}>Product1
                                    </option>
                                    <option value="2" {{ old('employee_id') == '2' ? 'selected' : '' }}>Product2
                                    </option>
                                    <option value="3" {{ old('employee_id') == '3' ? 'selected' : '' }}>Product3
                                    </option>
                                </select>
                                @error('employee_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">HSN<b style="color: red;">*</b></label>
                                <select name="employee_id" class="form-select bg-light-subtle"
                                    aria-label="Default select example" required>
                                    <option value="" selected disabled>Select HSN</option>
                                    <option value="1" {{ old('employee_id') == '1' ? 'selected' : '' }}>Product1
                                    </option>
                                    <option value="2" {{ old('employee_id') == '2' ? 'selected' : '' }}>Product2
                                    </option>
                                    <option value="3" {{ old('employee_id') == '3' ? 'selected' : '' }}>Product3
                                    </option>
                                </select>
                                @error('employee_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">

                                <label class="form-label text-dark">Price<b style="color: red;">*</b></label>
                                <input name="price" class="form-control bg-light-subtle" placeholder="Enter price"
                                    required>{{ old('price') }}</input>

                                @error('price')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mx-auto mt-3">
                            <div class="col-md-4">
                                <label class="form-label">GST<b style="color: red;">*</b></label>
                                <select name="employee_id" class="form-select bg-light-subtle"
                                    aria-label="Default select example" required>
                                    <option value="" selected disabled>Select GST</option>
                                    <option value="1" {{ old('employee_id') == '1' ? 'selected' : '' }}>0%
                                    </option>
                                    <option value="2" {{ old('employee_id') == '2' ? 'selected' : '' }}>12%
                                    </option>
                                    <option value="3" {{ old('employee_id') == '3' ? 'selected' : '' }}>18%
                                    </option>
                                </select>
                                @error('employee_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">

                                <label class="form-label text-dark">Quantity<b style="color: red;">*</b></label>
                                <input name="quantity" class="form-control bg-light-subtle" placeholder="Enter quantity"
                                    required>{{ old('quantity') }}</input>

                                @error('quantity')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">

                                <label class="form-label text-dark">Total Ammount<b style="color: red;">*</b></label>
                                <input name="total_ammount" class="form-control bg-light-subtle"
                                    placeholder="Enter total_ammount" required>{{ old('total_ammount') }}</input>

                                @error('total_ammount')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mx-auto mt-3">

                            <div class="col-md-4">

                                <label class="form-label text-dark">Grand Total<b style="color: red;">*</b></label>
                                <input name="grand_total" class="form-control bg-light-subtle"
                                    placeholder="Enter grand total" required>{{ old('grand_total') }}</input>

                                @error('grand_total')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="">

                                <button type="submit" id="submitbutton" class="btn btn-success">Add</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection

@section('scripts')
    {{--
<script src="{{ asset('assets/js/vendor-validation.js') }}"></script> --}}
    <script src="{{ asset('admin/summernote/summernote.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    {{--
<script>
    document.getElementById('formFile').addEventListener('change', function () {
        const file = this.files[0];
        if (file.size > 52428800) { // 50MB limit
            alert('File size exceeds 50MB');
            this.value = ''; // Clear the input
        } else {
            alert(`Selected file: ${file.name}`);
        }
    });
</script> --}}
    <script>
        const inputvender = document.querySelector("#phoneNumVender");
        window.intlTelInput(inputvender, {
            initialCountry: "in",
            separateDialCode: true
        });
    </script>
    <script>
        const whatsappvender = document.querySelector("#whatsappNumVender");
        window.intlTelInput(whatsappvender, {
            initialCountry: "in",
            separateDialCode: true
        });
    </script>
    {{-- .............Show OTP verify input field (start)..................... --}}
    <script>
        function checkPhoneNumberOrWhatsapp(input) {
            const otpSection = document.getElementById('otpSection');
            const phoneNum = document.getElementById('phoneNumVender').value;
            const whatsappNum = document.getElementById('whatsappNumVender').value;

            // Check if either phone number or WhatsApp number is 10 digits
            if (phoneNum.length === 10 || whatsappNum.length === 10) {
                otpSection.style.display = 'block';
            } else {
                otpSection.style.display = 'none';
            }

        }
    </script>
    {{-- .............Show OTP verify input field (end)..................... --}}



    <script>
        document.getElementById('addlocation').addEventListener('click', function() {

            document.getElementById('longitude').classList.remove('d-none');
            document.getElementById('addlocation').classList.add('d-none');
        });
    </script>

    <script>
        document.getElementById('companyNameCheckbox').addEventListener('change', function() {
            const companyNameField = document.getElementById('companyname');
            const legalCompanyNameField = document.getElementById('lcompanyname');

            if (this.checked) {
                legalCompanyNameField.value = companyNameField.value;
            } else {
                legalCompanyNameField.value = ''; // Clear the legal company name if checkbox is unchecked
            }
        });

        // Optional: Sync legal company name when company name is typed
        document.getElementById('companyname').addEventListener('input', function() {
            const checkbox = document.getElementById('companyNameCheckbox');
            if (checkbox.checked) {
                document.getElementById('lcompanyname').value = this.value;
            }
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
                            $('#city').empty().append('<option value="">Select City</option>');
                            if (response.status === 1) {
                                $.each(response.data, function(key, city) {
                                    $('#city').append("<option value='" + city.id +
                                        "'>" + city.name + "</option>");
                                });
                            } else {
                                $('#city').append(
                                    '<option value="" disabled>No cities found</option>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                            $('#city').empty().append(
                                '<option value="" disabled>Error loading cities</option>');
                        }
                    });
                } else {
                    $('#city').empty().append('<option value="">Select City</option>');
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

        function sendOtpIfValid(input) {
            var phoneNumber = input.value;
            if (phoneNumber.length === 10) {
                // Clear any previous errors
                document.getElementById('phoneError').textContent = '';

                // AJAX call to send OTP
                $.ajax({
                    url: '/vendor-send-otp',
                    method: 'POST',
                    data: {
                        number: phoneNumber, // Changed to 'number'
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // alert(response.message); // Notify OTP sent
                        // alert(opt);
                        toastr.success('OTP has been sent: ' + response.otp);
                        document.getElementById('otpSection').style.display = 'block'; // Show OTP input
                    },
                    error: function(response) {
                        if (response.responseJSON && response.responseJSON.errors && response.responseJSON
                            .errors.number) {
                            document.getElementById('phoneError').textContent = response.responseJSON.errors
                                .number[0];
                        } else {
                            document.getElementById('phoneError').textContent =
                                'An error occurred. Please try again.';
                        }
                    }
                });
            } else {
                document.getElementById('phoneError').textContent = 'Please enter a valid 10-digit phone number.';
            }
        }

        function verifyOtp() {
            var otp = document.getElementById('otp').value;
            var phoneNumber = document.getElementById('phoneNumVender').value; // Get the mobile number

            if (otp.length === 4 && phoneNumber.length === 10) {
                document.getElementById('otpError').textContent = '';

                $.ajax({
                    url: '/vendor-verify-otp',
                    method: 'POST',
                    data: {
                        otp: otp,
                        mobile_number: phoneNumber, // send the mobile number as 'mobile_number'
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // alert(response.message); // Notify OTP verified
                        toastr.success('Otp verfied successfully')
                        document.getElementById('otpSection').style.display =
                            'none'; // Hide OTP input after verification
                    },
                    error: function(response) {
                        if (response.responseJSON && response.responseJSON.errors) {
                            document.getElementById('otpError').textContent = response.responseJSON.errors
                                .mobile_number ?
                                response.responseJSON.errors.mobile_number[0] :
                                response.responseJSON.errors.otp[0];
                        } else {
                            document.getElementById('otpError').textContent =
                                'An error occurred. Please try again.';
                        }
                    }
                });
            } else {
                document.getElementById('otpError').textContent =
                    'Please enter a valid 4-digit OTP and 10-digit phone number.';
            }
        }
    </script>
@endsection

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
                                <select class="form-control" id="subcategory" name="subcategory_id" required>
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
                                    <option value="" selected disabled>Select City</option>
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
                                <select name="hsn" class="form-select bg-light-subtle"
                                    aria-label="Default select example" required>
                                    <option value="" selected disabled>Select HSN</option>
                                    <option value="1" {{ old('hsn') == '998429' ? 'selected' : '' }}>998429
                                    </option>
                                    <option value="2" {{ old('hsn') == '996511' ? 'selected' : '' }}>996511
                                    </option>
                                </select>
                                @error('hsn')
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
                            <div class="col-md-3">
                                <label class="form-label">GST<b style="color: red;">*</b></label>
                                <select name="gst" class="form-select bg-light-subtle"
                                    aria-label="Default select example" required>
                                    <option value="3" {{ old('gst') == '18%' ? 'selected' : '' }}>18%
                                    </option>
                                    <option value="1" {{ old('gst') == '5%' ? 'selected' : '' }}>5%
                                    </option>
                                    <option value="2" {{ old('gst') == '12%' ? 'selected' : '' }}>12%
                                    </option>
                                </select>
                                @error('gst')
                                    <div class="text-danger">{{ $message }}</div>
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
                                @if(session('new_invoice'))
                                    @php $invoice = session('new_invoice'); @endphp
                                    <tr>
                                        <td>1</td>
                                        <td> {{ $invoice->category->name ?? '' }} </td>
                                        <td> {{ $invoice->subcategory->name ?? '' }} </td>
                                        <td> {{ $invoice->menu->name ?? '' }} </td>
                                        <td> {{ $invoice->submenu->name ?? '' }} </td>
                                        <td> {{ $invoice->price ?? '' }} </td>
                                        <td> {{ $invoice->quantity ?? '' }} </td>
                                        <td> {{ $invoice->total_ammount ?? '' }} </td>
                                        <td> {{ $invoice->grand_total ?? '' }} </td>
                                        <td> {{ $invoice->city_name->name ?? '' }} </td>
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
                                @else
                                    <tr>
                                        <td colspan="12" class="text-center">No data found</td>
                                    </tr>
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>

                {{-- product data show fileds --}}
                <div class="container mt-4 border rounded shadow">
                    <form id="addCategoryModal" action="{{ route('vendors.update', $vendor->id ?? '') }}" method="POST"
                        enctype="multipart/form-data" data-parsley-validate="true">
                        @csrf
                        <div class="row mx-auto">

                            <div class="col-md-6">

                                <label class="form-label text-dark">Company Name<b style="color: red;">*</b></label>
                                <input name="company_name" class="form-control bg-light-subtle"
                                    placeholder="Enter company name"
                                    value="{{ old('company_name', $vendor->company_name ?? '') }}" required></input>

                                @error('company_name')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-dark">Min Lead<b style="color: red;">*</b></label>
                                <input name="min_lead" class="form-control bg-light-subtle" value="1"
                                    placeholder="Enter company name" required />

                                @error('company_name')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row mx-auto mt-3">
                            <div class="col-md-4">
                                <label class="form-label text-dark">Locality<b style="color: red;">*</b></label>
                                <input name="location_lat" class="form-control bg-light-subtle"
                                    value="{{ $vendor->location_lat ?? '' }}" placeholder="Enter company name"
                                    required />

                                @error('company_name')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-dark">Whatsapp Number<b style="color: red;">*</b></label>
                                <input name="whatsapp" class="form-control bg-light-subtle" id="price"
                                    maxlength="10" value="{{ $vendor->whatsapp ?? '' }}"
                                    placeholder="Enter company name" required />

                                @error('whatsapp')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-dark">Phone Number<b style="color: red;">*</b></label>
                                <input name="number" id="discount" class="form-control bg-light-subtle"
                                    value="{{ $vendor->number ?? '' }}" placeholder="Enter company name" required />

                                @error('number')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mx-auto mt-3">
                            <div class="col-md-4">
                                <label class="form-label text-dark">Email<b style="color: red;">*</b></label>
                                <input name="email" id="discount" class="form-control bg-light-subtle"
                                    value="{{ $vendor->email ?? '' }}" placeholder="Enter company name" required />

                                @error('email')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-dark">State<b style="color: red;">*</b></label>
                                <input name="state" id="discount" class="form-control bg-light-subtle"
                                    value="{{ $vendor->cityName->state->name ?? '' }}" placeholder="Enter company name"
                                    required />

                                @error('state')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-dark">City<b style="color: red;">*</b></label>
                                <input name="city" id="discount" class="form-control bg-light-subtle"
                                    value="{{ $vendor->cityName->name ?? '' }}" placeholder="Enter company name"
                                    required />

                                @error('city')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mx-auto mt-3">
                            <div class="col-md-4">
                                <label class="form-label text-dark">Transaction Id<b style="color: red;">*</b></label>
                                <select class="selectpicker" multiple="multiple" data-live-search="true"
                                        data-selected-text-format="value" id="transactionId" name="transaction_id[]">
                                    <option value="" selected disabled>Select Transaction ID</option>
                                    @foreach ($transactions as $transaction)
                                        <option value="{{ $transaction->id }}">{{ $transaction->transaction_id ?? '' }}</option>
                                    @endforeach
                                </select>
                                @error('transaction_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">UTR<b style="color: red;">*</b></label>
                                <input class="form-control" type="text" name="utr" value="{{ old('utr') }}">
                                @error('utr')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Payment Date<b style="color: red;">*</b></label>
                                <input class="form-control" type="text" name="payment_time" value="{{ old('payment_time') }}">
                                @error('payment_time')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Screenshot<b style="color: red;">*</b></label>
                                <div id="screenshotContainer" style="width: 50px; height;50px">
                                    <!-- Images will be inserted here by AJAX -->

                                </div>
                                <input class="form-control" type="file" name="screenshot"
                                    value="{{ old('screenshot') }}">
                                @error('screenshot')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label text-dark">GST<b style="color: red;">*</b></label>
                                <input name="gst" class="form-control bg-light-subtle" placeholder="Enter gst"
                                    required>{{ old('gst') }}</input>

                                @error('gst')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label text-dark">Date<b style="color: red;">*</b></label>
                                <input name="Date" class="form-control bg-light-subtle" placeholder="Enter Date"
                                    required>{{ old('Date') }}</input>

                                @error('Date')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-dark">Address<b style="color: red;">*</b></label>
                                <textarea name="address" class="form-control bg-light-subtle" placeholder="Enter address"
                                    required>{{ old('address',$vendor->address ??'') }}</textarea>

                                @error('address')
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
      <script>
        $(document).ready(function() {
    $('#transactionId').on('change', function() {
        var transactionIds = $(this).val(); // Get selected transaction IDs

        if (transactionIds && transactionIds.length) {
            $.ajax({
                url: '/transactions',
                type: 'GET',
                data: { transaction_ids: transactionIds },
                dataType: 'json',
                success: function(data) {
                    if (data && !data.error) {
                        var utrs = [];
                        var paymentTimes = [];
                        var screenshots = [];

                        $.each(data, function(id, details) {
                            utrs.push(details.utr);
                            paymentTimes.push(details.payment_time);
                            if (details.screenshot) {
                                screenshots.push('<img src="' + details.screenshot + '" alt="Screenshot" style="width: 120px;">');
                            } else {
                                screenshots.push('No Image');
                            }
                        });

                        $('input[name="utr"]').val(utrs.join(', '));
                        $('input[name="payment_time"]').val(paymentTimes.join(', '));
                        $('#screenshotContainer').html(screenshots.join('<br>'));
                    } else {
                        alert(data.error || 'Transaction details not found');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error retrieving transaction details: ' + textStatus);
                }
            });
        }
    });
});

      </script>

@endsection

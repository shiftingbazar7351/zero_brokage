@extends('backend.layouts.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/virtual-select.min.css') }}">
    <style>
        #multi_option {
            max-width: 100%;
            width: 350px;
        }

        .labeltransaction {
            display: block;
            margin-bottom: 5px;
        }

        .vscomp-toggle-button {
            padding: 10px 30px 10px 10px;
            border-radius: 5px;
        }

        .vscomp-ele {
            max-width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">

            <div class="main-wrapper">

                <div class="container mt-4 border rounded shadow p-3">
                    <form id="addCategoryModal" action="{{ route('invoice.store') }}" method="POST"
                        enctype="multipart/form-data" data-parsley-validate="true">
                        @csrf
                        <div class="row mx-auto  mt-3">

                            <div class="col-md-3">
                                <label for="category">Category<b style="color: red;">*</b></label>
                                {{-- <select class="form-control" id="category" name="category_id" required>
                                    <option value="" selected disabled>Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select> --}}

                                <select id="category" class="multiOption" multiple name="native-select"
                                    placeholder="Select category" data-silent-initial-value-set="false">
                                    <option value="1">AC</option>
                                    <option value="2">PLUMBER</option>
                                    <option>MECHANIC</option>
                                    <option value="4">CLEANING</option>
                                    <option value="5">JAVA</option>
                                    <option>PHP</option>
                                </select>
                                @error('category')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="subcategory">Sub Category<b style="color: red;">*</b></label>
                                {{-- <select class="form-control" id="subcategory" name="subcategory_id" required>
                                    <option value="" selected disabled>Select subcategory</option>
                                </select> --}}

                                <select class="multiOption" multiple name="native-select" placeholder="Select Subcategory"
                                    data-silent-initial-value-set="false">
                                    <option value="1">Installation__</option>
                                    <option value="2">Uninstallation__</option>
                                    <option value="3">services__</option>
                                    <option value="4">CLEANING</option>
                                    <option value="5">JAVA</option>
                                    <option value="6">PHP</option>
                                </select>
                                @error('sub_category')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="menu">Menu<b style="color: red;">*</b></label>
                                {{-- <select class="form-control" id="menu" name="menu_id" required>
                                    <option value="" selected disabled>Select menu</option>
                                </select> --}}
                                <select class="multiOption" multiple name="native-select" placeholder="Select menu"
                                    data-silent-initial-value-set="false">
                                    <option>Menu</option>
                                    <option>Uninstallation__</option>
                                    <option value="3">services__</option>
                                    <option value="4">CLEANING</option>
                                    <option value="5">JAVA</option>
                                    <option value="6">PHP</option>
                                </select>
                                @error('menu_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="submenu">Sub-Menu<b style="color: red;">*</b></label>
                                {{-- <select class="form-control" id="submenu" name="submenu_id" required>
                                    <option value="" selected disabled>Select submenu</option>
                                </select> --}}
                                <select class="multiOption" multiple name="native-select" placeholder="Select submenu"
                                    data-silent-initial-value-set="false">
                                    <option value="1">SubMenu</option>
                                    <option value="2">Uninstallation__</option>
                                    <option value="3">services__</option>
                                    <option value="4">CLEANING</option>
                                    <option value="5">JAVA</option>
                                    <option value="6">PHP</option>
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
                                <input id="price" name="price" class="form-control bg-light-subtle"
                                    placeholder="Enter price" required value="{{ old('price') }}">
                                @error('price')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label text-dark">Quantity<b style="color: red;">*</b></label>
                                <input id="quantity" name="quantity" class="form-control bg-light-subtle"
                                    placeholder="Enter quantity" required value="{{ old('quantity') }}">
                                @error('quantity')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label text-dark">Total Amount<b style="color: red;">*</b></label>
                                <input id="total_amount" name="total_ammount" class="form-control bg-light-subtle"
                                    placeholder="Enter total amount" readonly required
                                    value="{{ old('total_ammount') }}">
                                @error('total_ammount')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">GST<b style="color: red;">*</b></label>
                                <select id="gst" name="gst" class="form-select bg-light-subtle"
                                    aria-label="Default select example" required>
                                    <option value="18" {{ old('gst') == '18%' ? 'selected' : '' }}>18%</option>
                                    <option value="12" {{ old('gst') == '12%' ? 'selected' : '' }}>12%</option>
                                    <option value="5" {{ old('gst') == '5%' ? 'selected' : '' }}>5%</option>
                                </select>
                                @error('gst')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mx-auto my-3">
                            <div class="col-md-4">
                                <label class="form-label text-dark">Grand Total<b style="color: red;">*</b></label>
                                <input id="grand_total" name="grand_total" class="form-control bg-light-subtle"
                                    placeholder="Enter grand total" readonly required value="{{ old('grand_total') }}">
                                @error('grand_total')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2 align-items-end d-flex">
                                <button type="submit" id="submitbutton" class="btn btn-success">Add Invoice</button>
                            </div>
                        </div>

                    </form>
                    <div class="row col-12">
                        <div class="table-responsive table-div">
                            <table class="table text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Sub Category</th>
                                        <th scope="col">Menu</th>
                                        <th scope="col">Sub Menu</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total Ammount</th>
                                        <th scope="col">Grand Total</th>
                                        <th scope="col">City</th>
                                        <th scope="col">State</th>
                                        <th scope="col">Action</th>
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
                    <div class="row mt-3">
                        <form id="addCategoryModal" action="{{ route('invoice.data.store', $vendor->id ?? '') }}"
                            method="POST" enctype="multipart/form-data" data-parsley-validate="true">
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
                                    <label class="form-label text-dark">Whatsapp Number<b
                                            style="color: red;">*</b></label>
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
                                    <input name="email" class="form-control bg-light-subtle"
                                        value="{{ $vendor->email ?? '' }}" placeholder="Enter company name" required />

                                    @error('email')
                                        <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label text-dark">State<b style="color: red;">*</b></label>
                                    <input name="state" id="discount" class="form-control bg-light-subtle" disabled
                                        value="{{ $vendor->cityName->state->name ?? '' }}"
                                        placeholder="Enter company name" required />

                                    @error('state')
                                        <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label text-dark">City<b style="color: red;">*</b></label>
                                    <input name="city" id="discount" class="form-control bg-light-subtle" disabled
                                        value="{{ $vendor->cityName->name ?? '' }}" placeholder="Enter company name"
                                        required />

                                    @error('city')
                                        <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mx-auto mt-3">
                                <div class="col-md-4">
                                    <label class="form-label text-dark labeltransaction">Transaction Id<b
                                            style="color: red;">*</b></label>
                                    <select class="multiOption" multiple name="transaction_id[]" id="transactionId"
                                        data-silent-initial-value-set="false">
                                        <option value="" disabled>Select Transaction ID</option>
                                        @foreach ($transactions as $transaction)
                                            <option value="{{ $transaction->id }}">
                                                {{ $transaction->transaction_id ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('transaction_id')
                                        <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-4">
                                    <label class="form-label">UTR<b style="color: red;">*</b></label>
                                    <input class="form-control" type="text" name="utr"
                                        value="{{ old('utr') }}">
                                    @error('utr')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Payment Date<b style="color: red;">*</b></label>
                                    <input class="form-control" type="text" name="payment_time"
                                        value="{{ old('payment_time') }}">
                                    @error('payment_time')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mx-auto mt-3">

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
                                    <input name="date" type="date" class="form-control bg-light-subtle"
                                        placeholder="Enter Date" required>{{ old('Date') }}</input>

                                    @error('Date')
                                        <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mx-auto mt-3">
                                <div class="col-md-12">
                                    <label class="form-label text-dark">Address<b style="color: red;">*</b></label>
                                    <textarea name="address" class="form-control bg-light-subtle" placeholder="Enter address" required>{{ old('address', $vendor->address ?? '') }}</textarea>

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
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/virtual-select.min.js') }}"></script>

    <script type="text/javascript">
        VirtualSelect.init({
            ele: '.multiOption'
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
        $(document).ready(function() {
            $('#transactionId').on('change', function() {
                var transactionIds = $(this).val(); // Get selected transaction IDs

                if (transactionIds && transactionIds.length) {
                    $.ajax({
                        url: '/transactions',
                        type: 'GET',
                        data: {
                            transaction_ids: transactionIds
                        },
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
                                        screenshots.push('<img src="' + details
                                            .screenshot +
                                            '" alt="Screenshot" style="width: 120px;">'
                                        );
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

        document.addEventListener('DOMContentLoaded', function() {
            const priceInput = document.getElementById('price');
            const quantityInput = document.getElementById('quantity');
            const totalAmountInput = document.getElementById('total_amount');
            const gstSelect = document.getElementById('gst');
            const grandTotalInput = document.getElementById('grand_total');

            function calculateTotals() {
                const price = parseFloat(priceInput.value) || 0;
                const quantity = parseFloat(quantityInput.value) || 0;
                const gstPercentage = parseFloat(gstSelect.value) || 0;

                // Calculate Grand Total: Price * Quantity
                const grandTotal = price * quantity;
                grandTotalInput.value = grandTotal.toFixed(2);

                // Calculate GST Amount: Grand Total * GST%
                const gstAmount = grandTotal * (gstPercentage / 100);

                // Calculate Total Amount after subtracting GST: Grand Total - GST Amount
                const totalAmount = grandTotal - gstAmount;
                totalAmountInput.value = totalAmount.toFixed(2);
            }

            priceInput.addEventListener('input', calculateTotals);
            quantityInput.addEventListener('input', calculateTotals);
            gstSelect.addEventListener('change', calculateTotals);
        });
    </script>
@endsection

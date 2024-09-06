@extends('backend.layouts.main')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
<link rel="stylesheet" href="{{ asset('admin/summernote/summernote.min.css') }}">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="page-wrapper page-settings">
    <div class="content">

        <div class="main-wrapper">

            <div class="container border p-2 shadow-sm mt-2">
                <h4> Create Vendor</h4>
            </div>
            <div class="container mt-4 border p-5 rounded shadow">
                <form id="addCategoryModal" action="{{ route('vendors.store') }}" method="POST"
                    enctype="multipart/form-data" data-parsley-validate="true">
                    @csrf
                    <div class="row mx-auto">
                        <div class="col-md-4">
                            <label for="formManager" class="form-label">Manager <b style="color: red;">*</b></label>
                            <select name="manager_id" id="formManager" class="form-select bg-light-subtle"
                                aria-label="Default select example" style="box-shadow: none; font-size:1.4rem" required>
                                <option selected disabled>Select Option</option>
                                <option value="1" {{ old('manager_id')=='1' ? 'selected' : '' }}>dummy</option>
                                <option value="2" {{ old('manager_id')=='2' ? 'selected' : '' }}>person</option>
                                <option value="3" {{ old('manager_id')=='3' ? 'selected' : '' }}>thify</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="formFile" class="form-label">Employee<b style="color: red;">*</b></label>
                            <select name="employee_id" class="form-select bg-light-subtle"
                                aria-label="Default select example" style="box-shadow: none;font-size:1.4rem" required>
                                <option value="" selected disabled>Select Option</option>
                                <option value="1" {{ old('employee_id')=='1' ? 'selected' : '' }}>employee1
                                </option>
                                <option value="2" {{ old('employee_id')=='2' ? 'selected' : '' }}>employee2
                                </option>
                                <option value="3" {{ old('employee_id')=='3' ? 'selected' : '' }}>employee3
                                </option>
                            </select>
                            @error('employee_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="category">Category<b style="color: red;">*</b></label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="">Select category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mx-auto mt-3">
                        <div class="col-md-4">
                            <label for="subcategory">Sub Category<b style="color: red;">*</b></label>
                            <select class="form-control" id="subcategory" name="sub_category" required>
                                <option value="">Select subcategory</option>
                            </select>
                            @error('sub_category')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="menu">Menu<b style="color: red;">*</b></label>
                            <select class="form-control" id="menu" name="menu_id" required>
                                <option value="">Select menu</option>
                            </select>
                            @error('menu_id')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
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
                        <div class="col-md-6">
                            <label for="companyname" class="form-label">Company Name<b
                                    style="color: red;">*</b></label><span> (if same name)</span>
                            <input name="company_name_checkbox" class="form-check-input mx-1" type="checkbox"
                                id="companyNameCheckbox">
                            <input name="company_name" value="{{ old('company_name') }}" id="companyname"
                                class="form-control bg-light-subtle" type="text" placeholder="Company name"
                                aria-label="default input example" required>
                            @error('company_name')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="lcompanyname" class="form-label">Legal Company Name<b
                                    style="color: red;">*</b></label>
                            <input name="legal_company_name" value="{{ old('legal_company_name') }}" id="lcompanyname"
                                class="form-control bg-light-subtle" type="text" placeholder="Legal Company name"
                                aria-label="default input example" required>
                            @error('legal_company_name')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="state" class="form-label">State<b style="color: red;">*</b></label>
                            <select id="state" name="state" class="form-select" style="font-size:1.4rem" required>
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
                            <select class="form-select" id="city" name="city" style="font-size:1.4rem" required>
                                <option value="">Select City</option>
                            </select>
                            @error('city')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="pinnumber" class="form-label">PIN Code<b style="color: red;">*</b></label>
                            <input name="pincode" value="{{ old('pincode') }}" id="pinnumber"
                                class="form-control bg-light-subtle" type="text" placeholder="PIN code number"
                                maxlength="6" onkeyup="validateField(this)" aria-label="default input example" required>
                            <div id="pinnumberError" class="errorMessage text-danger"></div>
                        </div>
                        @error('pincode')
                        <div class="error text-danger ">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="row mt-4">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label text-dark">Address<b
                                    style="color: red;">*</b></label>
                            <textarea name="address" class="form-control bg-light-subtle" placeholder="Enter Address"
                                id="exampleFormControlTextarea1" rows="3" required>{{ old('address') }}</textarea>
                        </div>
                        @error('address')
                        <div class="error text-danger ">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="row mt-4">
                        <div class="col-md-3">
                            <label for="emailAddressVender" class="form-label">Email Address<b
                                    style="color: red;">*</b></label>
                            <input name="email" value="{{ old('email') }}" class="form-control bg-light-subtle"
                                id="emailAddressVender" type="text" placeholder="Email address"
                                aria-label="default input example" onkeyup="validateField(this)" required>
                            <div id="emailError" class="text-danger"></div>
                            @error('email')
                            <div class="error text-danger ">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mt-4 mt-md-0">
                            <label for="whatsappNumVender" class="form-label">WhatsApp<b
                                    style="color: red;">*</b></label>
                            <span class="mx-3">(Get notification)</span>
                            <input name="whatsapp" value="{{ old('whatsapp') }}" class="form-control bg-light-subtle"
                                id="whatsappNumVender" oninput="checkPhoneNumberOrWhatsapp(this)" type="text"
                                placeholder="WhatsApp number" aria-label="default input example" maxlength="10"
                                required>
                            <div id="whatsappError" class="text-danger"></div>
                            @error('whatsapp')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="col-md-3 mt-4 mt-md-0">
                            <label for="phoneNumVender" class="form-label">Phone Number<b
                                    style="color: red;">*</b></label>
                            <span>(Get notification)</span>
                            <input name="number" value="{{ old('number') }}" class="form-check-input mx-2"
                                type="checkbox" value="" id="flexCheckChecked" unchecked>
                            <input name="number" value="{{ old('number') }}" class="form-control bg-light-subtle"
                                id="phoneNumVender" type="text" placeholder="Phone number"
                                aria-label="default input example" maxlength="10" accept=""
                                oninput="checkPhoneNumber(this)" required>
                            <div id="phoneError" class="text-danger"></div>

                            @error('number')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div> --}}


                        {{-- <div class="col-md-3 mt-4 mt-md-0">
                            <label for="phoneNumVender" class="form-label">Phone Number<b
                                    style="color: red;">*</b></label>
                            <span>(Get notification)</span>
                            <input name="number" value="{{ old('number') }}" class="form-check-input mx-2"
                                type="checkbox" id="flexCheckChecked">
                            <input name="number" value="{{ old('number') }}" class="form-control bg-light-subtle"
                                id="phoneNumVender" type="text" placeholder="Phone number"
                                aria-label="default input example" onblur="sendOtpIfValid(this)"
                                oninput="checkPhoneNumber(this)" maxlength="10" required>
                            <div id="phoneError" class="text-danger"></div>
                            @error('number')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="col-md-3 mt-4 mt-md-0" id="otpSection" style="display: none;">
                            <label for="phoneNumVender" class="form-label">Verify OTP<b
                                    style="color: red;">*</b></label>
                            <div class="d-flex">
                                <input type="text" class="form-control me-2" placeholder="Enter OTP" aria-label="OTP">
                                <button type="button" class="btn btn-primary">OTP Submit</button>
                            </div>
                        </div> --}}

                        <div class="col-md-3 mt-4 mt-md-0">
                            <label for="phoneNumVender" class="form-label">Phone Number<b
                                    style="color: red;">*</b></label>
                            <span>(Get notification)</span>
                            <input name="number" value="{{ old('number') }}" class="form-control bg-light-subtle"
                                id="phoneNumVender" type="text" placeholder="Phone number"
                                aria-label="default input example" oninput="checkPhoneNumberOrWhatsapp(this)"
                                maxlength="10" required>
                            <div id="phoneError" class="text-danger"></div>
                            @error('number')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mt-4 mt-md-0" id="otpSection" style="display: none;">
                            <label for="otp" class="form-label">Verify OTP<b style="color: red;">*</b></label>
                            <div class="d-flex">
                                <input type="text" class="form-control me-2" id="otp" placeholder="Enter OTP"
                                    aria-label="OTP">
                                <button type="button" class="btn btn-primary" onclick="verifyOtp()">OTP Submit</button>
                            </div>
                            <div id="otpError" class="text-danger"></div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4">
                            <label for="formFile" class="form-label">Website (if available)</label>
                            <input name="website" value="{{ old('website') }}" class="form-control bg-light-subtle"
                                type="text" placeholder="www.example.com" aria-label="default input example">
                            @error('website')
                            <div class="error text-danger ">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="formFile" class="form-label">Verified or Approved By Team</label>
                            <select name="verified" class="form-select bg-light-subtle"
                                aria-label="Default select example" style="box-shadow: none;font-size:1.4rem">
                                <option selected disabled value="">Select Option</option>
                                @foreach ($verifieds as $verified)
                                <option value="{{ $verified->id }}">{{ $verified->name }}</option>
                                @endforeach
                            </select>
                            @error('verified')
                            <div class="error text-danger ">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="otp" class="form-label">OTP<b style="color: red;">*</b></label>
                            <input name="otp" value="{{ old('otp') }}" class="form-control bg-light-subtle" type="text"
                                id="otp" placeholder="Enter valid OTP" required>
                            <div id="otpError" class="text-danger"></div>
                            @error('otp')
                            <div class="error text-danger ">{{ $message }}</div>
                            @enderror
                        </div>

                                @error('number')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="col-md-3 mt-4 mt-md-0" id="otpSection" style="display: none;">
                                <label for="phoneNumVender" class="form-label">Verify OTP<b
                                        style="color: red;">*</b></label>
                                <div class="d-flex">
                                    <input type="text" class="form-control me-2" placeholder="Enter OTP"
                                        aria-label="OTP">
                                    <button type="button" class="btn btn-primary">OTP Submit</button>
                                </div>
                            </div> --}}

                            <div class="col-md-3 mt-4 mt-md-0">
                                <label for="phoneNumVender" class="form-label">Phone Number<b
                                        style="color: red;">*</b></label>
                                <span>(Get notification)</span>
                                <input name="number" value="{{ old('number') }}" class="form-control bg-light-subtle"
                                    id="phoneNumVender" type="text" placeholder="Phone number"
                                    aria-label="default input example" onblur="sendOtpIfValid(this)" maxlength="10"
                                    oninput="checkPhoneNumber(this)" required>
                                <div id="phoneError" class="text-danger"></div>
                                @error('number')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mt-4 mt-md-0" id="otpSection" style="display: none;">
                                <label for="otp" class="form-label">Verify OTP<b style="color: red;">*</b></label>
                                <div class="d-flex">
                                    <input type="text" class="form-control me-2" id="otp"
                                        placeholder="Enter OTP" aria-label="OTP" maxlength="4" id="number">
                                    <button type="button" class="btn btn-primary" onclick="verifyOtp()">OTP
                                        Submit</button>
                                </div>
                                <div id="otpError" class="text-danger"></div>
                            </div>

                        </div>

                        <div class="row mt-4">
                            <div class="col-md-4">
                                <label for="formFile" class="form-label">Website (if available)</label>
                                <input name="website" value="{{ old('website') }}" class="form-control bg-light-subtle"
                                    type="text" placeholder="www.example.com" aria-label="default input example">
                                @error('website')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="formFile" class="form-label">Verified or Approved By Team</label>
                                <select name="verified" class="form-select bg-light-subtle"
                                    aria-label="Default select example" style="box-shadow: none">
                                    <option selected disabled value="">Select Option</option>
                                    @foreach ($verifieds as $verified)
                                        <option value="{{ $verified->id }}">{{ $verified->name }}</option>
                                    @endforeach
                                </select>
                                @error('verified')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mt-4 mt-md-0" id="otpSection" style="display: none;">
                                <label for="otp" class="form-label">Verify OTP<b style="color: red;">*</b></label>
                                <div class="d-flex">
                                    <input type="text" class="form-control me-2" id="otp"
                                        placeholder="Enter OTP" aria-label="OTP">
                                    <button type="button" class="btn btn-primary" onclick="verifyOtp()">OTP
                                        Submit</button>
                                </div>
                                <div id="otpError" class="text-danger"></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="formFile" class="form-label">Vendor Name<b style="color: red;">*</b></label>
                            <input class="form-control bg-light-subtle" type="text" name="vendor_name"
                                placeholder="Enter Vendor Name" aria-label="default input example" required>
                            @error('video')
                            <div class="error text-danger ">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="formFile" class="form-label">Review Count<b style="color: red;">*</b></label>
                            <input class="form-control bg-light-subtle" type="text" name="review_count"
                                placeholder="Enter Review Count" aria-label="default input example" required>
                            @error('video')
                            <div class="error text-danger ">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 mb-3">
                            <label for="experience" class="form-label">Experience<b style="color: red;">*</b></label>
                            <select name="experience" id="experience" class="form-control bg-light-subtle" required>
                                <option value="" selected disabled>Select Experience</option>
                                @for ($i = 0; $i <= 20; $i++) <option value="{{ $i }}" {{ old('experience')==$i
                                    ? 'selected' : '' }}>
                                    {{ $i }}
                                    </option>
                                    @endfor
                            </select>
                            <div id="experienceError" class="text-danger"></div>
                            @error('experience')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="row mt-3">
                        {{-- <div class="col-md-4">
                            <label for="formFile" class="form-label">price<b style="color: red;">*</b></label>
                            <input class="form-control bg-light-subtle" type="text" name="price"
                                placeholder="Enter price" aria-label="default input example" required>
                            @error('video')
                            <div class="error text-danger ">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <div class="col-md-4">
                            <label for="formFile" class="form-label">Location<b style="color: red;">*</b></label>
                            <input class="form-control bg-light-subtle" type="text" name="location_lat"
                                placeholder="Enter location" aria-label="default input example" required>
                            @error('video')
                            <div class="error text-danger ">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-1 d-flex" style="align-items: flex-end">
                            <button type="button" id="addlocation" class="btn btn-primary">Add</button>
                        </div>
                        <div class="col-md-4 d-none" id="longitude">
                            <label for="formFile" class="form-label">Longitude Location<b
                                    style="color: red;">*</b></label>
                            <div class="d-flex gap-4">
                                <input class="form-control bg-light-subtle" type="text" name="location_lang"
                                    placeholder="Enter longitude location" aria-label="default input example">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="mb-3 col-md-12">
                                <label for="summery" class="col-form-label">Description <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="summery"
                                    name="description">{{ old('desription') }}</textarea>
                                @error('sub_category')
                                <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                    $('#summery').summernote({
                                        placeholder: "Write short description.....",
                                        tabsize: 2,
                                        height: 330
                                    });
                                });
                        </script>


                    </div>
                    <div class="row mt-3">
                        <div class="">

                            <button type="submit" id="submitbutton" class="btn btn-success">Submit</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/summernote/summernote.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

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

    // // Handle error messages
    // if (input.id === 'phoneNumVender') {
    //     document.getElementById('phoneError').textContent = (phoneNum.length < 10) ? 'Please enter a valid 10-digit phone number.' : '';
    // } else if (input.id === 'whatsappNumVender') {
    //     document.getElementById('whatsappError').textContent = (whatsappNum.length < 10) ? 'Please enter a valid 10-digit WhatsApp number.' : '';
    // }
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
                        alert(response.message); // Notify OTP sent
                        // alert(opt);
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
                        alert(response.message); // Notify OTP verified
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

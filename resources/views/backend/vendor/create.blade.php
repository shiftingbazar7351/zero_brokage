@extends('backend.layouts.main')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
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
                                    aria-label="Default select example" style="box-shadow: none" required>
                                    <option selected disabled>Select Option</option>
                                    <option value="1" {{ old('manager_id') == '1' ? 'selected' : '' }}>dummy</option>
                                    <option value="2" {{ old('manager_id') == '2' ? 'selected' : '' }}>person</option>
                                    <option value="3" {{ old('manager_id') == '3' ? 'selected' : '' }}>thify</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="formFile" class="form-label">Employee<b style="color: red;">*</b></label>
                                <select name="employee_id" class="form-select bg-light-subtle"
                                    aria-label="Default select example" style="box-shadow: none" required>
                                    <option value="" selected disabled>Select Option</option>
                                    <option value="1" {{ old('employee_id') == '1' ? 'selected' : '' }}>employee1
                                    </option>
                                    <option value="2" {{ old('employee_id') == '2' ? 'selected' : '' }}>employee2
                                    </option>
                                    <option value="3" {{ old('employee_id') == '3' ? 'selected' : '' }}>employee3
                                    </option>
                                </select>
                                @error('employee_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="formFileCategory" class="form-label">Sub-Category <b
                                        style="color: red;">*</b></label>
                                <select name="sub_category" id="formFileCategory" class="form-select bg-light-subtle"
                                    aria-label="Default select example" style="box-shadow: none" required>
                                    <option selected disabled value="">Select Option</option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>
                        <div class="row mx-auto mt-3">
                            <div class="col-md-6">
                                <label for="companyname" class="form-label">Company Name<b
                                        style="color: red;">*</b></label><span> (if same
                                    name)</span>
                                <input name="company_name" class="form-check-input mx-1" type="checkbox"
                                    value="{{ old('company_name') }}" id="flexCheckChecked" checked>
                                <input name="company_name" value="{{ old('company_name') }}" id="companyname"
                                    class="form-control bg-light-subtle" type="text" placeholder="Company name"
                                    aria-label="default input example" required>
                                @error('company_name')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="lcompanyname" class="form-label">Legal Company Name<b
                                        style="color: red;">*</b></label>
                                <input name="legal_company_name" value="{{ old('legal_company_name') }}" id="lcompanyname"
                                    class="form-control bg-light-subtle" type="text" placeholder="Company name"
                                    aria-label="default input example" required>
                                @error('legal_company_name')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="formFile" class="form-label">State<b style="color: red;">*</b></label>
                                <select name="state" class="form-select bg-light-subtle"
                                    aria-label="Default select example" style="box-shadow: none" required>
                                    <option selected disabled>Select State</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                @error('state')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="formFile" class="form-label">City<b style="color: red;">*</b></label>
                                <select name="city" class="form-select bg-light-subtle"
                                    aria-label="Default select example" style="box-shadow: none" required>
                                    <option selected disabled>Select City</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                @error('city')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="pinnumber" class="form-label">PIN Code<b style="color: red;">*</b></label>
                                <input name="pincode" value="{{ old('pincode') }}" id="pinnumber"
                                    class="form-control bg-light-subtle" type="text" placeholder="PIN code number"
                                    maxlength="6" onkeyup="validateField(this)" aria-label="default input example"
                                    required>
                                <div id="pinnumberError" class="errorMessage text-danger"></div>
                            </div>
                            @error('pincode')
                                <div class="error text-danger ">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="row mt-4">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label text-dark">Example
                                    textarea<b style="color: red;">*</b></label>
                                <textarea name="address" value="{{ old('address') }}" class="form-control bg-light-subtle"
                                    id="exampleFormControlTextarea1" rows="3" required>{{ old('address') }}</textarea>
                            </div>
                            @error('address')
                                <div class="error text-danger ">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="row mt-4">
                            <div class="col-md-4">
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

                            <div class="col-md-4 mt-4 mt-md-0">
                                <label for="formFile" class="form-label">Whatsapp<b
                                        style="color: red;">*</b></label><span class="mx-3">(Get
                                    notification)</span>
                                <input name="whatsapp" value="{{ old('whatsapp') }}" class="form-check-input mx-2"
                                    type="checkbox" value="" id="flexCheckChecked" checked>
                                <input name="whatsapp" value="{{ old('whatsapp') }}"
                                    class="form-control bg-light-subtle" id="whatsappNumVender" type="text"
                                    placeholder="Whatsapp number" aria-label="default input example"
                                    onkeyup="validateField(this)" maxlength="10" required>
                                <div id="whatsappError" class="text-danger"></div>
                                @error('whatsapp')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mt-4 mt-md-0">
                                <label for="phoneNumVender" class="form-label">Phone Number<b
                                        style="color: red;">*</b></label><span class="mx-3">(Get
                                    notification)</span>
                                <input name="number" value="{{ old('number') }}" class="form-check-input mx-2"
                                    type="checkbox" value="" id="flexCheckChecked" checked>
                                <input name="number" value="{{ old('number') }}" class="form-control bg-light-subtle"
                                    id="phoneNumVender" type="text" placeholder="Phone number"
                                    aria-label="default input example" onkeyup="validateField(this)" maxlength="10"
                                    required>
                                <div id="phoneError" class="text-danger"></div>
                                @error('number')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="formFile" class="form-label">Website (if available)</label>
                                <input name="website" value="{{ old('website') }}" class="form-control bg-light-subtle"
                                    type="text" placeholder="www.example.com" aria-label="default input example">
                                @error('website')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="formFile" class="form-label">Verified or Approved By Team</label>
                                <select name="verified" class="form-select bg-light-subtle"
                                    aria-label="Default select example" style="box-shadow: none" >
                                    <option selected disabled value="">Select Option</option>
                                    {{-- @foreach ($verifieds as $verified)
                                        <option value="{{ $verified->id }}">{{ $verified->name }}</option>
                                        @endforeach --}}
                                </select>
                                @error('verified')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="formFile" class="form-label">Select Sub-Menu<b
                                        style="color: red;">*</b></label>
                                <select name="submenu_id" class="form-select bg-light-subtle"
                                    aria-label="Default select example" style="box-shadow: none" required>
                                    <option selected disabled value="">Select Option</option>
                                    @foreach ($submenus as $submenu)
                                        <option value="{{ $submenu->id }}">{{ $submenu->name }}</option>
                                    @endforeach
                                </select>
                                @error('submenu_id')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="col-4 mb-3">
                                <label for="formFile" class="form-label">Vender Logo<b style="color: red;">*</b></label>
                                <input name="logo" value="{{ old('logo') }}" class="form-control bg-light-subtle"
                                    type="file" id="formFile" required>
                                @error('logo')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="formFile" class="form-label">Owner name<b style="color: red;">*</b></label>
                                <input name="owner_name" value="{{ old('owner_name') }}"
                                    class="form-control bg-light-subtle" type="text" placeholder="Enter owner name"
                                    aria-label="default input example" required>
                                @error('owner_name')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-4 mb-3">
                                <label for="formFile" class="form-label">Vender Image<b style="color: red;">*</b></label>
                                <input name="vendor_image" value="{{ old('vendor_image') }}"
                                    class="form-control bg-light-subtle" type="file" id="formFile" required>
                                @error('vendor_image')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3 mb-3">
                                <label for="GSTimage" class="form-label">GST Image<b style="color: red;">*</b></label>
                                <input name="gst_image" value="{{ old('gst_image') }}"
                                    class="form-control bg-light-subtle" type="file" id="GSTimage" required>
                                <div id="gstImageError" class="text-danger"></div>
                                @error('gst_image')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="gstNumber" class="form-label">GST Number<b style="color: red;">*</b></label>
                                <input name="gst_number" value="{{ old('gst_number') }}"
                                    class="form-control bg-light-subtle" id="gstNumber" type="text"
                                    placeholder="GST number" aria-label="default input example"
                                    onkeyup="validateField(this)" maxlength="15" required>
                                <div id="gstError" class="text-danger"></div>
                                @error('gst_number')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="PanImage" class="form-label">PAN Image<b style="color: red;">*</b></label>
                                <input name="pan_image" value="{{ old('pan_image') }}"
                                    class="form-control bg-light-subtle" type="file" id="PanImage" required>
                                <div id="PanImageError" class="text-danger"></div>
                                @error('pan_image')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="panCard" class="form-label">PAN Card Number<b
                                        style="color: red;">*</b></label>
                                <input name="pan_number" value="{{ old('pan_number') }}"
                                    class="form-control bg-light-subtle" id="panCard" type="text"
                                    placeholder="PAN Card number" aria-label="default input example"
                                    onkeyup="validateField(this)" maxlength="10" required>
                                <div id="panError" class="text-danger"></div>
                                @error('pan_number')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-md-3">
                            <div class="col-md-3">
                                <label for="adharvender" class="form-label">Adhar Number<b
                                        style="color: red;">*</b></label>
                                <input name="adhar_numbere" value="{{ old('adhar_numbere') }}"
                                    class="form-control bg-light-subtle" id="adharvender" onkeyup="validateField(this)"
                                    type="text" placeholder="Adhar Number" aria-label="default input example"
                                    maxlength="12" required>
                                <div id="adharError" class="text-danger"></div>
                                @error('adhar_numbere')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="adharImage" class="form-label">Adhar Image<b
                                        style="color: red;">*</b></label>
                                <input name="adhar_image" value="{{ old('adhar_image') }}"
                                    class="form-control bg-light-subtle" type="file" id="adharImage" required>
                                <div id="adharImageError" class="text-danger" required></div>
                                @error('adhar_image')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="formFile" class="form-label">Visiting Card Image<b
                                        style="color: red;">*</b></label>
                                <input name="visiting_card" value="{{ old('visiting_card') }}"
                                    class="form-control bg-light-subtle" type="file" id="formFile" required>
                                @error('visiting_card')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="formFile" class="form-label">Client signature<b
                                        style="color: red;">*</b></label>
                                <input name="client_sign" class="form-control bg-light-subtle" type="file"
                                    id="formFile" required>
                                @error('client_sign')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label for="formFile" class="form-label">Official video<b
                                        style="color: red;">*</b></label>
                                <input name="video" class="form-control bg-light-subtle" type="file" id="formFile"
                                    required>
                                @error('video')
                                    <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="formFile" class="form-label">Location<b style="color: red;">*</b></label>
                                {{-- <div class="d-flex gap-4"> --}}
                                    <input class="form-control bg-light-subtle" type="text"
                                        placeholder="Enter location" aria-label="default input example" required>

                                    @error('video')
                                        <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                {{-- </div> --}}

                            </div>
                            <div class="col-md-1 d-flex" style="align-items: flex-end">
                                    <button type="button" id="addlocation" class="btn btn-primary">Add</button>

                            </div>
                            <div class="col-md-4 d-none" id="longitude">
                                <label for="formFile" class="form-label">Longitude Location<b
                                        style="color: red;">*</b></label>
                                <div class="d-flex gap-4">
                                    <input class="form-control bg-light-subtle" type="text"
                                        placeholder="Enter longitude location" aria-label="default input example">
                                </div>
                            </div>


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
    {{-- <script src="{{ asset('assets/js/vendor-validation.js') }}"></script> --}}
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
@endsection
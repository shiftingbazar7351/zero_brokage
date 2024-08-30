@extends('backend.layouts.main')

@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="main-wrapper">

                <div class="main-wrapper">

                    <div class="container border p-2 shadow-sm mt-2">
                        <h4> Edit Vendor</h4>
                    </div>
                    <div class="container mt-4 border p-5 rounded shadow">
                        <form id="addCategoryModal" action="{{ route('vendors.update',$vendor->id ??'', $vendor->company_name ??'') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mx-auto">
                                <div class="col-2">
                                    <label for="formManager" class="form-label">Manager</label>
                                    <select name="manager_id" id="formManager" class="form-select bg-light-subtle"
                                        aria-label="Default select example" style="box-shadow: none"  >
                                        <option selected>Select Option</option>
                                        <option value="1" {{ old('manager_id') == '1' ? 'selected' : '' }}>One</option>
                                        <option value="2" {{ old('manager_id') == '2' ? 'selected' : '' }}>Two</option>
                                        <option value="3" {{ old('manager_id') == '3' ? 'selected' : '' }}>Three</option>
                                    </select>
                                </div>

                                <div class="col-3">
                                    <label for="formFile" class="form-label">Employee</label>
                                    <select name="employee_id" class="form-select bg-light-subtle" aria-label="Default select example" style="box-shadow: none">
                                        <option value="" {{ old('employee_id', $vendor->employee_id) == '' ? 'selected' : '' }}>Select Option</option>
                                        <option value="1" {{ old('employee_id', $vendor->employee_id) == '1' ? 'selected' : '' }}>One</option>
                                        <option value="2" {{ old('employee_id', $vendor->employee_id) == '2' ? 'selected' : '' }}>Two</option>
                                        <option value="3" {{ old('employee_id', $vendor->employee_id) == '3' ? 'selected' : '' }}>Three</option>
                                    </select>
                                    @error('employee_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                
                                <div class="col-2">
                                    <label for="formFileCategory" class="form-label">Category</label>
                                    <select name="sub_category" id="formFileCategory" class="form-select  bg-light-subtle"
                                        aria-label="Default select example" style="box-shadow: none">
                                        <option selected disabled value="">Select Option</option>
                                        <option value="1"{{ old('sub_category') == '1' ? 'selected' : '' }}>One</option>
                                        <option value="2"{{ old('sub_category') == '2' ? 'selected' : '' }}>Two</option>
                                        <option value="3"{{ old('sub_category') == '3' ? 'selected' : '' }}>Three</option>
                                    </select>
                                    @error('sub_category')
                                    <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="companyname" class="form-label">Company Name</label><span> (if same
                                        name)</span>
                                    <input name="company_name" class="form-check-input mx-1" type="checkbox" value="{{ old('company_name', $vendor->company_name ??'') }}"
                                        id="flexCheckChecked" checked>
                                    <input name="company_name" value="{{ old('company_name',$vendor->company_name ??'') }}" id="companyname" class="form-control bg-light-subtle"
                                        type="text" placeholder="Company name" aria-label="default input example">
                                    @error('company_name')
                                        <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="lcompanyname" class="form-label">Legal Company Name</label>
                                    <input name="legal_company_name"  value="{{ old('legal_company_name', $vendor->legal_company_name ??'') }}" id="lcompanyname" class="form-control bg-light-subtle"
                                        type="text" placeholder="Company name" aria-label="default input example">
                                    @error('legal_company_name')
                                    <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>
                               
                            </div>

                            <div class="row mt-3">
                                <div class="col-4">
                                    <label for="formFile" class="form-label">State</label>
                                    <select name="state" class="form-select bg-light-subtle"
                                        aria-label="Default select example" style="box-shadow: none">
                                        <option selected>Select State</option>
                                        <option value="1"{{ old('state') == '3' ? 'selected' : '' }}>One</option>
                                        <option value="2"{{ old('state') == '3' ? 'selected' : '' }}>Two</option>
                                        <option value="3"{{ old('state') == '3' ? 'selected' : '' }}>Three</option>
                                    </select>
                                   
                                </div>

                                <div class="col-4">
                                    <label for="formFile" class="form-label">City</label>
                                    <select name="city" class="form-select bg-light-subtle"
                                        aria-label="Default select example" style="box-shadow: none">
                                        <option selected>Select City</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    @error('city')
                                    <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="pinnumber" class="form-label">PIN Code</label>
                                    <input name="pincode" value="{{ old('pincode', $vendor->pincode ??'') }}" id="pinnumber" class="form-control bg-light-subtle"
                                        type="text" placeholder="PIN code number" maxlength="6"
                                        onkeyup="validateField(this)" aria-label="default input example">
                                    <div id="pinnumberError" class="errorMessage text-danger"></div>
                                </div>
                                @error('pincode')
                                <div class="error text-danger ">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mt-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label text-dark">Address</label>
                                    <textarea name="address" class="form-control bg-light-subtle" id="exampleFormControlTextarea1" rows="3">{{ old('address', isset($vendor) ? $vendor->address : '') }}</textarea>
                                    @error('address')
                                        <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            


                            <div class="row mt-4">
                                <div class="col-4">
                                    <label for="emailAddressVender" class="form-label">Email Address</label>
                                    <input name="email" value="{{ old('email', $vendor->email ??'') }}" class="form-control bg-light-subtle" id="emailAddressVender"
                                        type="text" placeholder="Email address" aria-label="default input example"
                                        onkeyup="validateField(this)">
                                    <div id="emailError" class="text-danger"></div>
                                    @error('email')
                                    <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-4">
                                    <label for="formFile" class="form-label">Whatsapp</label><span class="mx-3">(Get notification)</span>
                                
                                    <!-- Checkbox for notification -->
                                    <input name="whatsapp_notification" class="form-check-input mx-2" type="checkbox"
                                        id="flexCheckChecked"
                                        {{ old('whatsapp_notification', isset($vendor) && $vendor->whatsapp ? 'checked' : '') }}>
                                
                                    <!-- Input field for WhatsApp number -->
                                    <input name="whatsapp" value="{{ old('whatsapp', $vendor->whatsapp ?? '') }}"
                                        class="form-control bg-light-subtle" id="whatsappNumVender"
                                        type="text" placeholder="Whatsapp number" aria-label="default input example"
                                        onkeyup="validateField(this)" maxlength="10">
                                
                                    <!-- Error message for WhatsApp -->
                                    <div id="whatsappError" class="text-danger"></div>
                                    @error('whatsapp')
                                        <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-4">
                                    <label for="phoneNumVender" class="form-label">Phone Number</label><span
                                        class="mx-3">(Get
                                        notification)</span>
                                    <input name="number" value="{{ old('number', $vendor->number ??'') }}"  class="form-check-input mx-2" type="checkbox" value=""
                                        id="flexCheckChecked" checked>
                                    <input name="number"  value="{{ old('number', $vendor->number ??'') }}" class="form-control bg-light-subtle" id="phoneNumVender"
                                        type="text" placeholder="Phone number" aria-label="default input example"
                                        onkeyup="validateField(this)" maxlength="10">
                                    <div id="phoneError" class="text-danger"></div>
                                    @error('number')
                                    <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-4">
                                    <label for="formFile" class="form-label">Website (if available)</label>
                                    <input name="website"  value="{{ old('website', $vendor->website ??'') }}" class="form-control bg-light-subtle" type="text"
                                        placeholder="www.example.com" aria-label="default input example">
                                        @error('website')
                                        <div class="error text-danger ">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="col-4">
                                    <label for="formFile" class="form-label">Verified or Approved By Team</label>
                                    <select name="verified" class="form-select bg-light-subtle"
                                        aria-label="Default select example" style="box-shadow: none">
                                        <option selected>Industry Leader</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    @error('verified')
                                    <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-4">
                                    <label for="formFile" class="form-label">Select Sub-Menu</label>
                                    <select name="submenu_id" class="form-select bg-light-subtle"
                                        aria-label="Default select example" style="box-shadow: none">
                                        <option selected disabled value="">Select Option</option>
                                        @foreach($submenus as $submenu)
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
                                    <label for="formFile" class="form-label">Vender Logo</label>
                                    <input name="logo" value="{{ old('logo', $vendor->logo ??'') }}" class="form-control bg-light-subtle" type="file"
                                        id="formFile">
                                        @error('logo')
                                        <div class="error text-danger ">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="col-4">
                                    <label for="formFile" class="form-label">Owner name</label>
                                    <input name="owner_name" value="{{ old('owner_name', $vendor->owner_name ??'') }}" class="form-control bg-light-subtle" type="text"
                                        placeholder="Enter owner name" aria-label="default input example">
                                        @error('owner_name')
                                        <div class="error text-danger ">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="formFile" class="form-label">Vender Image</label>
                                    <input name="vendor_image" value="{{ old('vendor_image', $vendor->vendor_image ??'') }}" class="form-control bg-light-subtle" type="file"
                                        id="formFile">
                                        @error('vendor_image')
                                        <div class="error text-danger ">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-3 mb-3">
                                    <label for="GSTimage" class="form-label">GST Image</label>
                                    <input name="gst_image" value="{{ old('gst_image', $vendor->gst_image ??'') }}" class="form-control bg-light-subtle" type="file"
                                        id="GSTimage">
                                    <div id="gstImageError" class="text-danger"></div>
                                    @error('gst_image')
                                    <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <label for="gstNumber" class="form-label">GST Number</label>
                                    <input name="gst_number"  value="{{ old('gst_number', $vendor->gst_number ??'') }}" class="form-control bg-light-subtle" id="gstNumber"
                                        type="text" placeholder="GST number" aria-label="default input example"
                                        onkeyup="validateField(this)" maxlength="15">
                                    <div id="gstError" class="text-danger"></div>
                                    @error('gst_number')
                                    <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-3 mb-3">
                                    <label for="PanImage" class="form-label">PAN Image</label>
                                    <input name="pan_image" value="{{ old('pan_image', $vendor->pan_image ??'') }}" class="form-control bg-light-subtle" type="file"
                                        id="PanImage">
                                    <div id="PanImageError" class="text-danger"></div>
                                    @error('pan_image')
                                    <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-3">
                                    <label for="panCard" class="form-label">PAN Card Number</label>
                                    <input name="pan_number" value="{{ old('pan_number', $vendor->pan_number ??'') }}" class="form-control bg-light-subtle" id="panCard"
                                        type="text" placeholder="PAN Card number" aria-label="default input example"
                                        onkeyup="validateField(this)" maxlength="10">
                                    <div id="panError" class="text-danger"></div>
                                    @error('pan_number')
                                    <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-3">
                                    <label for="adharvender" class="form-label">Adhar Number</label>
                                    <input name="adhar_numbere" value="{{ old('adhar_numbere', $vendor->adhar_numbere ??'') }}" class="form-control bg-light-subtle" id="adharvender"
                                        onkeyup="validateField(this)" type="text" placeholder="Adhar Number"
                                        aria-label="default input example" maxlength="12">
                                    <div id="adharError" class="text-danger"></div>
                                    @error('adhar_numbere')
                                    <div class="error text-danger ">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-3 mb-3">
                                    <label for="adharImage" class="form-label">Adhar Image</label>
                                    <input name="adhar_image" value="{{ old('adhar_image', $vendor->adhar_image ??'') }}" class="form-control bg-light-subtle" type="file"
                                        id="adharImage">
                                    <div id="adharImageError" class="text-danger"></div>
                                    @error('adhar_image')
                                    <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-3 mb-3">
                                    <label for="formFile" class="form-label">Visiting Card Image</label>
                                    <input name="visiting_card" value="{{ old('visiting_card', $vendor->visiting_card ??'') }}" class="form-control bg-light-subtle" type="file"
                                        id="formFile">
                                        @error('visiting_card')
                                        <div class="error text-danger ">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="col-3 mb-3">
                                    <label for="formFile" class="form-label">Client signature</label>
                                    <input name="client_sign" class="form-control bg-light-subtle" type="file"
                                        id="formFile">
                                        @error('client_sign')
                                        <div class="error text-danger ">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-5 mb-3">
                                    <label for="formFile" class="form-label">Official video</label>
                                    <input name="video" class="form-control bg-light-subtle" type="file"
                                        id="formFile">
                                        @error('video')
                                        <div class="error text-danger ">{{ $message }}</div>
                                        @enderror
                                </div>

                                <div class="col-5">
                                    <label for="formFile" class="form-label">Location</label>
                                    <div class="d-flex gap-4">
                                        <input class="form-control bg-light-subtle" type="text"
                                            placeholder="Enter location" aria-label="default input example">
                                        <button type="button" class="btn btn-primary">Add</button>
                                    </div>
                                    @error('video')
                                    <div class="error text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>
                            <div class="row mt-3">
                                <div class="">

                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

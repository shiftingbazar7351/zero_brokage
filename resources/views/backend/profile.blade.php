@extends('backend.layouts.main')
@section('content')
    <div class="main-wrapper">
        <div class="page-wrapper page-settings">
            <div class="content w-100">
                <div class="content-page-header">
                    <h5>Account Settings</h5>
                </div>
                <div class="row shadow border">
                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                        <div class="col-md-4   p-4">
                            <div class="form-grouphead">
                                <h2>Profile Picture</h2>
                            </div>
                            <div class="">
                                <div class="text-center">
                                    <img src="{{ asset('admin/assets/img/customer/user-01.jpg') }}" alt="img"
                                        id="blah" class="shadow rounded" style="width: 200px;height:220px">

                                    <div class="">
                                        <div class="">
                                            <div class="" style="position: relative; display: inline-block;">
                                                <input type="file" id="imgInp" style="display:none;">
                                                <a href="javascript:void(0);"
                                                    onclick="document.getElementById('imgInp').click();"
                                                    style="background-color: #e1f2f9;padding:10px;border-radius:50%;cursor:pointer;
                                    position: absolute; bottom: 18px; left: 57px;">
                                                    <i class="fa fa-pencil" aria-hidden="true"
                                                        style="color: black;font-size:22px"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="profile-upload-para">
                                            <p>*image size should be at least 320px big,and less then 500kb. Allowed files
                                                .png
                                                and .jpg.</p>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                        <div class="col-md-8 p-4">
                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ old('name', $user->name ?? '') }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="lname"
                                        value="{{ old('lname', $user->lname ?? '') }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email"
                                        value="{{ old('email', $user->email ?? '') }}">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Mobile Number</label>
                                    <input type="text" class="form-control" name="phone_number"
                                        value="{{ old('phone_number', $user->phone_number ?? '') }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Employement Code</label>
                                    <div>{{ old('employee_code', $user->employee_code ?? '') }}</div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Current Address</label>
                                    <textarea type="text" class="form-control" rows="3" name="current_address">{{ old('current_address', $user->current_address ?? '') }}</textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Permanent Address</label>
                                    <textarea type="text" class="form-control" rows="3" name="permanent_address">{{ old('permanent_address', $user->permanent_address ?? '') }}</textarea>
                                </div>


                            </div>
                            <div class="row">
                                <div class="btn-path">
                                    <a href="javascript:void(0);" class="btn btn-cancel me-3">Cancel</a>
                                    <a href="javascript:void(0);" class="btn btn-primary">Save Changes</a>
                                </div>
                            </div>
                            {{-- <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number',$user->phone_number ??'') }}">
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Bio</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>


                        </div> --}}
                            {{-- <div class="form-grouphead">
                            <h2>Personal Information</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Country</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                  </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>City</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                  </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Address</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Pincode</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Language</label>
                                <input class="input-tags form-control" type="text" data-role="tagsinput"
                                    name="specialist" value="English,French,Spanish" id="specialist">
                            </div>

                        </div>
                        <div class="row">
                            <div class="btn-path">
                                <a href="javascript:void(0);" class="btn btn-cancel me-3">Cancel</a>
                                <a href="javascript:void(0);" class="btn btn-primary">Save Changes</a>
                            </div>
                        </div> --}}
                        </div>
                </form>
            </div>
        </div>
    @endsection

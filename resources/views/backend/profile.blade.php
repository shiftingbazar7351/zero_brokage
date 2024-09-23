@extends('backend.layouts.main')
@section('content')
    <div class="main-wrapper">
        <div class="page-wrapper page-settings">
            <div class="content w-100">
                <div class="content-page-header">
                    <h5>Account Settings</h5>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-grouphead">
                            <h2>Profile Picture</h2>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="profile-upload">
                            <div class="profile-upload-img">
                                <img src="assets/img/customer/user-01.jpg" alt="img" id="blah">
                            </div>
                            <div class="profile-upload-content">
                                <div class="profile-upload-btn">
                                    <div class="profile-upload-file">
                                        <input type="file" id="imgInp">
                                        <a href="javascript:void(0);" class="btn btn-upload">Upload</a>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-remove">Remove</a>
                                </div>
                                <div class="profile-upload-para">
                                    <p>*image size should be at least 320px big,and less then 500kb. Allowed files .png
                                        and .jpg.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-grouphead">
                            <h2>Profile</h2>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Bio</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-grouphead">
                            <h2>Personal Information</h2>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label>Pincode</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Language</label>
                            <input class="input-tags form-control" type="text" data-role="tagsinput"
                                name="specialist" value="English,French,Spanish" id="specialist">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="btn-path">
                            <a href="javascript:void(0);" class="btn btn-cancel me-3">Cancel</a>
                            <a href="javascript:void(0);" class="btn btn-primary">Save Changes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

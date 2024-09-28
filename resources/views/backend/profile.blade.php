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
                        @csrf
                        <div class="col-md-4   p-4">
                            <div class="form-grouphead">
                                <h2>Profile Picture</h2>
                            </div>
                            <div class="">
                                <div class="text-center">
                                    <!-- Display user's current profile picture -->
                                    <img src="{{ asset('storage/profile_picture/' . $user->profile_picture ?? '') }}"
                                        alt="img" id="blah" class="shadow rounded"
                                        style="width: 200px; height: 220px;">

                                    <div class="">
                                        <div class="">
                                            <div class="" style="position: relative; display: inline-block;">
                                                <!-- File input for selecting profile picture -->
                                                <input type="file" name="profile_picture" id="imgInp"
                                                    style="display:none;" accept="image/*">
                                                <!-- Trigger for file input -->
                                                <a href="javascript:void(0);"
                                                    onclick="document.getElementById('imgInp').click();"
                                                    style="background-color: #e1f2f9;padding:10px;border-radius:50%;cursor:pointer;position: absolute; bottom: 18px; left: 57px;">
                                                    <i class="fa fa-pencil" aria-hidden="true"
                                                        style="color: black; font-size: 22px;"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="profile-upload-para">
                                            <p>*Image size should be less than 2MB. Allowed file types: .png, .jpg, .jpeg.
                                            </p>
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
                                    <a href="{{ route('home') }}" class="btn btn-cancel me-3">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endsection
        @section('scripts')
            <script>
                document.getElementById('imgInp').onchange = function(evt) {
                    const file = imgInp.files[0];

                    if (file) {
                        // Check if the file is an image
                        if (!file.type.match('image.*')) {
                            alert("Please select a valid image file (.jpg, .jpeg, .png)!");
                            imgInp.value = ""; // Clear the input
                            document.getElementById('blah').src =
                                "{{ asset('storage/profile_picture/' . $user->profile_picture ?? '') }}"; // Reset image preview
                            return;
                        }

                        // Check if file size is less than 2MB
                        if (file.size > 2 * 1024 * 1024) {
                            alert("File size must be less than 2MB!");
                            imgInp.value = ""; // Clear the input
                            document.getElementById('blah').src =
                                "{{ asset('storage/profile_picture/' . $user->profile_picture ?? '') }}"; // Reset image preview
                        } else {
                            // Show the image preview if valid
                            document.getElementById('blah').src = URL.createObjectURL(file);
                        }
                    }
                };
            </script>
        @endsection

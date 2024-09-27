@extends('backend.layouts.main')
@section('styles')
    <style>
        .preview-img{
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
    </style>
@endsection
@section('content')

    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Head Office</h5>
                <div class="list-btn d-flex gap-3">
                    <div class="page-headers">
                        <div class="search-bar">
                            <span><i class="fe fe-search"></i></span>
                            <input type="text" id="search" placeholder="Search" class="form-control">
                        </div>
                    </div>
                    @can('employee-headoffice-create')
                    <ul>
                        <li>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#add_company"><i class="fa fa-plus me-2"></i>Add Head-Office</button>
                        </li>
                    </ul>
                    @endcan
                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="table-responsive table-div">
                        <div id="usersTable">
                            @include('employee::headoffice.partials.headoffice-index') {{-- Load the users list initially --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Company Modal -->
    <div class="modal fade" id="add_company" tabindex="-1" aria-labelledby="addCompanyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCompanyLabel">Add Head-Office</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="addOfficeForm" action="{{ route('employee-headoffice.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Head-Office Name</label>
                            <input type="text" class="form-control" id="addName" name="name"
                                placeholder="Enter Head-Office name">
                            <div id="name_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Number</label>
                            <input type="text" class="form-control" id="number" name="number"
                                placeholder="Enter number">
                            <div id="number_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" placeholder="Enter Address"> </textarea>
                            <div id="address_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image </label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="image-preview-icon" src="{{ asset('admin/assets/img/icons/upload.svg') }}"
                                        alt="img" class="default-img">
                                    <div class="file-browse">
                                        <h6>Drag & drop image or </h6>
                                        <div class="file-browse-path">
                                            <input type="file" name="image" id="image-input-icon" accept="image/*">
                                            <a href="javascript:void(0);"> Browse</a>
                                        </div>
                                    </div>
                                    <h5>Supported formats: JPEG, PNG, PDF Etc.</h5>
                                </div>
                            </div>
                            <div id="image_error" class="text-danger"></div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Company Modal -->
    <div class="modal fade" id="edit-office" tabindex="-1" aria-labelledby="editCompanyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCompanyLabel">Edit Head-Office</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="editCompanyForm" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <input type="hidden" id="editOfficeId" name="id">
                        <div class="mb-3">
                            <label class="form-label">Head-Office Name</label>
                            <input type="text" class="form-control" id="editName" name="name"
                                placeholder="Enter Head-Office name">
                            <div id="editname_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Number</label>
                            <input type="text" class="form-control" id="editNumber" name="number"
                                placeholder="Enter number">
                            <div id="editnumber_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea type="text" class="form-control" id="editAddress" name="address" placeholder="Enter Address"> </textarea>
                            <div id="editaddress_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image </label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="edit-image-preview-icon"
                                        src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img"
                                        class="default-img prev">
                                    <div class="file-browse">
                                        <h6>Drag & drop image or </h6>
                                        <div class="file-browse-path">
                                            <input type="file" name="image" id="edit-image-input-icon"
                                                accept="image/*">
                                            <a href="javascript:void(0);"> Browse</a>
                                        </div>
                                    </div>
                                    <h5>Supported formats: JPEG, PNG, PDF Etc.</h5>
                                </div>
                            </div>
                            <div id="image_error_edit" class="text-danger"></div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var statusRoute = `{{ route('employee-headoffice.status') }}`;
        var searchRoute = `{{ route('employee-headoffice.index') }}`;
    </script>
    <script src="{{ asset('admin/assets/js/search.js') }}"></script>
    <script src="{{ asset('admin/assets/js/status-update.js') }}"></script>
    <script src="{{ asset('admin/assets/js/preview-img.js') }}"></script>
    <script>
        // Function to preview the image
        function previewImage(input, previewId) {
            var file = input.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + previewId).attr('src', e.target.result)
                        .css({
                            'width': '150px',
                            'height': '150px'
                        }); // Set the preview image size to 50px
                };
                reader.readAsDataURL(file);
            }
        }

        // Event listener for icon image preview
        $('#edit-image-input-icon').on('change', function() {
            previewImage(this, 'edit-image-preview-icon');
        });

        // Event listener for background image preview
        $('#edit-image-input-bg').on('change', function() {
            previewImage(this, 'edit-image-preview-bg');
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#addOfficeForm').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            location.reload(); // Refresh page to show new data
                        }
                    },
                    error: function(xhr) {
                        $('#name_error').text(xhr.responseJSON.errors.name ? xhr.responseJSON
                            .errors.name[0] : '');
                        $('#number_error').text(xhr.responseJSON.errors.number ? xhr
                            .responseJSON
                            .errors.number[0] : '');
                        $('#name_error').text(xhr.responseJSON.errors.name ? xhr.responseJSON
                            .errors.name[0] : '');
                        $('#address_error').text(xhr.responseJSON.errors.address ? xhr
                            .responseJSON
                            .errors.address[0] : ''); // Moved inside error function
                        $('#image_error').text(xhr.responseJSON.errors.image ? xhr.responseJSON
                            .errors.image[0] : '');
                    }
                });
            });
        });


        window.editOffice = function(id) {
            $.ajax({
                url: `/employee-headoffice/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    $('#editOfficeId').val(response.office.id);
                    $('#editName').val(response.office.name);
                    $('#editNumber').val(response.office.number);
                    $('#editAddress').val(response.office.address);

                    if (response.office.image) {
                        $('#edit-image-preview-icon').attr('src',
                            `/storage/employee/office/${response.office.image}`);
                    }

                }
            });
        }

        $('#editCompanyForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let id = $('#editOfficeId').val();

            // Append '_method' field for Laravel to recognize this as a PUT request
            // formData.append('_method', 'PUT');

            $.ajax({
                type: 'POST', // Or 'PUT' if your Laravel route directly supports it
                url: `/employee-headoffice/${id}`,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        location.reload(); // Refresh page to show updated data
                    }
                },
                error: function(xhr) {
                    // Clear previous errors
                    $('#editname_error').text('');
                    $('#editnumber_error').text('');
                    $('#editaddress_error').text('');
                    $('#image_error_edit').text('');

                    // Handle new errors
                    if (xhr.responseJSON.errors) {
                        $('#editname_error').text(xhr.responseJSON.errors.name ? xhr.responseJSON.errors
                            .name[0] : '');
                        $('#editnumber_error').text(xhr.responseJSON.errors.number ? xhr.responseJSON
                            .errors.number[0] : '');
                        $('#editaddress_error').text(xhr.responseJSON.errors.address ? xhr.responseJSON
                            .errors.address[0] : '');
                        $('#image_error_edit').text(xhr.responseJSON.errors.image ? xhr.responseJSON
                            .errors.image[0] : '');
                    }
                }
            });
        });
    </script>
@endsection

@extends('backend.layouts.main')
@section('styles')
    <style>
        .preview-img {
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
                <h5>Branchs</h5>
                <div class="list-btn d-flex gap-3">
                    <div class="page-headers">
                        <div class="search-bar">
                            <span><i class="fe fe-search"></i></span>
                            <input type="text" id="search" placeholder="Search" class="form-control">
                        </div>
                    </div>
                    @can('employee-branch-create')
                        <ul>
                            <li>
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#add_branch"><i class="fa fa-plus me-2"></i>Add Branch</button>
                            </li>
                        </ul>
                    @endcan
                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="table-responsive table-div">
                        <div id="usersTable">
                            @include('employee::branch.partials.branch-index') {{-- Load the users list initially --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Company Modal -->
    <div class="modal fade" id="add_branch" tabindex="-1" aria-labelledby="addCompanyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCompanyLabel">Add Branch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="addBranchForm" action="{{ route('employee-branch.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="product">Product Name</label>
                            <select class="form-control" id="product" name="product_id">
                                <option value="">Select product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                            <div id="product_id_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Branch Name</label>
                            <input type="text" class="form-control" id="addName" name="name"
                                placeholder="Enter Branch Name">
                            <div id="name_error" class="text-danger"></div>
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
    <div class="modal fade" id="edit-product" tabindex="-1" aria-labelledby="editCompanyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCompanyLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="editBranchForm" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <input type="hidden" id="editbranchId" name="id">

                        <div class="mb-3">
                            <label for="product">product Name</label>
                            <select class="form-control" id="editproductId" name="product_id">
                                <option value="">Select product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                            <div id="editproduct_id_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="editName" name="name"
                                placeholder="Enter Product Name">
                            <div id="editname_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" id="editaddress" name="address" placeholder="Enter Address"> </textarea>
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
                            <div id="editimage_error" class="text-danger"></div>
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
    <script>
        var statusRoute = `{{ route('employee-branch.status') }}`;
        var searchRoute = `{{ route('employee-branch.index') }}`;
    </script>
    <script src="{{ asset('admin/assets/js/search.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    </script>
    <script>
        $(document).ready(function() {
            $('#addBranchForm').off('submit').on('submit', function(e) {
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
                        $('#product_id_error').text(xhr.responseJSON.errors
                            .product_id ? xhr
                            .responseJSON.errors.product_id[0] : '');
                        $('#name_error').text(xhr.responseJSON.errors.name ? xhr
                            .responseJSON
                            .errors.name[0] : '');
                        $('#address_error').text(xhr.responseJSON.errors.address ? xhr
                            .responseJSON
                            .errors.address[0] : '');
                        $('#image_error').text(xhr.responseJSON.errors.image ? xhr
                            .responseJSON
                            .errors.image[0] : '');
                    }
                });
            });
        });


        window.editBranch = function(id) {
            $.ajax({
                url: `/employee-branch/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    $('#editbranchId').val(response.branch.id);
                    $('#editproductId').val(response.branch.product_id).trigger('change');
                    $('#editName').val(response.branch.name);
                    $('#editaddress').val(response.branch.address);

                    if (response.branch.image) {
                        $('#edit-image-preview-icon').attr('src',
                            `/storage/employee/branch/${response.branch.image}`);
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching the branch data:', xhr);
                }
            });
        };

        $('#editBranchForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let id = $('#editbranchId').val();

            $.ajax({
                type: 'POST',
                url: `/employee-branch/${id}`,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        location.reload(); // Refresh page to show updated data
                    }
                },
                error: function(xhr) {
                    $('#editname_error').text(xhr.responseJSON.errors.name ? xhr.responseJSON.errors
                        .name[0] : '');
                    $('#editproduct_id_error').text(xhr.responseJSON.errors.product_id ? xhr
                        .responseJSON.errors
                        .product_id[0] : '');
                    $('#editaddress_error').text(xhr.responseJSON.errors.address ? xhr.responseJSON
                        .errors
                        .address[0] : '');
                    $('#editimage_error').text(xhr.responseJSON.errors.image ? xhr.responseJSON.errors
                        .image[0] : '');
                }
            });
        });
    </script>
@endsection

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
                <h5>Products</h5>
                @can('employee-product-create')
                <div class="list-btn">
                    <ul>
                        <li>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#add_product"><i class="fa fa-plus me-2"></i>Add Product</button>
                        </li>
                    </ul>
                </div>
                @endcan
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="table-responsive table-div">
                        <table class="table datatable table-striped text-center table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    @can('employee-product-status')
                                    <th>Status</th>
                                    @endcan
                                    @can(['employee-product-edit', 'employee-product-delete'])
                                    <th>Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @if ($products->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="table-imgname">
                                                    @if ($product->image)
                                                        <img src="{{ Storage::url('employee/hoffice/' . $product->image) }}"
                                                            class="me-2 preview-img" alt="img">
                                                    @else
                                                        No Image
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $product->name ?? '' }}</td>
                                            @can('employee-product-status')
                                            <td>
                                                <div class="active-switch">
                                                    <label class="switch">
                                                        <input type="checkbox" class="status-toggle"
                                                            data-id="{{ $product->id }}"
                                                            onclick="return confirm('Are you sure want to change status?')"
                                                            {{ $product->status ? 'checked' : '' }}>
                                                        <span class="sliders round"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            @endcan
                                            @can(['employee-product-edit', 'employee-product-delete'])
                                            <td>
                                                <div class="table-actions d-flex justify-content-center">

                                                    <button class="btn delete-table me-2" onclick="editproduct({{ $product->id }})" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#edit-product">
                                                        <i class="fe fe-edit"></i>
                                                    </button>

                                                    <form action="{{ route('employee-product.destroy', $product->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn delete-table" type="submit"
                                                            onclick="return confirm('Are you sure want to delete this?')">
                                                            <i class="fe fe-trash-2"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Company Modal -->
    <div class="modal fade" id="add_product" tabindex="-1" aria-labelledby="addCompanyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCompanyLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="addProductForm" action="{{ route('employee-product.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="company">Company Name</label>
                            <select class="form-control" id="company" name="company_id">
                                <option value="">Select company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->brand_name }}</option>
                                @endforeach
                            </select>
                            <div id="company_id_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="addName" name="name"
                                placeholder="Enter Company Name">
                            <div id="name_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image </label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="image-preview-icon" src="{{ asset('admin/assets/img/icons/upload.svg') }}"
                                        alt="img" class="default-img preview-img">
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
                    <form id="editproductForm" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <input type="hidden" id="editproductId" name="id">

                        <div class="mb-3">
                            <label for="company">Company Name</label>
                            <select class="form-control" id="editcompanyId" name="company_id">
                                <option value="">Select company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->brand_name }}</option>
                                @endforeach
                            </select>
                            <div id="editcompany_id_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="editName" name="name"
                                placeholder="Enter Product Name">
                            <div id="editname_error" class="text-danger"></div>
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
            $('#addProductForm').off('submit').on('submit', function(e) {
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
                        $('#office_id_error').text(xhr.responseJSON.errors
                            .hoffice_id ? xhr
                            .responseJSON.errors.hoffice_id[0] : '');
                        $('#company_id_error').text(xhr.responseJSON.errors
                            .company_id ? xhr
                            .responseJSON.errors.company_id[0] : '');
                        $('#name_error').text(xhr.responseJSON.errors.name ? xhr
                            .responseJSON
                            .errors.name[0] : '');
                        $('#image_error').text(xhr.responseJSON.errors.image ? xhr
                            .responseJSON
                            .errors.image[0] : '');
                    }
                });
            });
        });


        window.editproduct = function(id) {
            $.ajax({
                url: `/employee-product/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    $('#editproductId').val(response.product.id);
                    $('#editcompanyId').val(response.product.company_id).trigger('change');
                    $('#editName').val(response.product.name);

                    if (response.product.image) {
                        $('#edit-image-preview-icon').attr('src',
                            `/storage/employee/hoffice/${response.product.image}`);
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching the office data:', xhr);
                }
            });
        };

        $('#editproductForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let id = $('#editproductId').val();

            $.ajax({
                type: 'POST',
                url: `/employee-product/${id}`,
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
                        $('#editcompany_id_error').text(xhr.responseJSON.errors.company_id ? xhr.responseJSON.errors
                        .company_id[0] : '');
                    $('#editimage_error').text(xhr.responseJSON.errors.image ? xhr.responseJSON.errors
                        .image[0] : '');
                }
            });
        });
    </script>
@endsection

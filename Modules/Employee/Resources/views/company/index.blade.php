@extends('backend.layouts.main')
@section('styles')
    <style>
        img {
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
                <h5>Company</h5>
                <div class="list-btn">
                    <ul>
                        <li>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#add_company"><i class="fa fa-plus me-2"></i>Add Company Name</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="table-responsive table-div">
                        <table class="table datatable table-striped text-center table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Brand-Company Name</th>
                                    <th>Legel-Company Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($companies->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($companies as $company)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="table-imgname">
                                                    @if ($company->image)
                                                        <img src="{{ Storage::url('employee/company/' . $company->image) }}"
                                                            class="me-2 preview-img" alt="img">
                                                    @else
                                                        No Image
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $company->brand_name }}</td>
                                            <td>{{ $company->legel_name }}</td>
                                            <td>
                                                <div class="active-switch">
                                                    <label class="switch">
                                                        <input type="checkbox" class="status-toggle"
                                                            data-id="{{ $company->id }}"
                                                            onclick="return confirm('Are you sure want to change status?')"
                                                            {{ $company->status ? 'checked' : '' }}>
                                                        <span class="sliders round"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="table-actions d-flex justify-content-center">

                                                    <button class="btn delete-table me-2"
                                                        onclick="editCompany({{ $company->id }})" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#edit-company">
                                                        <i class="fe fe-edit"></i>
                                                    </button>

                                                    <form action="{{ route('employee-company.destroy', $company->id) }}"
                                                        method="POST" style="display:inline;">
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
    <div class="modal fade" id="add_company" tabindex="-1" aria-labelledby="addCompanyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCompanyLabel">Add Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="addCompanyForm" action="{{ route('employee-company.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="office">Head-Office</label>
                            <select class="form-control" id="office" name="hoffice_id">
                                <option value="">Select Head-Office</option>
                                @foreach ($offices as $office)
                                    <option value="{{ $office->id }}">{{ $office->name }}</option>
                                @endforeach
                            </select>
                            <div id="hoffice_id_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Brand-Company Name</label>
                            <input type="text" class="form-control" id="addName" name="brand_name"
                                placeholder="Enter Company Name">
                            <div id="name_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Legel-Company Name</label>
                            <input class="form-control" id="legel_name" name="legel_name"
                                placeholder="Enter legel company name">
                            <div id="legel_name_error" class="text-danger"></div>
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
    <div class="modal fade" id="edit-company" tabindex="-1" aria-labelledby="editCompanyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCompanyLabel">Edit Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="editCompanyForm" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <input type="hidden" id="editCompanyId" name="id">
                        <div class="mb-3">
                            <label for="office">Head-Office</label>
                            <select class="form-control" id="editoffice" name="hoffice_id">
                                <option value="">Select office</option>
                                @foreach ($offices as $office)
                                    <option value="{{ $office->id }}">{{ $office->name }}</option>
                                @endforeach
                            </select>
                            <div id="edithoffice_id_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Brand-Company Name</label>
                            <input type="text" class="form-control" id="editName" name="brand_name"
                                placeholder="Enter Company Name">
                            <div id="editname_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Legel-Company Name</label>
                            <input class="form-control" id="editlegel_name" name="legel_name"
                                placeholder="Enter legel company name">
                            <div id="editlegel_name_error" class="text-danger"></div>
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
            $('#addCompanyForm').on('submit', function(e) {
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
                        $('#name_error').text(xhr.responseJSON.errors.brand_name ? xhr.responseJSON
                            .errors.brand_name[0] : '');
                            $('#legel_name_error').text(xhr.responseJSON.errors.legel_name ? xhr.responseJSON
                            .errors.legel_name[0] : '');
                            
                            $('#hoffice_id_error').text(xhr.responseJSON.errors.hoffice_id ? xhr.responseJSON
                            .errors.hoffice_id[0] : '');

                        $('#image_error').text(xhr.responseJSON.errors.image ? xhr.responseJSON
                            .errors.image[0] : ''); // Moved inside error function
                    }
                });
            });
        });


        window.editCompany = function(id) {
            $.ajax({
                url: `/employee-company/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    $('#editCompanyId').val(response.company.id);
                    $('#editName').val(response.company.brand_name);
                    $('#editlegel_name').val(response.company.legel_name);
                    $('#editoffice').val(response.company.hoffice_id);
                   
                    if (response.company.image) {
                        $('#edit-image-preview-icon').attr('src',
                            `/storage/employee/company/${response.company.image}`);
                    }
                   
                }
            });
        }


        $('#editCompanyForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let id = $('#editCompanyId').val();
            $.ajax({
                type: 'POST',
                url: `/employee-company/${id}`,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        location.reload(); // Refresh page to show updated data
                    }
                },
                error: function(xhr) {
                    $('#editname_error').text(xhr.responseJSON.errors.brand_name ? xhr.responseJSON.errors
                        .brand_name[0] : '');
                        $('#edithoffice_id_error').text(xhr.responseJSON.errors.hoffice_id ? xhr.responseJSON.errors
                        .hoffice_id[0] : '');
                        $('#editlegel_name_error').text(xhr.responseJSON.errors.legel_name ? xhr.responseJSON.errors
                        .legel_name[0] : '');    
                    $('#image_error_edit').text(xhr.responseJSON.errors.image ? xhr.responseJSON.errors
                        .image[0] : '');
                }
            });
        });

    </script>
@endsection
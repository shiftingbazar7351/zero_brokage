@extends('backend.layouts.main')
@section('content')

    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Products</h5>
                <div class="list-btn">
                    <ul>
                        <li>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#add_product"><i class="fa fa-plus me-2"></i>Add Product</button>
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
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($products->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="table-imgname">
                                                    <span>{{ $product->name ?? '' }}</span>
                                                </div>
                                            </td>
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
                                            <td>
                                                <div class="table-actions d-flex justify-content-center">

                                                    <button class="btn delete-table me-2" onclick="#" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#edit-product">
                                                        <i class="fe fe-edit"></i>
                                                    </button>

                                                    <form action="#" method="POST" style="display:inline;">
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
                                @foreach ($categories as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
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
                    <h5 class="modal-title" id="editCompanyLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="editCompanyForm" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <input type="hidden" id="editproductId" name="id">
                        <input type="hidden" id="editcompanyId" name="company_id">
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="editName" name="name"
                                placeholder="Enter Product Name">
                            <div id="editname_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label for="company">Company Name</label>
                            <select class="form-control" id="company" name="company_id">
                                <option value="">Select company</option>
                                @foreach ($categories as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                            <div id="editcompany_id_error" class="text-danger"></div>
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
        var statusRoute = `{{ route('subcategories.status') }}`;
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
                        $('#company_id_error').text(xhr.responseJSON.errors
                            .company_id ? xhr
                            .responseJSON.errors.company_id[0] : '');
                        $('#name_error').text(xhr.responseJSON.errors.name ? xhr
                            .responseJSON
                            .errors.name[0] : '');
                    }
                });
            });
        });


        // window.editCompany = function(id) {
        //     $.ajax({
        //         url: `/employee-company/${id}/edit`,
        //         method: 'GET',
        //         success: function(response) {
        //             $('#editName').val(response.company.name);
        //             $('#editCompanyId').val(response.company.id);
        //         }
        //     });
        // }

        window.editCategory = function(id) {
            $.ajax({
                url: `/employee-product/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    $('#editcompanyId').val(response.product.id);
                    $('#editName').val(response.product.name);
                    $('#editCategorySelect').val(response.product.category_id).trigger('change');


                    if (response.menu.image) {
                        $('#background-preview').attr('src',
                            `/storage/menu/${response.menu.image}`);
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching the menu data:', xhr);
                }
            });
        };

        $(document).ready(function() {
            $('#editCompanyForm').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let id = $('#editCompanyId').val();

                $.ajax({
                    type: 'POST', // POST with _method for PUT in the form
                    url: `/employee-company/${id}`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            $('#edit-company').modal('hide'); // Close modal on success
                            location.reload(); // Reload to reflect changes
                        } else {
                            alert('Unexpected response from server.');
                        }
                    },
                    error: function(xhr) {
                        // Clear previous error messages
                        $('.editname-error').text('');

                        if (xhr.status === 422) { // Validation error
                            let errors = xhr.responseJSON.errors;
                            if (errors.name) {
                                $('.editname-error').text(errors.name[0]);
                            }
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
@endsection

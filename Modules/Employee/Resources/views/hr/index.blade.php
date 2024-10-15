@extends('backend.layouts.main')
@section('styles')
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>HR Names</h5>
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
                                    data-bs-target="#add_branch"><i class="fa fa-plus me-2"></i>Add HR</button>
                            </li>
                        </ul>
                    @endcan
                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="table-responsive table-div">
                        <div id="usersTable">
                            @include('employee::hr.partials.hr-index') {{-- Load the users list initially --}}
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
                    <h5 class="modal-title" id="addCompanyLabel">Add HR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="addHrForm" action="{{ route('employee-hr.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="designation">Designation</label>
                            <select class="form-control" id="designation" name="designation">
                                <option value="">Select designation</option>
                                <option value="HR Head">HR head</option>
                                <option value="HR Executive">HR executive</option>
                                <option value="HR Intern">HR Intern</option>
                            </select>
                            <div id="designation_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">H.R. Name</label>
                            <input type="text" class="form-control" id="addName" name="name"
                                placeholder="Enter H.R. Name">
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
    <div class="modal fade" id="edit-product" tabindex="-1" aria-labelledby="editCompanyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCompanyLabel">Edit HR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="editHrForm" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <input type="hidden" id="editHrId" name="id">

                        <div class="mb-3">
                            <label for="designation">Designation</label>
                            <select class="form-control" id="editdesignation" name="designation">
                                <option value="">Select designation</option>
                                <option value="HR Head">HR head</option>
                                <option value="HR Executive">HR executive</option>
                                <option value="HR Intern">HR Intern</option>
                            </select>
                            <div id="editdesignation_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">H.R. Name</label>
                            <input type="text" class="form-control" id="editName" name="name"
                                placeholder="Enter H.R. Name">
                            <div id="editname_error" class="text-danger"></div>
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
        var statusRoute = `{{ route('employee-hr.status') }}`;
        var searchRoute = `{{ route('employee-hr.index') }}`;
    </script>
    <script src="{{ asset('admin/assets/js/search.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('admin/assets/js/status-update.js') }}"></script>

    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "3000",
            };

            $('#addHrForm').off('submit').on('submit', function(e) {
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
                            toastr.success('HR created successfully!');
                            location.reload(); // Refresh page to show new data
                        }
                    },
                    error: function(xhr) {
                        $('#designation_error').text(xhr.responseJSON.errors
                            .designation ? xhr
                            .responseJSON.errors.designation[0] : '');
                        $('#name_error').text(xhr.responseJSON.errors.name ? xhr
                            .responseJSON
                            .errors.name[0] : '');

                    }
                });
            });
        });


        window.editHr = function(id) {
            $.ajax({
                url: `/employee-hr/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    $('#editHrId').val(response.hr.id);
                    $('#editdesignation').val(response.hr.designation).trigger('change');
                    $('#editName').val(response.hr.name);

                },
                error: function(xhr) {
                    console.error('Error fetching the hr data:', xhr);
                }
            });
        };

        $('#editHrForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let id = $('#editHrId').val();

            $.ajax({
                type: 'POST',
                url: `/employee-hr/${id}`,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        toastr.success('HR updated successfully!');
                        location.reload(); // Refresh page to show updated data
                    }
                },
                error: function(xhr) {
                    $('#editname_error').text(xhr.responseJSON.errors.name ? xhr.responseJSON.errors
                        .name[0] : '');
                    $('#editdesignation_error').text(xhr.responseJSON.errors.designation ? xhr
                        .responseJSON.errors
                        .designation[0] : '');
                }
            });
        });
    </script>
@endsection

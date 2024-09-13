@extends('backend.layouts.main')
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
                                    <th>Name</th>
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
                                                    <span>{{ $company->name }}</span>
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
                    <form id="addCompanyForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="addName" name="name"
                                placeholder="Enter Company Name">
                            <span class="text-danger error-text name_error"></span>
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
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editCompanyId" name="id">
                        <div class="mb-3">
                            <label class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="editName" name="name"
                                placeholder="Enter Company Name">
                            <div class="text-danger editname-error"></div>
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

<!-- Ensure jQuery is loaded before these scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Helper function to clear error messages
        function clearErrorMessages() {
            $('.error-text').text(''); // Clear all error messages
        }

        // Add Company (AJAX submission)
        $('#addCompanyForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            clearErrorMessages();

            $.ajax({
                type: 'POST',
                url: '{{ route('employee-company.store') }}', // Laravel route to store data
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        $('#add_company').modal('hide'); // Close modal on success
                        location.reload(); // Reload the page to see the new entry
                    } else {
                        alert(response.message);
                    }
                },
                error: function(response) {
                    if (response.status === 422) { // Validation error
                        let errors = response.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('.' + key + '_error').text(value[
                                0]); // Display validation error
                        });
                    } else {
                        console.log(response); // Log other errors
                        alert('An error occurred. Please try again.');
                    }
                }
            });
        });


    });

    window.editCompany = function(id) {
        $.ajax({
            url: `/employee-company/${id}/edit`,
            method: 'GET',
            success: function(response) {
                console.log(response);
                $('#editName').val(response.company.name);
                $('#editCompanyId').val(response.company.id);
            }
        });
    }

    $(document).ready(function() {
        $('#editCompanyForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let id = $('#editCompanyId').val();

            $.ajax({
                type: 'POST',
                url: `/employee-company/${id}`, // Ensure this URL is correct
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        if (response.success) {
                            location.reload(); // Refresh page to show updated data
                        }
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    alert(errors);
                    $('#editName .editname-error').text(errors.name ? errors.name[0] :
                        '');

                }
            });
        });
    });
</script>

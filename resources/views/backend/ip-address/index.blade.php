@extends('backend.layouts.main')
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Ip Addresss</h5>
                <div class="list-btn">
                    <ul>
                        <li>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#add-category">
                                <i class="fa fa-plus me-2"></i>Add Ip Address
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-12">
                    <div class="table-responsive table-div">
                        <table class="table datatable table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ip Address</th>
                                    <th>Creted By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($ipaddresses as $ipaddress)
                                <tbody>
                                    <td>{{ $ipaddress->id ?? '' }}</td>
                                    <td>{{ $ipaddress->ip_address ?? '' }}</td>
                                    <td>{{ $ipaddress->createdBy->name ?? '' }}</td>
                                    <td>
                                        <div class="active-switch">
                                            <label class="switch">
                                                <input type="checkbox" class="status-toggle" data-id="{{ $ipaddress->id }}"
                                                    {{ $ipaddress->status ? 'checked' : '' }}>
                                                <span class="sliders round"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-actions d-flex justify-content-center">
                                            <button class="btn delete-table me-2"
                                                onclick="editCategory({{ $ipaddress->id }})" type="button"
                                                data-bs-toggle="modal" data-bs-target="#edit-category">
                                                <i class="fe fe-edit"></i>
                                            </button>
                                            <form action="{{ route('ipaddress.destroy', $ipaddress->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn delete-table" type="subm it"
                                                    onclick="return confirm('Are you sure want to delete this?')">
                                                    <i class="fe fe-trash-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Category Modal -->
    <div class="modal fade" id="add-category" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryLabel">Add Ip Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="addCategoryForm" enctype="multipart/form-data" data-parsley-validate="true">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">IP Address</label>
                            <input type="text" class="form-control" id="ipAddress" name="ip_address"
                                placeholder="Enter IP Address" required>
                            <span class="text-danger error-text ip_address_error"></span>
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

    <!-- Edit Category Modal -->
    <div class="modal fade" id="edit-category" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryLabel">Edit IP Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="editCategoryForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editCategoryId" name="id">
                        <div class="mb-3">
                            <label class="form-label">IP Address</label>
                            <input type="text" class="form-control" id="editName" name="ip_address">
                            <span class="text-danger error-text ip_address_error"></span>
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
        var statusRoute = `{{ route('ipaddress.status') }}`;
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('ipAddress').addEventListener('input', function(e) {
            let value = e.target.value;

            // Allow only numbers and dots
            value = value.replace(/[^0-9.]/g, '');

            // Limit to 2 dots
            let parts = value.split('.');
            if (parts.length > 2) {
                value = parts.slice(0, 2).join('.') + '.';
            }

            // Set the validated value back to the input field
            e.target.value = value;
        });

        $('#addCategoryForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            let form = this;
            let formData = new FormData(form);

            $.ajax({
                url: "{{ route('ipaddress.store') }}", // Your route for IP address storage
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text(''); // Clear error messages
                },
                success: function(response) {
                    if (response.status === 1) {
                        // Show success message or close modal
                        alert('IP Address added successfully');
                        // Optionally, reload the page or update the table with the new entry
                        location.reload();
                    } else {
                        alert('Error adding IP Address');
                    }
                },
                error: function(response) {
                    if (response.responseJSON.errors) {
                        $.each(response.responseJSON.errors, function(key, value) {
                            $('span.' + key + '_error').text(value[
                                0]); // Display validation errors
                        });
                    }
                }
            });
        });
    </script>

    <script>
        function openEditModal(id) {
            $.ajax({
                url: "/ipaddress/" + id, // Ensure this URL matches your route
                method: "GET",
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                    } else {
                        // Populate modal with data
                        $('#editCategoryId').val(response.id);
                        $('#editName').val(response.ip_address);

                        // Show the modal (using Bootstrap 5)
                        var editModal = new bootstrap.Modal(document.getElementById('edit-category'));
                        editModal.show();
                    }
                },
                error: function() {
                    alert('Error fetching IP address data.');
                }
            });
        }
    </script>
@endsection

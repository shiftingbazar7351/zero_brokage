@extends('backend.layouts.main')
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Transactions</h5>
                <div class="list-btn">
                    <ul>
                        <li>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#add-category">
                                <i class="fa fa-plus me-2"></i>Add Transaction
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
                                    <th>Transaction Id</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id ?? '' }}</td>
                                        <td>{{ $transaction->transaction_id ?? '' }}</td>
                                        <td>{{ $transaction->createdBy->name ?? '' }}</td>
                                        <td>
                                            <div class="active-switch">
                                                <label class="switch">
                                                    <input type="checkbox" class="status-toggle"
                                                        data-id="{{ $transaction->id }}"
                                                        {{ $transaction->status ? 'checked' : '' }}>
                                                    <span class="sliders round"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-actions d-flex justify-content-center">
                                                <button class="btn delete-table me-2"
                                                    onclick="editTransaction({{ $transaction->id }})" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#edit-transaction-modal">
                                                    <i class="fe fe-edit"></i>
                                                </button>
                                                <form action="{{ route('transaction.destroy', $transaction->id) }}"
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
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No data found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Transaction Modal -->
    <div class="modal fade" id="add-category">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <form id="addTransactionForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Transaction Id</label>
                            <input type="text" class="form-control" name="transaction_id"
                                placeholder="Enter Transaction ID" required>
                            <div id="name_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">UTR Number</label>
                            <input type="text" class="form-control" name="utr"
                                placeholder="Enter UTR Number" required>
                            <div id="utr_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Screenshots</label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="image-preview-icon" width="100px" height="100px" src="{{ asset('admin/assets/img/icons/upload.svg') }}"
                                        alt="img" class="default-img">
                                    <div class="file-browse">
                                        <h6>Drag & drop image or </h6>
                                        <div class="file-browse-path">
                                            <input type="file" name="screenshot" id="image-input-icon"
                                                accept="image/jpeg, image/png">
                                            <a href="javascript:void(0);"> Browse</a>
                                        </div>
                                    </div>
                                    <h5>Supported formats: JPEG, PNG</h5>
                                </div>
                            </div>
                            <div id="image-error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Time</label>
                            <input type="datetime-local" class="form-control" name="payment_time"
                                placeholder="Enter Payment time" required>
                            <div id="payment_time_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <input type="text" class="form-control" name="payment_method"
                                placeholder="Enter Payment Method" required>
                            <div id="payment_time_error" class="text-danger"></div>
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


    <div class="modal fade" id="edit-transaction-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="editTransactionForm" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- {{ dd($transaction) }} --}}
                        <div class="mb-3">
                            <label class="form-label">Transaction Id</label>
                            <input type="text" class="form-control" id="editTransactionId" name="transaction_id"
                                value="{{ $transaction->transaction_id ?? '' }}" required>
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
        var statusRoute = `{{ route('transaction.status') }}`;
    </script>
    <script src="{{ asset('admin/assets/js/status-update.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('admin/assets/js/preview-img.js') }}"></script>
    <script>
        function editTransaction(id) {
            $.ajax({
                url: `/transaction/${id}/edit`, // Adjust to your route
                method: 'GET',
                success: function(data) {
                    // Populate the modal form fields with the fetched data
                    $('#editTransactionId').val(data.transaction_id); // Fill transaction_id
                    $('#editTransactionForm').attr('action', `/transaction/${id}`); // Update form action URL
                    $('#edit-transaction-modal').modal('show'); // Show modal
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching transaction data:', error);
                    alert('Error fetching transaction details.');
                }
            });
        }

        $(document).ready(function() {
            $('#addTransactionForm').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Clear previous error messages
                $('#name_error').text('');

                // Get form data
                var formData = new FormData(this);

                // Send AJAX request
                $.ajax({
                    url: "{{ route('transaction.store') }}", // Adjust this route if necessary
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        location.reload();
                        // Handle success response
                        // alert('Transaction added successfully!');
                        // Optionally, close modal and reset the form
                        $('#add-category').modal('hide');
                        $('#addTransactionForm')[0].reset();

                        // You can also refresh the table or append the new transaction to the table dynamically
                    },
                    error: function(xhr) {
                        // Handle error response
                        if (xhr.status === 422) {
                            // Display validation errors
                            var errors = xhr.responseJSON.errors;
                            if (errors.transaction_id) {
                                $('#name_error').text(errors.transaction_id[0]);
                            }
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
@endsection

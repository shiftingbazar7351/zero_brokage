@extends('backend.layouts.main')

@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Transactions</h5>
                <div class="list-btn d-flex gap-3">
                    <div class="page-headers">
                        <div class="search-bar">
                            <span><i class="fe fe-search"></i></span>
                            <input type="text" id="search" placeholder="Search" class="form-control">
                        </div>
                    </div>
                    <ul>
                        <li>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#add-transaction-modal">
                                <i class="fa fa-plus me-2"></i>Add Transaction
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-12">
                    <div class="table-responsive table-div">
                        <div id="usersTable">
                            @include('backend.transaction.partials.transaction-index') {{-- Load the users list initially --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Transaction Modal -->
    <div class="modal fade" id="add-transaction-modal" tabindex="-1" aria-labelledby="addTransactionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTransactionModalLabel">Add Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <input type="text" class="form-control" name="utr" placeholder="Enter UTR Number"
                                required>
                            <div id="utr_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Screenshots</label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="image-preview-icon" width="100" height="100"
                                        src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img">
                                    <div class="file-browse">
                                        <h6>Drag & drop image or </h6>
                                        <div class="file-browse-path">
                                            <input type="file" name="screenshot" id="image-input-icon" accept="image/*">
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
                            <div id="payment_method_error" class="text-danger"></div>
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

    <!-- Edit Transaction Modal -->
    <div class="modal fade" id="edit-transaction-modal" tabindex="-1" aria-labelledby="editTransactionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTransactionModalLabel">Edit Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="editTransactionForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Transaction Id</label>
                            <input type="text" class="form-control" id="editTransactionId" name="transaction_id"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">UTR Number</label>
                            <input type="text" class="form-control" id="editUtrId" name="utr"
                                placeholder="Enter UTR Number" required>
                            <div id="utr_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Screenshot</label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img id="background-preview" width="100" height="100"
                                        src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img">
                                    <div class="file-browse">
                                        <h6>Drag & drop image or </h6>
                                        <div class="file-browse-path">
                                            <input type="file" id="editImage" name="image" accept="image/*">
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
                            <input type="datetime-local" class="form-control" id="editTimeId" name="payment_time"
                                required>
                            <div id="payment_time_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <input type="text" class="form-control" id="editPaymentMethodId" name="payment_method"
                                required>
                            <div id="payment_method_error" class="text-danger"></div>
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

    <!-- Reject Transaction Modal -->
    @foreach ($transactions as $transaction)
        <div class="modal fade" id="rejectModal-{{ $transaction->id }}" tabindex="-1"
            aria-labelledby="rejectModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectModalLabel">Reject Transaction</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-0">
                        <form action="{{ route('transaction.reject', $transaction->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Reason</label>
                                <textarea class="form-control" name="reason" rows="3" required></textarea>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-secondary me-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
    <script>
        var searchRoute = `{{ route('meta.index') }}`;
    </script>
    <script src="{{ asset('admin/assets/js/search.js') }}"></script>
    <script>
        function editTransaction(id) {
            $.ajax({
                url: `/transaction/${id}/edit`, // Adjust to your route
                method: 'GET',
                success: function(data) {
                    // Populate the modal form fields with the fetched data
                    $('#editTransactionId').val(data.transaction_id);
                    $('#editUtrId').val(data.utr);
                    $('#editTimeId').val(data.payment_time);
                    $('#editPaymentMethodId').val(data.payment_method);
                    // Generate the URL for the screenshot image
                    if (data.screenshot) {
                        // Assuming `data.screenshot` is the path relative to `storage/app/public`
                        $('#background-preview').attr('src', `/storage/transaction/${data.screenshot}`);
                    } else {
                        $('#background-preview').attr('src',
                            '{{ asset('admin/assets/img/icons/upload.svg') }}'); // Default preview image
                    }

                    $('#editTransactionForm').attr('action', `/transaction/${id}`); // Update form action URL
                    $('#edit-transaction-modal').modal('show'); // Show modal
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching transaction data:', error);
                    alert('Error fetching transaction details.');
                }
            });
        }
    </script>
@endsection

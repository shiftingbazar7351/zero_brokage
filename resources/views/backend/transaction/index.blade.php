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
                        <table class="table datatable table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Transaction Id</th>
                                    <th>Payment Time</th>
                                    <th>Payment Method</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id ??'' }}</td>
                                        <td>{{ $transaction->transaction_id ?? '' }}</td>
                                        {{-- <td>{{ $transaction->payment_time ? \Carbon\Carbon::parse($transaction->payment_time)->format('h:i A, d M Y') : '' }}</td> --}}
                                        <td>
                                            @if ($transaction->payment_time)
                                                {{ \Carbon\Carbon::parse($transaction->payment_time)->format('h:i A') }} <br>
                                                {{ \Carbon\Carbon::parse($transaction->payment_time)->format('d M Y') }}
                                            @endif
                                        </td>

                                        <td>{{ $transaction->payment_method ?? '' }}</td>
                                        <td>{{ $transaction->createdBy->name ?? '' }}</td>
                                        <td>
                                            @if ($transaction->created_at)
                                                @if ($transaction->created_at->isToday())
                                                        <span class="badge bg-success">Today</span>
                                                @elseif ($transaction->created_at->isYesterday())
                                                        <span class="badge bg-secondary">Yesterday</span>

                                                @else
                                                    {{ $transaction->created_at->format('d M Y') }}
                                                @endif
                                            @else
                                                <!-- Handle the case if created_at is null -->
                                                N/A
                                            @endif
                                        </td>


                                        <td>
                                            @if ($transaction->payment_status == 2)
                                                <div class="status-actions d-flex justify-content-center">
                                                    <!-- Approve Form -->
                                                    <form action="{{ route('transaction.approve', $transaction->id) }}"
                                                        method="POST" class="me-2">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success"
                                                            {{ $transaction->payment_status == 1 ? 'disabled' : '' }}
                                                            title="Approve">
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                    </form>
                                                    <!-- Reject Button (Triggers Modal for Rejection Reason) -->
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#rejectModal-{{ $transaction->id }}"
                                                        {{ $transaction->payment_status == 0 ? 'disabled' : '' }}
                                                        title="Reject">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            @elseif($transaction->payment_status == 0)
                                                <span class="badge bg-danger">Rejected</span>
                                                <br>
                                                <span class="text-wrap">{{ $transaction->reason ??'' }}</span>
                                            @else
                                                <span class="badge bg-success">Approved</span>
                                            @endif
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
                                                        onclick="return confirm('Are you sure you want to delete this?')">
                                                        <i class="fe fe-trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No data found</td>
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

<table class="table table-striped table-bordered">
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

@if ($transactions->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }}
            entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $transactions->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $transactions->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $transactions->lastPage()) as $i)
                    @if ($i == 1 || $i == $transactions->lastPage() || abs($i - $transactions->currentPage()) <= 2)
                        <li class="page-item {{ $transactions->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $transactions->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $transactions->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$transactions->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $transactions->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif


<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Company Name</th>
            <th>Mobile Number</th>
            <th>Date Time</th>
            <th>Employee</th>
            <th>Client</th>
            <th>Tag</th>
            <th>Status</th>
            <th>Comment</th>
            <th>Note</th>
            <th>Next FollowUp</th>
            <th>Image</th>
            <th>Audio</th>
            <th>created By</th>
            @canany(['vendor-task-edit', 'vendor-task-delete'])
                <th>Action</th>
            @endcanany
        </tr>
    </thead>
    <tbody>
        @if ($tasks->isEmpty())
            <tr>
                <td colspan="17" class="text-center">No data found</td>
            </tr>
        @else
            @foreach ($tasks as $task)
                <tr data-id="{{ $task->id }}">
                    <td>{{ $task->id ?? '' }}</td>
                    <td>{{ $task->vendorDetail->company_name ?? '' }}</td>
                    <td>{{ $task->vendorDetail->number ?? '' }}</td>
                    <td>
                        @if ($task->created_at->isToday())
                            <b style="color:green">Today</b>, {{ $task->created_at->format('h:i A') }}
                        @else
                            {{ $task->created_at->format('d M Y, h:i A') }}
                        @endif
                    </td>
                    <td>{{ $task->employeeId->name ?? '' }}</td>
                    <td>
                        <span class="badge bg-info">
                            {{ $task->client_type ?? '' }}
                        </span>
                    </td>

                    <td>
                        <span class="badge bg-primary">
                            {{ strtoupper($task->tags ?? '') }}
                        </span>
                    </td>
                    <td>
                        <span
                            class="badge
                            @switch($task->status)
                                @case('pending')
                                    bg-info
                                    @break
                                @case('cancelled')
                                    bg-danger
                                    @break
                                @case('on_hold')
                                    bg-warning
                                    @break
                                @case('in_progress')
                                    bg-primary
                                    @break
                                @case('completed')
                                    bg-success
                                    @break
                                @default
                                    bg-secondary
                            @endswitch
                        ">
                            {{ strtoupper($task->status ?? '') }}
                        </span>
                    </td>

                    <td>{{ $task->comments ?? '' }}</td>
                    <td>{{ $task->note ?? '' }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($task->next_followup_date_time)->format('d M Y, h:i A') }}
                    </td>

                    <td>
                        <a href="{{ asset('storage/call_history_images/' . $task->call_history_img) }}"
                            target="_blank">Image</a>
                    </td>

                    <td>
                        <a href="{{ asset('storage/call_records/' . $task->call_record) }}" target="_blank">Audio</a>
                    </td>
                    <td>{{ $task->userName->name ?? '' }}</td>
                    @canany(['vendor-task-edit', 'vendor-task-delete'])
                        <td>
                            <div class="table-actions d-flex justify-content-center">
                                <a class="btn delete-table me-2 edit-service"
                                    href="{{ route('vendor-task.edit', $task->id) }}">
                                    <i class="fe fe-edit"></i>
                                </a>
                                <form action="{{ route('vendor-task.destroy', $task->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn delete-table" type="submit"
                                        onclick="return confirm('Are you sure want to delete this?')">
                                        <i class="fe fe-trash-2"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    @endcanany
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
@if ($tasks->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $tasks->firstItem() }} to {{ $tasks->lastItem() }} of {{ $tasks->total() }} entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $tasks->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $tasks->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $tasks->lastPage()) as $i)
                    @if ($i == 1 || $i == $tasks->lastPage() || abs($i - $tasks->currentPage()) <= 2)
                        <li class="page-item {{ $tasks->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $tasks->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $tasks->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$tasks->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $tasks->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif

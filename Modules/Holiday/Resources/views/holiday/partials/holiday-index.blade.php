<table class="table table-striped text-center table-bordered shadow">
    <thead>
        <tr>
            <th>#</th>
            <th>Festival Name</th>
            <th>Start date</th>
            <th>End date</th>
            @can('holiday-status')
            <th>Status</th>
            @endcan
            @can(['holiday-edit', 'holiday-delete'])
            <th>Action</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        @if ($holidays->isEmpty())
            <tr>
                <td colspan="7" class="text-center">No data found</td>
            </tr>
        @else
            @foreach ($holidays as $holiday)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td> {{ $holiday->festival_name ?? '' }} </td>
                    <td> {{ $holiday->start_date ?? '' }} </td>
                    <td> {{ $holiday->end_date ?? '' }} </td>
                    @can('holiday-status')
                    <td>
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" class="status-toggle"
                                    data-id="{{ $holiday->id }}"
                                    onclick="return confirm('Are you sure want to change status?')"
                                    {{ $holiday->status ? 'checked' : '' }} >
                                <span class="sliders round"></span>
                            </label>
                        </div>
                    </td>
                    @endcan
                    @can(['holiday-edit', 'holiday-delete'])
                    <td>
                        <div class="table-actions d-flex justify-content-center">

                            <button class="btn delete-table me-2"
                                onclick="editHoliday({{ $holiday->id }})" type="button"
                                data-bs-toggle="modal" data-bs-target="#edit-office">
                                <i class="fe fe-edit"></i>
                            </button>

                            <form action="{{ route('holiday.destroy', $holiday->id) }}"
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
                    @endcan
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

@if ($holidays->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $holiday->firstItem() }} to {{ $holiday->lastItem() }} of {{ $holiday->total() }}
            entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $holiday->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $holiday->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $holiday->lastPage()) as $i)
                    @if ($i == 1 || $i == $holiday->lastPage() || abs($i - $holiday->currentPage()) <= 2)
                        <li class="page-item {{ $holiday->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $holiday->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $holiday->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$holiday->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $holiday->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif

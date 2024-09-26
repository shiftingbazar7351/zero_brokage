<table class="table table-striped text-center table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Designation</th>
            <th>Name</th>
            @can('employee-hr-status')
            <th>Status</th>
            @endcan
            @can(['employee-hr-edit', 'employee-hr-delete'])
            <th>Action</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        @if ($hrs->isEmpty())
            <tr>
                <td colspan="5" class="text-center">No data found</td>
            </tr>
        @else
            @foreach ($hrs as $hr)
                <tr>
                    <td>{{ $hr->id ?? ''}}</td>
                    <td>{{ $hr->designation ?? '' }}</td>
                    <td>{{ $hr->name ?? '' }}</td>
                    @can('employee-hr-status')
                    <td>
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" class="status-toggle"
                                    data-id="{{ $hr->id }}"
                                    onclick="return confirm('Are you sure want to change status?')"
                                    {{ $hr->status ? 'checked' : '' }}>
                                <span class="sliders round"></span>
                            </label>
                        </div>
                    </td>
                    @endcan
                    @can(['employee-hr-edit', 'employee-hr-delete'])
                    <td>
                        <div class="table-actions d-flex justify-content-center">

                            @can('employee-hr-edit')
                            <button class="btn delete-table me-2" onclick="editHr({{ $hr->id }})" type="button"
                                data-bs-toggle="modal" data-bs-target="#edit-product">
                                <i class="fe fe-edit"></i>
                            </button>
                            @endcan
                            @can('employee-hr-delete')
                            <form action="{{ route('employee-hr.destroy', $hr->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn delete-table" type="submit"
                                    onclick="return confirm('Are you sure want to delete this?')">
                                    <i class="fe fe-trash-2"></i>
                                </button>
                            </form>
                            @endcan
                        </div>
                    </td>
                    @endcan
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

@if ($hrs->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $hrs->firstItem() }} to {{ $hrs->lastItem() }} of {{ $hrs->total() }}
            entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $hrs->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $hrs->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $hrs->lastPage()) as $i)
                    @if ($i == 1 || $i == $hrs->lastPage() || abs($i - $hrs->currentPage()) <= 2)
                        <li class="page-item {{ $hrs->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $hrs->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $hrs->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$hrs->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $hrs->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif

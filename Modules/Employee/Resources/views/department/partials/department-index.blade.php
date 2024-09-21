<table class="table table-striped text-center table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Department Name </th>
            @can('employee-department-status')
                <th>Status</th>
            @endcan
            @canany(['employee-department-edit', 'employee-department-delete'])
                <th>Action</th>
            @endcanany
        </tr>
    </thead>
    <tbody>
        @if ($departments->isEmpty())
            <tr>
                <td colspan="7" class="text-center">No data found</td>
            </tr>
        @else
            @foreach ($departments as $department)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="table-imgname">
                            @if ($department->image)
                                <img src="{{ Storage::url('employee/departments/' . $department->image) }}"
                                    class="me-2 preview-img" alt="img">
                            @else
                                No Image
                            @endif
                        </div>
                    </td>
                    <td>{{ $department->department_id ?? '' }}</td>
                    @can('employee-department-status')
                        <td>
                            <div class="active-switch">
                                <label class="switch">
                                    <input type="checkbox" class="status-toggle" data-id="{{ $department->id }}"
                                        onclick="return confirm('Are you sure want to change status?')"
                                        {{ $department->status ? 'checked' : '' }}>
                                    <span class="sliders round"></span>
                                </label>
                            </div>
                        </td>
                    @endcan
                    @canany(['employee-department-edit', 'employee-department-delete'])
                        <td>
                            <div class="table-actions d-flex justify-content-center">
                                <button class="btn delete-table me-2" onclick="editdepartment({{ $department->id }})"
                                    type="button" data-bs-toggle="modal" data-bs-target="#edit-department">
                                    <i class="fe fe-edit"></i>
                                </button>

                                <form action="{{ route('employee-department.destroy', $department->id) }}" method="POST"
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

@if ($departments->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $departments->firstItem() }} to {{ $departments->lastItem() }} of {{ $departments->total() }}
            entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $departments->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $departments->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $departments->lastPage()) as $i)
                    @if ($i == 1 || $i == $departments->lastPage() || abs($i - $departments->currentPage()) <= 2)
                        <li class="page-item {{ $departments->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $departments->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $departments->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$departments->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $departments->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif

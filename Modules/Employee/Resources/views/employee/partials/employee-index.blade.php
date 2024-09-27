<table class="table datatable">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Company</th>
            <th>Email</th>
            <th>Department</th>
            @canany(['employee-edit', 'employee-delete', 'employee-show'])
                <th>Action</th>
            @endcanany
        </tr>
    </thead>
    <tbody>
        @forelse ($employees as $employee)
            <tr>
                <td>{{ $employee->id ??'' }}</td>
                <td>{{ $employee->name??''}}</td>
                <td>{{ $employee->companyName->legel_name??''}}</td>
                <td>{{ $employee->email ??''}}</td>
                <td>{{ $employee->department ??''}}</td>
                @canany(['employee-edit', 'employee-delete', 'employee-show'])
                    <td>
                        <div class="d-flex">
                            <a class="btn delete-table me-2 edit-service"
                                href="{{ route('employee.show', $employee->id) }}">
                                <i class="fe fe-eye"></i>
                            </a>

                            <a class="btn delete-table me-2 edit-service"
                                href="{{ route('employee.edit', $employee->id) }}">
                                <i class="fe fe-edit"></i>
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('employee.destroy', $employee->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn delete-table"
                                    onclick="return confirm('Are you sure you want to delete this Employee?');">
                                    <i class="fe fe-trash-2"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                @endcanany
            </tr>
        @empty
            <tr>
                <td colspan="12" class="text-center">No data found</td>
            </tr>
        @endforelse
    </tbody>
</table>
@if ($employees->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $employees->firstItem() }} to {{ $employees->lastItem() }} of {{ $employees->total() }} entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $employees->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $employees->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $employees->lastPage()) as $i)
                    @if ($i == 1 || $i == $employees->lastPage() || abs($i - $employees->currentPage()) <= 2)
                        <li class="page-item {{ $employees->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $employees->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $employees->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$employees->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $employees->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif

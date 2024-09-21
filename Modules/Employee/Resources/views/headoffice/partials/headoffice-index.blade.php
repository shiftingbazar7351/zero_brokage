<table class="table table-striped text-center table-bordered shadow">
    <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Number</th>
            <th>Address</th>
            @can('employee-headoffice-status')
            <th>Status</th>
            @endcan
            @can(['employee-headoffice-edit', 'employee-headoffice-delete'])
            <th>Action</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        @if ($offices->isEmpty())
            <tr>
                <td colspan="7" class="text-center">No data found</td>
            </tr>
        @else
            @foreach ($offices as $office)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="table-imgname">
                            @if ($office->image)
                                <img src="{{ Storage::url('employee/office/' . $office->image) }}"
                                    class="me-2 preview-img" alt="img">
                            @else
                                No Image
                            @endif
                        </div>
                    </td>
                    <td> {{ $office->name ?? '' }} </td>
                    <td> {{ $office->number ?? '' }} </td>
                    <td> {{ $office->address ?? '' }} </td>
                    @can('employee-headoffice-status')
                    <td>
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" class="status-toggle"
                                    data-id="{{ $office->id }}"
                                    onclick="return confirm('Are you sure want to change status?')"
                                    {{ $office->status ? 'checked' : '' }}>
                                <span class="sliders round"></span>
                            </label>
                        </div>
                    </td>
                    @endcan
                    @can(['employee-headoffice-edit', 'employee-headoffice-delete'])
                    <td>
                        <div class="table-actions d-flex justify-content-center">

                            <button class="btn delete-table me-2"
                                onclick="editOffice({{ $office->id }})" type="button"
                                data-bs-toggle="modal" data-bs-target="#edit-office">
                                <i class="fe fe-edit"></i>
                            </button>

                            <form action="{{ route('employee-headoffice.destroy', $office->id) }}"
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

@if ($offices->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $offices->firstItem() }} to {{ $offices->lastItem() }} of {{ $offices->total() }}
            entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $offices->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $offices->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $offices->lastPage()) as $i)
                    @if ($i == 1 || $i == $offices->lastPage() || abs($i - $offices->currentPage()) <= 2)
                        <li class="page-item {{ $offices->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $offices->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $offices->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$offices->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $offices->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif

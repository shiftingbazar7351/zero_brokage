<table class="table table-striped text-center table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            @can('employee-branch-status')
            <th>Status</th>
            @endcan
            @can(['employee-branch-edit', 'employee-branch-delete'])
            <th>Action</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        @if ($Branchs->isEmpty())
            <tr>
                <td colspan="5" class="text-center">No data found</td>
            </tr>
        @else
            @foreach ($Branchs as $Branch)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="table-imgname">
                            @if ($Branch->image)
                                <img src="{{ Storage::url('employee/branch/' . $Branch->image) }}"
                                    class="me-2 preview-img" alt="img">
                            @else
                                No Image
                            @endif
                        </div>
                    </td>
                    <td>{{ $Branch->name ?? '' }}</td>
                    @can('employee-branch-status')
                    <td>
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" class="status-toggle"
                                    data-id="{{ $Branch->id }}"
                                    onclick="return confirm('Are you sure want to change status?')"
                                    {{ $Branch->status ? 'checked' : '' }}>
                                <span class="sliders round"></span>
                            </label>
                        </div>
                    </td>
                    @endcan
                    @can(['employee-branch-edit', 'employee-branch-delete'])
                    <td>
                        <div class="table-actions d-flex justify-content-center">

                            <button class="btn delete-table me-2" onclick="editBranch({{ $Branch->id }})" type="button"
                                data-bs-toggle="modal" data-bs-target="#edit-product">
                                <i class="fe fe-edit"></i>
                            </button>

                            <form action="{{ route('employee-branch.destroy', $Branch->id) }}" method="POST" style="display:inline;">
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

@if ($Branchs->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $Branchs->firstItem() }} to {{ $Branchs->lastItem() }} of {{ $Branchs->total() }}
            entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $Branchs->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $Branchs->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $Branchs->lastPage()) as $i)
                    @if ($i == 1 || $i == $Branchs->lastPage() || abs($i - $Branchs->currentPage()) <= 2)
                        <li class="page-item {{ $Branchs->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $Branchs->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $Branchs->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$Branchs->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $Branchs->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif

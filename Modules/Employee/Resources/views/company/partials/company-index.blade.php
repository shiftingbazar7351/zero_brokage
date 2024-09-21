<table class="table table-striped text-center table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Brand-Company Name</th>
            <th>Legel-Company Name</th>
            @can('employee-company-status')
            <th>Status</th>
            @endcan
            @can(['employee-company-edit', 'employee-company-delete'])
            <th>Action</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        @if ($companies->isEmpty())
            <tr>
                <td colspan="6" class="text-center">No data found</td>
            </tr>
        @else
            @foreach ($companies as $company)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="table-imgname">
                            @if ($company->image)
                                <img src="{{ Storage::url('employee/company/' . $company->image) }}"
                                    class="me-2 preview-img" alt="img">
                            @else
                                No Image
                            @endif
                        </div>
                    </td>
                    <td>{{ $company->brand_name }}</td>
                    <td>{{ $company->legel_name }}</td>
                    @can('employee-company-status')
                    <td>
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" class="status-toggle"
                                    data-id="{{ $company->id }}"
                                    onclick="return confirm('Are you sure want to change status?')"
                                    {{ $company->status ? 'checked' : '' }}>
                                <span class="sliders round"></span>
                            </label>
                        </div>
                    </td>
                    @endcan
                    @can(['employee-company-edit', 'employee-company-delete'])
                    <td>
                        <div class="table-actions d-flex justify-content-center">

                            <button class="btn delete-table me-2"
                                onclick="editCompany({{ $company->id }})" type="button"
                                data-bs-toggle="modal" data-bs-target="#edit-company">
                                <i class="fe fe-edit"></i>
                            </button>

                            <form action="{{ route('employee-company.destroy', $company->id) }}"
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

@if ($companies->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $companies->firstItem() }} to {{ $companies->lastItem() }} of {{ $companies->total() }}
            entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $companies->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $companies->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $companies->lastPage()) as $i)
                    @if ($i == 1 || $i == $companies->lastPage() || abs($i - $companies->currentPage()) <= 2)
                        <li class="page-item {{ $companies->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $companies->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $companies->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$companies->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $companies->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif

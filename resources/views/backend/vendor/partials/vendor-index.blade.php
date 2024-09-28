<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>email</th>
            @canany(['vendors-edit', 'vendors-delete', 'vendors-show'])
                <th>Action</th>
            @endcanany
        </tr>
    </thead>
    <tbody>
        @forelse ($vendors as $vendor)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $vendor->company_name }}</td>
                <td>{{ $vendor->email }}</td>
                @canany(['vendors-edit', 'vendors-delete', 'vendors-show'])
                    <td>
                        <div class="d-flex">

                            <a class="btn delete-table me-2 edit-service" href="{{ route('vendors.show', $vendor->id) }}">
                                <i class="fe fe-eye"></i>
                            </a>

                            <a class="btn delete-table me-2 edit-service" href="{{ route('vendors.edit', $vendor->id) }}">
                                <i class="fe fe-edit"></i>
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn delete-table"
                                    onclick="return confirm('Are you sure you want to delete this sub-category?');">
                                    <i class="fe fe-trash-2"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                @endcanany
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">No data found</td>
            </tr>
        @endforelse
    </tbody>
</table>
@if ($vendors->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $vendors->firstItem() }} to {{ $vendors->lastItem() }} of {{ $vendors->total() }} entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $vendors->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $vendors->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $vendors->lastPage()) as $i)
                    @if ($i == 1 || $i == $vendors->lastPage() || abs($i - $vendors->currentPage()) <= 2)
                        <li class="page-item {{ $vendors->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $vendors->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $vendors->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$vendors->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $vendors->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif

<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($packages->isEmpty())
            <tr>
                <td colspan="6" class="text-center">No data found</td>
            </tr>
        @else
            @foreach ($packages as $package)
                <tr class="text-wrap">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $package->name }}</td>
                    <td title="{{ $package->description }}">
                        {!! truncateCharacters($package->description, 500) !!}
                    </td>

                    <td>
                        <div class="d-flex">
                            <a class="btn delete-table me-2 edit-product"
                                href="#">
                                <i class="fe fe-eye"></i>
                            </a>

                            <a class="btn delete-table me-2 edit-product"
                                href="{{ route('package.edit', $package->id) }}">
                                <i class="fe fe-edit"></i>
                            </a>
                            <!-- Delete Button -->
                            <form action="{{ route('package.destroy', $package->id) }}"
                                method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn delete-table"
                                    onclick="return confirm('Are you sure you want to delete this package?');">
                                    <i class="fe fe-trash-2"></i>
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
            @endforeach
        @endif
    </tbody>
</table>
@if ($packages->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $packages->firstItem() }} to {{ $packages->lastItem() }} of {{ $packages->total() }} entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $packages->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $packages->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $packages->lastPage()) as $i)
                    @if ($i == 1 || $i == $packages->lastPage() || abs($i - $packages->currentPage()) <= 2)
                        <li class="page-item {{ $packages->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $packages->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $packages->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$packages->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $packages->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif

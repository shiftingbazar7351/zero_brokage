<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Description</th>
            @can(['india-services-edit', 'india-services-delete'])
            <th>Action</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        @if ($services->isEmpty())
            <tr>
                <td colspan="6" class="text-center">No data found</td>
            </tr>
        @else
            @foreach ($services as $service)
                <tr class="text-wrap">
                    <td>{{ $loop->iteration }}</td>
                    <td title="{{ $service->description }}">
                        {!! truncateCharacters($service->description, 500) !!}
                    </td>
                    @can(['india-services-edit', 'india-services-delete'])
                    <td>
                        <div class="d-flex">
                            <a class="btn delete-table me-2 edit-service" href="{{ route('india-services.edit', $service->id) }}">
                                <i class="fe fe-edit"></i>
                            </a>
                            <!-- Delete Button -->
                            <form action="{{ route('india-services.destroy', $service->id) }}"
                                method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn delete-table"
                                    onclick="return confirm('Are you sure you want to delete this sub-category?');">
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

@if ($services->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $services->firstItem() }} to {{ $services->lastItem() }} of {{ $services->total() }}
            entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $services->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $services->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $services->lastPage()) as $i)
                    @if ($i == 1 || $i == $services->lastPage() || abs($i - $services->currentPage()) <= 2)
                        <li class="page-item {{ $services->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $services->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $services->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$services->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $services->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif

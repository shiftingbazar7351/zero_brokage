<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Url</th>
            <th>Title</th>
            <th>Description</th>
            @can(['meta-edit', 'meta-delete'])
                <th>Action</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        @if ($metas->isEmpty())
            <tr>
                <td colspan="6" class="text-center">No data found</td>
            </tr>
        @else
            @foreach ($metas as $meta)
                <tr data-id="{{ $meta->id }}">
                    <td>{{ $meta->id }}</td>
                    <td>{{ $meta->url }}</td>
                    <td>{{ $meta->title }}</td>
                    <td>{{ $meta->description }}</td>
                    @can(['meta-edit', 'meta-delete'])
                        <td>
                            <div class="table-actions d-flex justify-content-center">
                                <button class="btn delete-table me-2" onclick="editCategory({{ $meta->id }})"
                                    type="button" data-bs-toggle="modal" data-bs-target="#edit-meta">
                                    <i class="fe fe-edit"></i>
                                </button>

                                <form action="{{ route('meta.destroy', $meta->id) }}" method="POST"
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
                    @endcan
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
@if ($metas->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $metas->firstItem() }} to {{ $metas->lastItem() }} of {{ $metas->total() }} entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $metas->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $metas->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $metas->lastPage()) as $i)
                    @if ($i == 1 || $i == $metas->lastPage() || abs($i - $metas->currentPage()) <= 2)
                        <li class="page-item {{ $metas->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $metas->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $metas->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$metas->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $metas->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif

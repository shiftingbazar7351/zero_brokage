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
{{-- Pagination Links --}}
<div class="d-flex justify-content-center">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            @if ($metas->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $metas->previousPageUrl() }}">Previous</a>
                </li>
            @endif

            @for ($i = 1; $i <= $metas->lastPage(); $i++)
                <li class="page-item {{ $metas->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $metas->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($metas->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $metas->nextPageUrl() }}">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Next</span>
                </li>
            @endif
        </ul>
    </nav>
</div>

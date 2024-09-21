<table class="table datatable">
    <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            @can('verified-status')
            <th>Status</th>
            @endcan
            @can(['verified-edit', 'verified-delete'])
            <th>Action</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        @forelse ($verifieds as $verified)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <div class="table-imgname">
                        @if ($verified->image)
                            <img src="{{ Storage::url('verified/' . $verified->image) }}"
                                class="me-2 preview-img" alt="img">
                        @else
                            No Image
                        @endif
                    </div>
                </td>
                <td>{{ $verified->name ?? '' }}</td>
                @can('verified-status')
                <td>
                    <div class="active-switch">
                        <label class="switch">
                            <input type="checkbox" class="status-toggle"
                                data-id="{{ $verified->id }}"
                                onclick="return confirm('Are you sure want to change status?')"
                                {{ $verified->status ? 'checked' : '' }}>
                            <span class="sliders round"></span>
                        </label>
                    </div>
                </td>
                @endcan
                @can(['verified-edit', 'verified-delete'])
                <td>
                    <div class="table-actions d-flex justify-content-center">
                        <button class="btn delete-table me-2"
                            onclick="editVerified({{ $verified->id }})" type="button"
                            data-bs-toggle="modal" data-bs-target="#edit-category">
                            <i class="fe fe-edit"></i>
                        </button>
                        <form action="{{ route('verified.destroy', $verified->id) }}" method="POST"
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
        @empty
            <tr>
                <td colspan="6" class="text-center">No data found</td>
            </tr>
        @endforelse
    </tbody>
</table>

@if ($verifieds->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $verifieds->firstItem() }} to {{ $verifieds->lastItem() }} of {{ $verifieds->total() }} entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $verifieds->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $verifieds->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $verifieds->lastPage()) as $i)
                    @if ($i == 1 || $i == $verifieds->lastPage() || abs($i - $verifieds->currentPage()) <= 2)
                        <li class="page-item {{ $verifieds->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $verifieds->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $verifieds->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$verifieds->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $verifieds->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif

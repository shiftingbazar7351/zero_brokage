<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Profession</th>
            @can('reviews-status')
                <th>Status</th>
            @endcan
            <th>Date</th>
            <th>Created by</th>
            @can(['reviews-edit', 'reviews-delete'])
                <th>Action</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        @forelse ($reviews as $review)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $review->name ?? '' }}</td>
                <td>{{ $review->description ?? '' }}</td>
                <td>{{ $review->profession ?? '' }}</td>

                @can('reviews-status')
                    <td>
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" class="status-toggle" data-id="{{ $review->id }}"
                                    {{ $review->status ? 'checked' : '' }}>
                                <span class="sliders round"></span>
                            </label>
                        </div>
                    </td>
                @endcan
                <td>{{ $review->created_at ? $review->created_at->format('d M Y') : '' }}</td>
                <td>{{ $review->createdBy->name ?? '' }}</td>
                @can(['reviews-edit', 'reviews-delete'])
                    <td>
                        <div class="table-actions d-flex justify-content-center">
                            <button class="btn delete-table me-2" onclick="editCategory({{ $review->id }})" type="button"
                                data-bs-toggle="modal" data-bs-target="#edit-review">
                                <i class="fe fe-edit"></i>
                            </button>
                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn delete-table" type="subm it"
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
                <td colspan="7" class="text-center">No data found</td>
            </tr>
        @endforelse
    </tbody>
</table>
@if ($reviews->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $reviews->firstItem() }} to {{ $reviews->lastItem() }} of {{ $reviews->total() }} entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $reviews->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $reviews->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $reviews->lastPage()) as $i)
                    @if ($i == 1 || $i == $reviews->lastPage() || abs($i - $reviews->currentPage()) <= 2)
                        <li class="page-item {{ $reviews->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $reviews->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $reviews->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$reviews->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $reviews->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif

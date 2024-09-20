<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Email</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($newsletters as $newsletter)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $newsletter->email ?? '' }}</td>
                @php
                $createdAt = $newsletter->created_at;
                $formattedDate = '';

                if ($createdAt->isToday()) {
                    $formattedDate = '<span class="badge bg-primary">Today</span>';
                } elseif ($createdAt->isYesterday()) {
                    $formattedDate = '<span class="badge bg-secondary">Yesterday</span>';
                } else {
                    $formattedDate = $createdAt->format('d M Y');
                }
            @endphp

            <td>{!! $formattedDate !!}</td>


                <td>
                    <div class="table-actions">

                        <form action="{{ route('newsletter.destroy', $newsletter->id) }}" method="POST"
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
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No data found</td>
            </tr>
        @endforelse
    </tbody>
</table>

@if ($newsletters->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $newsletters->firstItem() }} to {{ $newsletters->lastItem() }} of {{ $newsletters->total() }}
            entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $newsletters->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $newsletters->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $newsletters->lastPage()) as $i)
                    @if ($i == 1 || $i == $newsletters->lastPage() || abs($i - $newsletters->currentPage()) <= 2)
                        <li class="page-item {{ $newsletters->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $newsletters->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $newsletters->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$newsletters->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $newsletters->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif

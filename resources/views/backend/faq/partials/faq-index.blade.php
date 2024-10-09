<table class="table  table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Date</th>
            <th>Created by</th>
            @can('faq-status')
                <th>Status</th>
            @endcan
            @can(['faq-edit', 'faq-delete'])
                <th>Action</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        @forelse ($faqs as $faq)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $faq->question ?? '' }}</td>
                <td>{{ $faq->answer ?? '' }}</td>
                <td>{{ $faq->created_at ? $faq->created_at->format('d M Y') : '' }}</td>
                <td>{{ $faq->createdBy->name ?? '' }}</td>
                @can('faq-status')
                <td>
                    <div class="active-switch">
                        <label class="switch">
                            <input type="checkbox" class="status-toggle"
                                data-id="{{ $faq->id }}" {{ $faq->status ? 'checked' : '' }}>
                            <span class="sliders round"></span>
                        </label>
                    </div>
                </td>
                @endcan
                @can(['faq-edit', 'faq-delete'])
                <td>
                    <div class="table-actions d-flex justify-content-center">
                        <button class="btn delete-table me-2"
                            onclick="editCategory({{ $faq->id }})" type="button"
                            data-bs-toggle="modal" data-bs-target="#edit-faq">
                            <i class="fe fe-edit"></i>
                        </button>
                        <form action="{{ route('faq.destroy', $faq->id) }}" method="POST"
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
@if ($faqs->lastPage() > 1)
<div class="d-flex justify-content-between align-items-center">
    <!-- Showing X to Y of Z entries -->
    <div>
        Showing {{ $faqs->firstItem() }} to {{ $faqs->lastItem() }} of {{ $faqs->total() }} entries
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination mb-0">
            <!-- Previous Button -->
            <li class="page-item {{ $faqs->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $faqs->previousPageUrl() }}" tabindex="-1">Previous</a>
            </li>

            <!-- Page numbers with ellipsis -->
            @foreach (range(1, $faqs->lastPage()) as $i)
                @if ($i == 1 || $i == $faqs->lastPage() || abs($i - $faqs->currentPage()) <= 2)
                    <li class="page-item {{ $faqs->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $faqs->url($i) }}">{{ $i }}</a>
                    </li>
                @elseif ($i == 2 || $i == $faqs->lastPage() - 1)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
            @endforeach

            <!-- Next Button -->
            <li class="page-item {{ !$faqs->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $faqs->nextPageUrl() }}">Next</a>
            </li>
        </ul>
    </nav>
</div>
@endif

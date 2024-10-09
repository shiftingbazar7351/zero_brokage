<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Menu</th>
            <th>Sub Menu</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Ammount</th>
            <th>Grand Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($invoices as $invoice)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td> {{ $invoice->category->name ?? '' }} </td>
                <td> {{ $invoice->subcategory->name ?? '' }} </td>
                <td> {{ $invoice->menu->name ?? '' }} </td>
                <td> {{ $invoice->submenu->name ?? '' }} </td>
                <td> {{ $invoice->price ?? '' }} </td>
                <td> {{ $invoice->quantity ?? '' }} </td>
                <td> {{ $invoice->total_ammount ?? '' }} </td>
                <td> {{ $invoice->grand_total ?? '' }} </td>
                <td>
                    <div class="table-actions d-flex justify-content-center">
                        <button class="btn delete-table me-2" onclick="#" type="button"
                            data-bs-toggle="modal" data-bs-target="#edit-category">
                            <i class="fe fe-edit"></i>
                        </button>
                        <form action="#" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn delete-table" type="submit"
                                onclick="return confirm('Are you sure want to delete this?')">
                                <i class="fe fe-trash-2"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="12" class="text-center">No data found</td>
            </tr>
        @endforelse
    </tbody>
</table>
@if ($invoices->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $invoices->firstItem() }} to {{ $invoices->lastItem() }} of {{ $invoices->total() }} entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $invoices->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $invoices->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $invoices->lastPage()) as $i)
                    @if ($i == 1 || $i == $invoices->lastPage() || abs($i - $invoices->currentPage()) <= 2)
                        <li class="page-item {{ $invoices->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $invoices->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $invoices->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$invoices->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $invoices->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif

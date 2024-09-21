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
        @if ($products->isEmpty())
            <tr>
                <td colspan="6" class="text-center">No data found</td>
            </tr>
        @else
            @foreach ($products as $product)
                <tr class="text-wrap">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td title="{{ $product->description }}">
                        {!! truncateCharacters($product->description, 500) !!}
                    </td>

                    <td>
                        <div class="d-flex">
                            <a class="btn delete-table me-2 edit-product"
                                href="{{ route('products.show', $product->id) }}">
                                <i class="fe fe-eye"></i>
                            </a>

                            <a class="btn delete-table me-2 edit-product"
                                href="{{ route('products.edit', $product->id) }}">
                                <i class="fe fe-edit"></i>
                            </a>
                            <!-- Delete Button -->
                            <form action="{{ route('products.destroy', $product->id) }}"
                                method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn delete-table"
                                    onclick="return confirm('Are you sure you want to delete this product?');">
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
@if ($products->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $products->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $products->lastPage()) as $i)
                    @if ($i == 1 || $i == $products->lastPage() || abs($i - $products->currentPage()) <= 2)
                        <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $products->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$products->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $products->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif

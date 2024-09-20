<table class="table table-striped text-center table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            @can('employee-product-status')
            <th>Status</th>
            @endcan
            @can(['employee-product-edit', 'employee-product-delete'])
            <th>Action</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        @if ($products->isEmpty())
            <tr>
                <td colspan="5" class="text-center">No data found</td>
            </tr>
        @else
            @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="table-imgname">
                            @if ($product->image)
                                <img src="{{ Storage::url('employee/hoffice/' . $product->image) }}"
                                    class="me-2 preview-img" alt="img">
                            @else
                                No Image
                            @endif
                        </div>
                    </td>
                    <td>{{ $product->name ?? '' }}</td>
                    @can('employee-product-status')
                    <td>
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" class="status-toggle"
                                    data-id="{{ $product->id }}"
                                    onclick="return confirm('Are you sure want to change status?')"
                                    {{ $product->status ? 'checked' : '' }}>
                                <span class="sliders round"></span>
                            </label>
                        </div>
                    </td>
                    @endcan
                    @can(['employee-product-edit', 'employee-product-delete'])
                    <td>
                        <div class="table-actions d-flex justify-content-center">

                            <button class="btn delete-table me-2" onclick="editproduct({{ $product->id }})" type="button"
                                data-bs-toggle="modal" data-bs-target="#edit-product">
                                <i class="fe fe-edit"></i>
                            </button>

                            <form action="{{ route('employee-product.destroy', $product->id) }}" method="POST" style="display:inline;">
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

@if ($products->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }}
            entries
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

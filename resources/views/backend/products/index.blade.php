@extends('backend.layouts.main')

@section('content')

    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Products Listing</h5>
                <div class="list-btn">
                    <ul>
                        <li>
                            <button class="btn btn-primary" type="button" onclick="window.location='{{ route('products.create') }}'">
                                <i class="fa fa-plus me-2"></i>Add Product
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="table-resposnive table-div">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
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
                                            <td title="{{ $product->description }}">
                                                {!! truncateCharacters($product->description, 500) !!}
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a class="btn delete-table me-2 edit-product" href="{{ route('products.show', $product->id) }}">
                                                        <i class="fe fe-eye"></i>
                                                    </a>

                                                    <a class="btn delete-table me-2 edit-product" href="{{ route('products.edit', $product->id) }}">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

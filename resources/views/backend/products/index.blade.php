@extends('backend.layouts.main')

@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Products Listing</h5>
                <div class="list-btn d-flex gap-3">
                    <div class="page-headers">
                        <div class="search-bar">
                            <span><i class="fe fe-search"></i></span>
                            <input type="text" id="search" placeholder="Search" class="form-control">
                        </div>
                    </div>
                    @can('product-create')
                        <ul>
                            <li>
                                <button class="btn btn-primary" type="button"
                                    onclick="window.location='{{ route('products.create') }}'">
                                    <i class="fa fa-plus me-2"></i>Add Product
                                </button>
                            </li>
                        </ul>
                    @endcan
                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="table-resposnive table-div">
                        <div id="usersTable">
                            @include('backend.products.partials.products-index') {{-- Load the users list initially --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var searchRoute = `{{ route('products.index') }}`;
    </script>
    <script src="{{ asset('admin/assets/js/search.js') }}"></script>
@endsection

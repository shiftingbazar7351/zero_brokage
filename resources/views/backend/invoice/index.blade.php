@extends('backend.layouts.main')
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="main-wrapper">
                <div class="list-btn d-flex my-3 justify-content-end d-flex gap-3">
                    {{-- <div class="list-btn d-flex gap-3"> --}}
                        <div class="page-headers">
                            <div class="search-bar">
                                <span><i class="fe fe-search"></i></span>
                                <input type="text" id="search" placeholder="Search" class="form-control">
                            </div>
                        </div>
                    <ul>
                        <li>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#add-invoice">
                                <i class="fa fa-plus me-2"></i>Add Vendors Invoice
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="col-12">
                    <div class="table-responsive table-div">
                        <div id="usersTable">
                            @include('backend.invoice.partials.invoice-index') {{-- Load the users list initially --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-invoice">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Vendor Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="addSubCategoryForm" action="{{ route('invoice.edit', $vendor->id ?? '') }}" method="GET"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="vendor">vendor Name</label>
                            <select class="form-control" id="vendor" name="vendor_id">
                                <option value="">Select vendor</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->vendor_name }}</option>
                                @endforeach
                            </select>
                            <div id="category_id_error" class="text-danger"></div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var searchRoute = `{{ route('meta.index') }}`;
    </script>
    <script src="{{ asset('admin/assets/js/search.js') }}"></script>


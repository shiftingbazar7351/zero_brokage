@extends('backend.layouts.main')
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="main-wrapper">
                <div class="list-btn d-flex my-3 justify-content-end">
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
                        <table class="table datatable table-striped table-bordered">
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

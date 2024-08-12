@extends('backend.layouts.main')
@section('content')

    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Service Detail Listing</h5>
                <div class="list-btn">
                    <ul>
                        <li>
                            {{-- <a href="{{ route('service-detail.create') }}" class="btn btn-primary mb-3">
                                Add Service Detail
                            </a> --}}

                            <button class="btn btn-primary" type="button" data-toggle="modal"
                            data-target="#addCategoryModal"><i class="fa fa-plus me-2"></i>Add Service details</button>
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
                                    <th>Subcategory</th>
                                    <th>Description</th>
                                    <th>Summery</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($serviceDetails->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($serviceDetails as $service)
                                        <tr class="text-wrap">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $service->subCategory->name ?? '' }}</td>
                                            <td title="{{ $service->description }}">
                                                {!! truncateCharacters($service->description, 100) !!}
                                            </td>
                                            <td title="{{ $service->summery }}">
                                                {!! truncateCharacters($service->summery, 100) !!}
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <a class="btn delete-table me-2 edit-service"
                                                        data-id="{{ $service->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#editCategoryModal">
                                                        <i class="fe fe-edit"></i>
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('service-detail.destroy', $service->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn delete-table"
                                                            onclick="return confirm('Are you sure you want to delete this sub-category?');">
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

    <div class="modal fade" id="addCategoryModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Service detail</h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('subcategories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf


                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Subcategory</h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('subcategories.update', $subcategory->id ?? '') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')


                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

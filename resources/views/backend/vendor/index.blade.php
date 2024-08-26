@extends('backend.layouts.main')
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Vendors</h5>

                <div class="list-btn d-flex gap-3">

                        <div class="page-headers">
                            <div class="search-bar">
                                <span><i class="fe fe-search"></i></span>
                                <input type="text" placeholder="Search" class="form-control">
                            </div>
                        </div>

                    <ul>
                        <li>

                                <button class="btn btn-primary" type="button"  onclick="window.location='{{ route('vendors.create') }}'" >
                                    <i class="fa fa-plus me-2"></i>Add Vendors
                                </button>
                            
                        </li>
                    </ul>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="table-responsive table-div">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                    <tr>
                                        <td colspan="3" class="text-center">No data found</td>
                                    </tr>

                                        <tr>
                                            <td>1</td>
                                            <td>vikas </td>
                                            <td>
                                                <button class="btn delete-table me-2 edit-url"  type="button" data-bs-toggle="modal" data-bs-target="#edit-category">
                                                    <i class="fe fe-edit"></i>
                                                </button>
                                            </td>



                                        </tr>
                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


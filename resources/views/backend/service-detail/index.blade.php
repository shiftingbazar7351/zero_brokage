@extends('backend.layouts.main')
@section('content')

    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Service Detail Listing</h5>
                <div class="list-btn">
                    <ul>
                        <li>
                            <a href="{{ route('service-detail.create') }}" class="btn btn-primary mb-3">
                                Add Service Detail
                            </a>
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
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($serviceDetails->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($serviceDetails as $service)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $service->subCategory->name ?? '' }}</td>
                                            <td title="{!! $service->description !!}">
                                                {!! truncateWords($service->description, 20) !!}
                                            </td>
                                            <td title="{!! $service->summery !!}">
                                                {!! truncateWords($service->summery, 20) !!}
                                            </td>


                                            <td>
                                                @if ($service->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
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

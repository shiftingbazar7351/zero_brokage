@extends('backend.layouts.main')

@section('content')

    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Service Detail Listing</h5>
                @can('service-detail-create')
                <div class="list-btn">
                    <ul>
                        <li>

                            <button class="btn btn-primary" type="button" onclick="window.location='{{ route('service-detail.create') }}'">
                                <i class="fa fa-plus me-2"></i>Add Service details
                            </button>
                        </li>
                    </ul>
                </div>
                @endcan
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
                                    @can(['service-detail-edit', 'service-detail-delete'])
                                        <th>Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @if ($serviceDetails->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($serviceDetails as $service)
                                        <tr class="text-wrap">
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $service->subCategory->name ?? '' }}</td>
                                            <td title="{{ $service->description }}">
                                                {!! truncateCharacters($service->description, 500) !!}
                                            </td>
                                            <td title="{{ $service->summery }}">
                                                {!! truncateCharacters($service->summery, 500) !!}
                                            </td>
                                            @can(['service-detail-edit', 'service-detail-delete'])
                                            <td>
                                                <div class="d-flex">
                                                    <a class="btn delete-table me-2 edit-service" href="{{ route('service-detail.edit', $service->id) }}">
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
                                            @endcan

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

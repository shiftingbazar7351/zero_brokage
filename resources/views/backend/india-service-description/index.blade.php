@extends('backend.layouts.main')

@section('content')

    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>India service Listing</h5>
                @can('india-services-create')
                <div class="list-btn">
                    <ul>
                        <li>
                            <button class="btn btn-primary" type="button" onclick="window.location='{{ route('india-services.create') }}'">
                                <i class="fa fa-plus me-2"></i>Add India services
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
                                    <th>Description</th>
                                    @can(['india-services-edit', 'india-services-delete'])
                                    <th>Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @if ($services->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($services as $service)
                                        <tr class="text-wrap">
                                            <td>{{ $loop->iteration }}</td>
                                            <td title="{{ $service->description }}">
                                                {!! truncateCharacters($service->description, 500) !!}
                                            </td>
                                            @can(['india-services-edit', 'india-services-delete'])
                                            <td>
                                                <div class="d-flex">
                                                    <a class="btn delete-table me-2 edit-service" href="{{ route('india-services.edit', $service->id) }}">
                                                        <i class="fe fe-edit"></i>
                                                    </a>
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('india-services.destroy', $service->id) }}"
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

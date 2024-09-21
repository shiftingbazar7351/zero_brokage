@extends('backend.layouts.main')

@section('content')

    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>India service Listing</h5>
                @can('india-services-create')
                <div class="list-btn d-flex gap-3">
                    <div class="page-headers">
                        <div class="search-bar">
                            <span><i class="fe fe-search"></i></span>
                            <input type="text" id="search" placeholder="Search" class="form-control">
                        </div>
                    </div>
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
                        <div id="usersTable">
                            @include('backend.india-service-description.partials.india-index') {{-- Load the users list initially --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    var searchRoute = `{{ route('india-services.index') }}`;
</script>
<script src="{{ asset('admin/assets/js/search.js') }}"></script>
@endsection

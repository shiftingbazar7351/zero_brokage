@extends('backend.layouts.main')
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>tasks</h5>
                <div class="list-btn d-flex gap-3">
                    <div class="page-headers">
                        <div class="search-bar">
                            <span><i class="fe fe-search"></i></span>
                            <input type="text" id="search" placeholder="Search" class="form-control">
                        </div>
                    </div>
                    @can('vendor-task-create')
                    <ul>
                        <li>
                            <a href="{{ route('vendor-task.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus me-2"></i>Add task
                            </a>
                        </li>
                    </ul>
                    @endcan
                </div>
            </div>
            <div class="row text-center">
                <div class="col-12">
                    <div class="table-responsive table-div">

                        <div id="usersTable">
                            @include('backend.vendor.task.partials.task-index') {{-- Load the users list initially --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        var statusRoute = `{{ route('vendor-task.status') }}`;
        var searchRoute = `{{ route('vendor-task.index') }}`;
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('admin/assets/js/search.js') }}"></script>
    <script src="{{ asset('admin/assets/js/status-update.js') }}"></script>
@endsection

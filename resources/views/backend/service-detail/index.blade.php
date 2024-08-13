@extends('backend.layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/summernote/summernote.min.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

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

                            <button class="btn btn-primary" type="button" onclick="window.location='{{ route('service-detail.create') }}'">
                                <i class="fa fa-plus me-2"></i>Add Service details
                            </button>
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

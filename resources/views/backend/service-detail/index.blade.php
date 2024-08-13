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
@section('scripts')
    <script src="{{ asset('admin/summernote/summernote.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 200
            });
        });
    </script>
     <script>
        $(document).ready(function() {
            $('#summery').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 200
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#category').on('change', function() {
                var subcategoryId = $(this).val();
                if (subcategoryId) {
                    $.ajax({
                        url: '/fetch-subcategory/' + subcategoryId, // Adjusted URL based on route
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}' // Include CSRF token for security
                        },
                        success: function(response) {
                            if (response.status === 1) {
                                var subcategory = response.data;
                                console.log(subcategory);
                                $('#subcategory').find('option')
                                    .remove(); // Clear existing options
                                var options =
                                    '<option value="">Select Subcategory</option>'; // Default option
                                $.each(subcategory, function(key, subcateg) {
                                    options += "<option value='" + subcateg.id + "'>" +
                                        subcateg
                                        .name + "</option>";
                                });
                                $('#subcategory').append(options);
                            }
                        }
                    });
                } else {
                    $('#subcategory').find('option').remove(); // Clear options if no state is selected
                    $('#subcategory').append('<option value="">Select ddd</option>');
                }
            });
        });
    </script>
@endsection
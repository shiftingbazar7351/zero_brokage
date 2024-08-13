@extends('backend.layouts.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/summernote/summernote.min.css') }}">
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
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
                            <button class="btn btn-primary" type="button" data-toggle="modal"
                                data-target="#addCategoryModal">
                                <i class="fa fa-plus me-2"></i>Add Service Details
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive table-div">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Subcategory</th>
                                    <th>Description</th>
                                    <th>Summary</th>
                                    <th>Action</th>
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
                                                {!! truncateCharacters($service->description, 100) !!}
                                            </td>
                                            <td title="{{ $service->summary }}">
                                                {!! truncateCharacters($service->summary, 100) !!}
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a class="btn delete-table me-2 edit-service" 
                                                       data-id="{{ $service->id }}" 
                                                       data-bs-toggle="modal" 
                                                       data-bs-target="#editCategoryModal">
                                                       <i class="fe fe-edit"></i>
                                                    </a>
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('service-detail.destroy', $service->id) }}" 
                                                          method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn delete-table"
                                                                onclick="return confirm('Are you sure you want to delete this service detail?');">
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

    <!-- Add Service Detail Modal -->
    <div class="modal fade" id="addCategoryModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Service Detail</h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('service-detail.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="category">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="subcategory">Subcategory</label>
                            <select class="form-control" id="subcategory" name="subcategory_id">
                                <option value="">Select Subcategory</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="col-form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="summary" name="summary">{{ old('summary') }}</textarea>
                            @error('summary')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Service Detail Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Service Detail</h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('service-detail.update', $service->id ?? '') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="category">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="subcategory">Subcategory</label>
                            <select class="form-control" id="subcategory" name="subcategory_id">
                                <option value="">Select Subcategory</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="col-form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="summary" name="summary">{{ old('summary') }}</textarea>
                            @error('summary')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/summernote/summernote.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: "Write short description...",
                tabsize: 2,
                height: 200
            });
            $('#summary').summernote({
                placeholder: "Write short summary...",
                tabsize: 2,
                height: 200
            });

            $('#category').on('change', function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: '/fetch-subcategory/' + categoryId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status === 1) {
                                var subcategory = response.data;
                                $('#subcategory').empty();
                                $('#subcategory').append('<option value="">Select Subcategory</option>');
                                $.each(subcategory, function(key, subcateg) {
                                    $('#subcategory').append("<option value='" + subcateg.id + "'>" + subcateg.name + "</option>");
                                });
                            }
                        }
                    });
                } else {
                    $('#subcategory').empty();
                    $('#subcategory').append('<option value="">Select Subcategory</option>');
                }
            });
        });
    </script>
@endsection

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
            <div class="row">
                <div>
                    {{-- <h1> Paragraph</h1> --}}
                    <form id="addCategoryModal" action="{{ route('service-detail.store') }}" method="POST">
                        @csrf
                        <div class="mb-3 col-md-6">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="category">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="category">Subcategory</label>
                            <select class="form-control" id="subcategory" name="subcategory_id">
                                <option value="">Select Subcategory</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="description" class="col-form-label">description <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="summery" class="col-form-label">Desription <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" id="summery" name="summery">{{ old('summery') }}</textarea>
                            @error('summery')
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
@endsection

@section('scripts')
    <script src="{{ asset('admin/summernote/summernote.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 330
            });
        });
    </script>
     <script>
        $(document).ready(function() {
            $('#summery').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 330
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

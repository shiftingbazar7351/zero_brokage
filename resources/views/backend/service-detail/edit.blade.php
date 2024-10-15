@extends('backend.layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/summernote/summernote.min.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
@endsection

@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="row">
                <div>
                    <form action="{{ route('service-detail.update', $serviceDetail->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 col-md-6">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="category_id">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $serviceDetail->subcategory->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="subcategory">Subcategory</label>
                            <select class="form-control" id="subcategory" name="subcategory_id">
                                <option value="">Select Subcategory</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="description" class="col-form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description">{{ old('description', $serviceDetail->description) }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="summery" class="col-form-label">Summary</label>
                            <textarea class="form-control" id="summery" name="summery">{{ old('summery', $serviceDetail->summery) }}</textarea>
                            @error('summery')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
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
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 330
            });
        });

        $(document).ready(function() {
            $('#summery').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 330
            });
        });


    </script>

<script>
    // Populate subcategories based on the selected category
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('category');
        const subcategorySelect = document.getElementById('subcategory');
        const selectedCategoryId = '{{ $serviceDetail->subcategory->category_id }}';
        const selectedSubcategoryId = '{{ $serviceDetail->subcategory_id }}';

        // Fetch subcategories for the initially selected category
        if (selectedCategoryId) {
            fetchSubcategories(selectedCategoryId, selectedSubcategoryId);
        }

        // Fetch subcategories when the category changes
        categorySelect.addEventListener('change', function () {
            const categoryId = this.value;
            fetchSubcategories(categoryId);
        });

        function fetchSubcategories(categoryId, selectedSubcategoryId = null) {
            subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>'; // Clear existing options

            if (categoryId) {
                fetch(`/subcategories/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.subcategories.forEach(subcategory => {
                            const option = document.createElement('option');
                            option.value = subcategory.id;
                            option.text = subcategory.name;
                            if (subcategory.id == selectedSubcategoryId) {
                                option.selected = true;
                            }
                            subcategorySelect.add(option);
                        });
                    });
            }
        }
    });
</script>
@endsection

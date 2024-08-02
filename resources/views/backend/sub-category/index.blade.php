@extends('backend.layouts.main')
@section('content')
<div class="page-wrapper page-settings">
    <div class="content">
        <div class="content-page-header content-page-headersplit mb-0">
            <h5>Categories</h5>
            <div class="list-btn">
                <ul>
                    <li>
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                            data-target="#addCategoryModal">
                            Add Sub-Category
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
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subcategories as $subcategory)
                                <tr>
                                    <td>{{ $subcategory->id }}</td>
                                    <td>{{ $subcategory->name }}</td>
                                    <td>
                                        @if ($subcategory->image)
                                            <img src="{{ asset('storage/images/' . $subcategory->image) }}"
                                                class="img-thumbnail" width="100">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Edit Button -->
                                        <!-- <a href="{{ route('subcategories.edit', $subcategory->id) }}"
                                                            class="fa fa-edit"></a> -->
                                        <div class="d-flex">
                                            <a class="btn delete-table me-2"
                                                href="{{ route('subcategories.edit', $subcategory->id) }}">
                                                <i class="fe fe-edit"></i>
                                            </a>
                                            <!-- Delete Button -->
                                            <form action="{{ route('subcategories.destroy', $subcategory->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn delete-table" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#delete-pages"
                                                    onclick="return confirm('Are you sure you want to delete this sub-category?');">
                                                    <i class="fe fe-trash-2"></i>
                                                </button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Add Sub-Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('subcategories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
    <label class="form-label">Category Image</label>
    <div class="form-uploads">
        <div class="form-uploads-path" style="position: relative; text-align: center;">
            <!-- Image Preview -->
            <div id="image-preview-container" style="border: 2px dashed #ccc; border-radius: 5px; padding: 10px; display: inline-block; width: 150px; height: 150px; overflow: hidden; position: relative;">
                <img id="image-preview" src="{{asset('admin/assets/img/icons/upload.svg')}}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover; display: block;">
            </div>
            <!-- File Upload -->
            <div class="file-browse" style="margin-top: 10px;">
                <h6 style="margin: 0;">Drag & drop image or</h6>
                <input type="file" id="image-upload" name="image" accept="image/jpeg, image/png" style="display: none;">
                <a href="javascript:void(0);" id="browse-btn" style="color: #007bff; text-decoration: underline; cursor: pointer;">Browse</a>
                <h5 style="margin-top: 10px;">Supported formats: JPEG, PNG</h5>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('image-upload');
    const imagePreview = document.getElementById('image-preview');
    const browseBtn = document.getElementById('browse-btn');

    // Handle file input change event
    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file && (file.type === 'image/jpeg' || file.type === 'image/png')) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };

            reader.readAsDataURL(file);
        } else {
            alert('Please select a JPEG or PNG image.');
            fileInput.value = ''; // Clear the input
        }
    });

    // Trigger file input click when browse button is clicked
    browseBtn.addEventListener('click', function() {
        fileInput.click();
    });
});

</script>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    })

    $(document).ready(function){
        $("#category").change(function () {
            var subcategory = $(this).val();
            console.log('vikas::::::');
        })
    }
</script>
@endsection
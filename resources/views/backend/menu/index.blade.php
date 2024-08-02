@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container mt-5">
    <h1>Menus</h1>
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addMenuModal">
        Add Menu
    </button>

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
            @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->id }}</td>
                <td>{{ $menu->name }}</td>
                <td>
                    @if ($menu->image)
                        <img src="{{ asset('storage/assets/menu/' . $menu->image) }}" width="100">
                    @else
                        No Image
                    @endif
                </td>
                <td>
                    <!-- Edit Button -->
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editMenuModal" data-id="{{ $menu->id }}" data-name="{{ $menu->name }}" data-category="{{ $menu->category_id }}" data-subcategory="{{ $menu->subcategory_id }}" data-image="{{ $menu->image }}">
                        Edit
                    </button>
                    <!-- Delete Button -->
                    <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this menu?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Menu Modal -->
<div class="modal fade" id="addMenuModal" tabindex="-1" aria-labelledby="addMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMenuModalLabel">Add Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
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

                    <div class="form-group">
                        <label for="subcategory">Sub Category</label>
                        <select class="form-control" id="subcategory" name="subcategory" required>
                            <option value="">Select a sub-category</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" name="image" id="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Menu Modal -->
<!-- <div class="modal fade" id="editMenuModal" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editMenuForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="edit_name">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name">
                    </div>

                    <div class="form-group">
                        <label for="edit_category">Category</label>
                        <select class="form-control" id="edit_category" name="category" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_subcategory">Sub Category</label>
                        <select class="form-control" id="edit_subcategory" name="subcategory" required>
                            <option value="">Select a sub-category</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_image">Image:</label>
                        <input type="file" name="image" id="edit_image">
                        <input type="hidden" id="existing_image" name="existing_image">
                        <img id="edit_image_preview" src="" width="100" style="display:none;">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div> -->

<script>
$(document).ready(function() {
    // Fetch subcategories when a category is selected
    $("#category, #edit_category").change(function() {
        var categoryId = $(this).val();
        var targetSelect = $(this).attr('id') === 'category' ? '#subcategory' : '#edit_subcategory';
        
        if (categoryId === "") {
            categoryId = 0;
        }

        $.ajax({
            url: '{{ url("/fetch-subcategory/") }}' + '/' + categoryId,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response) {
                if(response.status === 1) {
                    $(targetSelect).find('option:not(:first)').remove();
                    $.each(response.data, function(key, value) {
                        $(targetSelect).append("<option value='" + value.id + "'>" + value.name + "</option>");
                    });
                } else {
                    console.error('Failed to fetch subcategories');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.log(xhr.responseText);
            }
        });
    });

    // Populate edit modal with menu data
    $('#editMenuModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var name = button.data('name');
        var category = button.data('category');
        var subcategory = button.data('subcategory');
        var image = button.data('image');

        var modal = $(this);
        modal.find('#edit_name').val(name);
        modal.find('#edit_category').val(category);
        modal.find('#existing_image').val(image);
        
        // Fetch and populate subcategories for edit
        $.ajax({
            url: '{{ url("/fetch-subcategory/") }}' + '/' + category,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response) {
                if(response.status === 1) {
                    var editSubcategory = modal.find('#edit_subcategory');
                    editSubcategory.find('option:not(:first)').remove();
                    $.each(response.data, function(key, value) {
                        editSubcategory.append("<option value='" + value.id + "'>" + value.name + "</option>");
                    });
                    editSubcategory.val(subcategory); // Set the current subcategory
                }
            }
        });

        if (image) {
            modal.find('#edit_image_preview').attr('src', '{{ asset('storage/assets/menu/') }}/' + image).show();
        } else {
            modal.find('#edit_image_preview').hide();
        }

        modal.find('form').attr('action', '{{ url("/menus/") }}/' + id);
    });
});
</script>
</body>
</html>
@endsection

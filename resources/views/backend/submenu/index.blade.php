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
    <h1>Sub-Menus</h1>
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addMenuModal">
        Add Sub-Menu
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
                <form action="{{ route('submenu.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="menu">Menu</label>
                        <select class="form-control" id="menu" name="menu" required>
                            <option value="">Select Menu</option>
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

    $(document).ready(function() {
    $("#subcategory, #edit_menu").change(function() {
        var categoryId = $(this).val();
        var targetSelect = $(this).attr('id') === 'subcategory' ? '#edit_subcategory' : '#subcategory';

        alert('vikas:::::' + categoryId);
        console.log(categoryId);

        if (categoryId === "") {
            categoryId = 0;
        }

        $.ajax({
            url: '{{ url("/fetch-menus/") }}' + '/' + categoryId,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            context: { targetSelect: targetSelect }, // Bind the targetSelect variable to the context
            success: function(response) {
                console.log(response);
                if(response.status === 1) {
                    $(this.targetSelect).find('option:not(:first)').remove(); // Use this.targetSelect to access the variable
                    $.each(response.data, function(key, value) {
                        $(this.targetSelect).append("<option value='" + value.id + "'>" + value.name + "</option>");
                    }.bind(this)); // Bind the each function's context to include this.targetSelect
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

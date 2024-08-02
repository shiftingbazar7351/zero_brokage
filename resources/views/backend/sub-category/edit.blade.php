<!-- resources/views/subcategories/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit SubCategory</h2>
    <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $subcategory->name }}" required>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
            @if ($subcategory->image)
                <img src="{{ Storage::url($subcategory->image) }}" alt="{{ $subcategory->name }}" width="100">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

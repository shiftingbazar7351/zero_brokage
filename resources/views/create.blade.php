@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Add Category</h1>

    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
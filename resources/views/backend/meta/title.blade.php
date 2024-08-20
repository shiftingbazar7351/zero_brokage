@extends('backend.layouts.main')
@section('styles')
    <style>
        .preview-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
@endsection
@section('content')

    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Meta-title</h5>
                <div class="list-btn  d-flex gap-3">
                    <div class="page-headers">
                        <div class="search-bar">
                            <span><i class="fe fe-search"></i></span>
                            <input type="text" placeholder="Search" class="form-control">
                        </div>
                    </div>

                    <ul>
                        <li>
                            @if ($titles->isEmpty())
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#add-category"><i class="fa fa-plus me-2"></i>Add title</button>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive table-div">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($titles->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($titles as $title)
                                        <tr>
                                            <td>{{ $title->id }}</td>
                                            <td>{{ $title->title }}</td>
                                            <td>
                                                <button class="btn delete-table me-2 edit-url" data-id="{{ $title->id }}" data-url="{{ $title->title }}" type="button" data-bs-toggle="modal" data-bs-target="#edit-category">
                                                    <i class="fe fe-edit"></i>
                                                </button>

                                                {{-- <button class="btn btn-sm btn-danger delete-title" data-id="{{ $title->id }}">
                                                    Delete
                                                </button> --}}
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

    <!-- Add Category Modal -->
    <div class="modal fade" id="add-category">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Meta-title</h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <div id="add-category-error" class="alert alert-danger d-none"></div>
                    <form id="add-category-form">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Meta Title">
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="edit-category">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Meta-title</h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <div id="edit-category-error" class="alert alert-danger d-none"></div>
                    <form id="edit-category-form">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="edit-category-id">
                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" class="form-control" name="title" id="edit-category-title" placeholder="Enter Meta Title">
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#add-category-form').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('meta-title.store') }}",
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        $('#add-category-error').text(errors.title).removeClass('d-none');
                    }
                });
            });

            $('.edit-title').on('click', function() {
                let id = $(this).data('id');
                let title = $(this).data('title');

                $('#edit-category-id').val(id);
                $('#edit-category-title').val(title);
            });

            $('#edit-category-form').on('submit', function(e) {
                e.preventDefault();
                let id = $('#edit-category-id').val();
                let formData = $(this).serialize();

                $.ajax({
                    url: "/meta-title/" + id,
                    method: 'PUT',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        $('#edit-category-error').text(errors.title).removeClass('d-none');
                    }
                });
            });

            // $('.delete-title').on('click', function() {
            //     let id = $(this).data('id');

            //     if (confirm('Are you sure you want to delete this title?')) {
            //         $.ajax({
            //             url: "/meta-title/" + id,
            //             method: 'DELETE',
            //             data: {
            //                 _token: "{{ csrf_token() }}"
            //             },
            //             success: function(response) {
            //                 if (response.success) {
            //                     location.reload();
            //                 }
            //             }
            //         });
            //     }
            // });
        });
    </script>
@endsection

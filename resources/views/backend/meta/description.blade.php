@extends('backend.layouts.main')
@section('styles')
    <style>
        .preview-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .error-desc {
            color: red;
        }
    </style>
@endsection
@section('content')

    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Categories</h5>
                <div class="list-btn">
                    <ul>
                        <li>
                            @if ($descriptions->isEmpty())
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#add-category"><i class="fa fa-plus me-2"></i>Add Description</button>
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
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($descriptions->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($descriptions as $description)
                                        <tr>
                                            <td>{{ $description->id }}</td>
                                            <td>{{ $description->description }}</td>
                                            <td>
                                                <button class="btn btn-sm "
                                                data-bs-target="#edit-category-{{ $description->id }}" type="button"
                                                data-bs-toggle="modal">
                                                <i class="fe fe-edit"></i>
                                            </button>
                                                {{-- <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit-category-{{ $description->id }}">Edit</button> --}}
                                            </td>
                                        </tr>

                                        <!-- Edit Category Modal -->
                                        <div class="modal fade" id="edit-category-{{ $description->id }}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Meta-Description</h5>
                                                        <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fe fe-x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body pt-0">
                                                        <form id="edit-form-{{ $description->id }}" action="{{ route('meta.update', $description->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label class="form-label">Meta Description</label>
                                                                <input type="text" class="form-control" name="desc" placeholder="Enter Meta Description" value="{{ $description->description }}">
                                                                <span class="error-desc"></span>
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
                    <h5 class="modal-title">Add Meta-Description</h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <form id="add-form" action="{{ route('meta.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <input type="text" class="form-control" name="desc" placeholder="Enter Meta Description" value="">
                            <div class="text-danger meta_description-error">{{ $errors->first('meta_description') }}</div>
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
<script>
    $(document).ready(function() {
    // Handle Add Form Submission
    $('#add-category form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function(response) {
                if(response.success) {
                    window.location.reload();
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                $('#add-category .error-desc').text(errors.desc ? errors.desc[0] : '');
            }
        });
    });

    // Handle Edit Form Submission
    $('form[id^="edit-form-"]').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function(response) {
                if(response.success) {
                    window.location.reload();
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                form.find('.error-desc').text(errors.desc ? errors.desc[0] : '');
            }
        });
    });
});

</script>
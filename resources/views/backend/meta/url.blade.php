@extends('backend.layouts.main')

@section('content')
<div class="page-wrapper page-settings">
    <div class="content">
        <div class="content-page-header content-page-headersplit mb-0">
            <h5>Meta-url</h5>
            <div class="list-btn  d-flex gap-3">
                <div class="page-headers">
                    <div class="search-bar">
                        <span><i class="fe fe-search"></i></span>
                        <input type="text" placeholder="Search" class="form-control">
                    </div>
                </div>
                <ul>
                    <li>
                        @if ($urls->isEmpty())
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#add-category">
                            <i class="fa fa-plus me-2"></i>Add URL
                        </button>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-resposnive table-div">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Url</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($urls->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center">No data found</td>
                                </tr>
                            @else
                                @foreach ($urls as $url)
                                    <tr data-id="{{ $url->id }}">
                                        <td>{{ $url->id }}</td>
                                        <td>{{ $url->url }}</td>
                                        <td>
                                            <button class="btn delete-table me-2 edit-url"
                                            data-id="{{ $url->id }}" data-url="{{ $url->url }}"
                                            type="button" data-bs-toggle="modal" data-bs-target="#edit-category">
                                            <i class="fe fe-edit"></i>
                                            </button>
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
                <h5 class="modal-title">Add Meta-url</h5>
                <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fe fe-x"></i>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div id="add-category-error" class="alert alert-danger d-none"></div>
                <form id="add-url-form">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Meta Url</label>
                        <input type="text" class="form-control" name="url" placeholder="Enter Meta Url">
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
                <h5 class="modal-title">Edit Meta-url</h5>
                <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fe fe-x"></i>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div id="edit-category-error" class="alert alert-danger d-none"></div>
                <form id="edit-url-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit-url-id">
                    <div class="mb-3">
                        <label class="form-label">Meta Url</label>
                        <input type="text" class="form-control" name="url" id="edit-url" placeholder="Enter Meta Url">
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
<script>
    $(document).ready(function() {
        // Add URL
        $('#add-url-form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('meta-url.store') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    }
                },
                error: function(response) {
                    let errors = response.responseJSON.errors;
                    let errorText = '';
                    $.each(errors, function(key, value) {
                        errorText += value + '<br>';
                    });
                    $('#add-category-error').html(errorText).removeClass('d-none');
                }
            });
        });

        // Edit URL
        $('.edit-url').on('click', function() {
            var id = $(this).data('id');
            var url = $(this).data('url');
            $('#edit-url-id').val(id);
            $('#edit-url').val(url);
        });

        // Update URL
        $('#edit-url-form').on('submit', function(e) {
            e.preventDefault();
            var id = $('#edit-url-id').val();
            $.ajax({
                url: '/meta-url/' + id,
                method: 'PUT',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    }
                },
                error: function(response) {
                    let errors = response.responseJSON.errors;
                    let errorText = '';
                    $.each(errors, function(key, value) {
                        errorText += value + '<br>';
                    });
                    $('#edit-category-error').html(errorText).removeClass('d-none');
                }
            });
        });
    });
</script>
@endsection

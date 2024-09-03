@extends('backend.layouts.main')

@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Meta Data</h5>
                <div class="list-btn  d-flex gap-3">
                    <div class="page-headers">
                        <div class="search-bar">
                            <span><i class="fe fe-search"></i></span>
                            <input type="text" placeholder="Search" class="form-control">
                        </div>
                    </div>
                    <ul>
                        <li>
                            @if ($metas->isEmpty())
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#add-meta">
                                    <i class="fa fa-plus me-2"></i>Add Meta
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
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($metas->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($metas as $meta)
                                        <tr data-id="{{ $meta->id }}">
                                            <td>{{ $meta->id }}</td>
                                            <td>{{ $meta->url }}</td>
                                            <td>{{ $meta->title }}</td>
                                            <td>{{ $meta->description }}</td>
                                            <td>
                                                <div class="table-actions d-flex justify-content-center">
                                                    <button class="btn delete-table me-2"
                                                    onclick="editCategory({{ $meta->id }})" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#edit-meta">
                                                    <i class="fe fe-edit"></i>
                                                </button>

                                                    <form action="{{ route('meta.destroy', $meta->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn delete-table" type="submit"
                                                            onclick="return confirm('Are you sure want to delete this?')">
                                                            <i class="fe fe-trash-2"></i>
                                                        </button>
                                                    </form>
                                                </div>
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
    <div class="modal fade" id="add-meta">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Meta</h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    {{-- <div id="add-meta-error" class="alert alert-danger d-none"></div> --}}
                    <form id="add-url-form" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Meta Url</label>
                            <input type="text" class="form-control" name="url" placeholder="Enter Meta Url">
                            <div id="url_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Meta Title">
                            <div id="title_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Keyword</label>
                            <input type="text" class="form-control" name="keyword" placeholder="Enter Meta Keyword">
                            <div id="keyword_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea type="text" class="form-control" name="description"
                                placeholder="Enter Meta Description" >{{ old('description') }}</textarea>
                            <div id="description_error" class="text-danger"></div>
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
    <div class="modal fade" id="edit-meta">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Meta</h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <div id="edit-category-error" class="alert alert-danger d-none"></div>
                    <form id="editmetaForm" method="POST" action="{{ route('meta.update', 'meta_id') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="meta_id">
                        <div class="mb-3">
                            <label class="form-label">Meta Url</label>
                            <input type="text" class="form-control" name="url" id="edit_url" placeholder="Enter Meta Url">
                            <div id="editurl_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" class="form-control" name="title" id="edit_title" placeholder="Enter Meta Title">
                            <div id="edittitle_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Keyword</label>
                            <input type="text" class="form-control" name="keyword" id="edit_keyword" placeholder="Enter Meta Keyword">
                            <div id="editkeyword_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <input type="text" class="form-control" id="edit_description" name="description"
                                placeholder="Enter Meta Description" value="{{ old('description') }}">
                            <div id="editdescription_error" class="text-danger"></div>
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
            $('#add-url-form').off('submit').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission
                $.ajax({
                    url: $(this).attr('action'), // Form action URL
                    method: 'POST',
                    data: $(this).serialize(), // Serialize form data
                    success: function(response) {
                        $('#add-meta').modal('hide'); // Hide the modal
                        if (response) {
                            location.reload(); // Refresh page to show updated data
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            $('#url_error').text('');
                            $('#title_error').text('');
                            $('#keyword_error').text('');
                            $('#description_error').text('');
                            if (errors.url) {
                                $('#url_error').text(errors.url[0]);
                            }
                            if (errors.title) {
                                $('#title_error').text(errors.title[0]);
                            }
                            if (errors.keyword) {
                                $('#keyword_error').text(errors.keyword[0]);
                            }
                            if (errors.description) {
                                $('#description_error').text(errors.description[0]);
                            }
                        }
                    }
                });
            });
        });

        function editCategory(id) {
            $.ajax({
                url: `/meta/${id}/edit`,
                method: 'GET',
                success: function(data) {
                    $('#meta_id').val(data.id);
                    $('#edit_url').val(data.url);
                    $('#edit_title').val(data.title);
                    $('#edit_keyword').val(data.keyword);
                    $('#edit_description').val(data.description);

                    // Update form action URL
                    $('#editmetaForm').attr('action', `/meta/${data.id}`);

                    // Show the modal
                    $('#edit-meta').modal('show');
                },
                error: function() {
                    alert('Error fetching review data.');
                }
            });
        }
    </script>
@endsection

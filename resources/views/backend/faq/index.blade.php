@extends('backend.layouts.main')
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>FAQs</h5>

                <div class="list-btn d-flex gap-3">

                    <div class="page-headers">
                        <div class="search-bar">
                            <span><i class="fe fe-search"></i></span>
                            <input type="text" placeholder="Search" class="form-control">
                        </div>
                    </div>
                    @can('faq-create')
                    <ul>
                        <li>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#add-faqs">
                                <i class="fa fa-plus me-2"></i>Add FAQ
                            </button>
                        </li>
                    </ul>
                    @endcan
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-resposnive table-div">
                        <table class="table  table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Date</th>
                                    <th>Created by</th>
                                    @can('faq-status')
                                        <th>Status</th>
                                    @endcan
                                    @can(['faq-edit', 'faq-delete'])
                                        <th>Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($faqs as $faq)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $faq->question ?? '' }}</td>
                                        <td>{{ $faq->answer ?? '' }}</td>
                                        <td>{{ $faq->created_at ? $faq->created_at->format('d M Y') : '' }}</td>
                                        <td>{{ $faq->createdBy->name ?? '' }}</td>
                                        @can('faq-status')
                                        <td>
                                            <div class="active-switch">
                                                <label class="switch">
                                                    <input type="checkbox" class="status-toggle"
                                                        data-id="{{ $faq->id }}" {{ $faq->status ? 'checked' : '' }}>
                                                    <span class="sliders round"></span>
                                                </label>
                                            </div>
                                        </td>
                                        @endcan
                                        @can(['faq-edit', 'faq-delete'])
                                        <td>
                                            <div class="table-actions d-flex justify-content-center">
                                                <button class="btn delete-table me-2"
                                                    onclick="editCategory({{ $faq->id }})" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#edit-faq">
                                                    <i class="fe fe-edit"></i>
                                                </button>
                                                <form action="{{ route('faq.destroy', $faq->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn delete-table" type="subm it"
                                                        onclick="return confirm('Are you sure want to delete this?')">
                                                        <i class="fe fe-trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        @endcan
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No data found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-faqs">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Faq</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <form id="addFaqForm" method="POST" data-parsley-validate="true">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Question</label>
                            <textarea type="text" class="form-control" name="question" placeholder="Enter question" required>{{ old('question') }}</textarea>
                            <div id="question_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Answer</label>
                            <textarea type="text" class="form-control" name="answer" placeholder="Enter answer" required>{{ old('answer') }}</textarea>
                            <div id="answer_error" class="text-danger"></div>
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


    <!-- Edit Menu Modal -->
    <div class="modal fade" id="edit-faq">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Faq</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <form id="editFaqForm" method="POST" action="{{ route('faq.update', 'faq_id') }}"
                        enctype="multipart/form-data" data-parsley-validate="true">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editFaqId" name="faq_id">
                        <div class="mb-3">
                            <label class="form-label">Question</label>
                            <textarea type="text" class="form-control" id="editQuestion" name="question" placeholder="Enter question"
                                required></textarea>
                            <div id="editQuestion_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Answer</label>
                            <textarea type="text" class="form-control" id="editAnswer" name="answer" placeholder="Enter answer" required></textarea>
                            <div id="editAnswer_error" class="text-danger"></div>
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
        var statusRoute = `{{ route('faq.status') }}`;
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('admin/assets/js/status-update.js') }}"></script>
    <script>
        function editCategory(id) {
            $.ajax({
                url: `/faq/${id}/edit`,
                method: 'GET',
                success: function(data) {
                    $('#editFaqId').val(data.id);
                    $('#editQuestion').val(data.question);
                    $('#editAnswer').val(data.answer);

                    // Update form action URL
                    $('#editFaqForm').attr('action', `/faq/${data.id}`);

                    // Show the modal
                    $('#edit-faq').modal('show');
                },
                error: function() {
                    alert('Error fetching FAQ data.');
                }
            });
        }

        // for validation in addition

        $(document).ready(function() {
            $('#add-faqs').on('shown.bs.modal', function() {
                $('#addFaqForm').off('submit').on('submit', function(event) {
                    console.log("Form submitted"); // Debugging message
                    event.preventDefault(); // Prevent the default form submission

                    $.ajax({
                        url: $(this).attr('action'), // Form action URL
                        method: 'POST',
                        data: $(this).serialize(), // Serialize form data
                        success: function(response) {
                            $('#add-faqs').modal('hide'); // Hide the modal
                            window.location.reload(); // Reload the page
                        },
                        error: function(xhr) {
                            console.log(xhr
                            .responseJSON); // Debugging message for error response
                            var errors = xhr.responseJSON.errors;
                            if (errors) {
                                $('#question_error').text('');
                                $('#answer_error').text('');
                                if (errors.question) {
                                    $('#question_error').text(errors.question[0]);
                                }
                                if (errors.answer) {
                                    $('#answer_error').text(errors.answer[0]);
                                }
                            }
                        }
                    });
                });
            });
        });

    </script>
@endsection

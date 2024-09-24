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

                        <div id="usersTable">
                            @include('backend.faq.partials.faq-index') {{-- Load the users list initially --}}
                        </div>
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
                    <form id="addFaqForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Question</label>
                            <textarea type="text" class="form-control" name="question" placeholder="Enter question">{{ old('question') }}</textarea>
                            <div id="question_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Answer</label>
                            <textarea type="text" class="form-control" name="answer" placeholder="Enter answer">{{ old('answer') }}</textarea>
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
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editFaqId" name="faq_id">
                        <div class="mb-3">
                            <label class="form-label">Question</label>
                            <textarea type="text" class="form-control" id="editQuestion" name="question" placeholder="Enter question"></textarea>
                            <div id="editQuestion_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Answer</label>
                            <textarea type="text" class="form-control" id="editAnswer" name="answer" placeholder="Enter answer"></textarea>
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
        var searchRoute = `{{ route('categories.index') }}`;
    </script>
    <script src="{{ asset('admin/assets/js/search.js') }}"></script>
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
            // Event listener when the modal is shown
            $('#add-faqs').on('shown.bs.modal', function() {
                // Unbind any previous submit handlers and bind the new one
                $('#addFaqForm').off('submit').on('submit', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    // Debugging message to check if form submission is triggered
                    console.log("Submitting form...");

                    $.ajax({
                        url: $(this).attr('action') ||
                        '{{ route('faq.store') }}', // Ensure the correct URL is used
                        type: 'POST', // Use 'type' instead of 'method' for compatibility
                        data: $(this).serialize(), // Serialize the form data
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content') // Include CSRF token in headers
                        },
                        success: function(response) {
                            // Debugging message for successful response
                            console.log("Form submitted successfully:", response);

                            // Hide the modal and reload the page
                            $('#add-faqs').modal('hide');
                            window.location
                        .reload(); // Reload the page to reflect changes
                        },
                        error: function(xhr) {
                            // Debugging message for error response
                            console.log("Error occurred:", xhr.responseJSON);

                            // Clear any previous error messages
                            $('#question_error').text('');
                            $('#answer_error').text('');

                            // Extract and display validation errors if they exist
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                const errors = xhr.responseJSON.errors;
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

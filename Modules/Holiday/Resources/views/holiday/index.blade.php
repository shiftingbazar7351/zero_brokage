@extends('backend.layouts.main')
@section('styles')
    <style>
        .preview-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
    </style>
@endsection
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Holidays</h5>
                <div class="list-btn d-flex gap-3">
                    <div class="page-headers">
                        <div class="search-bar">
                            <span><i class="fe fe-search"></i></span>
                            <input type="text" id="search" placeholder="Search" class="form-control">
                        </div>
                    </div>
                    @can('holiday-create')
                        <ul>
                            <li>
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#add_holiday"><i class="fa fa-plus me-2"></i>Add Holiday</button>
                            </li>
                        </ul>
                    @endcan
                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="table-responsive table-div">
                        <div id="usersTable">
                            @include('holiday::holiday.partials.holiday-index') {{-- Load the users list initially --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Company Modal -->
    <div class="modal fade" id="add_holiday" tabindex="-1" aria-labelledby="addCompanyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCompanyLabel">Add Holiday</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="addHolidayForm" action="{{ route('holiday.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Festival Types<b style="color: red;">*</b></label>
                            <select name="festival_types" class="form-select bg-light-subtle" required>
                                <option value="" selected disabled>Festival Types</option>
                                <option value="National" {{ old('festival_types') == 'National' ? 'selected' : '' }}>
                                    National
                                </option>
                                <option value="Gested" {{ old('festival_types') == 'Gested' ? 'selected' : '' }}>Gested
                                </option>
                                <option value="Restricted" {{ old('festival_types') == 'Restricted' ? 'selected' : '' }}>
                                    Restricted
                                </option>
                            </select>
                            <div id="festival_types_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Festival Name</label>
                            <input type="text" class="form-control" name="festival_name"
                                placeholder="Enter Festival name">
                            <div id="name_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Start date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                onchange="calculateDays()" placeholder="Enter start date">
                            <div id="start_date_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">End date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                onchange="calculateDays()" placeholder="Enter end date">
                            <div id="end_date_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Number of days</label>
                            <input type="text" class="form-control" id="Number_of_days" name="Number_of_days" readonly
                                placeholder="Enter number of days">
                            <div id="Number_of_days_error" class="text-danger"></div>
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


    <!-- Edit Company Modal -->
    <div class="modal fade" id="edit-office" tabindex="-1" aria-labelledby="editCompanyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCompanyLabel">Edit Holiday</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="editHolidayForm" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <input type="hidden" id="editHolidayId" name="id">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Festival Types<b style="color: red;">*</b></label>
                            <select name="festival_types" id="editfestival_types" class="form-select bg-light-subtle"
                                aria-label="Default select example" required>
                                <option value="" disabled>Festival Types</option>

                                <option value="National"
                                    {{ isset($holiday) && $holiday->festival_types == 'National' ? 'selected' : '' }}>
                                    National
                                </option>

                                <option value="Gazetted "
                                    {{ isset($holiday) && $holiday->festival_types == 'Gazetted ' ? 'selected' : '' }}>
                                    Gazetted
                                </option>

                                <option value="Restricted"
                                    {{ isset($holiday) && $holiday->festival_types == 'Restricted' ? 'selected' : '' }}>
                                    Restricted
                                </option>
                            </select>
                            <div id="editfestival_types_error" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Festival Name</label>
                            <input type="text" class="form-control" id="editfestival_name" name="festival_name"
                                placeholder="Enter Festival name">
                            <div id="editname_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Start date</label>
                            <input type="date" class="form-control" id="editstart_date" name="start_date"
                                onchange="calculateDays()" placeholder="Enter start date">
                            <div id="editstart_date_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">End date</label>
                            <input type="date" class="form-control" id="editend_date" name="end_date"
                                onchange="calculateDays()" placeholder="Enter end date">
                            <div id="editend_date_error" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Number of days</label>
                            <input type="text" class="form-control" id="editNumber_of_days" name="Number_of_days"
                                readonly placeholder="Enter number of days">
                            <div id="editNumber_of_days_error" class="text-danger"></div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var statusRoute = `{{ route('holiday.status') }}`;
        var searchRoute = `{{ route('holiday.index') }}`;
    </script>
    <script src="{{ asset('admin/assets/js/search.js') }}"></script>
    <script src="{{ asset('admin/assets/js/status-update.js') }}"></script>
    <script>
        function calculateDays() {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);

                // Calculate the difference in time
                const timeDiff = end.getTime() - start.getTime();

                // Calculate the difference in days
                const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                // If the difference is negative (end date before start date), set to 0
                document.getElementById('Number_of_days').value = daysDiff > 0 ? daysDiff : 0;
            }
        }
    </script>
    <script>
        function calculateDays() {
            const startDate = document.getElementById('editstart_date').value;
            const endDate = document.getElementById('editend_date').value;

            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);

                // Calculate the difference in time
                const timeDiff = end.getTime() - start.getTime();

                // Calculate the difference in days
                const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                // If the difference is negative (end date before start date), set to 0
                document.getElementById('editNumber_of_days').value = daysDiff > 0 ? daysDiff : 0;
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#addHolidayForm').off('submit').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            location.reload(); // Refresh page to show new data
                        }
                    },
                    error: function(xhr) {
                        $('#name_error').text(xhr.responseJSON.errors.festival_name ? xhr
                            .responseJSON
                            .errors.festival_name[0] : '');
                        $('#start_date').text(xhr.responseJSON.errors.start_date ? xhr
                            .responseJSON
                            .errors.start_date[0] : '');

                    }
                });
            });
        });

        window.editHoliday = function(id) {
            $.ajax({
                url: `/holiday/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    $('#editHolidayId').val(response.holiday.id);
                    $('#editfestival_name').val(response.holiday.festival_name);
                    $('#editstart_date').val(response.holiday.start_date);
                    $('#editend_date').val(response.holiday.end_date);
                    $('#editNumber_of_days').val(response.holiday.Number_of_days);

                }
            });
        }

        $('#editHolidayForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let id = $('#editHolidayId').val();

            $.ajax({
                type: 'POST',
                url: `/holiday/${id}`,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        location.reload(); // Refresh page to show updated data
                    }
                },
                error: function(xhr) {

                    $('#editfestival_types_error').text('');
                    $('#editname_error').text('');
                    $('#editstart_date_error').text('');
                    $('#editend_date_error').text('');
                    $('#editNumber_of_days_error').text('');

                    // Handle new errors start_date_error
                    if (xhr.responseJSON.errors) {
                        $('#editfestival_types_error').text(xhr.responseJSON.errors.festival_types ? xhr
                            .responseJSON
                            .errors.festival_types[0] : '');
                        $('#editname_error').text(xhr.responseJSON.errors.name ? xhr.responseJSON.errors
                            .name[0] : '');
                        $('#editstart_date_error').text(xhr.responseJSON.errors.start_date ? xhr
                            .responseJSON
                            .errors.start_date[0] : '');
                        $('#editend_date_error').text(xhr.responseJSON.errors.end_date ? xhr
                            .responseJSON
                            .errors.end_date[0] : '');
                        $('#editNumber_of_days_error').text(xhr.responseJSON.errors.Number_of_days ? xhr
                            .responseJSON
                            .errors.Number_of_days[0] : '');
                    }
                }
            });
        });
    </script>
@endsection

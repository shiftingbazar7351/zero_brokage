@extends('backend.layouts.main')
@section('content')

    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Enquiry Listing</h5>
                <div class="list-btn">
                    <ul>
                        <li>
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                data-bs-target="#addEnquiryModal">
                                Add Enquiry
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive table-div">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($enquiries->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($enquiries as $enquiry)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $enquiry->name }}</td>
                                            <td>{{ $enquiry->move_from_origin }}</td>
                                            <td>
                                                @php
                                                    $date = \Carbon\Carbon::parse($enquiry->date_time);
                                                @endphp
                                                @if ($date->isToday())
                                                    <span class="badge bg-success">Today</span>
                                                @elseif ($date->isYesterday())
                                                    <span class="badge bg-warning text-dark">Yesterday</span>
                                                @elseif ($date->isTomorrow())
                                                    <span class="badge bg-primary">Tomorrow</span>
                                                @else
                                                    {{ $date->format('d-m-Y') }}
                                                @endif
                                            </td>
                                            <td>{{ $enquiry->email }}</td>
                                            <td>{{ $enquiry->mobile_number }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a class="btn delete-table me-2 edit-enquiry"
                                                        data-id="{{ $enquiry->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#editEnquiryModal">
                                                        <i class="fe fe-edit"></i>
                                                    </a>
                                                    <form action="{{ route('enquiry.destroy', $enquiry->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn delete-table"
                                                            onclick="return confirm('Are you sure you want to delete this sub-category?');">
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

    <!-- Add Enquiry Modal -->
    <div class="modal fade" id="addEnquiryModal" tabindex="-1" aria-labelledby="addEnquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEnquiryModalLabel">Add Enquiry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="enquiryForm" action="{{ route('enquiry.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-control" id="category" name="category">
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger category-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="subcategory" class="form-label">Subcategory</label>
                            <select class="form-control" id="subcategory" name="subcategory_id">
                                <option value="" disabled selected>Select Subcategory</option>
                            </select>
                            <div class="text-danger subcategory_id-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="move_from_origin" class="form-label">Location</label>
                            <input type="text" id="move_from_origin" name="move_from_origin" class="form-control"
                                placeholder="Enter your location">
                            <div class="text-danger move_from_origin-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="date_time" class="form-label">Date and Time</label>
                            <input type="datetime-local" id="date_time" name="date_time" class="form-control">
                            <div class="text-danger date_time-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter your name">
                            <div class="text-danger name-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter your email address">
                            <div class="text-danger email-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="mobile_number" class="form-label">Mobile Number</label>
                            <input type="text" id="mobile_number" name="mobile_number" class="form-control"
                                placeholder="Enter your mobile number">
                            <div class="text-danger mobile_number-error"></div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editEnquiryModal" tabindex="-1" aria-labelledby="editEnquiryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Subcategory</h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('enquiry.update', $enquiry->id ?? '') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-control" id="category" name="category">
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger category-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="subcategory" class="form-label">Subcategory</label>
                            <select class="form-control" id="subcategory" name="subcategory_id">
                                <option value="" disabled selected>Select Subcategory</option>
                            </select>
                            <div class="text-danger subcategory_id-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="move_from_origin" class="form-label">Location</label>
                            <input type="text" id="move_from_origin" name="move_from_origin" class="form-control"
                                placeholder="Enter your location"
                                value="{{ old('move_from_origin', $enquiry->move_from_origin ?? '') }}">
                            <div class="text-danger move_from_origin-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="date_time" class="form-label">Date and Time</label>
                            <input type="datetime-local" id="date_time" name="date_time"
                                value="{{ old('date_time', $enquiry->date_time) }}" class="form-control">
                            <div class="text-danger date_time-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter your name" value="{{ old('name', $enquiry->name) }}">
                            <div class="text-danger name-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter your email address" value="{{ old('email', $enquiry->email) }}">
                            <div class="text-danger email-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="mobile_number" class="form-label">Mobile Number</label>
                            <input type="text" id="mobile_number" name="mobile_number" class="form-control"
                                placeholder="Enter your mobile number"
                                value="{{ old('mobile_number', $enquiry->mobile_number) }}">
                            <div class="text-danger mobile_number-error"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#category').on('change', function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: '/fetch-subcategory/' + categoryId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status === 1) {
                                var subcategory = response.data;
                                $('#subcategory').empty().append(
                                    '<option value="" selected disabled>Select Subcategory</option>'
                                );
                                $.each(subcategory, function(key, subcateg) {
                                    $('#subcategory').append('<option value="' +
                                        subcateg.id + '">' + subcateg.name +
                                        '</option>');
                                });
                            }
                        }
                    });
                } else {
                    $('#subcategory').empty().append('<option value="">Select Subcategory</option>');
                }
            });
            $('#addEnquiryModal').on('hidden.bs.modal', function() {
                $('#enquiryForm')[0].reset();
                $('#subcategory').empty().append('<option value="">Select Subcategory</option>');
            });

            // for store the data
            $('#enquiryForm').off('submit').on('submit', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                var url = $(this).attr('action');

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    success: function(response) {

                        var message = response.message === 'Submitted Successfully';
                        $('#addEnquiryModal').modal(message ? 'hide' : 'show');
                        $("#addEnquiryModal .success-msg").toggle(message).delay(3000).hide(0);
                        setTimeout(function() {
                            window.location.reload();
                        }, message ? 3000 : 0);
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        $('.text-danger').text('');

                        $.each(errors, function(key, value) {
                            var errorElement = $('.' + key + '-error');
                            errorElement.text(value[0]);

                        });
                    }
                });
            });
        });
    </script>
@endsection

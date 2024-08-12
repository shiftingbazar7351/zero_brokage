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
                                                    <button class="btn delete-table me-2"
                                                        onclick="editEnquiry({{ $enquiry->id }})" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#edit-enquiry">
                                                        <i class="fe fe-edit"></i>
                                                    </button>
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
    @include('backend.enquiry.create')

    @include('backend.enquiry.edit')

@endsection

@section('scripts')
    <script>
        function editCategory(id) {
            $.ajax({
                url: `/enquiry/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    const {
                        id,
                        name,

                    } = response.category;

                    // Set form action and category details
                    $('#editCategoryId').val(id);
                    $('#name').val(name);
                    $('#editCategoryForm').attr('action', `/enquiry/${id}`);

                    // Show the modal
                    $('#edit-category').modal('show');
                }
            });
        }

        $(document).ready(function() {
            $('#category').off('change').on('change', function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: '/fetch-subcategory/' + categoryId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#subcategory').empty().append(
                                '<option value="" selected disabled>Select Subcategory</option>'
                            );

                            if (response.status === 1 && response.data.length > 0) {
                                var subcategory = response.data;
                                $.each(subcategory, function(key, subcateg) {
                                    $('#subcategory').append('<option value="' +
                                        subcateg.id + '">' + subcateg.name +
                                        '</option>');
                                });
                            }
                        },
                        error: function() {
                            // Handle the error scenario
                            $('#subcategory').empty().append(
                                '<option value="" disabled>Error loading subcategories</option>'
                            );
                        }
                    });
                } else {
                    $('#subcategory').empty().append(
                        '<option value="" selected disabled>Select Subcategory</option>');
                }
            });

            $('#addEnquiryModal').on('hidden.bs.modal', function() {
                $('#enquiryForm')[0].reset();
                $('#subcategory').empty().append(
                    '<option value="" selected disabled>Select Subcategory</option>');
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

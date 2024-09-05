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
                                + Add Enquiry
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row text-center">
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
                                        <td colspan="7" class="text-center">No data found</td>
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
                                                <div class="d-flex" style="justify-content: center">

                                                    <button class="btn delete-table me-2"
                                                    onclick="showData({{ $enquiry->id }})"
                                                    type="button" data-bs-toggle="modal"
                                                    data-bs-target="#showdata-preview">
                                                    <i class="fe fe-eye"></i>
                                                    </button>
                                                    


                                                    <button class="btn delete-table me-2"
                                                        onclick="editEnquiry({{ $enquiry->id }}, '{{ $enquiry->name }}', '{{ $enquiry->email }}', '{{ $enquiry->mobile_number }}', '{{ $enquiry->move_from_origin }}', '{{ $enquiry->date_time }}')"
                                                        type="button" data-bs-toggle="modal"
                                                        data-bs-target="#edit-enquiry">
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

    {{-- @include('backend.enquiry.show') --}}

    <!-- Modal Structure -->
    <div class="modal fade" id="showdata-preview" tabindex="-1" aria-labelledby="editEnquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEnquiryModalLabel">Edit Enquiry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="showdata-preview-form">
                        <div class="mb-3">
                            <label for="enquiry-name" class="form-label">Enquiry Name</label>
                            <input type="text" class="form-control" id="enquiry-name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="enquiry-description" class="form-label">Enquiry Description</label>
                            <textarea class="form-control" id="enquiry-description" name="description"></textarea>
                        </div>
                        <!-- Add other fields as needed -->
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

            function showData(enquiryId) {
                // Example: Fetch data via AJAX or pass it from a dataset
                $.ajax({
                    url: '/enquiries/' + enquiryId + '/edit',
                    method: 'GET',
                    success: function(data) {
                        // Populate modal fields with data (for example, name and description)
                        $('#enquiry-name').val(data.name);
                        $('#enquiry-description').val(data.description);
                        // Open the modal if it's not handled by data-bs-toggle
                        $('#showdata-preview').modal('show');
                    },
                    error: function(error) {
                        console.log('Error fetching enquiry data:', error);
                    }
                });
            }


            // $(document).ready(function() {
            // Function to fetch subcategories
            function fetchSubcategories(categoryId, subcategoryElement) {
                if (categoryId) {
                    $.ajax({
                        url: '/fetch-subcategory/' + categoryId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            subcategoryElement.empty().append(
                                '<option value="" selected disabled>Select Subcategory</option>'
                            );

                            if (response.status === 1 && response.data.length > 0) {
                                $.each(response.data, function(key, subcateg) {
                                    subcategoryElement.append('<option value="' +
                                        subcateg.id + '">' + subcateg.name +
                                        '</option>');
                                });
                            } else {
                                subcategoryElement.append(
                                    '<option value="" disabled>No subcategories available</option>'
                                );
                            }
                        },
                        error: function() {
                            subcategoryElement.empty().append(
                                '<option value="" disabled>Error loading subcategories</option>'
                            );
                        }
                    });
                } else {
                    subcategoryElement.empty().append(
                        '<option value="" selected disabled>Select Subcategory</option>');
                }
            }

            // Trigger fetch when editing enquiry
            $('#editCategory').off('change').on('change', function() {
                var categoryId = $(this).val();
                var subcategoryElement = $('#editSubcategory');
                fetchSubcategories(categoryId, subcategoryElement);
            });

            // Trigger fetch for another category element
            $('#category').off('change').on('change', function() {
                var categoryId = $(this).val();
                var subcategoryElement = $('#subcategory');
                fetchSubcategories(categoryId, subcategoryElement);
            });

            function fetchMenus(subcategoryId, menuElement) {
                if (subcategoryId) {
                    $.ajax({
                        url: '/getMenus/' + subcategoryId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            menuElement.empty().append(
                                '<option value="" selected disabled>Select Menu</option>'
                            );

                            if (response.status === 1 && response.data.length > 0) {
                                $.each(response.data, function(key, menu) {
                                    menuElement.append('<option value="' + menu.id +
                                        '">' + menu.name + '</option>');
                                });
                            } else {
                                menuElement.append(
                                    '<option value="" disabled>No menus available</option>'
                                );
                            }
                        },
                        error: function(xhr) {
                            console.error('Error loading menus:', xhr);
                            menuElement.empty().append(
                                '<option value="" disabled>Error loading menus</option>'
                            );
                        }
                    });
                } else {
                    menuElement.empty().append(
                        '<option value="" selected disabled>Select Menu</option>');
                }
            }

            // Event listener for editSubcategory
            $('#editSubcategory').on('change', function() {
                var subcategoryId = $(this).val();
                var menuElement = $('#editmenu');
                fetchMenus(subcategoryId, menuElement);
            });

            // Event listener for subcategory
            $('#subcategory').on('change', function() {
                var subcategoryId = $(this).val();
                var menuElement = $('#menu');
                fetchMenus(subcategoryId, menuElement);
            });

            function fetchSubMenus(menuId, submenuElement) {
                if (menuId) {
                    $.ajax({
                        url: '/getsubMenus/' + menuId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            submenuElement.empty().append(
                                '<option value="" selected disabled>Select SubMenu</option>'
                            );

                            if (response.status === 1 && response.data.length > 0) {
                                $.each(response.data, function(key, submenu) {
                                    submenuElement.append('<option value="' +
                                        submenu.id + '">' + submenu.name +
                                        '</option>');
                                });
                            } else {
                                submenuElement.append(
                                    '<option value="" disabled>No submenus available</option>'
                                );
                            }
                        },
                        error: function(xhr) {
                            console.error('Error loading submenus:', xhr);
                            submenuElement.empty().append(
                                '<option value="" disabled>Error loading submenus</option>'
                            );
                        }
                    });
                } else {
                    submenuElement.empty().append(
                        '<option value="" selected disabled>Select SubMenu</option>');
                }
            }

            // Event listener for editmenu
            $('#editmenu').on('change', function() {
                var menuId = $(this).val();
                var submenuElement = $('#editsubmenu');
                fetchSubMenus(menuId, submenuElement);
            });

            // Event listener for menu
            $('#menu').on('change', function() {
                var menuId = $(this).val();
                var submenuElement = $('#submenu');
                fetchSubMenus(menuId, submenuElement);
            });
            // });


            // Handle reset when modal is hidden
            $('#addEnquiryModal').on('hidden.bs.modal', function() {
                $('#enquiryForm')[0].reset();
                $('#subcategory').empty().append(
                    '<option value="" selected disabled>Select Subcategory</option>');
            });

            // Function to handle edit button
            window.editEnquiry = function(enquiryId, enquiryName) {
                const form = document.getElementById('editEnquiryForm');
                form.action = `/enquiry/${enquiryId}`; // Ensure this matches your route
                document.getElementById('editEnquiryId').value = enquiryId;
                document.getElementById('editName').value = enquiryName;
                $('#edit-enquiry').modal('show'); // Show the edit modal
            }

            // Handle form submission for adding enquiry
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

            // Handle form submission for editing enquiry
            $('#editEnquiryForm').off('submit').on('submit', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                var url = $(this).attr('action');

                $.ajax({
                    url: url,
                    method: 'PUT',
                    data: formData,
                    success: function(response) {
                        var message = response.message === 'Updated Successfully';
                        $('#edit-enquiry').modal(message ? 'hide' : 'show');
                        $("#edit-enquiry .success-msg").toggle(message).delay(3000).hide(0);
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

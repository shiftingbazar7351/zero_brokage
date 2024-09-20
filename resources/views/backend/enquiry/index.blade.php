@extends('backend.layouts.main')
@section('content')

    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Enquiry Listing</h5>
                <div class="list-btn d-flex gap-3">
                    <div class="page-headers">
                        <div class="search-bar">
                            <span><i class="fe fe-search"></i></span>
                            <input type="text" id="search" placeholder="Search" class="form-control">
                        </div>
                    </div>
                    @can('enquiry-create')
                    <ul>
                        <li>
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                data-bs-target="#addEnquiryModal">
                                + Add Enquiry
                            </button>
                        </li>
                    </ul>
                    @endcan
                </div>
            </div>
            <div class="row text-center">
                <div class="col-12">
                    <div class="table-responsive table-div">
                        <div id="usersTable">
                            @include('backend.enquiry.partials.enquiry-index')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Enquiry Modal -->
    @include('backend.enquiry.create')
    @include('backend.enquiry.edit')
    <!-- Modal Structure -->
@endsection

@section('scripts')
<script>
    var searchRoute = `{{ route('enquiry.index') }}`;
</script>
<script src="{{ asset('admin/assets/js/search.js') }}"></script>
    <script>
        $(document).ready(function() {

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

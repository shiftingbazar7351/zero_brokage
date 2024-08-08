@extends('backend.layouts.main')

@section('content')
<div class="page-wrapper page-enquiry-form">
    <div class="content">
        <div class="content-page-header content-page-headersplit mb-0">
            <h5>Enquiry Form</h5>
        </div>
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('enquiry.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="category">Subcategory</label>
                        <select class="form-control" id="subcategory" name="subcategory_id">
                            <option value="">Select Subcategory</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="move_from_origin" class="form-label">Move From (Origin)</label>
                        <input type="text" id="move_from_origin" name="move_from_origin" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="move_from_destination" class="form-label">Move From (Destination)</label>
                        <input type="text" id="move_from_destination" name="move_from_destination" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="date_time" class="form-label">Date and Time</label>
                        <input type="datetime-local" id="date_time" name="date_time" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="mobile_number" class="form-label">Mobile Number</label>
                        <input type="text" id="mobile_number" name="mobile_number" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="otp" class="form-label">OTP</label>
                        <input type="text" id="otp" name="otp" class="form-control">
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
            $('#category').on('change', function() {
                var subcategoryId = $(this).val();
                if (subcategoryId) {
                    $.ajax({
                        url: '/fetch-subcategory/' + subcategoryId, // Adjusted URL based on route
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}' // Include CSRF token for security
                        },
                        success: function(response) {
                            if (response.status === 1) {
                                var subcategory = response.data;
                                console.log(subcategory);
                                $('#subcategory').find('option').remove(); // Clear existing options
                                var options =
                                    '<option value="">Select subcategory</option>'; // Default option
                                $.each(subcategory, function(key, subcateg) {
                                    options += "<option value='" + subcateg.id + "'>" + subcateg
                                        .name + "</option>";
                                });
                                $('#subcategory').append(options);
                            }
                        }
                    });
                } else {
                    $('#subcategory').find('option').remove(); // Clear options if no state is selected
                    $('#subcategory').append('<option value="">Select ddd</option>');
                }
            });
        });
</script>
@endsection

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

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

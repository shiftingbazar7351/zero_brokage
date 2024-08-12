<!-- Edit Enquiry Modal -->
<div class="modal fade" id="edit-enquiry" tabindex="-1" aria-labelledby="editEnquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Enquiry</h5>
                <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fe fe-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="editEnquiryForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" id="editEnquiryId" name="enquiry_id">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="editName" name="name" class="form-control"
                            placeholder="Enter your name" value="">
                        <div class="text-danger name-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="editEmail" name="email" class="form-control"
                            placeholder="Enter your email address" value="">
                        <div class="text-danger email-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="mobile_number" class="form-label">Mobile Number</label>
                        <input type="text" id="editMobileNumber" name="mobile_number" class="form-control"
                            placeholder="Enter your mobile number" value="">
                        <div class="text-danger mobile_number-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="editCategory" class="form-label">Category</label>
                        <select class="form-control" id="editCategory" name="category">
                            <option value="" disabled>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="text-danger category-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="editSubcategory" class="form-label">Subcategory</label>
                        <select class="form-control" id="editSubcategory" name="subcategory_id">
                            <option value="" disabled>Select Subcategory</option>
                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">
                                    {{ $subcategory->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="text-danger subcategory_id-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="editMoveFromOrigin" class="form-label">Location</label>
                        <input type="text" id="editMoveFromOrigin" name="move_from_origin" class="form-control"
                            placeholder="Enter your location" value="">
                        <div class="text-danger move_from_origin-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="editDateTime" class="form-label">Date and Time</label>
                        <input type="datetime-local" id="editDateTime" name="date_time" value="" class="form-control">
                        <div class="text-danger date_time-error"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

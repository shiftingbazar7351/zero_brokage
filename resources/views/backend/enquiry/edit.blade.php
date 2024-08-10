<div class="modal fade" id="editEnquiryModal" tabindex="-1" aria-labelledby="editEnquiryModalLabel" aria-hidden="true">
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
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control" id="category" name="category">
                            <option value="" disabled>Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == old('category', $enquiry->subcategory->category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                        </select>
                        <div class="text-danger category-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="subcategory" class="form-label">Subcategory</label>
                        <select class="form-control" id="subcategory" name="subcategory_id">
                            <option value="" disabled selected>Select Subcategory</option>
                            @foreach ($subcategories as $subategory)
                                <option value="{{ $subategory->id }}"
                                    {{ $subategory->id == old('subcategory_id', $enquiry->subcategory_id) ? 'selected' : '' }}>
                                    {{ $subategory->name }}
                                </option>
                            @endforeach
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

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

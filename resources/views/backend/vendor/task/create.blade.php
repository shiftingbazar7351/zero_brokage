@extends('backend.layouts.main')

@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="main-wrapper">
                <div class="container border p-2 shadow-sm mt-2">
                    <h4>Create Task</h4>
                </div>
                <div class="container mt-4 border p-5 rounded shadow">
                    <form action="{{ route('vendor-task.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="category">Category<b style="color: red;">*</b></label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="">Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        <!-- Next Follow-up Date -->
                        <div class="mb-3 col-md-4">
                            <label for="next_followup_date" class="form-label">Next Follow-up Date</label>
                            <input type="date" class="form-control" id="next_followup_date" name="next_followup_date">
                        </div>

                        <!-- Next Follow-up Time -->
                        <div class="mb-3 col-md-4">
                            <label for="next_followup_time" class="form-label">Next Follow-up Time</label>
                            <input type="time" class="form-control" id="next_followup_time" name="next_followup_time">
                        </div>

                        <!-- Next Follow-up AM/PM -->
                        <div class="mb-3 col-md-4">
                            <label for="next_followup_am_pm" class="form-label">Next Follow-up AM/PM <span class="text-danger">*</span></label>
                            <select class="form-select" id="next_followup_am_pm" name="next_followup_am_pm" required>
                                <option value="" selected disabled>Select AM/PM</option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </div>

                        <!-- Tags -->
                        <div class="mb-3 col-md-4">
                            <label for="tags" class="form-label">Tags</label>
                            <input type="text" class="form-control" id="tags" name="tags" placeholder="Enter tags, separated by commas">
                        </div>

                        <!-- Call Record -->
                        <div class="mb-3 col-md-4">
                            <label for="call_record" class="form-label">Call Record</label>
                            <input type="file" class="form-control" id="call_record" name="call_record">
                        </div>

                        <!-- Call History Image -->
                        <div class="mb-3 col-md-4">
                            <label for="call_history_img" class="form-label">Call History Image</label>
                            <input type="file" class="form-control" id="call_history_img" name="call_history_img">
                        </div>

                        <!-- Client Type -->
                        <div class="mb-3 col-md-4">
                            <label for="client_type" class="form-label">Client Type</label>
                            <select class="form-select" id="client_type" name="client_type">
                                <option value="" selected disabled>Select Client Type</option>
                                <option value="new">New</option>
                                <option value="existing">Existing</option>
                            </select>
                        </div>

                        <!-- Task Status -->
                        <div class="mb-3 col-md-4">
                            <label for="task_status" class="form-label">Task Status</label>
                            <select class="form-select" id="task_status" name="task_status">
                                <option value="" selected disabled>Select Task Status</option>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                                <option value="in-progress">In Progress</option>
                            </select>
                        </div>

                        <!-- Comments -->
                        <div class="mb-3 col-md-4">
                            <label for="comments" class="form-label">Comments</label>
                            <textarea class="form-control" id="comments" name="comments" placeholder="Enter your comments" rows="3"></textarea>
                        </div>

                        <!-- Note -->
                        <div class="mb-3 col-md-4">
                            <label for="note" class="form-label">Note</label>
                            <textarea class="form-control" id="note" name="note" placeholder="Enter your note" rows="3"></textarea>
                        </div>

                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

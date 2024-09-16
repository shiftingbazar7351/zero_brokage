{{ Form::open(['route' => ['role.update',$data->id], 'method' => 'PUT', 'data-parsley-validate' => 'true']) }}
    <div class="form-group">
        <label class="form-label">Role Title <span class="text-danger">*</span></label>
        {{ Form::text('title', $data->title ?? old('title'), ['class' => 'form-control', 'id' => 'role-title', 'placeholder' => 'Enter Title', 'required']) }}
    </div>
    <label class="form-label">Status</label>
    <div class="form-check">
        {{ Form::radio('status', '1', $data->status == 1, ['class' => 'form-check-input', 'id' => 'roleassigned']) }}
        <label class="form-check-label" for="roleassigned">Yes</label>
    </div>
    <div class="mb-3 form-check">
        {{ Form::radio('status', '0', $data->status == 0, ['class' => 'form-check-input', 'id' => 'rolenotassigned']) }}
        <label class="form-check-label" for="rolenotassigned">No</label>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
{{ Form::close() }}

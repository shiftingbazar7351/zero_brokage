{{ Form::open(['url' => route('role.store'),'method' => 'POST', 'data-parsley-validate' => 'true']) }}
@csrf
<div class="form-group">
    <label class="form-label">Role title <span class="text-danger">*</span></label>
    {{ Form::text('title', old('title'), ['class' => 'form-control','id' => 'role-title', 'placeholder' => 'Enter Title', 'required']) }}
</div>
<label class="form-label">Status </label>
<div class="form-check">
    {{ Form::radio('status', '1',old('status'), ['class' => 'form-check-input', 'id' => 'roleassigned','checked']) }}
    <label class="form-check-label" for="roleassigned">yes</label>
</div>
<div class="mb-3 form-check">
    {{ Form::radio('status', '0',old('status'), ['class' => 'form-check-input', 'id' => 'rolenotassigned']);}}
    <label class="form-check-label" for="rolenotassigned">no</label>
</div>
<button type="submit" class="btn btn-primary">Save</button>
<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
{{ Form::close() }}


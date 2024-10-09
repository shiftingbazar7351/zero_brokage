{{ Form::open(['url' => route('permission.store'), 'method' => 'POST', 'data-parsley-validate' => 'true']) }}
@csrf
<div class="form-group">
    <label class="form-label">Permission Title<span class="text-danger">*</span></label>
    {{ Form::text('title', old('title'), ['class' => 'form-control', 'id' => 'permission-title', 'placeholder' => 'Enter Title', 'required']) }}
</div>
<button type="submit" class="btn btn-primary">Save</button>
<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
{{ Form::close() }}

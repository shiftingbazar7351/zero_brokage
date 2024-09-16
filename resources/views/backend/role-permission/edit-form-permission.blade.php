{{ Form::open(['route' => ['permission.update', $data->id], 'method' => 'put', 'data-parsley-validate' => 'true']) }}
@csrf
{{ Form::hidden('id', $data->id) }}
<div class="form-group">
    <label class="form-label">Permission Title <span class="text-danger">*</span></label>
    {{ Form::text('title', $data->title ?? old('title'), ['class' => 'form-control', 'id' => 'permission-title', 'placeholder' => 'Enter Title', 'required']) }}
</div>
<button type="submit" class="btn btn-primary">Save</button>
<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
{{ Form::close() }}

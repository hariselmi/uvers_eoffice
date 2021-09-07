@if (!empty($employee))
    <div class="modal-content" id="editEmployee">
        {{ Form::model($employee, ['route' => ['employees.update', $employee->id], 'method' => 'PUT']) }}
    @else
        <div class="modal-content" id="addEmployee">
            {{ Form::open(['url' => 'employees', 'files' => true]) }}
@endif
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">
    @if (!empty($employee)) {{ __('Edit User') }} @else
            {{ __('Tambah User') }}@endif
    </h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                {{ Form::label('name', trans('employee.name') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('email', trans('employee.email') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::text('email', null, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                {{ Form::label('password', trans('employee.password'), ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('password_confirmation', trans('employee.confirm_password'), ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    <input type="password" class="form-control" name="password_confirmation"
                        placeholder="Confirm Password">
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->checkSpPermission('assaign.roles'))
        <div class="form-group row">
            {{ Form::label('role', __('Role *'), ['class' => 'col-sm-2 text-center']) }}
            <div class="col-sm-10 pl-0">
                @foreach ($roles as $role)
                    <span style="margin-right:30px"><input type="radio" name="role[]" value="{{ $role->name }}"
                            {{ !empty($employee) && $employee->hasRole($role->name) ? 'checked' : '' }}>
                        {{ ucwords($role->name) }}</span>
                @endforeach
            </div>
        </div>
    @endif
</div>
<div class="modal-footer">
    {{ Form::submit(__('Simpan'), ['class' => 'btn btn-success']) }}
    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
</div>
{{ Form::close() }}
</div>

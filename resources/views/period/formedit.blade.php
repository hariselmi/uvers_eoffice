<div class="modal-content" id="editPeriod">
    {{ Form::model($period, ['route' => ['period.update', $period->id], 'method' => 'PUT', 'files' => true]) }}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">
        {{ __('Edit Periode') }}
        </h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-10">
                <div class="form-group row">
                    {{ Form::label('title', 'Tahun' . ' *', ['class' => 'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::text('title', null, ['class' => 'form-control', 'required']) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('semester', 'Semester' . ' *', ['class' => 'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::select('semester', array('Gasal' => 'Gasal', 'Genap' => 'Genap'), null, ['id' => 'edit_semester','class' => 'form-control', 'required']) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('status', 'Semester' . ' *', ['class' => 'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::select('status', array('0' => 'Non Active', '1' => 'Active'), null, ['id' => 'edit_status','class' => 'form-control', 'required']) }}
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal-footer">
        @if (!empty($page))
        <input type="hidden" name="page" value="{{ $page }}" />
        @endif
        {{ Form::submit(trans('period.submit'), ['class' => 'btn btn-success']) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
    </div>
    {{ Form::close() }}
</div>
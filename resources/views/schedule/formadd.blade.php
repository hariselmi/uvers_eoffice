<div class="modal-content" id="addSchedule">
    {{ Form::open(['url' => 'schedules', 'files' => true]) }}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">
        {{ __('Tambah Jadwal') }}
    </h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-10">
            <div class="form-group row">
                {{ Form::label('auditor_id', trans('schedule.auditor') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('auditor_id', $auditor, null, ['placeholder' => 'Pilih Auditor', 'class' => 'form-control', 'onchange' => 'getMembers(this);getClockStart()', 'required']) !!}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('auditee_id', trans('schedule.auditee') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('auditee_id', $auditee, null, ['placeholder' => 'Pilih Auditee', 'class' => 'form-control', 'required', 'onchange' => 'getClockStart()']) !!}
                </div>
            </div>
            <div class="form-group row">
                    {{ Form::label('division_id', trans('schedule.division')  . ' *', ['class' => 'col-sm-3 text-right']) }}
                    <div class="col-sm-9">

                        {!! Form::select('division_id', $parents, null, ['placeholder' => 'Pilih Unit', 'class' => 'form-control', '']) !!}
                    </div>
                </div>
            <div class="form-group row">
                {{ Form::label('standard_id', trans('schedule.standard') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('standard_id', $standards, null, ['placeholder' => 'Pilih Standar', 'onchange' => 'getStandardDetails(this)', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('standard_detail_id', trans('schedule.standard_detail') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('standard_detail_id', [], null, ['placeholder' => 'Pilih Standar Detail', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>
            
            <div class="form-group row clockpicker" data-placement="top" data-align="right" data-autoclose="true">
                {{ Form::label('period_id', trans('schedule.period') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('period_id', $periods, null, ['placeholder' => 'Pilih Periode', 'class' => 'form-control', 'required']) !!}



                </div>
            </div>


            <div class="form-group row">
                {{ Form::label('schedule_date', trans('schedule.date') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::date('schedule_date', date('Y-m-d'), ['class' => 'form-control', 'onchange' => 'getClockStart()', 'required']) }}
                </div>
            </div>
            <div class="form-group row clockpicker" data-placement="top" data-align="right" data-autoclose="true">
                {{ Form::label('clock_start_id', trans('schedule.time_start') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('clock_start_id', $clocks, null, ['placeholder' => 'Pilih Jam Mulai', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group row clockpicker" data-placement="top" data-align="right" data-autoclose="true">
                {{ Form::label('clock_finish_id', trans('schedule.time_finish') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('clock_finish_id', $clocks, null, ['placeholder' => 'Pilih Jam Selesai', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>


            <div class="form-group row">
                {{ Form::label('member_one', __('Anggota 1') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    @if (Auth::user()->role == 'auditor')
                            {!! Form::select('member_one', $auditorMembers, null, ['placeholder' => 'Pilih Anggota 1', 'class' => 'form-control', 'required']) !!}
                    @else
                            {!! Form::select('member_one', ['1' => 'Anggota 1'], null, ['placeholder' => 'Pilih Anggota 1', 'class' => 'form-control', 'required']) !!}
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('member_two', __('Anggota 2') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    @if (Auth::user()->role == 'auditor')
                            {!! Form::select('member_two', $auditorMembers, null, ['placeholder' => 'Pilih Anggota 2', 'class' => 'form-control', 'required']) !!}
                    @else
                            {!! Form::select('member_two', ['1' => 'Anggota 1'], null, ['placeholder' => 'Pilih Anggota 2', 'class' => 'form-control', 'required']) !!}
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('status', trans('schedule.status') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('status', ['1' => 'Pending', '2' => 'Process', '3' => 'Complete', '4' => 'Cancel'], null, ['class' => 'form-control', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    @if (!empty($page))
        <input type="hidden" name="page" value="{{ $page }}" />
    @endif
    {{ Form::submit(trans('schedule.submit'), ['class' => 'btn btn-success']) }}
    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
</div>
{{ Form::close() }}
</div>

<script type="text/javascript" src="{{ asset('js/schedule.js') }}"></script>
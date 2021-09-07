<script type="text/javascript">
$(function() {

  $('.date').datepicker({  
    dateFormat: 'dd-mm-yy',
    autoclose: true,
    orientation: "top auto",
  });  

    $('.clockpicker').clockpicker()
    .find('input').change(function(){
    });

       //getClockStartEdit();

});
</script>

<div class="modal-content" id="editSchedule">
    @if (!empty($schedule))
        {{ Form::model($schedule, ['route' => ['schedules.update', $schedule->id], 'method' => 'PUT', 'files' => true]) }}
    @endif
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">
            {{ __('Edit Jadwal') }}
        </h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-10">
                <div class="form-group row">
                    <?php
                    $check_disable = (session('role') == 'auditor') ? 'disabled' : '';

                    ?>
                    {{ Form::label('auditor_id', trans('schedule.auditor') . ' *', ['class' => 'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                            {!! Form::select('auditor_id', $auditor, null, ['id' => 'edit_auditor_id', 'placeholder' => 'Pilih Auditor', 'class' => 'form-control', 'onchange' => 'getMembersEdit(this);', 'required',$check_disable]) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('auditee_id', trans('schedule.auditee') . ' *', ['class' => 'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {!! Form::select('auditee_id', $auditee, null, ['id' => 'edit_auditee_id', 'placeholder' => 'Pilih Auditee', 'class' => 'form-control',  'required',$check_disable]) !!}
                    </div>
                </div>
                            <div class="form-group row">
                {{ Form::label('division_id', trans('schedule.division') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">

                     {!! Form::select('division_id', $parents, null, ['placeholder' => 'Pilih Divisi', 'class' => 'form-control', $check_disable]) !!}

                     {!! Form::hidden('id',  null, ['id' => 'edit_id','placeholder' => '', 'class' => 'form-control', '']) !!}


                </div>
            </div>
                <div class="form-group row">
                    {{ Form::label('standard_id', trans('schedule.standard') . ' *', ['class' => 'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {!! Form::select('standard_id', $standards, null, ['id' => 'edit_standard_id', 'placeholder' => 'Pilih Standar', 'onchange' => 'getStandardDetailsEdit(this)', 'class' => 'form-control', 'required',$check_disable]) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('standard_detail_id', trans('schedule.standard_detail') . ' *', ['class' => 'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        @if (!empty($standard_details))
                            {!! Form::select('standard_detail_id', $standard_details, null, ['id' => 'edit_standard_detail_id', 'placeholder' => 'Pilih Standar Detail', 'class' => 'form-control', 'required',$check_disable]) !!}
                        @endif
                    </div>
                </div>


                <div class="form-group row clockpicker" data-placement="top" data-align="right" data-autoclose="true">
                {{ Form::label('period_id', trans('schedule.period') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">

                    {!! Form::select('period_id', $periods, null, ['id' => 'edit_period_id', 'placeholder' => 'Pilih Periode', 'class' => 'form-control', 'required',$check_disable]) !!}
            
                </div>
            </div>

                <div class="form-group row">
                    {{ Form::label('schedule_date', trans('schedule.date') . ' *', ['class' => 'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::date('schedule_date', null, ['id' => 'edit_schedule_date', 'class' => 'form-control', 'required',$check_disable]) }}
                    </div>
                </div>


                 <div class="form-group row clockpicker" data-placement="top" data-align="right" data-autoclose="true">
                {{ Form::label('clock_start_id', trans('schedule.time_start') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('clock_start_id', $clocks, null, ['id' => 'edit_clock_start_id', 'placeholder' => 'Pilih Jam Mulai', 'class' => 'form-control', 'onclick' => 'getClockStartEdit()', 'required',$check_disable]) !!}
                </div>
            </div>

            <div class="form-group row clockpicker" data-placement="top" data-align="right" data-autoclose="true">
                {{ Form::label('clock_finish_id', trans('schedule.time_finish') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('clock_finish_id', $clocks, null, ['id' => 'edit_clock_finish_id', 'placeholder' => 'Pilih Jam Selesai', 'class' => 'form-control', 'required',$check_disable]) !!}
                </div>
            </div>


                <div class="form-group row">
                    {{ Form::label('member_one', __('Anggota 1') . ' *', ['class' => 'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        @if (Auth::user()->role == 'auditor')
                            {!! Form::select('member_one', $auditorMembers, null, ['id' => 'edit_member_one', 'placeholder' => 'Pilih Anggota 1', 'class' => 'form-control', 'required',$check_disable]) !!}
                        @else
                            @if (!empty($members))
                                {!! Form::select('member_one', $members, null, ['id' => 'edit_member_one', 'placeholder' => 'Pilih Anggota 1', 'class' => 'form-control', 'required',$check_disable]) !!}
                            @endif
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('member_two', __('Anggota 2') . ' *', ['class' => 'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        @if (Auth::user()->role == 'auditor')
                            {!! Form::select('member_two', $auditorMembers, null, ['id' => 'edit_member_two', 'placeholder' => 'Pilih Anggota 2', 'class' => 'form-control', 'required',$check_disable]) !!}
                        @else
                            @if (!empty($members))
                                {!! Form::select('member_two', $members, null, ['id' => 'edit_member_two', 'placeholder' => 'Pilih Anggota 2', 'class' => 'form-control', 'required',$check_disable]) !!}
                            @endif
                        @endif
                    </div>
                </div>
                
                <div class="form-group row">
                    {{ Form::label('status', trans('schedule.status') . ' *', ['class' => 'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {!! Form::select('status', ['1' => 'Pending', '2' => 'Process', '3' => 'Complete', '4' => 'Cancel'], null, ['id' => 'edit_status', 'class' => 'form-control', 'required']) !!}
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



@if (!empty($report))
    <div class="modal-content" id="editReport">
        {{ Form::model($report, ['route' => ['reports.update', $report->id], 'method' => 'PUT', 'files' => true]) }}
    @else
        <div class="modal-content" id="addReport">
            {{ Form::open(['url' => 'reports', 'files' => true]) }}
@endif
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">
    @if (!empty($report)) {{ __('Edit Report') }} @else {{ __('Add Report') }}
        @endif
    </h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-10 container">
            {{-- <div class="form-group row">
                    {{ Form::label('auditor_id', trans('schedule.auditor') .' *',['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9"> 
                            {!! Form::select('auditor_id', $auditor, null, array('placeholder' => 'Pilih Ketua Auditor', 'class' => 'form-control', 'onchange'=>'getMembers(this)', 'required')); !!}
                    </div>
                </div> --}}
            <div class="form-group row">
                {{ Form::label('auditee_id', trans('schedule.auditee') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('auditee_id', ['2019' => '2019', '2020' => '2020', '2021' => '2021'], null, ['placeholder' => 'Pilih Auditee', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('schedule_id', trans('schedule.schedule') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('schedule_id', ['2019' => '2019', '2020' => '2020', '2021' => '2021'], null, ['placeholder' => 'Pilih Tanggal Audit', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>


        </div>

        <div style="width: 90%; margin:auto">
            <table class="table table-bordered table-hover" id="tab_logic">
                <thead>
                    <tr>
                        <th class="text-center">
                            #
                        </th>
                        <th class="text-center">
                            Report
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr id='addr0'>
                        <td>
                            1
                        </td>
                        <td>
                            <input type="text" name='report[]' placeholder='Report' class="form-control" required />
                        </td>
                    </tr>
                    <tr id='addr1'></tr>
                </tbody>
            </table>
            <a id="add_row" class="btn btn-default pull-left">Add Row</a><a id='delete_row'
                class="pull-right btn btn-default">Delete Row</a>
        </div>
    </div>

</div>
<div class="modal-footer">
    @if (!empty($page))
        <input type="hidden" name="page" value="{{ $page }}" />
    @endif
    {{ Form::submit(trans('report.submit'), ['class' => 'btn btn-success']) }}
    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
</div>
{{ Form::close() }}
</div>

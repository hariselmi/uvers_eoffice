<div class="" id="reportTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ trans('report.period') }}</th>
                <th>{{ trans('report.date') }}</th>
                <th>{{ trans('report.time') }}</th>
                <th>{{ trans('report.auditor') }}</th>
                <th>{{ trans('report.auditee') }}</th>
                <th>{{ trans('schedule.division') }}</th>
                <th>{{ trans('schedule.status') }}</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $value)
                <tr>
                    <td>{{ Get_field::get_data($value->period_id,'periods','title') }} {{ Get_field::get_data($value->period_id,'periods','semester') }}</td>
                    <td>{{ Get_field::format_indo($value->schedule_date) }}</td>
                   <td>{!!Get_field::get_data($value->clock_start_id, 'clock', 'nama')!!} - {!!Get_field::get_data($value->clock_finish_id, 'clock', 'nama')!!}</td>
                    <td>{{ $value->auditor_name }}</td>
                    <td>{{ $value->auditee_name }}</td>
                    <td>{{ Get_field::get_data($value->division_id, 'divisions', 'title') }}</td>
                    <td>
                        @switch($value->status)
                            @case(1)
                                Pending
                                @break
                            @case(2)
                                Process
                                @break
                            @case(3)
                                Complete
                                @break
                            @case(4)
                                Cancel
                                @break
                            @default
                                
                        @endswitch</td>
                    <td class="item_btn_group">
                        @php
                            $actions = [['url' => 'reports/' . $value->id . '/print', 'name' => ' Cetak', 'target' => '_blank', 'icon' => 'print']];
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$reports, 'index_route'=>route('reports.index')])
</div>

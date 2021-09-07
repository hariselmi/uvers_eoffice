<div class="" id="scheduleTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                {{-- <th width="50" class="hidden-xs">{{trans('schedule.customer_id')}}</th> --}}
                <th>{{ trans('schedule.auditor') }}</th>
                <th>{{ trans('schedule.auditee') }}</th>
                <th>{{ trans('schedule.division') }}</th>
                <th>{{ trans('schedule.period') }}</th>
                <th>{{ trans('schedule.date') }}</th>
                <th>{{ trans('schedule.time') }}</th>
                <th>{{ trans('schedule.status') }}</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $value)
                <tr>
                    {{-- <td class="hidden-xs">{{ $value->id }}</td> --}}
                    <td>{{ $value->auditor_name }}</td>
                    <td>{{ $value->auditee_name }}</td>
                    <td>{{ Get_field::get_data($value->division_id, 'divisions', 'title') }}</td>
                    <td>{{ Get_field::get_data($value->period_id, 'periods', 'title') }} {{ Get_field::get_data($value->period_id, 'periods', 'semester') }}</td>
                    <td>{{ Get_field::format_indo($value->schedule_date) }}</td>
                    <td>{!!Get_field::get_data($value->clock_start_id, 'clock', 'nama')!!} - {!!Get_field::get_data($value->clock_finish_id, 'clock', 'nama')!!}</td>
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

                                $actions = [];
                                    if (auth()->user()->checkSpPermission('schedules.show')) {
                                        # code...
                                        $view = ['data-replace' => '#showSchedule', 'url' => '#showScheduleModal', 'ajax-url' => url('schedules/' . $value->schedule_id . '/'), 'name' => ' Lihat', 'icon' => 'eye'];
                                        array_push($actions, $view);
                                    }

                                    if(Auth::user()->role == 'admin' or session('role') == 'auditor' ){

                                    if (auth()->user()->checkSpPermission('schedules.edit')) {
                                        # code...
                                        $edit = ['data-replace' => '#editSchedule', 'url' => '#editScheduleModal', 'ajax-url' => url('schedules/' . $value->schedule_id . '/edit'), 'name' => ' Sunting', 'icon' => 'pencil'];
                                        array_push($actions, $edit);
                                    }
                                    if (auth()->user()->checkSpPermission('schedules.destroy')) {
                                        # code...
                                        $delete = ['url' => 'schedules/' . $value->schedule_id, 'name' => 'delete'];
                                        array_push($actions, $delete);
                                    }
                                }


                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$schedules, 'index_route'=>route('schedules.index')])
</div>

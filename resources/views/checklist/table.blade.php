<div class="" id="checklistTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ trans('checklist.period') }}</th>
                <th>{{ trans('checklist.date') }}</th>
                <th>{{ trans('checklist.time') }}</th>
                <th>{{ trans('checklist.auditor') }}</th>
                <th>{{ trans('checklist.auditee') }}</th>
                <th>{{ trans('schedule.division') }}</th>
                <th>{{ trans('schedule.status') }}</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($checklists as $value)
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
                            $actions = [];
                            if (Auth::user()->role == 'admin') {
                                # code...
                                array_push($actions, ['data-replace' => '#showChecklist', 'url' => '#showChecklistModal', 'ajax-url' => url('checklists/' . $value->id . '/'), 'name' => ' Lihat', 'icon' => 'eye'], 
                                ['data-replace' => '#editChecklist', 'url' => '#editChecklistModal', 'ajax-url' => url('checklists/' . $value->id . '/edit'), 'name' => ' Sunting', 'icon' => 'pencil'], 
                                ['url' => 'checklists/' . $value->id . '/print', 'name' => ' Cetak', 'target' => '_blank', 'icon' => 'print']);
                            }else{

                                    if (auth()->user()->checkSpPermission('checklists.show')) {
                                        # code...
                                        $view = ['data-replace' => '#showChecklist', 'url' => '#showChecklistModal', 'ajax-url' => url('checklists/' . $value->id . '/'), 'name' => ' Lihat', 'icon' => 'eye'];
                                        array_push($actions, $view);
                                    }
                                    if (auth()->user()->checkSpPermission('checklists.edit') && session('role') == 'auditor') {
                                        # code...
                                            $edit = ['data-replace' => '#editChecklist', 'url' => '#editChecklistModal', 'ajax-url' => url('checklists/' . $value->id . '/edit'), 'name' => ' Sunting', 'icon' => 'pencil'];
                                            array_push($actions, $edit);
                                    }
                                    if (auth()->user()->checkSpPermission('checklists.print') && session('role') == 'auditor') {
                                        # code...
                                            $delete = ['url' => 'checklists/' . $value->id . '/print', 'name' => ' Cetak', 'target' => '_blank', 'icon' => 'print'];
                                    }

                                // if (session('role') == 'auditor') {
                                //     # code...
                                //     array_push($actions, ['data-replace' => '#showChecklist', 'url' => '#showChecklistModal', 'ajax-url' => url('checklists/' . $value->id . '/'), 'name' => ' Lihat', 'icon' => 'eye'], 
                                //     ['data-replace' => '#editChecklist', 'url' => '#editChecklistModal', 'ajax-url' => url('checklists/' . $value->id . '/edit'), 'name' => ' Sunting', 'icon' => 'pencil'], 
                                //     ['url' => 'checklists/' . $value->id . '/print', 'name' => ' Cetak', 'target' => '_blank', 'icon' => 'print']);
                                // } else if(session('role') == 'auditee') {
                                //     # code...
                                //     array_push($actions, ['data-replace' => '#showChecklist', 'url' => '#showChecklistModal', 'ajax-url' => url('checklists/' . $value->id . '/'), 'name' => ' Lihat', 'icon' => 'eye']);
                                // }
                            }
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$checklists, 'index_route'=>route('checklists.index')])
</div>

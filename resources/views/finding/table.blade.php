<div class="" id="findingTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ trans('finding.period') }}</th>
                <th>{{ trans('finding.date') }}</th>
                <th>{{ trans('finding.time') }}</th>
                <th>{{ trans('finding.auditor') }}</th>
                <th>{{ trans('finding.auditee') }}</th>
                <th>{{ trans('schedule.division') }}</th>
                <th>{{ trans('schedule.status') }}</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($findings as $value)
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
                                array_push($actions, ['data-replace' => '#showFinding', 'url' => '#showFindingModal', 'ajax-url' => url('findings/' . $value->id . '/'), 'name' => ' Lihat', 'icon' => 'eye'], 
                                ['data-replace' => '#editFinding', 'url' => '#editFindingModal', 'ajax-url' => url('findings/' . $value->id . '/edit'), 'name' => ' Sunting', 'icon' => 'pencil'], 
                                ['url' => 'findings/' . $value->id . '/print', 'name' => ' Cetak', 'target' => '_blank', 'icon' => 'print']);
                            }else{


                                if (auth()->user()->checkSpPermission('findings.show')) {
                                        # code...
                                        $view = ['data-replace' => '#showFinding', 'url' => '#showFindingModal', 'ajax-url' => url('findings/' . $value->id . '/'), 'name' => ' Lihat', 'icon' => 'eye'];
                                        array_push($actions, $view);
                                    }
                                    if (auth()->user()->checkSpPermission('findings.edit') && session('role') == 'auditor') {
                                        # code...
                                            $edit = ['data-replace' => '#editFinding', 'url' => '#editFindingModal', 'ajax-url' => url('findings/' . $value->id . '/edit'), 'name' => ' Sunting', 'icon' => 'pencil'];
                                            array_push($actions, $edit);
                                    }
                                    if (auth()->user()->checkSpPermission('findings.print') && session('role') == 'auditor') {
                                        # code...
                                            $delete = ['url' => 'findings/' . $value->id . '/print', 'name' => ' Cetak', 'target' => '_blank', 'icon' => 'print'];
                                            array_push($actions, $delete);
                                    }


                                // if (session('role') == 'auditor') {
                                //     # code...
                                //     array_push($actions, ['data-replace' => '#showFinding', 'url' => '#showFindingModal', 'ajax-url' => url('findings/' . $value->id . '/'), 'name' => ' Lihat', 'icon' => 'eye'], 
                                //     ['data-replace' => '#editFinding', 'url' => '#editFindingModal', 'ajax-url' => url('findings/' . $value->id . '/edit'), 'name' => ' Sunting', 'icon' => 'pencil'], 
                                //     ['url' => 'findings/' . $value->id . '/print', 'name' => ' Cetak', 'target' => '_blank', 'icon' => 'print']);
                                // } else if(session('role') == 'auditee') {
                                //     # code...
                                //     array_push($actions, ['data-replace' => '#showFinding', 'url' => '#showFindingModal', 'ajax-url' => url('findings/' . $value->id . '/'), 'name' => ' Lihat', 'icon' => 'eye']);
                                // }
                            }
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$findings, 'index_route'=>route('findings.index')])
</div>

<div class="" id="documentTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ trans('document.period') }}</th>
                <th>{{ trans('document.date') }}</th>
                <th>{{ trans('document.time') }}</th>
                <th>{{ trans('document.auditor') }}</th>
                <th>{{ trans('document.auditee') }}</th>
                <th>{{ trans('schedule.division') }}</th>
                <th>{{ trans('schedule.status') }}</th>
                @if (auth()->user()->checkSpPermission('documents.show') || auth()->user()->checkSpPermission('documents.edit') || auth()->user()->checkSpPermission('documents.destroy'))
                    <th class="text-center">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $value)
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
                    @if (auth()->user()->checkSpPermission('documents.show') || auth()->user()->checkSpPermission('documents.edit') || auth()->user()->checkSpPermission('documents.destroy'))
                        <td class="item_btn_group">
                                @php
                                    // $actions = [
                                    //     ['data-replace' => '#showDocument', 'url' => '#showDocumentModal', 'ajax-url' => url('documents/' . $value->id . '/'), 'name' => ' Lihat', 'icon' => 'eye'], 
                                    //     ['data-replace' => '#editDocument', 'url' => '#editDocumentModal', 'ajax-url' => url('documents/' . $value->id . '/edit'), 'name' => ' Edit', 'icon' => 'pencil'], 
                                    //     ['url' => 'documents/' . $value->id . '/print', 'name' => ' Cetak', 'target' => '_blank', 'icon' => 'print']];\


                                $actions = [];
                                    if (auth()->user()->checkSpPermission('documents.show')) {
                                        # code...
                                        $view = ['data-replace' => '#showDocument', 'url' => '#showDocumentModal', 'ajax-url' => url('documents/' . $value->id . '/'), 'name' => ' Lihat', 'icon' => 'eye'];
                                        array_push($actions, $view);
                                    }
                                    if (auth()->user()->checkSpPermission('documents.edit')  && session('role') == 'auditor') {
                                        # code...
                                        $edit = ['data-replace' => '#editDocument', 'url' => '#editDocumentModal', 'ajax-url' => url('documents/' . $value->id . '/edit'), 'name' => ' Edit', 'icon' => 'pencil'];
                                        array_push($actions, $edit);
                                    }
                                    if (auth()->user()->checkSpPermission('documents.print')  && session('role') == 'auditor') {
                                        # code...
                                        $delete = ['url' => 'documents/' . $value->id . '/print', 'name' => ' Cetak', 'target' => '_blank', 'icon' => 'print'];
                                        array_push($actions, $delete);
                                    }
                                @endphp
                                @include('partials.actions', ['actions'=>$actions])
                            </td>
                        </tr>
                    @endif
                @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$documents, 'index_route'=>route('documents.index')])
</div>

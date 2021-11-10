<div class="" id="uploaddocumentTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ trans('uploaddocument.period') }}</th>
                <th>{{ trans('uploaddocument.date') }}</th>
                <th>{{ trans('uploaddocument.time') }}</th>
                <th>{{ trans('uploaddocument.auditor') }}</th>
                <th>{{ trans('uploaddocument.auditee') }}</th>
                <th>{{ trans('schedule.status') }}</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($uploaddocuments as $value)

                <tr>
                    <td>{{ Get_field::get_data($value->period_id,'periods','title') }} {{ Get_field::get_data($value->period_id,'periods','semester') }}</td>
                    <td>{{ Get_field::format_indo($value->schedule_date) }}</td>
                   <td>{!!Get_field::get_data($value->clock_start_id, 'clock', 'nama')!!} - {!!Get_field::get_data($value->clock_finish_id, 'clock', 'nama')!!}</td>
                    <td>{{ $value->auditor_name }}</td>
                    <td>{{ $value->auditee_name }}</td>
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
                            // $actions = [
                            //     ['data-replace' => '#showUploadDocument', 'url' => '#showUploadDocumentModal', 'ajax-url' => url('uploaddocuments/' . $value->id . '/'), 'name' => ' Lihat', 'icon' => 'eye'], 
                            //     ['data-replace' => '#editUploadDocument', 'url' => '#editUploadDocumentModal', 'ajax-url' => url('uploaddocuments/' . $value->id . '/edit'), 'name' => ' Edit', 'icon' => 'pencil']];
                                
                                $actions = [];
                                    if (auth()->user()->checkSpPermission('uploaddocuments.show')) {
                                        # code...
                                        $view = ['data-replace' => '#showUploadDocument', 'url' => '#showUploadDocumentModal', 'ajax-url' => url('uploaddocuments/' . $value->id . '/'), 'name' => ' Lihat', 'icon' => 'eye'];
                                        array_push($actions, $view);
                                    }
                                    if (auth()->user()->checkSpPermission('uploaddocuments.edit')) {
                                        # code...
                                        $edit = ['data-replace' => '#editUploadDocument', 'url' => '#editUploadDocumentModal', 'ajax-url' => url('uploaddocuments/' . $value->id . '/edit'), 'name' => ' Edit', 'icon' => 'pencil'];
                                        array_push($actions, $edit);
                                    }
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$uploaddocuments, 'index_route'=>route('uploaddocuments.index')])
</div>

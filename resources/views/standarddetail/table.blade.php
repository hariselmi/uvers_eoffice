<div class="" id="standarddetailTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                {{-- <th width="50" class="hidden-xs">{{trans('standarddetail.customer_id')}}</th> --}}
                <th>{{ trans('standard.name') }}</th>
                <th>{{ trans('standarddetail.name') }}</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($standarddetails as $value)
                <tr>
                    {{-- <td class="hidden-xs">{{ $value->id }}</td> --}}
                    <td>{{ Get_field::get_data($value->standard_id,'standards','standard') }}</td>
                    <td>{{ $value->standard_details }}</td>
                    <td class="item_btn_group">
                        @php
                            $actions = [
                                ['data-replace' => '#showStandardDetail', 'url' => '#showStandardDetailModal', 'ajax-url' => url('standarddetails/' . $value->id . '/'), 'name' => ' Lihat', 'icon' => 'eye'], 
                                ['data-replace' => '#editStandardDetail', 'url' => '#editStandardDetailModal', 'ajax-url' => url('standarddetails/' . $value->id . '/edit'), 'name' => ' Sunting', 'icon' => 'pencil'],
                                ['url' => 'standarddetails/' . $value->id, 'name' => 'delete']
                            ];
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$standarddetails, 'index_route'=>route('standarddetails.index')])
</div>

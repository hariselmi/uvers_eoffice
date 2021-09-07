<div class="" id="standardTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                {{-- <th width="50" class="hidden-xs">{{trans('standard.customer_id')}}</th> --}}
                <th>{{ trans('standard.name') }}</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($standards as $value)
                <tr>
                    {{-- <td class="hidden-xs">{{ $value->id }}</td> --}}
                    <td>{{ $value->standard }}</td>
                    <td class="item_btn_group">
                        @php
                            $actions = [
                                ['data-replace' => '#editStandard', 'url' => '#editStandardModal', 'ajax-url' => url('standards/' . $value->id . '/edit'), 'name' => ' Sunting', 'icon' => 'pencil'],
                                ['url' => 'standards/' . $value->id, 'name' => 'delete']
                            ];
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$standards, 'index_route'=>route('standards.index')])
</div>

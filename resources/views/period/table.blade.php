<div class="" id="periodTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Periode</th>
                <th>Status</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periods as $index=>$value)
                <tr>
                    <td>{{ $value->title }} {{ $value->semester }}</td>
                    <td>
                        @if ($value->status == 1 )
                            Active
                        @else
                            Non Active
                        @endif
                    </td>
                    <td class="item_btn_group">
                        @php
                            $actions = [
                                ['data-replace' => '#editPeriod', 'url' => '#editPeriodModal', 'ajax-url' => url('period/' . $value->id . '/edit'), 'name' => ' Sunting', 'icon' => 'pencil'],
                                ['url' => 'period/' . $value->id, 'name' => 'delete']
                            ];
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$periods, 'index_route'=>route('period.index')])
</div>

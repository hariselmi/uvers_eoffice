<div class="" id="divisionTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Group</th>
                <th>Nama</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($divisions as $index=>$value)
                <tr>
                    <td>{{ Get_field::get_data(Get_field::get_data($value->id, 'divisions', 'parent_id'),'divisions','title') }}</td>
                    <td>{{ $value->title }}</td>
                    <td class="item_btn_group">
                        @php
                            $actions = [
                                ['data-replace' => '#editDivision', 'url' => '#editDivisionModal', 'ajax-url' => url('division/' . $value->id . '/edit'), 'name' => ' Sunting', 'icon' => 'pencil'],
                                ['url' => 'division/' . $value->id, 'name' => 'delete']
                            ];
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$divisions, 'index_route'=>route('division.index')])
</div>

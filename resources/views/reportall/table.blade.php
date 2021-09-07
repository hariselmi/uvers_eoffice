<div class="" id="reportsTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Periode</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $value)
                <tr>
                    <td>{{ $value->title }} {{ $value->semester }}</td>
                    <td class="item_btn_group">
                        @php
                            $actions = [['url' => 'reportalls/' . $value->id . '/print', 'name' => ' Cetak', 'target' => '_blank', 'icon' => 'print']];
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$reports, 'index_route'=>route('reportalls.index')])
</div>

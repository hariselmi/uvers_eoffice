<div class="" id="agendasTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Periode</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agendas as $value)
                <tr>
                    <td>{{ $value->title }} {{ $value->semester }}</td>
                        <td class="item_btn_group">
                                @php
                                    // $actions = [
                                    //     ['data-replace' => '#showAgenda', 'url' => '#showAgendaModal', 'ajax-url' => url('agenda/' . $value->id . '/'), 'name' => ' Lihat', 'icon' => 'eye'], 
                                    //     ['data-replace' => '#editAgenda', 'url' => '#editAgendaModal', 'ajax-url' => url('agenda/' . $value->id . '/edit'), 'name' => ' Sunting', 'icon' => 'pencil'], 
                                    //     ['url' => 'agenda/' . $value->id . '/print', 'name' => ' Cetak', 'target' => '_blank', 'icon' => 'print']];\


                                $actions = [];
                                        $edit = ['data-replace' => '#editAgenda', 'url' => '#editAgendaModal', 'ajax-url' => url('agenda/' . $value->id . '/edit'), 'name' => ' Sunting', 'icon' => 'pencil'];
                                        array_push($actions, $edit);
                                        $delete = ['url' => 'agenda/' . $value->id . '/print', 'name' => ' Cetak', 'target' => '_blank', 'icon' => 'print'];
                                        array_push($actions, $delete);
                                @endphp
                                @include('partials.actions', ['actions'=>$actions])
                            </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$agendas, 'index_route'=>route('reportalls.index')])
</div>

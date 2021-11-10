<div class="" id="verificationsTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Periode</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($verifications as $value)
                <tr>
                    <td>{{ $value->title }} {{ $value->semester }}</td>
                        <td class="item_btn_group">
                                @php
                                    // $actions = [
                                    //     ['data-replace' => '#showVerification', 'url' => '#showVerificationModal', 'ajax-url' => url('verification/' . $value->id . '/'), 'name' => ' Lihat', 'icon' => 'eye'], 
                                    //     ['data-replace' => '#editVerification', 'url' => '#editVerificationModal', 'ajax-url' => url('verification/' . $value->id . '/edit'), 'name' => ' Edit', 'icon' => 'pencil'], 
                                    //     ['url' => 'verification/' . $value->id . '/print', 'name' => ' Cetak', 'target' => '_blank', 'icon' => 'print']];\


                                $actions = [];
                                        $edit = ['data-replace' => '#editVerification', 'url' => '#editVerificationModal', 'ajax-url' => url('verification/' . $value->id . '/edit'), 'name' => ' Edit', 'icon' => 'pencil'];
                                        array_push($actions, $edit);
                                        $delete = ['url' => 'verification/' . $value->id . '/print', 'name' => ' Cetak', 'target' => '_blank', 'icon' => 'print'];
                                        array_push($actions, $delete);
                                @endphp
                                @include('partials.actions', ['actions'=>$actions])
                            </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$verifications, 'index_route'=>route('reportalls.index')])
</div>

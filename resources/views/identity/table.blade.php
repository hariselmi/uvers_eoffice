<div class="" id="identityTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Facebook</th>
                <th>WhatsApp</th>
                <th>Instagram</th>
                <th>Email</th>
                <th>Telepon</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($identity as $value)
                <tr>
                    <td>{{ $value->nama }}</td>
                    <td>{{ $value->facebook }}</td>
                    <td>{{ $value->whatsapp }}</td>
                    <td>{{ $value->instagram }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->phone }}</td>
                    <td class="item_btn_group">
                        @php
                            $actions = [
                                ['data-replace' => '#editIdentity', 'url' => '#editIdentityModal', 'ajax-url' => url('identity/' . $value->id . '/edit'), 'name' => ' Sunting', 'icon' => 'pencil']
                            ];
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

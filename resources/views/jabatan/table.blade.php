<div class="" id="JabatanTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Jabatan</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($semua_jabatan as $index=>$value)
                <tr>
                    <td class="text-center">{{ $index+1 }}</td>
                    <td class="text-left">{{ $value->nama }}</td>
                    <td class="text-left">{{ $value->keterangan }}</td>

                    <td class="item_btn_group">
                        @php
                            $actions = [ 
                                ['data-replace' => '#editJabatan', 'url' => '#editJabatanModal', 'ajax-url' => url('jabatan/' . $value->id . '/edit'), 'name' => ' Edit', 'icon' => 'pencil'],

                                ['url' => 'jabatan/' . $value->id, 'name' => 'delete']
                            ];
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$semua_jabatan, 'index_route'=>route('jabatan.index')])
</div>
<script type="text/javascript">
    $('#addJabatanModal').modal('hide');
    $('#editJabatanModal').modal('hide');
</script>

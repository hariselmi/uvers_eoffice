<div class="" id="JenisSuratTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Jenis Surat</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($semua_jenis_surat as $index=>$value)
                <tr>
                    <td class="text-center">{{ $index+1 }}</td>
                    <td class="text-left">{{ $value->nama }}</td>
                    <td class="text-left">{{ $value->keterangan }}</td>
                    <td class="item_btn_group">
                        @php
                            $actions = [ 
                                ['data-replace' => '#editJenisSurat', 'url' => '#editJenisSuratModal', 'ajax-url' => url('jenis-surat/' . $value->id . '/edit'), 'name' => ' Edit', 'icon' => 'pencil'],

                                ['url' => 'jenis-surat/' . $value->id, 'name' => 'delete']
                            ];
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$semua_jenis_surat, 'index_route'=>route('jenis-surat.index')])
</div>
<script type="text/javascript">
    $('#addJenisSuratModal').modal('hide');
    $('#editJenisSuratModal').modal('hide');
</script>

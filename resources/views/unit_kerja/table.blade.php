<div class="" id="UnitKerjaTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Unit</th>
                <th class="text-center">Kepala Unit</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($semua_unit_kerja as $index=>$value)
                <tr>
                    <td class="text-center">{{ $index+1 }}</td>
                    <td class="text-left">{{ $value->nama }}</td>
                    <td class="text-left">{{ Get_field::get_data($value->pegawai_id, 'pegawai', 'nama') }}</td>
                    <td class="text-left">{{ $value->keterangan }}</td>
                    <td class="item_btn_group">
                        @php
                            $actions = [ 
                                ['data-replace' => '#editUnitKerja', 'url' => '#editUnitKerjaModal', 'ajax-url' => url('unit-kerja/' . $value->id . '/edit'), 'name' => ' Edit', 'icon' => 'pencil'],

                                ['url' => 'unit-kerja/' . $value->id, 'name' => 'delete']
                            ];
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$semua_unit_kerja, 'index_route'=>route('unit-kerja.index')])
</div>
<script type="text/javascript">
    $('#addUnitKerjaModal').modal('hide');
    $('#editUnitKerjaModal').modal('hide');
</script>

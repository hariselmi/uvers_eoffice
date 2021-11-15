<div class="" id="PegawaiTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Email</th>
                <th class="text-center">Telepon</th>
                <th class="text-center">Unit Kerja</th>
                <th class="text-center">Jabatan</th>
                <th class="text-center">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($semua_pegawai as $index=>$value)
                <tr>
                    <td class="text-center">{{ $index+1 }}</td>
                    <td class="text-left">{{ $value->nama }}</td>
                    <td class="text-left">{{ $value->email }}</td>
                    <td class="text-left">{{ $value->telepon }}</td>
                    <td class="text-left">{{ Get_field::get_data($value->unit_kerja_id, 'unit_kerja', 'nama') }} </td>
                    <td class="text-left">{{ Get_field::get_data($value->jabatan_id, 'jabatan', 'nama') }} <br>
                        <?php
                        if($value->kepala_unit == '2'){
                            echo "[Kepala Unit]";
                        }
                        ?>

                    </td>

                    <td class="item_btn_group">
                        @php
                            $actions = [ 
                                ['data-replace' => '#editPegawai', 'url' => '#editPegawaiModal', 'ajax-url' => url('pegawai/' . $value->id . '/edit'), 'name' => ' Edit', 'icon' => 'pencil'],

                                ['url' => 'pegawai/' . $value->id, 'name' => 'delete']
                            ];
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$semua_pegawai, 'index_route'=>route('pegawai.index')])
</div>
<script type="text/javascript">
    $('#addPegawaiModal').modal('hide');
    $('#editPegawaiModal').modal('hide');
</script>

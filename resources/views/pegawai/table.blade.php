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
                    <td class="text-center">{{ $value->nama }}</td>
                    <td class="text-center">{{ $value->email }}</td>
                    <td class="text-center">{{ $value->telepon }}</td>
                    <td class="text-center">{{ Get_field::get_data($value->unit_kerja_id, 'unit_kerja', 'nama') }} </td>
                    <td class="text-center">{{ Get_field::get_data($value->jabatan_id, 'jabatan', 'nama') }} <br>
                        <?php
                        if($value->kepala_unit == '2'){
                            echo "[Kepala Unit]";
                        }
                        ?>

                    </td>
                    <td class="text-center">
                        <a href="#editPegawaiModal" data-replace-empty="#editPegawai" data-ajax-url="/pegawai/{{$value->id}}/edit" data-toggle="modal">
                        <button class="btn btn-small btn-warning pull-left" style="margin: 10px;"><i class="fa fa-edit"></i> Edit</button>
                        </a>



                        <a href="#" class="delete-form" onclick="return confirm('Apakah anda yakin?')"><form method="POST" action="/pegawai/{{$value->id}}" accept-charset="UTF-8" class="form-inline">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-small btn-danger pull-left" style="margin: 10px;"><i class="fa fa-trash"></i> Hapus</button>
                        </form></a>
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

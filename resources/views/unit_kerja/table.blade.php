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
                    <td class="text-center">
                        <a href="#editUnitKerjaModal" data-replace-empty="#editUnitKerja" data-ajax-url="/unit-kerja/{{$value->id}}/edit" data-toggle="modal">
                        <button class="btn btn-small btn-warning pull-left" style="margin: 10px;"><i class="fa fa-edit"></i> Edit</button>
                        </a>



                        <a href="#" class="delete-form" onclick="return confirm('Apakah anda yakin?')"><form method="POST" action="/unit-kerja/{{$value->id}}" accept-charset="UTF-8" class="form-inline">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-small btn-danger pull-left" style="margin: 10px;"><i class="fa fa-trash"></i> Hapus</button>
                        </form></a>
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

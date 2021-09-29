<div class="" id="PrioritasSuratTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Prioritas Surat</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($semua_prioritas_surat as $index=>$value)
                <tr>
                    <td class="text-center">{{ $index+1 }}</td>
                    <td class="text-center">{{ $value->nama }}</td>
                    <td class="text-center">{{ $value->keterangan }}</td>
                    <td class="text-center">
                        <a href="#editPrioritasSuratModal" data-replace-empty="#editPrioritasSurat" data-ajax-url="/prioritas-surat/{{$value->id}}/edit" data-toggle="modal">
                        <button class="btn btn-small btn-warning pull-left" style="margin: 10px;"><i class="fa fa-edit"></i> Edit</button>
                        </a>



                        <a href="#" class="delete-form" onclick="return confirm('Apakah anda yakin?')"><form method="POST" action="/prioritas-surat/{{$value->id}}" accept-charset="UTF-8" class="form-inline">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-small btn-danger pull-left" style="margin: 10px;"><i class="fa fa-trash"></i> Hapus</button>
                        </form></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$semua_prioritas_surat, 'index_route'=>route('prioritas-surat.index')])
</div>
<script type="text/javascript">
    $('#addPrioritasSuratModal').modal('hide');
    $('#editPrioritasSuratModal').modal('hide');
</script>

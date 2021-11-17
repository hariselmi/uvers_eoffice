<div class="" id="pelaporanRepositoriInternalTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="50" class="hidden-xs text-center">No</th>
                <th class="text-center">Jenis Surat</th>
                <th class="text-center">Perihal</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Asal Surat</th>
                <th class="text-center">File</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelaporan_repositori_internal as $key=>$value)
            <tr>
                <td class="hidden-xs text-center">{{ $key+1 }}</td>
                <td class="hidden-xs">{{ Get_field::get_data($value->jenis_id, 'jenis_surat', 'nama') }}</td>
                <td class="hidden-xs">{{ $value->perihal }} </td>
                <td class="hidden-xs">{{ Get_field::format_indo($value->tgl_surat) }}</td>
                <td class="hidden-xs">{{ Get_field::get_data($value->asal_surat, 'pegawai', 'nama') }}</td>
                <td class="text-center">
                        <a href="#lihatRepositoriInternalModal" data-replace-empty="#lihatRepositoriInternal" data-ajax-url="/pelaporan-repositori-internal/{{$value->id}}/repositori" data-toggle="modal">
                        <button class="btn btn-small btn-warning pull-left" style="margin: 10px;"><i class="fa fa-file"></i> Lihat Repositori</button>
                        </a>
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
            @include('partials.pagination', ['items'=>$pelaporan_repositori_internal, 'index_route'=>route('pelaporan-repositori-internal.index')])
        </div>
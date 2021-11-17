<div class="" id="pelaporanRepositoriTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="50" class="hidden-xs text-center">No</th>
                <th class="text-center">Jenis Surat</th>
                <th class="text-center">Perihal</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Asal Surat</th>
                <th class="text-center">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelaporan_repositori as $key=>$value)
            <tr>
                <td class="hidden-xs text-center">{{ $key+1 }}</td>
                <td class="hidden-xs">{{ Get_field::get_data($value->jenis_id, 'jenis_surat', 'nama') }}</td>
                <td class="hidden-xs">{{ $value->perihal }} </td>
                <td class="hidden-xs">{{ Get_field::format_indo($value->tgl_surat) }}</td>
                <td class="hidden-xs">{{ $value->asal_surat }}</td>
                <td class="text-center">
                        <a href="#lihatRepositoriModal" data-replace-empty="#lihatRepositori" data-ajax-url="/pelaporan-repositori/{{$value->id}}/repositori" data-toggle="modal">
                        <button class="btn btn-small btn-warning pull-left" style="margin: 10px;"><i class="fa fa-file"></i> Lihat Repositori</button>
                        </a>
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
            @include('partials.pagination', ['items'=>$pelaporan_repositori, 'index_route'=>route('pelaporan-repositori.index')])
        </div>

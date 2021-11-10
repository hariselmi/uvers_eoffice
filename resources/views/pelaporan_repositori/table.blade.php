<div class="" id="pelaporanEofficeTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="50" class="hidden-xs text-center">No</th>
                <th>Jenis Surat</th>
                <th>Perihal</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelaporan_repositori as $key=>$value)
            <tr>
                <td class="hidden-xs text-center">{{ $key+1 }}</td>
                <td class="hidden-xs">{{ Get_field::get_data($value->jenis_id, 'jenis_surat', 'nama') }}</td>
                <td class="hidden-xs">{{ $value->perihal }} </td>
                <td class="hidden-xs">
                    @if($value->file_surat != '' && $value->file_surat != null)
                    File :
                    <a href="{{ url('/document')}}/{!!$value->file_surat!!}" target="_blank">
                        <span>Download</span></a>
                        @else
                        File :
                        @endif
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
            @include('partials.pagination', ['items'=>$pelaporan_repositori, 'index_route'=>route('pelaporan-repositori.index')])
        </div>
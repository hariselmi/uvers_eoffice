<div class="" id="pelaporanEofficeTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="50" class="hidden-xs text-center">No</th>
                <th class="text-center">No Surat</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Perihal</th>
                <th class="text-center">Asal Surat</th>
                <th class="text-center">User</th>
                <th class="text-center">Status</th>
                <th class="text-center">Laporan</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelaporan_eoffice as $key=>$value)
            <tr>
                <td class="hidden-xs text-center">{{ $key+1 }}</td>
                <td class="hidden-xs">{{ $value->no_surat }}</td>
                <td class="hidden-xs">{{ Get_field::format_indo($value->tgl_surat) }}</td>
                <td class="hidden-xs">{{ $value->perihal }} <br>
                    @if($value->file_surat != '' && $value->file_surat != null)
                    File :
                    <a href="{{ url('/document')}}/{!!$value->file_surat!!}" target="_blank">
                        <span>Download</span></a>
                        @else
                        File :
                        @endif
                    </td>
                    <td class="hidden-xs">{{ $value->asal_surat }}</td>
                    <td class="hidden-xs">Laporan Oleh : {{ Get_field::get_data($value->laporan_pegawai_id, 'pegawai', 'nama') }} <br>
                        Validasi : {{ Get_field::get_data($value->laporan_pegawai_approval_id, 'pegawai', 'nama') }}
                    </td>
                    <td class="hidden-xs">{{ Get_field::get_data($value->status_laporan_id, 'status_laporan', 'nama') }}</td>
                    <td class="hidden-xs">Catatan : {{ $value->laporan_catatan }} <br>
                        @if($value->laporan_file != '' && $value->laporan_file != null)
                        File :
                        <a href="{{ url('/document')}}/{!!$value->laporan_file!!}" target="_blank">
                            <span>Download</span></a>
                            @else
                            File :
                            @endif
                        </td>
                        <td class="item_btn_group">
                            
                            @if($value->status_laporan_id == '1')
                            @php
                            $actions = [
                            ['data-replace' => '#laporanPelaporanEoffice', 'url' => '#laporanPelaporanEofficeModal', 'ajax-url' => url('pelaporan-eoffice/' . $value->id . '/laporan'), 'name' => ' Laporan ', 'icon' => 'pencil']
                            ];
                            @endphp
                            @elseif($value->status_laporan_id == '2')

                            @if($value->laporan_pegawai_id == Auth::user()->pegawai_id)
                            
                                @php
                                $actions = [
                                ['data-replace' => '#validasiPelaporanEoffice', 'url' => '#', 'ajax-url' => url('pelaporan-eoffice/' . $value->id . '/validasi'), 'name' => ' Menunggu Persetujuan ', 'icon' => 'tutup']
                                ];
                                @endphp
                            @else
                                @php
                                $actions = [
                                ['data-replace' => '#validasiPelaporanEoffice', 'url' => '#validasiPelaporanEofficeModal', 'ajax-url' => url('pelaporan-eoffice/' . $value->id . '/validasi'), 'name' => ' Validasi ', 'icon' => 'check']
                                ];
                                @endphp

                            @endif

                            @else
                            @php
                            $actions = [
                            ['data-replace' => '#', 'url' => '#', 'ajax-url' => url('#'), 'name' => ' Selesai ', 'icon' => 'tutup']
                            ];
                            @endphp
                            @endif
                            
                            @include('partials.actions', ['actions'=>$actions])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @include('partials.pagination', ['items'=>$pelaporan_eoffice, 'index_route'=>route('pelaporan-eoffice.index')])
        </div>
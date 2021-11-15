<div class="" id="suratKeluarTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="50" class="hidden-xs text-center">No</th>
                <th class="text-center">No Surat</th>
                <th class="text-center">Perihal</th>
                <th class="text-center">Asal Surat</th>
                <th class="text-center">Tujuan Surat</th>
                <th class="text-center">Status</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($semua_surat_keluar as $index=>$value)

            <?php 

                $ceklast = DB::table('history_surat_keluar')
                ->where('surat_keluar_id', $value->id)
                ->where('dlt','0')
                ->where('pegawai_id', Auth::user()->pegawai_id)
                ->limit('1')
                ->orderBy('id', 'DESC')->count();
            ?>
                <tr>
                    <td class="hidden-xs text-center">{{ $index + 1 }}</td>
                    <td class="hidden-xs">No : {{ $value->no_surat }} <br>
                    Tgl : {{ Get_field::format_indo($value->tgl_surat) }}</td>
                    <td class="hidden-xs">{{ $value->perihal }} <br>

                    @if($value->file_surat != '' OR $value->file_surat != null)
                    File : 
                      <a href="{{ url('/document')}}/{!!$value->file_surat!!}" target="_blank">
                        <span>Download</span></a>
                      @else
                              File :  
                    @endif
                    </td>
                    <td class="hidden-xs">
                        {{ Get_field::get_data(Get_field::get_data($value->asal_surat, 'pegawai', 'unit_kerja_id'), 'unit_kerja', 'nama') }} <br>
                        [ {{ Get_field::get_data($value->asal_surat, 'pegawai', 'nama') }}  ] 
                        
                        
                    </td>
                    <td class="hidden-xs">{{ Get_field::get_data($value->tujuan_surat, 'unit_kerja', 'nama') }} <br>
                        [ {{  Get_field::get_data(Get_field::get_data($value->tujuan_surat, 'unit_kerja', 'pegawai_id'), 'pegawai', 'nama') }} ]</td>
                    <td class="hidden-xs">{{ Get_field::get_data($value->status, 'status_keluar', 'nama')  }}</td>
                    
                    <td class="item_btn_group">
                        @if($value->pegawai_id == $pegawaiID)
                            @if($value->status == '1')
                                @php
                                    $actions = [
                                        ['data-replace' => '#posisiSuratKeluar', 'url' => '#posisiSuratKeluarModal', 'ajax-url' => url('surat-keluar/' . $value->id . '/posisi'), 'name' => ' Posisi', 'icon' => 'eye'], 
                                        ['data-replace' => '#editSuratKeluar', 'url' => '#editSuratKeluarModal', 'ajax-url' => url('surat-keluar/' . $value->id . '/edit'), 'name' => ' Edit', 'icon' => 'pencil'],
                                        ['url' => 'surat-keluar/' . $value->id, 'name' => 'delete']
                                    ];
                                @endphp
                            @else
                                @php
                                    $actions = [
                                        ['data-replace' => '#posisiSuratKeluar', 'url' => '#posisiSuratKeluarModal', 'ajax-url' => url('surat-keluar/' . $value->id . '/posisi'), 'name' => ' Posisi', 'icon' => 'eye'], 
                                    ];
                                @endphp
                            @endif

                        @else
                            @if($value->status == '3' OR $value->status == '3' OR $value->status == '5')
                                @php
                                    $actions = [
                                        ['data-replace' => '#posisiSuratKeluar', 'url' => '#posisiSuratKeluarModal', 'ajax-url' => url('surat-keluar/' . $value->id . '/posisi'), 'name' => ' Posisi', 'icon' => 'eye']
                                    ];
                                @endphp
                            @else

                                @if($ceklast == 0)
                                    @php
                                    $actions = [
                                        ['data-replace' => '#posisiSuratKeluar', 'url' => '#posisiSuratKeluarModal', 'ajax-url' => url('surat-keluar/' . $value->id . '/posisi'), 'name' => ' Posisi', 'icon' => 'eye'], 
                                        ['data-replace' => '#disposisiSuratKeluar', 'url' => '#disposisiSuratKeluarModal', 'ajax-url' => url('surat-keluar/' . $value->id . '/disposisi'), 'name' => ' Validasi ', 'icon' => 'plus']
                                    ];
                                    @endphp
                                @else
                                    @php
                                    $actions = [
                                        ['data-replace' => '#posisiSuratKeluar', 'url' => '#posisiSuratKeluarModal', 'ajax-url' => url('surat-keluar/' . $value->id . '/posisi'), 'name' => ' Posisi', 'icon' => 'eye']
                                    ];
                                    @endphp
                                 @endif

                            @endif

                        @endif
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach




        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$semua_surat_keluar, 'index_route'=>route('surat-keluar.index')])
    
</div>
    
<script type="text/javascript">
    $('#addSuratKeluarModal').modal('hide');
    $('#showSuratKeluarModal').modal('hide');
    $('#posisiSuratKeluarModal').modal('hide');
    $('#editSuratKeluarModal').modal('hide');
</script>
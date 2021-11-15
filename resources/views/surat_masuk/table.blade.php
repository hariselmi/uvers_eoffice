<div class="" id="suratMasukTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="50" class="hidden-xs text-center">No</th>
                <th class="text-center">No Surat</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Perihal</th>
                <th class="text-center">Asal Surat</th>
                <th class="text-center">Status</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($surat_masuk as $key=>$value)

            <?php 

                $ceklast = DB::table('history_surat_masuk')
                ->where('surat_masuk_id', $value->id)
                ->where('dlt','0')
                ->where('pegawai_id', Auth::user()->pegawai_id)
                ->limit('1')
                ->orderBy('id', 'DESC')->count();
            ?>

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
                    <td class="hidden-xs">{{ Get_field::get_data($value->status, 'perintah_disposisi', 'nama') }}</td>
                    <td class="item_btn_group">

                        
                        @if(Auth::user()->role == 'Member')

                                @if($unitkerjaid == '2')
                                    @php
                                                $actions = [
                                                    ['data-replace' => '#posisiSuratMasuk', 'url' => '#posisiSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/posisi'), 'name' => ' Posisi', 'icon' => 'eye'], 
                                                    ['data-replace' => '#disposisiSuratMasuk', 'url' => '#disposisiSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/disposisi'), 'name' => ' Validasi', 'icon' => 'plus']
                                                ];
                                    @endphp
                                @else

                                    @if($value->status == 1 || $value->status == null)

                                    @if($ceklast == 0)
                                        @if(Auth::user()->role == 'Member')
                                            @php
                                                $actions = [
                                                    ['data-replace' => '#posisiSuratMasuk', 'url' => '#posisiSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/posisi'), 'name' => ' Posisi', 'icon' => 'eye'], 
                                                    ['data-replace' => '#disposisiSuratMasuk', 'url' => '#disposisiSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/disposisi'), 'name' => ' Validasi', 'icon' => 'plus']
                                                ];
                                            @endphp
                                        @else
                                            @php
                                                $actions = [
                                                    ['data-replace' => '#posisiSuratMasuk', 'url' => '#posisiSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/posisi'), 'name' => ' Posisi', 'icon' => 'eye'], 
                                                    ['data-replace' => '#disposisiSuratMasuk', 'url' => '#disposisiSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/disposisi'), 'name' => ' Validasi', 'icon' => 'plus'], 
                                                    ['data-replace' => '#editSuratMasuk', 'url' => '#editSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/edit'), 'name' => ' Edit', 'icon' => 'pencil'],
                                                    ['url' => 'surat-masuk/' . $value->id, 'name' => 'delete']
                                                ];
                                            @endphp
                                        @endif
                                     @else
                                                @php
                                                $actions = [
                                                    ['data-replace' => '#posisiSuratMasuk', 'url' => '#posisiSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/posisi'), 'name' => ' Posisi', 'icon' => 'eye']
                                                ];
                                            @endphp
                                     @endif


                                    @else
                                        @php
                                            $actions = [
                                                ['data-replace' => '#posisiSuratMasuk', 'url' => '#posisiSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/posisi'), 'name' => ' Posisi', 'icon' => 'eye']
                                            ];
                                        @endphp
                                    @endif

                                @endif

                            @else
                                @php
                                            $actions = [
                                                ['data-replace' => '#posisiSuratMasuk', 'url' => '#posisiSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/posisi'), 'name' => ' Posisi', 'icon' => 'eye'], 
                                                ['data-replace' => '#disposisiSuratMasuk', 'url' => '#disposisiSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/disposisi'), 'name' => ' Validasi', 'icon' => 'plus'], 
                                                ['data-replace' => '#editSuratMasuk', 'url' => '#editSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/edit'), 'name' => ' Edit', 'icon' => 'pencil'],
                                                ['url' => 'surat-masuk/' . $value->id, 'name' => 'delete']
                                            ];
                                        @endphp
                            @endif

                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$surat_masuk, 'index_route'=>route('surat-masuk.index')])
</div>


<script type="text/javascript">
    $('#addSuratMasukModal').modal('hide');
    $('#showSuratMasukModal').modal('hide');
    $('#posisiSuratMasukModal').modal('hide');
    $('#editSuratMasukModal').modal('hide');
</script>
    
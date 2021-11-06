<div class="" id="suratMasukTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="50" class="hidden-xs text-center">No</th>
                <th>No Surat</th>
                <th>Tanggal</th>
                <th>Perihal</th>
                <th>Asal Surat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($surat_masuk as $key=>$value)
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
                        @if($value->status == 1 || $value->status == null)
                            @php
                                $actions = [
                                    ['data-replace' => '#posisiSuratMasuk', 'url' => '#posisiSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/posisi'), 'name' => ' Posisi', 'icon' => 'eye'], 
                                    ['data-replace' => '#disposisiSuratMasuk', 'url' => '#disposisiSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/disposisi'), 'name' => ' Disposisi', 'icon' => 'plus'], 
                                    ['data-replace' => '#editSuratMasuk', 'url' => '#editSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/edit'), 'name' => ' Sunting', 'icon' => 'pencil'],
                                    ['url' => 'surat-masuk/' . $value->id, 'name' => 'delete']
                                ];
                            @endphp
                        @else
                            @php
                                $actions = [
                                    ['data-replace' => '#posisiSuratMasuk', 'url' => '#posisiSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/posisi'), 'name' => ' Posisi', 'icon' => 'eye'], 
                                    ['data-replace' => '#editSuratMasuk', 'url' => '#editSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/edit'), 'name' => ' Sunting', 'icon' => 'pencil'],
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
    
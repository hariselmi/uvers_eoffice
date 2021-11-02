<div class="" id="suratMasukTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="50" class="hidden-xs">No</th>
                <th>No Surat</th>
                <th>Tanggal</th>
                <th>Perihal</th>
                <th>Asal Surat</th>
                <th>Tujuan Surat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($surat_masuk as $key=>$value)
                <tr>
                    <td class="hidden-xs">{{ $key+1 }}</td>
                    <td class="hidden-xs">{{ $value->no_surat }}</td>
                    <td class="hidden-xs">{{ Get_field::format_indo($value->tgl_surat) }}</td>
                    <td class="hidden-xs">{{ $value->isi_ringkasan }}</td>
                    <td>{{ Get_field::get_data($value->asal_surat, 'pegawai', 'nama') }}</td>
                    <td>{{ Get_field::get_data($value->asal_surat, 'pegawai', 'nama') }}</td>
                    <td class="item_btn_group">
                        @php
                            $actions = [
                                ['data-replace' => '#posisiSuratMasuk', 'url' => '#posisiSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/posisi'), 'name' => ' Posisi', 'icon' => 'eye'], 
                                ['data-replace' => '#disposisiSuratMasuk', 'url' => '#disposisiSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/disposisi'), 'name' => ' Disoisisi', 'icon' => 'eye'], 
                                ['data-replace' => '#showSuratMasuk', 'url' => '#showSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/'), 'name' => ' Lihat', 'icon' => 'eye'], 
                                ['data-replace' => '#editSuratMasuk', 'url' => '#editSuratMasukModal', 'ajax-url' => url('surat-masuk/' . $value->id . '/edit'), 'name' => ' Sunting', 'icon' => 'pencil'],
                                ['url' => 'surat-masuk/' . $value->id, 'name' => 'delete']
                            ];
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$surat_masuk, 'index_route'=>route('members.index')])
</div>

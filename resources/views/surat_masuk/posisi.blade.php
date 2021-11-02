<div class="modal-content" id="posisiSuratMasuk">
    <section class="content-header">
        <h1><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            {{ __('Posisi Surat') }}</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        @include('partials.flash')
        <div class="row">
            <div class="col-md-12">
                <!-- Profile Image -->
                <div class="box box-success">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="50" class="hidden-xs">No</th>
                                <th>Pejabat Pengirim</th>
                                <th>Tgl Disposisi</th>
                                <th>Pejabat Penerima</th>
                                <th>Status</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($history_surat_masuk as $key=>$value)
                            <tr>
                                <td class="hidden-xs">{{ $key+1 }}</td>
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
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div>
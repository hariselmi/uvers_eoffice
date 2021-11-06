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
                                <th>Lama Proses</th>
                                <th>Isi Ringkasan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($history_pelaporan_eoffice as $key=>$value)
                            <tr>
                                <td class="hidden-xs">{{ $key+1 }}</td>
                                <td class="hidden-xs">{{ $value->asal_surat }}</td>
                                <td class="hidden-xs">{{ $value->tgl_posisi }}</td>
                                <td>{{ Get_field::get_data($value->tujuan_surat, 'pegawai', 'nama') }}</td>
                                <td>{{ Get_field::get_data($value->status, 'perintah_disposisi', 'nama') }}</td>
                                <td class="hidden-xs"></td>
                                <td class="hidden-xs">{{ $value->isi_ringkasan }}
                                @if($value->file_surat != '' && $value->file_surat != null)
                                File : 
                                  <a href="{{ url('/document')}}/{!!$value->file_surat!!}" target="_blank">
                                    <span>Download</span></a>
                                @endif
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
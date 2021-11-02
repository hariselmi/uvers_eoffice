<div class="modal-content" id="showSuratMasuk">
    <section class="content-header">
        <h1><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            {{ __('Detail Surat') }}</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        @include('partials.flash')
        <div class="row">
            <div class="col-md-12">
                <!-- Profile Image -->
                <div class="box box-success">
                    <div class="box-body box-profile">
                        {{-- <img class="profile-user-img img-responsive img-circle" src="{{$avatar}}" alt="User profile picture"> --}}
                        <!-- <h3 class="profile-username text-center">{{ $surat_masuk->name }}</h3> -->
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>No Surat </b> <a class="pull-right">{{ $surat_masuk->no_surat }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Perihal</b> <a class="pull-right">{{ $surat_masuk->perihal }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Asal Surat</b> <a class="pull-right">{{ Get_field::get_data($surat_masuk->asal_surat, 'pegawai', 'nama') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Tujuan Surat</b> <a class="pull-right">{{ Get_field::get_data($surat_masuk->asal_surat, 'pegawai', 'nama') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Isi Ringkas</b> <a class="pull-right">{{ $surat_masuk->isi_ringkasan }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Tanggal Surat</b> <a class="pull-right">{{ $surat_masuk->tgl_surat }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Jenis Surat</b> <a class="pull-right">{{ Get_field::get_data($surat_masuk->jenis_id, 'jenis_surat', 'nama') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Prioritas Surat</b> <a class="pull-right">{{ Get_field::get_data($surat_masuk->prioritas_id, 'prioritas_surat', 'nama') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Sifat Surat</b> <a class="pull-right">{{ Get_field::get_data($surat_masuk->sifat_id, 'sifat_surat', 'nama') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Media Pengiriman Surat</b> <a class="pull-right">{{ Get_field::get_data($surat_masuk->media_id, 'media_surat', 'nama') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Lokasi Penyimpanan Surat</b> <a class="pull-right">{{ $surat_masuk->lokasi_penyimpanan }}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div>
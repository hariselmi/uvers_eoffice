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
                        <!-- <h3 class="profile-username text-center">{{ $pelaporan_eoffice->name }}</h3> -->
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>No Surat </b> <a class="pull-right">{{ $pelaporan_eoffice->no_surat }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Perihal</b> <a class="pull-right">{{ $pelaporan_eoffice->perihal }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Asal Surat</b> <a class="pull-right">{{ Get_field::get_data($pelaporan_eoffice->asal_surat, 'pegawai', 'nama') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Tujuan Surat</b> <a class="pull-right">{{ Get_field::get_data($pelaporan_eoffice->asal_surat, 'pegawai', 'nama') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Isi Ringkas</b> <a class="pull-right">{{ $pelaporan_eoffice->isi_ringkasan }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Tanggal Surat</b> <a class="pull-right">{{ $pelaporan_eoffice->tgl_surat }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Jenis Surat</b> <a class="pull-right">{{ Get_field::get_data($pelaporan_eoffice->jenis_id, 'jenis_surat', 'nama') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Prioritas Surat</b> <a class="pull-right">{{ Get_field::get_data($pelaporan_eoffice->prioritas_id, 'prioritas_surat', 'nama') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Sifat Surat</b> <a class="pull-right">{{ Get_field::get_data($pelaporan_eoffice->sifat_id, 'sifat_surat', 'nama') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Media Pengiriman Surat</b> <a class="pull-right">{{ Get_field::get_data($pelaporan_eoffice->media_id, 'media_surat', 'nama') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Lokasi Penyimpanan Surat</b> <a class="pull-right">{{ $pelaporan_eoffice->lokasi_penyimpanan }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>File Surat</b> <a target="_blank" class="pull-right" href="{{asset('/document/'.$pelaporan_eoffice->file_surat)}}">{{ $pelaporan_eoffice->file_surat }}</a>
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
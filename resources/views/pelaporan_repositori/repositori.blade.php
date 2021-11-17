<div class="modal-content" id="lihatRepositori">
    <section class="content-header">
        <h1><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            {{ __('Repositori Surat Masuk') }}</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        @include('partials.flash')

        <div class="modal-content">
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <!-- Profile Image -->
                <div class="box box-success">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="50" class="hidden-xs text-center">No</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Perihal</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Asal Surat</th>
                                <th class="text-center">File</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- Surat Masuk -->
                        <?php 
                        $no = 0;
                        foreach ($surat_masuk as $key => $value) { 
                        $no++;
                        ?>
                            <tr>
                                <td width="50" class="hidden-xs text-center"><?=$no?></td>
                                <td class="text-center">Surat Masuk</td>
                                <td class="text-center"><?=$value->perihal?></td>
                                <td class="text-center">{{ Get_field::format_indo($value->tgl_surat) }}</td>
                                <td class="text-center"><?=$value->asal_surat?></td>
                                <td class="text-center">                                   
                                @if($value->file_surat != '' && $value->file_surat != null)
                                File : 
                                  <a href="{{ url('/document')}}/{!!$value->file_surat!!}" target="_blank">
                                    <span>Download</span></a>
                                  @else
                                          File :  
                                @endif
                                </td>
                            </tr>
                        <?php } ?>

                        <!-- History -->
                        <?php 
                        foreach ($history_surat_masuk as $key => $value) { 
                        $no++;
                        ?>
                            <tr>
                                <td width="50" class="hidden-xs text-center"><?=$no?></td>
                                <td class="text-center">Disposisi</td>
                                <td class="text-center"><?=$value->catatan_penting?></td>
                                <td class="text-center">{{ Get_field::format_indo($value->tanggal) }}</td>
                                <td class="text-center">{{ Get_field::get_data($value->asal_surat, 'pegawai', 'nama') }}</td>
                                <td class="text-center">                                   
                                @if($value->file_surat != '' && $value->file_surat != null)
                                File : 
                                  <a href="{{ url('/document')}}/{!!$value->file_surat!!}" target="_blank">
                                    <span>Download</span></a>
                                  @else
                                          File :  
                                @endif
                                </td>
                            </tr>
                        <?php } ?>

                        <!-- Laporan -->
                        <?php 
                        foreach ($surat_masuk_laporan as $key => $value) { 
                        $no++;
                        ?>
                            <tr>
                                <td width="50" class="hidden-xs text-center"><?=$no?></td>
                                <td class="text-center">Laporan</td>
                                <td class="text-center"><?=$value->laporan_catatan?></td>
                                <td class="text-center">{{ Get_field::format_indo($value->tanggal_laporan) }}</td>
                                <td class="text-center">{{ Get_field::get_data($value->laporan_pegawai_id, 'pegawai', 'nama') }}</td>
                                <td class="text-center">                                   
                                @if($value->laporan_file != '' && $value->laporan_file != null)
                                File : 
                                  <a href="{{ url('/document')}}/{!!$value->laporan_file!!}" target="_blank">
                                    <span>Download</span></a>
                                  @else
                                          File :  
                                @endif
                                </td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


 
 </div>
</div>
</section>
<section class="content-footer">
       <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
        </div>
    </section>
</div>






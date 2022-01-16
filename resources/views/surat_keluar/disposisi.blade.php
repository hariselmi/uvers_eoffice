<div class="modal-content" id="disposisiSuratKeluar">
    <section class="content-header">
        <h1><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            {{ __('Validasi Surat Internal') }}</h1>
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
                                <th>Tanggal</th>
                                <th>Pejabat Penerima</th>
                                <th>Status</th>
                                <th>Catatan Penting</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($history_surat_keluar as $key=>$value)
                            <tr>
                                <td class="hidden-xs">{{ $key+1 }}</td>
                                <td class="hidden-xs">{{ Get_field::get_data($value->asal_surat, 'pegawai', 'nama') }}
                                <br> [ {{ Get_field::get_data(Get_field::get_data($value->asal_surat, 'pegawai', 'unit_kerja_id'), 'unit_kerja', 'nama') }} ]</td>
                                <td class="hidden-xs">{{ Get_field::format_indo($value->tanggal) }}</td>
                                <td>{{ Get_field::get_data($value->tujuan_surat, 'pegawai', 'nama') }}
                                    <br> [ {{ Get_field::get_data(Get_field::get_data($value->tujuan_surat, 'pegawai', 'unit_kerja_id'), 'unit_kerja', 'nama') }} ]</td>
                                <td>{{ Get_field::get_data($value->status, 'status_keluar', 'nama') }}</td>
                                <td class="hidden-xs">{{ $value->catatan_penting }} <br>
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


        <!-- form dispoisis -->
        <div class="modal-content" id="addSuratKeluar">
            {{ Form::open(['url' => 'surat-keluar/store-disposisi', 'files' => true]) }}
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-10">
                 <div class="form-group row">
                        {{ Form::label('Status', 'Status*', ['class' => 'col-sm-3 text-right']) }}
                        <div class="col-sm-9">
                            {!! Form::select('status', $perintahDisposisi, $statusNow, ['placeholder' => 'Pilih Status','class' => 'form-control','onchange' => 'filter(this.value)']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('Catatan Penting', 'Catatan Penting*', ['class' => 'col-sm-3 text-right']) }}
                        <div class="col-sm-9">
                            {{ Form::hidden('surat_keluar_id', $surat_keluar_id, ['class' => 'form-control', 'style' => 'height:50px' ]) }}
                            {{ Form::textarea('catatan_penting', null, ['class' => 'form-control', 'style' => 'height:50px' ]) }}
                        </div>
                    </div>
                    <div class="form-group row" id="tujuan_surat_div" style="display: none;">
                        {{ Form::label('tujuan_surat', 'Pejabat Penerima', ['class' => 'col-sm-3 text-right']) }}
                        <div class="col-sm-9">
                            {!! Form::select('tujuan_surat', $pegawai, null, ['placeholder' => 'Pilih Pejabat Penerima','class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                    {{ Form::label('fileSurat', 'Unggah Berkas', ['class' => 'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                    {{ Form::file('fileSurat', null, ['class' => 'form-control']) }}
                </div>
            </div>
                    
                </div>
            </div>
        </div>
        <div class="modal-footer">
            @if (!empty($page))
                <input type="hidden" name="page" value="{{ $page }}" />
            @endif
            {{ Form::submit(trans('member.submit'), ['class' => 'btn btn-success']) }}
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
        </div>
        {{ Form::close() }}
        </div>
    </section>
</div>


<script type="text/javascript">
function filter(id) {

    if(id == '2')
    document.getElementById('tujuan_surat_div').style.display = 'block';
    else{
    document.getElementById('tujuan_surat_div').style.display = 'none';
    }
}
filter('<?=$statusNow?>');
 </script>




<div class="modal-content" id="posisiSuratMasuk">
    <section class="content-header">
        <h1><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            {{ __('Disposisi Surat') }}</h1>
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
                        @foreach ($history_surat_masuk as $key=>$value)
                            <tr>
                                <td class="hidden-xs">{{ $key+1 }}</td>
                                <td class="hidden-xs">{{ $value->asal_surat }}</td>
                                <td class="hidden-xs">{{ $value->tgl_posisi }}</td>
                                <td>{{ Get_field::get_data($value->tujuan_surat, 'pegawai', 'nama') }}</td>
                                <td>{{ Get_field::get_data($value->status, 'perintah_disposisi', 'nama') }}</td>
                                <td class="hidden-xs"></td>
                                <td class="hidden-xs">{{ $value->isi_ringkasan }}</td>
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
        <div class="modal-content" id="addSuratMasuk">
            {{ Form::open(['url' => 'surat-masuk/store-disposisi', 'files' => true]) }}
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-10">
                 <div class="form-group row">
                        {{ Form::label('status', 'Penyelesaian', ['class' => 'col-sm-3 text-right']) }}
                        <div class="col-sm-9">
                            {!! Form::select('status', $perintahDisposisi, null, ['placeholder' => 'Pilih Penyelesaian','class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('tujuan_surat', 'Tujuan Surat', ['class' => 'col-sm-3 text-right']) }}
                        <div class="col-sm-9">
                            {!! Form::select('tujuan_surat', $pegawai, null, ['placeholder' => 'Pilih Tujuan Surat','class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('isi_ringkasan', 'Keterangan', ['class' => 'col-sm-3 text-right']) }}
                        <div class="col-sm-9">
                            {{ Form::hidden('no_surat', $value->no_surat, ['class' => 'form-control', 'style' => 'height:50px' ]) }}
                            {{ Form::hidden('surat_id', $value->surat_masuk_id, ['class' => 'form-control', 'style' => 'height:50px' ]) }}
                            {{ Form::hidden('history_id', $value->id, ['class' => 'form-control', 'style' => 'height:50px' ]) }}
                            {{ Form::textarea('isi_ringkasan', null, ['class' => 'form-control', 'style' => 'height:50px' ]) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('tgl_surat', 'Tanggal Disposisi', ['class' => 'col-sm-3 text-right']) }}
                        <div class="col-sm-9">
                            {{ Form::date('tgl_surat', null, ['class' => 'form-control', '']) }}
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
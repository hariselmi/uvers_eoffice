<div class="modal-content" id="addSuratMasuk">
    {{ Form::open(['url' => 'surat-masuk', 'files' => true]) }}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">
        {{ __('Tambah Surat Masuk') }}
    </h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-10">
            <div class="form-group row">
                {{ Form::label('no_surat', 'No Surat', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::text('no_surat', null, ['class' => 'form-control', '']) }}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('perihal', 'Perihal', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::text('perihal', null, ['class' => 'form-control', '']) }}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('asal_surat', 'Asal Surat', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('asal_surat', $pegawai, null, ['placeholder' => 'Pilih Asal Surat','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('tujuan_surat', 'Tujuan Surat', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('tujuan_surat', $pegawai, null, ['placeholder' => 'Pilih Tujuan Surat','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('isi_ringkasan', 'Isi Ringkasan', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::textarea('isi_ringkasan', null, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('tgl_surat', 'Tanggal Surat', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::date('tgl_surat', null, ['class' => 'form-control', '']) }}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('jenis_id', 'Jenis Surat', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('jenis_id', $jenisSurat, null, ['placeholder' => 'Pilih Jenis Surat','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('prioritas_id', 'Prioritas Surat', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('prioritas_id', $prioritasSurat, null, ['placeholder' => 'Pilih Prioritas Surat','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('sifat_id', 'Sifat Surat', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('sifat_id', $sifatSurat, null, ['placeholder' => 'Pilih Sifat Surat','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('media_id', 'Media Pengiriman Surat', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('media_id', $mediaSurat, null, ['placeholder' => 'Pilih Media Pengiriman Surat','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('lokasi_penyimpanan', 'Lokasi Penyimpanan Berkas', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::textarea('lokasi_penyimpanan', null, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('file', 'Unggah Berkas', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::file('file', null, ['class' => 'form-control']) }}
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

<script type="text/javascript" src="{{ asset('js/member.js') }}"></script>


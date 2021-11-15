<div class="modal-content" id="addSuratKeluar">
    {{ Form::open(['url' => 'surat-keluar', 'files' => true]) }}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">
        {{ __('Tambah Surat Keluar') }}
    </h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-10">
            <div class="form-group row">
                {{ Form::label('no_surat', 'No Surat*', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::text('no_surat', null, ['class' => 'form-control', '']) }}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('tujuan_surat', 'Tujuan Surat*', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('tujuan_surat', $unitKerja, 'null', ['placeholder' => ' Pilih Tujuan','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('perihal', 'Perihal*', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::text('perihal', null, ['class' => 'form-control', '']) }}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('isi_ringkasan', 'Isi Ringkasan*', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::textarea('isi_ringkasan', null, ['class' => 'form-control', 'style' => 'height:50px' ]) }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('tgl_surat', 'Tanggal Surat*', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::date('tgl_surat', null, ['class' => 'form-control', '']) }}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('jenis_id', 'Jenis Surat*', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('jenis_id', $jenisSurat, null, ['placeholder' => 'Pilih Jenis Surat','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('fileSurat', 'Unggah Berkas*', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::file('fileSurat', null, ['class' => 'form-control']) }}
                    Maksimal 2MB
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    @if (!empty($page))
        <input type="hidden" name="page" value="{{ $page }}" />
    @endif
    {{ Form::submit(trans('Simpan'), ['class' => 'btn btn-success']) }}
    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
</div>
{{ Form::close() }}
</div>



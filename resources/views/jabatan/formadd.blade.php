<div class="modal-content" id="addJabatan">
    {{ Form::open(['url' => 'jabatan', 'files' => true]) }}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">
        Tambah Jabatan
    </h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-10">
            <div class="form-group row">
                {{ Form::label('nama', 'Jabatan' . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::text('nama', null, ['class' => 'form-control', 'required']) }}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('unit_kerja_id', 'Unit Kerja' . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('unit_kerja_id', $unitkerja, null, ['placeholder' => 'Pilih Unit Kerja', ' ' , 'class' => 'form-control', 'required']) !!}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('keterangan', 'Keterangan', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::text('keterangan', null, ['class' => 'form-control', '']) }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    @if (!empty($page))
        <input type="hidden" name="page" value="{{ $page }}" />
    @endif
    {{ Form::submit('Simpan', ['class' => 'btn btn-success']) }}
    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
</div>
{{ Form::close() }}
</div>
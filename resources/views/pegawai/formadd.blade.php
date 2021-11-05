<div class="modal-content" id="addPegawai">
    {{ Form::open(['url' => 'pegawai', 'files' => true]) }}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">
        Tambah Pegawai
    </h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-10">
            <div class="form-group row">
                {{ Form::label('nama', 'Nama' . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::text('nama', null, ['class' => 'form-control', 'required']) }}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('email', 'Email' . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::text('email', null, ['class' => 'form-control', 'required']) }}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('telepon', 'Telepon' . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::text('telepon', null, ['class' => 'form-control', 'required']) }}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('unit_kerja_id', 'Unit Kerja' . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('unit_kerja_id', $unitkerja, null, ['placeholder' => 'Pilih Unit Kerja', ' ' , 'class' => 'form-control', 'required', 'onchange' => 'getJabatan(this)']) !!}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('jabatan_id', 'Jabatan' . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('jabatan_id', [], null, ['placeholder' => 'Pilih Unit Kerja', ' ' , 'class' => 'form-control', 'required']) !!}
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
<script type="text/javascript" src="{{ asset('js/schedule.js') }}"></script>
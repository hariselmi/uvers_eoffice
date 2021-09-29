<div class="modal-content" id="editPrioritasSurat">
    @if (!empty($prioritas_surat))
    {{ Form::model($prioritas_surat, ['route' => ['prioritas-surat.update', $prioritas_surat->id], 'method' => 'PUT', 'files' => true]) }}
    @endif
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">
        Edit Prioritas Surat
    </h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-10">
            <div class="form-group row">
                {{ Form::label('nama', 'Prioritas Surat' . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::text('nama', null, ['id' => 'edit_nama', 'class' => 'form-control', 'required']) }}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('keterangan', 'Keterangan', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::text('keterangan', null, ['id' => 'edit_keterangan', 'class' => 'form-control', '']) }}
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
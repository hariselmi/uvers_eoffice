<div class="modal-content" id="editArticle">
    {{ Form::model($division, ['route' => ['division.update', $division->id], 'method' => 'PUT', 'files' => true]) }}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">
        {{ __('Edit Divisi') }}
    </h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-10">
            <div class="form-group row">
                {{ Form::label('parent_id', trans('division.category') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">

                     {!! Form::select('parent_id', $parents, null, ['placeholder' => 'Pilih Group', 'class' => 'form-control', '']) !!}


                </div>
            </div>

             <div class="form-group row">
                {{ Form::label('title', trans('division.title') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::text('title', null, ['class' => 'form-control', 'required']) }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    @if (!empty($page))
        <input type="hidden" name="page" value="{{ $page }}" />
    @endif
    {{ Form::submit(trans('division.submit'), ['class' => 'btn btn-success']) }}
    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
</div>
{{ Form::close() }}
</div>



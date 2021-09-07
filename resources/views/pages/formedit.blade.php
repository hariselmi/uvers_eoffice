<div class="modal-content" id="editPages">
    {{ Form::model($pages, ['route' => ['pages.update', $pages->id], 'method' => 'PUT', 'files' => true]) }}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">
        {{ __('Edit Halaman') }}
    </h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-10">

             <div class="form-group row">
                {{ Form::label('title', trans('pages.title') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::text('nama', null, ['id' => 'nama', 'class' => 'form-control', 'required']) }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('content', trans('article.content') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::textarea('content', null, ['id' => 'edit_content','class' => 'form-control', 'required']) }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    @if (!empty($page))
        <input type="hidden" name="page" value="{{ $page }}" />
    @endif
    {{ Form::submit(trans('pages.submit'), ['class' => 'btn btn-success']) }}
    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
</div>
{{ Form::close() }}
</div>

@if (!empty($pages))
    {{-- <script type="text/javascript" src="{{ asset('js/pages.js') }}"></script> --}}
    <script>
        CKEDITOR.replace( 'edit_content' );
    </script>
@endif


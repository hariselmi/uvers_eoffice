<div class="modal-content" id="editArticle">
    {{ Form::model($article, ['route' => ['articles.update', $article->id], 'method' => 'PUT', 'files' => true]) }}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">
        {{ __('Edit Artikel') }}
    </h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-10">
            <div class="form-group row">
                {{ Form::label('category', trans('article.category') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::select('category', array('1' => 'Standar Mutu', '2' => 'Agenda Kegiatan'), null, ['id' => 'edit_category','class' => 'form-control', 'required']) }}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('date', trans('article.date') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::date('date', null, ['id' => 'edit_date','class' => 'form-control', 'required']) }}
                </div>
            </div>

             <div class="form-group row">
                {{ Form::label('title', trans('article.title') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::text('title', null, ['id' => 'edit_title', 'class' => 'form-control', 'required']) }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('content', trans('article.content') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::textarea('content', null, ['id' => 'edit_content','class' => 'form-control', 'required']) }}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('thumbnail', trans('article.thumbnail') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::file('thumbnail', null, ['id' => 'edit_thumbnail','class' => 'form-control', 'required']) }}
                    @if (!empty($article))
                        {{ Form::hidden('Oldthumbnail', $article->thumbnail, ['id' => 'edit_Oldthumbnail','class' => 'form-control', 'required']) }}
                    @endif
                </div>
            </div>
             <div class="form-group row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">Ukuran Gambar (555px x 390px)</div>
                </div>
            <div class="form-group row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-9">
                    <img src="{{asset('/images/article/'.$article->thumbnail)}}" alt="" width="300px" height="200px">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    @if (!empty($page))
        <input type="hidden" name="page" value="{{ $page }}" />
    @endif
    {{ Form::submit(trans('article.submit'), ['class' => 'btn btn-success']) }}
    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
</div>
{{ Form::close() }}
</div>

@if (!empty($article))
    {{-- <script type="text/javascript" src="{{ asset('js/article.js') }}"></script> --}}
    <script>
        CKEDITOR.replace( 'edit_content' );
    </script>
@endif


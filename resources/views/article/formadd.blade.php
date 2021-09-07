<div class="modal-content" id="addArticle">
    {{ Form::open(['url' => 'articles', 'files' => true]) }}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">
        {{ __('Tambah Artikel') }}
        </h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-10">
                <div class="form-group row">
                    {{ Form::label('category', trans('article.category') . ' *', ['class' => 'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::select('category', array('1' => 'Standar Mutu', '2' => 'Agenda Kegiatan'), null, ['class' => 'form-control', 'required']) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('date', trans('article.date') . ' *', ['class' => 'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::date('date', null, ['class' => 'form-control', 'required']) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('title', trans('article.title') . ' *', ['class' => 'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::text('title', null, ['class' => 'form-control', 'required']) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('content', trans('article.content') . ' *', ['class' => 'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::textarea('content', null, ['class' => 'form-control', 'required']) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('thumbnail', trans('article.thumbnail') . ' *', ['class' => 'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        {{ Form::file('thumbnail', null, ['class' => 'form-control', 'required']) }}
                    </div>
                    
                </div>
                <div class="form-group row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">Ukuran Gambar (555px x 390px)</div>
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
<script type="text/javascript" src="{{ asset('js/article.js') }}"></script>
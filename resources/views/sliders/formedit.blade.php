<div class="modal-content" id="editSliders">
    {{ Form::model($slider, ['route' => ['sliders.update', $slider->id], 'method' => 'PUT', 'files' => true]) }}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">
        {{ __('Edit Slider') }}
    </h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-10">


             <div class="form-group row">
                {{ Form::label('title', trans('sliders.title') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::text('title', null, ['id' => 'edit_title', 'class' => 'form-control', 'required']) }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('category', trans('sliders.category') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::select('status', array('1' => 'Active', '0' => 'Non Active'), null, ['id' => 'edit_status','class' => 'form-control', 'required']) }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('thumbnail', trans('sliders.thumbnail') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::file('thumbnail', null, ['id' => 'edit_thumbnail','class' => 'form-control', 'required']) }}
                    @if (!empty($slider))
                        {{ Form::hidden('Oldthumbnail', $slider->thumbnail, ['id' => 'edit_Oldthumbnail','class' => 'form-control', 'required']) }}
                    @endif
                </div>
            </div>
            <div class="form-group row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">Ukuran Gambar (4238px x 1413px)</div>
                </div>
            <div class="form-group row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-9">
                    <img src="{{asset('/images/slider/'.$slider->thumbnail)}}" alt="" width="300px" height="200px">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    @if (!empty($page))
        <input type="hidden" name="page" value="{{ $page }}" />
    @endif
    {{ Form::submit(trans('sliders.submit'), ['class' => 'btn btn-success']) }}
    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
</div>
{{ Form::close() }}
</div>



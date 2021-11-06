<div class="modal-content" id="validasiPelaporanEoffice">

    @if (!empty($validasipelaporaneoffice))
    {{ Form::model($validasipelaporaneoffice, ['url' => 'pelaporan-eoffice/store-validasi', 'files' => true]) }}
    @endif

    <section class="content-header">
        <h1><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            {{ __('Pelaporan') }}</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        @include('partials.flash')


        <!-- form dispoisis -->
        <div class="modal-content" id="addPelaporanEoffice">
            {{ Form::open(['url' => 'pelaporan-eoffice/store-validasi', 'files' => true]) }}
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group row">
                        {{ Form::label('status_laporan_id', 'Validasi', ['class' => 'col-sm-3 text-right']) }}
                        <div class="col-sm-9">
                            {!! Form::select('status_laporan_id', $status_laporan, null, ['placeholder' => 'Pilih Status','class' => 'form-control']) !!}
                            {{ Form::hidden('surat_masuk_id', $surat_masuk_id, ['class' => 'form-control', 'style' => 'height:50px' ]) }}
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
    </section>
</div>






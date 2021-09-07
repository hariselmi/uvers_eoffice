<div class="modal-content" id="addStandardDetail">
    {{ Form::open(['url' => 'standarddetails', 'files' => true]) }}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">
        {{ __('Tambah Standar') }}
    </h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-10">
            <div class="form-group row">
                {{ Form::label('standard_id', trans('schedule.standard') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {!! Form::select('standard_id', $standards, null, ['placeholder' => 'Pilih Standar', 'onchange' => 'getStandardDetails(this)', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('standard_details', trans('standarddetail.name') . ' *', ['class' => 'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    {{ Form::text('standard_details', null, ['class' => 'form-control', 'required']) }}
                </div>
            </div>
        </div>


        <div style="width: 90%; margin:auto; margin-top: 70px">
            <a class="btn btn-primary pull-right add-record" data-added="0">
                <i class="glyphicon glyphicon-plus"></i>&nbsp;Add Row
            </a>
            <div class="tableFixHead">
                <table class="table table-bordered" id="tbl_posts">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 1%">No</th>
                            <th class="text-center">Dokumen</th>
                            <th class="text-center" style="width: 1%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbl_posts_body">
                        <tr id="rec-1">
                            <td class="text-center">
                                <span class="sn">1</span>.
                                <input type="hidden" name="id[]" value="0">
                            </td>
                            <td><input name='document[]' type='text' placeholder='Document'
                                    class='form-control input-md' required /></td>
                            <td class="text-center"><a class="btn btn-xs delete-record" data-id="1"><i
                                        class="glyphicon glyphicon-trash"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    @if (!empty($page))
        <input type="hidden" name="page" value="{{ $page }}" />
    @endif
    {{ Form::submit(trans('standarddetail.submit'), ['class' => 'btn btn-success']) }}
    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
</div>
{{ Form::close() }}
</div>

<script type="text/javascript" src="{{ asset('js/standarddetails.js') }}"></script>
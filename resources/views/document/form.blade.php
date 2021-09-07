@if (!empty($document))
<div class="modal-content" id="editDocument">
    {{ Form::model($document, ['route' => ['documents.update', $document->id], 'method' => 'PUT', 'files' => true]) }}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">
        @if (!empty($document)) {{ __('Edit Dokumen') }} @else
                {{ __('Add Dokumen') }}@endif
        </h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div style="width: 90%; margin:auto">
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
                            @if (count($documentDetails) > 0)
                                @foreach ($documentDetails as $index => $item)
                                    <tr id="rec-{{ $index + 1 }}">
                                        <td class="text-center">
                                            <span class="sn">{{ $index + 1 }}</span>.
                                            <input type="hidden" name="id[]" value="{{$item->id}}">
                                        </td>
                                        <td><input name='document[]' type='text' placeholder='Document'
                                                class='form-control input-md' required
                                                value="{{ $item->document }}" /></td>
                                        <td class="text-center"><a class="btn btn-xs delete-record"
                                                data-id="{{ $index + 1 }}"><i
                                                    class="glyphicon glyphicon-trash"></i></a></td>
                                    </tr>
                                @endforeach
                            @else
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
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            @if (!empty($page))
                <input type="hidden" name="page" value="{{ $page }}" />
            @endif
            {{ Form::submit(trans('document.submit'), ['class' => 'btn btn-success']) }}
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
        </div>
        {{ Form::close() }}
    </div>
@endif

@section('script')
<script type="text/javascript" src="{{ asset('js/angular.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/document.js') }}"></script>
@endsection

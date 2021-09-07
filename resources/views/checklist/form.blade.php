@if (!empty($checklist))
<div class="modal-content" id="editChecklist">
    {{ Form::model($checklist, ['route' => ['checklists.update', $checklist->id], 'method' => 'PUT', 'files' => true]) }}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">
        @if (!empty($checklist)) {{ __('Edit Checklist') }} @else
                {{ __('Add Checklist') }}@endif
        </h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div style="width: 90%; margin:auto">

                <a class="btn btn-primary pull-right add-record" data-added="0"><i
                        class="glyphicon glyphicon-plus"></i>&nbsp;Add Row</a>
                <div class="tableFixHead">
                    <table class="table table-bordered" id="tbl_posts">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:1%">No</th>
                                <th class="text-center">Referensi</th>
                                <th class="text-center">Pertanyaan</th>
                                <th class="text-center">Jawaban</th>
                                <th class="text-center">Catatan Khusus</th>
                                <th class="text-center">Audit Lapangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_posts_body">
                            @if (count($checklistDetails) > 0)
                                @foreach ($checklistDetails as $index => $item)
                                    <tr id="rec-{{ $index + 1 }}">
                                        <td class="text-center">
                                            <input type="hidden" name="id[]" value="{{$item->id}}">
                                            <span class="sn">{{ $index + 1 }}</span>.
                                        </td>
                                        <td><textarea class="form-control" name="reference[]" id="reference"
                                                rows="3" placeholder="Referensi"
                                                data-id='{{ $item->id }}'>{{ $item->reference }}</textarea></td>
                                        <td><textarea class="form-control" name="question[]" id="question" rows="3"
                                                placeholder="Pertanyaan">{{ $item->question }}</textarea></td>
                                        <td>
                                            <select class="form-select form-control"
                                                aria-label="Default select example" name="answer[]">
                                                @if ($item->answer == 1)
                                                    <option value="1" selected>Ya</option>
                                                    <option value="2">Tidak</option>
                                                @else
                                                    <option value="1">Ya</option>
                                                    <option value="2" selected>Tidak</option>
                                                @endif
                                            </select>
                                        </td>
                                        <td><textarea class="form-control" name="special_note[]" id="special_note"
                                                rows="3"
                                                placeholder="Catatan Khusus">{{ $item->special_note }}</textarea>
                                        </td>
                                        <td><textarea class="form-control" name="audit[]" id="audit" rows="3"
                                                placeholder="Audit Lapangan">{{ $item->audit }}</textarea></td>
                                        <td class="text-center"><a class="btn btn-xs delete-record"
                                                data-id="{{ $index + 1 }}"><i
                                                    class="glyphicon glyphicon-trash"></i></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr id="rec-1">
                                    <td class="text-center">
                                        <input type="hidden" name="id[]" value="0">
                                        <span class="sn">1</span>.
                                    </td>
                                    <td><textarea class="form-control" name="reference[]" id="reference" rows="3"
                                            placeholder="Referensi"></textarea></td>
                                    <td><textarea class="form-control" name="question[]" id="question" rows="3"
                                            placeholder="Pertanyaan"></textarea></td>
                                    <td>
                                        <select class="form-select form-control" aria-label="Default select example"
                                            name="answer[]">
                                            <option value="1">Ya</option>
                                            <option value="2">Tidak</option>
                                        </select>
                                    </td>
                                    <td><textarea class="form-control" name="special_note[]" id="special_note"
                                            rows="3" placeholder="Catatan Khusus"></textarea></td>
                                    <td><textarea class="form-control" name="audit[]" id="audit" rows="3"
                                            placeholder="Audit Lapangan"></textarea></td>
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
            {{ Form::submit(trans('checklist.submit'), ['class' => 'btn btn-success']) }}
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
        </div>
        {{ Form::close() }}
    </div>
@endif

@section('script')
<script type="text/javascript" src="{{ asset('js/angular.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/checklist.js') }}"></script>
@endsection

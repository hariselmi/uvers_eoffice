@if (!empty($finding))
<div class="modal-content" id="editFinding">
    {{ Form::model($finding, ['route' => ['findings.update', $finding->id], 'method' => 'PUT', 'files' => true]) }}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">
        @if (!empty($finding)) {{ __('Edit Temuan') }} @else
                {{ __('Tambah Temuan') }}@endif
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
                                <th class="text-center">KTS/OB</th>
                                <th class="text-center">Referensi</th>
                                <th class="text-center">Pernyataan</th>
                                <th class="text-center">Jawaban</th>
                                <th class="text-center">Alasan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_posts_body">
                            @if (count($findingDetails) > 0)
                                @foreach ($findingDetails as $index => $item)
                                    <tr id="rec-{{ $index + 1 }}">
                                        <td class="text-center">
                                            <input type="hidden" name="id[]" value="{{$item->id}}">
                                            <span class="sn">{{ $index + 1 }}</span>.
                                        </td>
                                        <td>
                                            <select class="form-select form-control"
                                                aria-label="Default select example" id="category" name="category[]">
                                                @switch($item->category)
                                                    @case(1)
                                                        <option value="1" selected>KTS (Minor)</option>
                                                        <option value="2">KTS (Mayor)</option>
                                                        <option value="3">OB</option>
                                                    @break
                                                    @case(2)
                                                        <option value="1">KTS (Minor)</option>
                                                        <option value="2" selected>KTS (Mayor)</option>
                                                        <option value="3">OB</option>
                                                    @break
                                                    @case(3)
                                                        <option value="1">KTS (Minor)</option>
                                                        <option value="2">KTS (Mayor)</option>
                                                        <option value="3" selected>OB</option>
                                                    @break
                                                    @default

                                                @endswitch
                                            </select>
                                        </td>
                                        <td><textarea class="form-control" name="reference[]" id="reference"
                                                rows="3" placeholder="Referensi">{{ $item->reference }}</textarea>
                                        </td>
                                        <td><textarea class="form-control" name="statement[]" id="statement" rows="3"
                                                placeholder="Pernyataan">{{ $item->statement }}</textarea></td>
                                        <td>
                                            <select class="form-select form-control"
                                                aria-label="Default select example" id="answer" name="answer[]">
                                                @if ($item->answer == 1)
                                                    <option value="1" selected>Setuju</option>
                                                    <option value="2">Tidak Setuju</option>
                                                @else
                                                    <option value="1">Setuju</option>
                                                    <option value="2" selected>Tidak Setuju</option>
                                                @endif
                                            </select>
                                        </td>
                                        <td><textarea class="form-control" name="reason[]" id="reason" rows="3"
                                                placeholder="Alasan tidak setuju">{{ $item->reason }}</textarea></td>
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
                                    <td>
                                        <select class="form-select form-control" aria-label="Default select example"
                                            id="category" name="category[]">
                                            <option value="1">KTS (Minor)</option>
                                            <option value="2">KTS (Mayor)</option>
                                            <option value="3">OB</option>
                                        </select>
                                    </td>
                                    <td><textarea class="form-control" name="reference[]" id="reference" rows="3"
                                            placeholder="Referensi"></textarea></td>
                                    <td><textarea class="form-control" name="statement[]" id="statement" rows="3"
                                            placeholder="Pernyataan"></textarea></td>
                                    <td>
                                        <select class="form-select form-control" aria-label="Default select example"
                                            id="answer" name="answer[]">
                                            <option value="1">Setuju</option>
                                            <option value="2">Tidak Setuju</option>
                                        </select>
                                    </td>
                                    <td><textarea class="form-control" name="reason[]" id="reason" rows="3"
                                            placeholder="Alasan Tidak Setuju"></textarea></td>
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
            {{ Form::submit(trans('finding.submit'), ['class' => 'btn btn-success']) }}
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
        </div>
        {{ Form::close() }}


    </div>
@endif

@section('script')
<script type="text/javascript" src="{{ asset('js/angular.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/finding.js') }}"></script>
@endsection

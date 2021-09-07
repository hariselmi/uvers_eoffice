@if (!empty($verification))
<div class="modal-content" id="editVerification">
    {{ Form::model($verification, ['route' => ['verification.update', $verification->id], 'method' => 'PUT', 'files' => true]) }}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">
        {{ __('Edit Berita Acara') }}
        </h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div style="width: 90%; margin:auto">
                <div class="tableFixHead">
                    <table class="table table-bordered" id="tbl_posts">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 1%">No</th>
                                <th class="text-center">Catatan Tindak Lanjut</th>
                                <th class="text-center">Program Studi</th>
                                <th class="text-center">PIC</th>
                                <th class="text-center">Deadline</th>
                                <th class="text-center">Verifikasi</th>
                                <th class="text-center">Catatan Verifikasi</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_posts_body">
                                @foreach ($findingDetails as $index => $item)
                                    <tr id="rec-{{ $index + 1 }}">
                                        <td class="text-center">
                                            <span class="sn">{{ $index + 1 }}</span>.
                                            <input type="hidden" name="id[]" value="{{$item->id}}">
                                        </td>
                                        <td>{{ $item->respon }}</td>
                                        <td>{{ Get_field::get_data($item->division_id, 'divisions', 'title') }}</td>
                                        <td>{{ Get_field::get_data($item->auditee_id,'users','name') }}</td>
                                        <td>{{ $item->deadline }}</td>

                                        <td> 
                                            <select class="form-control" id="verification" name="verification[]">
                                                @if($item->verification == 1)
                                                  <option value="1" selected>Selesai</option>
                                                  <option value="2">Belum selesai</option>
                                                @else
                                                  <option value="1">Selesai</option>
                                                  <option value="2" selected>Belum selesai</option>
                                                @endif
                                            </select>
                                        </td>
                                        <td><input name='notes[]' type='text' placeholder='Catatan Verifikasi'
                                            class='form-control input-md' value="{{ $item->notes }}" /></td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            @if (!empty($page))
                <input type="hidden" name="page" value="{{ $page }}" />
            @endif
            {{ Form::submit(trans('verification.submit'), ['class' => 'btn btn-success']) }}
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
        </div>
        {{ Form::close() }}
    </div>
@endif

@section('script')
<script type="text/javascript" src="{{ asset('js/angular.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/verification.js') }}"></script>
@endsection

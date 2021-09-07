@if (!empty($agenda))
<div class="modal-content" id="editAgenda">
    {{ Form::model($agenda, ['route' => ['agenda.update', $agenda->id], 'method' => 'PUT', 'files' => true]) }}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">
        {{ __('Edit Berita Acara') }}
        </h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div style="width: 90%; margin:auto">

                <div class="row">

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="date">Tanggal</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{$period->date}}" aria-describedby="emailHelp">
                      </div>   

                      <div class="form-group">
                        <label for="participant">Peserta Rapat</label>
                        <textarea class="form-control" id="participant" name="participant" rows="1">{{$period->participant}}</textarea>
                      </div> 

                      <div class="form-group">
                        <label for="agenda">Agenda</label>
                        <textarea class="form-control" id="agenda" name="agenda" rows="1">{{$period->agenda}}</textarea>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="time">Waktu</label>
                        <input type="text" class="form-control" id="time" name="time" value="{{$period->time}}" aria-describedby="emailHelp">
                      </div> 

                      <div class="form-group">
                        <label for="pejabat1">Menyetujui</label>
                        <input type="text" class="form-control" id="pejabat1" name="pejabat1" value="{{$period->pejabat1}}" aria-describedby="emailHelp">
                      </div> 

                      <div class="form-group">
                        <label for="pejabat2">Penyusun</label>
                        <input type="text" class="form-control" id="pejabat2" name="pejabat2" value="{{$period->pejabat2}}" aria-describedby="emailHelp">
                      </div> 
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="location">Tempat</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{$period->location}}" aria-describedby="emailHelp">
                      </div> 

                      <div class="form-group">
                        <label for="jabatan1">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan1" name="jabatan1" value="{{$period->jabatan1}}" aria-describedby="emailHelp">
                      </div> 

                      <div class="form-group">
                        <label for="jabatan2">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan2" name="jabatan2" value="{{$period->jabatan2}}" aria-describedby="emailHelp">
                      </div> 
                    </div>
                </div>

                <div class="tableFixHead" style="height:auto;">
                    <table class="table table-bordered" id="tbl_posts">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 1%">No</th>
                                <th class="text-center">Temuan</th>
                                <th class="text-center">Tindak Lanjut</th>
                                <th class="text-center">Program Studi</th>
                                <th class="text-center">PIC</th>
                                <th class="text-center">Deadline</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_posts_body">
                                @foreach ($findingDetails as $index => $item)
                                    <tr id="rec-{{ $index + 1 }}">
                                        <td class="text-center">
                                            <span class="sn">{{ $index + 1 }}</span>.
                                            <input type="hidden" name="id[]" value="{{$item->id}}">
                                        </td>
                                        <td>{{ $item->statement }}</td>
                                        <td><input name='respon[]' type='text' placeholder='Tindak Lanjut'
                                            class='form-control input-md' value="{{ $item->respon }}" /></td>
                                        <td>{{ Get_field::get_data($item->division_id, 'divisions', 'title') }}</td>
                                        <td>{{ Get_field::get_data($item->auditee_id,'users','name') }}</td>
                                        <td><input name='deadline[]' type='date' placeholder='Deadline'
                                            class='form-control input-md' value="{{ $item->deadline }}" /></td>
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
            {{ Form::submit(trans('agenda.submit'), ['class' => 'btn btn-success']) }}
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
        </div>
        {{ Form::close() }}
    </div>
@endif

@section('script')
<script type="text/javascript" src="{{ asset('js/angular.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/agenda.js') }}"></script>
@endsection

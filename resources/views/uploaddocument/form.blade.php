@if (!empty($uploaddocument))
<div class="modal-content" id="editUploadDocument">
    {{ Form::model($uploaddocument, ['route' => ['uploaddocuments.update', $uploaddocument->id], 'method' => 'PUT', 'files' => true]) }}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">
        @if (!empty($uploaddocument)) {{ __('Upload Dokumen') }} @else
                {{ __('Upload Dokumen') }}@endif
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
                                <th class="text-center" style="width: 40%">Dokumen Diperlukan</th>
                                <th class="text-center" style="width: 40%">Dokumen Diupload</th>
                                <th class="text-center">Upload Dokumen</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_posts_body">
                            @if (count($documents) > 0)
                                @for ($i = 0; $i < count($documents); $i++)
                                    <tr id="rec-{{ $i + 1 }}">
                                        <td class="text-center"><span class="sn">{{ $i + 1 }}</span>.</td>
                                        <td>{{ $documents[$i]->document }}</td>
                                        <td> 
                                            <ol style="height:60px; overflow:auto">
                                                @for ($index = 0; $index < count($totalFile[$i]); $index++)
                                                    <li><a href="{{ asset('document/'.$totalFile[$i][$index]->document_upload) }}" target="_blank">{{ $totalFile[$i][$index]->document_file_name }}</a></li>
                                                @endfor
                                            </ol> 
                                        </td>
                                        <td style="width:20%">
                                            <input type="hidden" name="documentid[]" value="{{$documents[$i]->id}}">
                                            <input type="hidden" name="oldFile[]" value="{{$documents[$i]->document_file}}">
                                            <input name='documentFile{{$documents[$i]->id}}[]' type='file' placeholder='Upload Document' class='form-control input-md' value="{{ $documents[$i]->id }}" multiple/>
                                        </td>
                                    </tr>
                                @endfor

{{-- 
                                @foreach ($documents as $index => $item)
                                    <tr id="rec-{{ $index + 1 }}">
                                        <td class="text-center"><span class="sn">{{ $index + 1 }}</span>.</td>
                                        <td>{{ $item->document }}</td>

                                            <td>

                                                @for ($i = 0; $i < count($totalFile); $i++)
                                                {{$totalFile[$i]}} dokumen diupload
                                                @endfor
                                            
                                            </td>
                                            
                                        <td style="width:20%">
                                            <input type="hidden" name="documentid[]" value="{{$item->id}}">
                                            <input type="hidden" name="oldFile[]" value="{{$item->document_file}}">
                                            <input name='documentFile{{$item->id}}[]' type='file' placeholder='Upload Document' class='form-control input-md' value="{{ $item->id }}" multiple/>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            @else
                                <tr id="rec-1">
                                    <td style="text-align: center" colspan="3">Tidak ada data</td>
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
            {{ Form::submit(trans('uploaddocument.submit'), ['class' => 'btn btn-success']) }}
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
        </div>
        {{ Form::close() }}
    </div>
@endif

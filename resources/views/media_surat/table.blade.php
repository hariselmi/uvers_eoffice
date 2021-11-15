<div class="" id="MediaSuratTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Media Surat</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($semua_media_surat as $index=>$value)
                <tr>
                    <td class="text-center">{{ $index+1 }}</td>
                    <td class="text-left">{{ $value->nama }}</td>
                    <td class="text-left">{{ $value->keterangan }}</td>

                    <td class="item_btn_group">
                        @php
                            $actions = [ 
                                ['data-replace' => '#editMediaSurat', 'url' => '#editMediaSuratModal', 'ajax-url' => url('media-surat/' . $value->id . '/edit'), 'name' => ' Edit', 'icon' => 'pencil'],

                                ['url' => 'media-surat/' . $value->id, 'name' => 'delete']
                            ];
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$semua_media_surat, 'index_route'=>route('media-surat.index')])
</div>
<script type="text/javascript">
    $('#addMediaSuratModal').modal('hide');
    $('#editMediaSuratModal').modal('hide');
</script>

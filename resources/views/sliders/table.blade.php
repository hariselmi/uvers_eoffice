<div class="" id="slidersTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ trans('sliders.title') }}</th>
                <th>{{ trans('sliders.thumbnail') }}</th>
                <th>{{ trans('sliders.status') }}</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $value)
                <tr>
                    <td class="text-center">{{ $value->title }}</td>
                    <td class="text-center"><img src="{{asset('/images/slider/'.$value->thumbnail )}}" alt="" width="auto" height="100px"></td>
                    <td class="text-center">
                        @if ($value->status == 1 )
                            Active
                        @else
                            Non Active
                        @endif
                    </td>
                    <td class="item_btn_group">
                        @php
                            $actions = [
                                ['data-replace' => '#editSliders', 'url' => '#editSlidersModal', 'ajax-url' => url('sliders/' . $value->id . '/edit'), 'name' => ' Edit', 'icon' => 'pencil'],
                                ['url' => 'sliders/' . $value->id, 'name' => 'delete']
                            ];
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$sliders, 'index_route'=>route('sliders.index')])
</div>

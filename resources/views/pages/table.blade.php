<div class="" id="pagesTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ trans('pages.title') }}</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pages as $value)
                <tr>
                    <td>{{ $value->nama }}</td>
                    <td class="item_btn_group">
                        @php
                            $actions = [
                                ['data-replace' => '#editPages', 'url' => '#editPagesModal', 'ajax-url' => url('pages/' . $value->id . '/edit'), 'name' => ' Edit', 'icon' => 'pencil']
                            ];
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$pages, 'index_route'=>route('pages.index')])
</div>

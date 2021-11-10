<div class="" id="articleTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ trans('article.category') }}</th>
                <th>{{ trans('article.title') }}</th>
                <th>{{ trans('article.date') }}</th>
                <th>{{ trans('article.thumbnail') }}</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $index=>$value)
                <tr>
                    <td>
                        @if ($value->category == 1 )
                            Standar Mutu
                        @else
                            Agenda Kegiatan
                        @endif
                    </td>
                    <td>{{ $value->title }}</td>
                    <td>{{ date('d-m-Y', strtotime($value->date)) }}</td>
                    <td><img src="{{asset('/images/article/'.$value->thumbnail )}}" alt="" width="auto" height="100px"></td>
                    <td class="item_btn_group">
                        @php
                            $actions = [
                                ['data-replace' => '#editArticle', 'url' => '#editArticleModal', 'ajax-url' => url('articles/' . $value->id . '/edit'), 'name' => ' Edit', 'icon' => 'pencil'],
                                ['url' => 'articles/' . $value->id, 'name' => 'delete']
                            ];
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$articles, 'index_route'=>route('articles.index')])
</div>

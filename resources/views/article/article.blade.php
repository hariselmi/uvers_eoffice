<div class="" id="articleDetails">
    <!-- Content Header (Page header) -->
    @if (auth()->user()->checkSpPermission('articles.create'))
    <section class="content-header m-3">
        <h1>{{ __('Artikel') }}
            <a class="btn btn-small btn-success pull-right" href="#addArticleModal" data-toggle='modal'>
                <i class="fa fa-plus"></i>&nbsp; {{ __('Tambah') }}</a>
        </h1>
    </section>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/articles'), 'filter_id'=>'articleFilter'])
                    </div>
                    <div class="box-body">
                        @include('article.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addArticleModal">
            <div class="modal-dialog modal-lg">
                @include('article.formadd', ['article'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editArticleModal">
            <div class="modal-dialog modal-lg">
                <div id="editArticle"></div>
            </div>
        </div>
        <div class="modal fade sub-modal" id="showArticleModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showArticle"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

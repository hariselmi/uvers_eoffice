<div class="" id="pagesDetails">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>{{ __('Halaman') }}
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/pages'), 'filter_id'=>'pagesFilter'])
                    </div>
                    <div class="box-body">
                        @include('pages.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="editPagesModal">
            <div class="modal-dialog modal-lg">
                <div id="editPages"></div>
            </div>
        </div>
        <div class="modal fade sub-modal" id="showPagesModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showPages"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

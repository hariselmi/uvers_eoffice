<div class="" id="PerintahDisposisi">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>Kelola Perintah Disposisi
            <a class="btn btn-small btn-success pull-right" href="#addPerintahDisposisiModal" data-toggle='modal'>
                <i class="fa fa-plus"></i> Tambah</a>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/perintah-disposisi'), 'filter_id'=>'PerintahDisposisiFilter'])
                    </div>
                    <div class="box-body">
                        @include('perintah_disposisi.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addPerintahDisposisiModal">
            <div class="modal-dialog modal-lg">
                @include('perintah_disposisi.formadd', ['perintah_disposisi'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editPerintahDisposisiModal">
            <div class="modal-dialog modal-lg">
                @include('perintah_disposisi.formedit', ['perintah_disposisi'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="showPerintahDisposisiModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showPerintahDisposisi"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

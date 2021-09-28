<div class="" id="JenisSurat">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>Kelola Jenis Surat
            <a class="btn btn-small btn-success pull-right" href="#addJenisSuratModal" data-toggle='modal'>
                <i class="fa fa-plus"></i> Tambah</a>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/jenis-surat'), 'filter_id'=>'JenisSuratFilter'])
                    </div>
                    <div class="box-body">
                        @include('jenis_surat.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addJenisSuratModal">
            <div class="modal-dialog modal-lg">
                @include('jenis_surat.formadd', ['jenis_surat'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editJenisSuratModal">
            <div class="modal-dialog modal-lg">
                @include('jenis_surat.formedit', ['jenis_surat'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="showJenisSuratModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showJenisSurat"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

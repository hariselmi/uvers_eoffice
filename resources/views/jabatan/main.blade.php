<div class="" id="Jabatan">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>Kelola Jabatan
            <a class="btn btn-small btn-success pull-right" href="#addJabatanModal" data-toggle='modal'>
                <i class="fa fa-plus"></i> Tambah</a>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/jabatan'), 'filter_id'=>'JabatanFilter'])
                    </div>
                    <div class="box-body">
                        @include('jabatan.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addJabatanModal">
            <div class="modal-dialog modal-lg">
                @include('jabatan.formadd', ['jabatan'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editJabatanModal">
            <div class="modal-dialog modal-lg">
                @include('jabatan.formedit', ['jabatan'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="showJabatanModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showJabatan"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

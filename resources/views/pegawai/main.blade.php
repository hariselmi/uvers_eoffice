<div class="" id="Pegawai">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>Kelola Pegawai
            <a class="btn btn-small btn-success pull-right" href="#addPegawaiModal" data-toggle='modal'>
                <i class="fa fa-plus"></i> Tambah</a>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/pegawai'), 'filter_id'=>'PegawaiFilter'])
                    </div>
                    <div class="box-body">
                        @include('pegawai.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addPegawaiModal">
            <div class="modal-dialog modal-lg">
                @include('pegawai.formadd', ['pegawai'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editPegawaiModal">
            <div class="modal-dialog modal-lg">
                @include('pegawai.formedit', ['pegawai'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="showPegawaiModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showPegawai"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

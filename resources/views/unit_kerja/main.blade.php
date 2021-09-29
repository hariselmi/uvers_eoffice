<div class="" id="UnitKerja">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>Kelola Unit Kerja
            <a class="btn btn-small btn-success pull-right" href="#addUnitKerjaModal" data-toggle='modal'>
                <i class="fa fa-plus"></i> Tambah</a>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/unit-kerja'), 'filter_id'=>'UnitKerjaFilter'])
                    </div>
                    <div class="box-body">
                        @include('unit_kerja.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addUnitKerjaModal">
            <div class="modal-dialog modal-lg">
                @include('unit_kerja.formadd', ['unit_kerja'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editUnitKerjaModal">
            <div class="modal-dialog modal-lg">
                @include('unit_kerja.formedit', ['unit_kerja'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="showUnitKerjaModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showUnitKerja"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

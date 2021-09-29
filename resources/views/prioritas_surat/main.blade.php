<div class="" id="PrioritasSurat">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>Kelola Prioritas Surat
            <a class="btn btn-small btn-success pull-right" href="#addPrioritasSuratModal" data-toggle='modal'>
                <i class="fa fa-plus"></i> Tambah</a>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/prioritas-surat'), 'filter_id'=>'PrioritasSuratFilter'])
                    </div>
                    <div class="box-body">
                        @include('prioritas_surat.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addPrioritasSuratModal">
            <div class="modal-dialog modal-lg">
                @include('prioritas_surat.formadd', ['prioritas_surat'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editPrioritasSuratModal">
            <div class="modal-dialog modal-lg">
                @include('prioritas_surat.formedit', ['prioritas_surat'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="showPrioritasSuratModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showPrioritasSurat"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

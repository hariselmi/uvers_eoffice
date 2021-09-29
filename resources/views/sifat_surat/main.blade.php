<div class="" id="SifatSurat">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>Kelola Sifat Surat
            <a class="btn btn-small btn-success pull-right" href="#addSifatSuratModal" data-toggle='modal'>
                <i class="fa fa-plus"></i> Tambah</a>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/sifat-surat'), 'filter_id'=>'SifatSuratFilter'])
                    </div>
                    <div class="box-body">
                        @include('sifat_surat.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addSifatSuratModal">
            <div class="modal-dialog modal-lg">
                @include('sifat_surat.formadd', ['sifat_surat'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editSifatSuratModal">
            <div class="modal-dialog modal-lg">
                @include('sifat_surat.formedit', ['sifat_surat'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="showSifatSuratModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showSifatSurat"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

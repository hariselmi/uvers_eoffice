<div class="" id="suratKeluarDetails">
    <!-- Content Header (Page header) -->

    <section class="content-header m-3">
        <h1>{{ __('Daftar Surat Internal') }}
            <a class="btn btn-small btn-success pull-right" href="#addSuratKeluarModal" data-toggle='modal'>
                <i class="fa fa-plus"></i>&nbsp; {{ __('Buat Surat') }}</a>
        </h1>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/surat-keluar'), 'filter_id'=>'suratKeluarFilter'])
                    </div>
                    <div class="box-body">
                        @include('surat_keluar.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addSuratKeluarModal">
            <div class="modal-dialog modal-lg">
                @include('surat_keluar.formadd', ['surat_keluar'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editSuratKeluarModal">
            <div class="modal-dialog modal-lg">
                @include('surat_keluar.formedit', ['surat_keluar'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="showSuratKeluarModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showSuratKeluar"></div>
            </div>
        </div>
        <div class="modal fade sub-modal" id="posisiSuratKeluarModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="posisiSuratKeluar"></div>
            </div>
        </div>
        <div class="modal fade sub-modal" id="disposisiSuratKeluarModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="disposisiSuratKeluar"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

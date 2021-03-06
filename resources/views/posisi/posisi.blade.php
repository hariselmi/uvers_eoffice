<div class="" id="suratMasukDetails">
    <!-- Content Header (Page header) -->

    <section class="content-header m-3">
        <h1>{{ __('Surat Masuk') }}
            <a class="btn btn-small btn-success pull-right" href="#addSuratMasukModal" data-toggle='modal'>
                <i class="fa fa-plus"></i>&nbsp; {{ __('Tambah') }}</a>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/surat-masuk'), 'filter_id'=>'suratMasukFilter'])
                    </div>
                    <div class="box-body">
                        @include('surat_masuk.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addSuratMasukModal">
            <div class="modal-dialog modal-lg">
                @include('surat_masuk.formadd', ['surat_masuk'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editSuratMasukModal">
            <div class="modal-dialog modal-lg">
                @include('surat_masuk.formedit', ['surat_masuk'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="showSuratMasukModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showSuratMasuk"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

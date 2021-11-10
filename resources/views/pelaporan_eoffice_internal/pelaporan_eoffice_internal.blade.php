<div class="" id="pelaporanEofficeInternalDetails">
    <!-- Content Header (Page header) -->

    <section class="content-header m-3">
        <h1>{{ __('Pelaporan') }} </h1>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/pelaporan-eoffice-internal'), 'filter_id'=>'pelaporanEofficeInternalFilter'])
                    </div>
                    <div class="box-body">
                        @include('pelaporan_eoffice_internal.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="laporanPelaporanEofficeInternalModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="laporanPelaporanEofficeInternal"></div>
            </div>
        </div>

        <div class="modal fade sub-modal" id="validasiPelaporanEofficeInternalModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="validasiPelaporanEofficeInternal"></div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

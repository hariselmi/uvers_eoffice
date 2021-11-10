<div class="" id="pelaporanRepositoriInternalDetails">
    <!-- Content Header (Page header) -->

    <section class="content-header m-3">
        <h1>{{ __('Repositori') }} </h1>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/pelaporan-eoffice-internal'), 'filter_id'=>'pelaporanRepositoriInternalFilter'])
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
        <div class="modal fade sub-modal" id="laporanPelaporanRepositoriInternalModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="laporanPelaporanRepositoriInternal"></div>
            </div>
        </div>

        <div class="modal fade sub-modal" id="validasiPelaporanRepositoriInternalModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="validasiPelaporanRepositoriInternal"></div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

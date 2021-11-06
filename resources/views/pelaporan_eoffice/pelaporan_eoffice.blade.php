<div class="" id="pelaporanEofficeDetails">
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
                        @include('partials.filters', ['filter_route'=>url('/pelaporan-eoffice'), 'filter_id'=>'pelaporanEofficeFilter'])
                    </div>
                    <div class="box-body">
                        @include('pelaporan_eoffice.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="laporanPelaporanEofficeModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="laporanPelaporanEoffice"></div>
            </div>
        </div>

        <div class="modal fade sub-modal" id="validasiPelaporanEofficeModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="validasiPelaporanEoffice"></div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

<div class="" id="pelaporanRepositori">
    <!-- Content Header (Page header) -->

    <section class="content-header m-3">
        <h1>{{ __('Repositori Surat Masuk') }} </h1>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/pelaporan-repositori'), 'filter_id'=>'pelaporanEofficeFilter'])
                    </div>
                    <div class="box-body">
                        @include('pelaporan_repositori.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="lihatRepositoriModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="lihatRepositori"></div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

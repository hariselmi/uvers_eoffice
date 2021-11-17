<div class="" id="pelaporanRepositoriInternal">
    <!-- Content Header (Page header) -->

    <section class="content-header m-3">
        <h1>{{ __('Repositori Surat Internal') }} </h1>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/pelaporan-repositori-internal'), 'filter_id'=>'pelaporanRepositoriInternalFilter'])
                    </div>
                    <div class="box-body">
                        @include('pelaporan_repositori_internal.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="lihatRepositoriInternalModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="lihatRepositoriInternal"></div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

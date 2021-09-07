<div class="" id="periodDetails">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>{{ __('Periode') }}
            <a class="btn btn-small btn-success pull-right" href="#addPeriodModal" data-toggle='modal'>
                <i class="fa fa-plus"></i>&nbsp; {{ __('Tambah') }}</a>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/period'), 'filter_id'=>'periodFilter'])
                    </div>
                    <div class="box-body">
                        @include('period.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addPeriodModal">
            <div class="modal-dialog modal-lg">
                @include('period.formadd', ['period'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editPeriodModal">
            <div class="modal-dialog modal-lg">
                <div id="editPeriod"></div>
            </div>
        </div>
        <div class="modal fade sub-modal" id="showPeriodModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showPeriod"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

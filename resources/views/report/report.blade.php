<div class="" id="reportDetails">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>{{ __('Laporan Audit') }}
            {{-- <a class="btn btn-small btn-success pull-right" href="#addReportModal" data-toggle='modal'>
      <i class="fa fa-plus"></i>&nbsp; {{__('Add')}}</a></h1> --}}
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/reports'), 'filter_id'=>'reportFilter'])
                    </div>
                    <div class="box-body">
                        @include('report.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addReportModal">
            <div class="modal-dialog modal-lg">
                @include('report.form', ['report'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editReportModal">
            <div class="modal-dialog modal-lg">
                <div id="editReport"></div>
            </div>
        </div>
        <div class="modal fade sub-modal" id="showReportModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showReport"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

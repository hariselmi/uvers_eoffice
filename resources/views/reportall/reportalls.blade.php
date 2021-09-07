<div class="" id="reportallDetails">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>{{ __('Laporan Audit') }}
            {{-- <a class="btn btn-small btn-success pull-right" href="#addReportAllModal" data-toggle='modal'>
      <i class="fa fa-plus"></i>&nbsp; {{__('Add')}}</a></h1> --}}
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/reportalls'), 'filter_id'=>'reportallsFilter'])
                    </div>
                    <div class="box-body">
                        @include('reportall.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

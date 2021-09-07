<div class="" id="divisionDetails">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>{{ __('Unit') }}
            <a class="btn btn-small btn-success pull-right" href="#addDivisionModal" data-toggle='modal'>
                <i class="fa fa-plus"></i>&nbsp; {{ __('Tambah') }}</a>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/division'), 'filter_id'=>'divisionFilter'])
                    </div>
                    <div class="box-body">
                        @include('division.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addDivisionModal">
            <div class="modal-dialog modal-lg">
                @include('division.formadd', ['division'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editDivisionModal">
            <div class="modal-dialog modal-lg">
                <div id="editDivision"></div>
            </div>
        </div>
        <div class="modal fade sub-modal" id="showDivisionModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showDivision"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

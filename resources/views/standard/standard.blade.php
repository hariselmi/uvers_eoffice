<div class="" id="standardDetails">
    <!-- Content Header (Page header) -->
    @if (auth()->user()->checkSpPermission('standards.create'))
    <section class="content-header m-3">
        <h1>{{ __('Standar') }}
            <a class="btn btn-small btn-success pull-right" href="#addStandardModal" data-toggle='modal'>
                <i class="fa fa-plus"></i>&nbsp; {{ __('Tambah') }}</a>
        </h1>
    </section>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/standards'), 'filter_id'=>'standardFilter'])
                    </div>
                    <div class="box-body">
                        @include('standard.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addStandardModal">
            <div class="modal-dialog modal-lg">
                @include('standard.formadd', ['standard'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editStandardModal">
            <div class="modal-dialog modal-lg">
                @include('standard.formedit', ['standard'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="showStandardModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showStandard"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

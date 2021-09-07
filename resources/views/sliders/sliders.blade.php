<div class="" id="slidersDetails">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>{{ __('Slider') }}
            <a class="btn btn-small btn-success pull-right" href="#addSlidersModal" data-toggle='modal'>
                <i class="fa fa-plus"></i>&nbsp; {{ __('Tambah') }}</a>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/sliders'), 'filter_id'=>'slidersFilter'])
                    </div>
                    <div class="box-body">
                        @include('sliders.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addSlidersModal">
            <div class="modal-dialog modal-lg">
                @include('sliders.formadd', ['sliders'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editSlidersModal">
            <div class="modal-dialog modal-lg">
                <div id="editSliders"></div>
            </div>
        </div>
        <div class="modal fade sub-modal" id="showSlidersModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showSliders"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

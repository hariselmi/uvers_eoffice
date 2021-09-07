<div class="" id="scheduleDetails">
    <!-- Content Header (Page header) -->
    @if (auth()->user()->checkSpPermission('schedules.create'))
        <section class="content-header m-3">
            <h1>{{ trans('schedule.schedule') }}
                <a class="btn btn-small btn-success pull-right" href="#addScheduleModal" data-toggle='modal'>
                    <i class="fa fa-plus"></i>&nbsp; {{ trans('schedule.add') }}</a>
            </h1>
        </section>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/schedules'), 'filter_id'=>'scheduleFilter'])
                    </div>
                    <div class="box-body">
                        @include('schedule.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addScheduleModal">
            <div class="modal-dialog modal-lg">
                @include('schedule.formadd', ['schedule'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editScheduleModal">
            <div class="modal-dialog modal-lg">
                @include('schedule.formedit', ['schedule'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="showScheduleModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showSchedule"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
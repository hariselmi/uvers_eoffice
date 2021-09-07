<div class="modal-content" id="showSchedule">
    <section class="content-header">
        <h1><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            {{-- {{__('Jadwal')}}</h1> --}}
    </section>
    <!-- Main content -->
    <section class="content">
        @include('partials.flash')
        <div class="row">
            <div class="col-md-12">
                <!-- Profile Image -->
                <div class="box box-success">
                    <div class="box-body box-profile">
                        {{-- <img class="profile-user-img img-responsive img-circle" src="{{$avatar}}" alt="User profile picture"> --}}
                        <h3 class="profile-username text-center">Jadwal</h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Auditor</b> <a class="pull-right">{{ $scheduleShow->auditor_name }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Auditee</b> <a class="pull-right">{{ $scheduleShow->auditee_name }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Unit</b> <a class="pull-right">{{                              Get_field::get_data($scheduleShow->division_id, 'divisions', 'title') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Standar</b> <a class="pull-right">{{ $scheduleShow->standard }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Standar Detail</b> <a class="pull-right">{{ $scheduleShow->standard_details }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Periode</b> <a class="pull-right">{{ Get_field::get_data($scheduleShow->period_id, 'periods', 'title') }} {{ Get_field::get_data($scheduleShow->period_id, 'periods', 'semester') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Tanggal Audit</b> <a class="pull-right">{{ Get_field::format_indo($scheduleShow->schedule_date) }}</a>
                            </li>
                             <li class="list-group-item hidden-print">
                                <b>Jam Audit</b> <a class="pull-right">{!!Get_field::get_data($scheduleShow->clock_start_id, 'clock', 'nama')!!} - {!!Get_field::get_data($scheduleShow->clock_finish_id, 'clock', 'nama')!!}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Anggota 1</b> <a class="pull-right">{{ Get_field::get_data($scheduleShow->member_one, 'users', 'name') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Anggota 2</b> <a class="pull-right">{{ Get_field::get_data($scheduleShow->member_two, 'users', 'name') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Status</b> <a class="pull-right">
                                    @switch($scheduleShow->status)
                                        @case(1)
                                            Pending
                                            @break
                                        @case(2)
                                            Process
                                            @break
                                        @case(3)
                                            Complete
                                            @break
                                        @case(4)
                                            Cancel
                                            @break
                                        @default
                                            
                                    @endswitch
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div>

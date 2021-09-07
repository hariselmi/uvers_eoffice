<div class="modal-content" id="showReport">

    <!-- Main content -->
    <section class="content">
        @include('partials.flash')
        <div class="row">
            <div class="col-md-12">
                <!-- Profile Image -->
                <div class="box box-success">
                    <div class="box-body box-profile">
                        {{-- <img class="profile-user-img img-responsive img-circle" src="{{$avatar}}" alt="User profile picture"> --}}
                        <h3 class="profile-username text-center">DAFTAR DOKUMEN AUDIT MUTU INTERNAL</h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Nama Audito </b> <a class="pull-right">{{ $report->auditor_name }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Nama Auditee </b> <a class="pull-right">{{ $report->auditee_name }}</a>
                            </li>
                             <li class="list-group-item hidden-print">
                                <b>Periode</b> <a class="pull-right">{{ Get_field::get_data($report->period_id,'periods','title') }} {{ Get_field::get_data($report->period_id,'periods','semester') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Tanggal Audit</b> <a class="pull-right">{{ $report->schedule_date }}</a>
                            </li>
                        </ul>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 1%; text-align:center">No</th>
                                    <th scope="col" style="text-align:center">Nama Dokumen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" style="text-align:center">1</th>
                                    <td>Mark</td>
                                </tr>
                            </tbody>
                        </table>
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

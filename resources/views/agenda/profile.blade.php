<div class="modal-content" id="showAgenda">
    <section class="content-header">
        <h1><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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
                        <h3 class="profile-username text-center">DAFTAR DOKUMEN AUDIT MUTU INTERNAL</h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Nama Auditor </b> <a class="pull-right">{{ $agenda->auditor_name }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Nama Auditee </b> <a class="pull-right">{{ $agenda->auditee_name }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Unit</b> <a class="pull-right">{{                              Get_field::get_data($agenda->division_id, 'divisions', 'title') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Periode</b> <a class="pull-right">{{ Get_field::get_data($agenda->period_id,'periods','title') }} {{ Get_field::get_data($agenda->period_id,'periods','semester') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Tanggal Audit</b> <a class="pull-right">{{ Get_field::format_indo($agenda->schedule_date) }}</a>
                            </li>
                             <li class="list-group-item hidden-print">
                                <b>Jam Audit</b> <a class="pull-right">{!!Get_field::get_data($agenda->clock_start_id, 'clock', 'nama')!!} - {!!Get_field::get_data($agenda->clock_finish_id, 'clock', 'nama')!!}</a>
                            </li>
                        </ul>
                        <div class="tableFixHead">
                            <table class="table table-bordered" id="tbl_posts">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 1%">No</th>
                                        <th class="text-center" style="width: 50%">Dokumen Diperlukan</th>
                                        <th class="text-center">Dokumen Diupload</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_posts_body">
                                    @if (count($agendas) > 0)
                                        @for ($i = 0; $i < count($agendas); $i++)
                                            <tr id="rec-{{ $i + 1 }}">
                                                <td class="text-center"><span class="sn">{{ $i + 1 }}</span>.</td>
                                                <td>{{ $agendas[$i]->agenda }}</td>
                                                <td> 
                                                    <ol style="height:60px; overflow:auto">
                                                        @for ($index = 0; $index < count($totalFile[$i]); $index++)
                                                            <li><a href="{{ asset('agenda/'.$totalFile[$i][$index]->agenda_upload) }}" target="_blank">{{ $totalFile[$i][$index]->agenda_file_name }}</a></li>
                                                        @endfor
                                                    </ol> 
                                                </td>
                                            </tr>
                                        @endfor
                                    @else
                                        <tr id="rec-1">
                                            <td style="text-align: center" colspan="3">Tidak ada data</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Tutup') }}</button>
    </div>
</div>

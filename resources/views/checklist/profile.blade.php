<div class="modal-content" id="showChecklist">

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
                        <h3 class="profile-username text-center">DAFTAR CHECKLIST AUDIT MUTU INTERNAL</h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Nama Auditor </b> <a class="pull-right">{{ $checklist->auditor_name }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Nama Auditee </b> <a class="pull-right">{{ $checklist->auditee_name }}</a>
                            </li>

<li class="list-group-item hidden-print">
                                <b>Unit</b> <a class="pull-right">{{                              Get_field::get_data($checklist->division_id, 'divisions', 'title') }}</a>
                            </li>

                            <li class="list-group-item hidden-print">
                                <b>Periode</b> <a class="pull-right">{{ Get_field::get_data($checklist->period_id,'periods','title') }} {{ Get_field::get_data($checklist->period_id,'periods','semester') }}</a>
                            </li>



                            <li class="list-group-item hidden-print">
                                <b>Tanggal Audit</b> <a class="pull-right">{{ Get_field::format_indo($checklist->schedule_date) }}</a>
                            </li>
                             <li class="list-group-item hidden-print">
                                <b>Jam Audit</b> <a class="pull-right">{!!Get_field::get_data($checklist->clock_start_id, 'clock', 'nama')!!} - {!!Get_field::get_data($checklist->clock_finish_id, 'clock', 'nama')!!}</a>
                            </li>
                        </ul>
                        <div class="tableFixHead">
                            <table class="table table-bordered ">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 1%;">No</th>
                                        <th scope="col" class="text-center">Referensi</th>
                                        <th scope="col" class="text-center">Pertanyaan</th>
                                        <th scope="col" class="text-center">Y</th>
                                        <th scope="col" class="text-center">T</th>
                                        <th scope="col" class="text-center">Catatan Khusus</th>
                                        <th scope="col" class="text-center">Audit Lapangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($checklistDetails) > 0)
                                        @foreach ($checklistDetails as $index => $item)
                                            <tr>
                                                <td class="text-center" scope="row">{{ $index + 1 }}</td>
                                                <td>{{ $item->reference }}</td>
                                                <td>{{ $item->question }}</td>
                                                <td class="text-center">
                                                    @if ($item->answer == 1)
                                                        <input type="checkbox" disabled checked>
                                                    @else
                                                        <input type="checkbox" disabled>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($item->answer == 2)
                                                        <input type="checkbox" disabled checked>
                                                    @else
                                                        <input type="checkbox" disabled>
                                                    @endif
                                                </td>
                                                <td>{{ $item->special_note }}</td>
                                                <td>{{ $item->audit }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <th colspan="7" style="text-align:center">Tidak ada checklist</th>
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

<div class="modal-content" id="showFinding">

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
                        <h3 class="profile-username text-center">DAFTAR TEMUAN AUDIT MUTU INTERNAL</h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Nama Auditor </b> <a class="pull-right">{{ $finding->auditor_name }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Nama Auditee </b> <a class="pull-right">{{ $finding->auditee_name }}</a>
                            </li>
                             <li class="list-group-item hidden-print">
                                <b>Divisi</b> <a class="pull-right">{{                              Get_field::get_data($finding->division_id, 'divisions', 'title') }}</a>
                            </li>
                             <li class="list-group-item hidden-print">
                                <b>Periode</b> <a class="pull-right">{{ Get_field::get_data($finding->period_id,'periods','title') }} {{ Get_field::get_data($finding->period_id,'periods','semester') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Tanggal Audit</b> <a class="pull-right">{{ Get_field::format_indo($finding->schedule_date) }}</a>
                            </li>
                             <li class="list-group-item hidden-print">
                                <b>Jam Audit</b> <a class="pull-right">{!!Get_field::get_data($finding->clock_start_id, 'clock', 'nama')!!} - {!!Get_field::get_data($finding->clock_finish_id, 'clock', 'nama')!!}</a>
                            </li>
                        </ul>
                        <div class="tableFixHead">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 1%; text-align:center">No</th>
                                        <th scope="col" style="text-align:center">KTS/OB</th>
                                        <th scope="col" style="text-align:center">Referensi</th>
                                        <th scope="col" style="text-align:center">Pernyataan</th>
                                        <th scope="col" style="width: 10%; text-align:center">Setuju</th>
                                        <th scope="col" style="width: 15%;text-align:center">Tidak Setuju</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($findingDetails) > 0)
                                        @foreach ($findingDetails as $index => $item)
                                            <tr>
                                                <th scope="row" style="text-align:center">{{ $index + 1 }}</th>
                                                <td>
                                                    @switch($item->category)
                                                        @case(1)
                                                            KTS (Minor)
                                                        @break
                                                        @case(2)
                                                            KTS (Mayor)
                                                        @break
                                                        @case(3)
                                                            OB
                                                        @break
                                                        @default

                                                    @endswitch
                                                </td>
                                                <td>{{ $item->reference }}</td>
                                                <td>{{ $item->statement }}</td>
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
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <th colspan="6" style="text-align:center">Tidak ada checklist</th>
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

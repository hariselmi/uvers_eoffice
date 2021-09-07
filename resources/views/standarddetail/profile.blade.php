<div class="modal-content" id="showStandardDetail">
    <section class="content-header">
        <h1><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            {{ __('Profil Standar') }}</h1>
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
                        <!-- <h3 class="profile-username text-center">{{ $standardDetail->name }}</h3> -->
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Standar</b> <a class="pull-right">{{ Get_field::get_data($standardDetail->standard_id,'standards','standard') }}</a>
                            </li>
                            <li class="list-group-item hidden-print">
                                <b>Standar Detail</b> <a class="pull-right">{{ $standardDetail->standard_details }}</a>
                            </li>
                        </ul>


                        <div class="tableFixHead">
                            <table class="table table-bordered" id="edit_tbl_posts">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 1%">No</th>
                                        <th class="text-center">Dokumen</th>
                                    </tr>
                                </thead>
                                <tbody id="edit_tbl_posts_body">
                                    @if (!empty($standardDetail))
                                        @foreach ($standardDocuments as $index => $item)
                                            <tr id="edit_rec-{{ $index + 1 }}">
                                                <td class="text-center">
                                                    <span class="sn">{{ $index + 1 }}</span>.
                                                    <input type="hidden" name="id[]" value="{{ $item->id }}">
                                                </td>
                                                <td>{{ $item->document }}</td>
                                            </tr>
                                        @endforeach
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
</div>
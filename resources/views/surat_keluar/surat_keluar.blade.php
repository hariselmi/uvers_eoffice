<div class="" id="memberDetails">
    <!-- Content Header (Page header) -->

    @if (auth()->user()->checkSpPermission('members.create'))
    <section class="content-header m-3">
        <h1>{{ __('Anggota') }}
            <a class="btn btn-small btn-success pull-right" href="#addMemberModal" data-toggle='modal'>
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
                        @include('partials.filters', ['filter_route'=>url('/members'), 'filter_id'=>'memberFilter'])
                    </div>
                    <div class="box-body">
                        @include('member.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addMemberModal">
            <div class="modal-dialog modal-lg">
                @include('member.formadd', ['member'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editMemberModal">
            <div class="modal-dialog modal-lg">
                @include('member.formedit', ['member'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="showMemberModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showMember"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

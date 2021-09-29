<div class="" id="MediaSurat">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>Kelola Media Surat
            <a class="btn btn-small btn-success pull-right" href="#addMediaSuratModal" data-toggle='modal'>
                <i class="fa fa-plus"></i> Tambah</a>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/media-surat'), 'filter_id'=>'MediaSuratFilter'])
                    </div>
                    <div class="box-body">
                        @include('media_surat.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addMediaSuratModal">
            <div class="modal-dialog modal-lg">
                @include('media_surat.formadd', ['media_surat'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editMediaSuratModal">
            <div class="modal-dialog modal-lg">
                @include('media_surat.formedit', ['media_surat'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="showMediaSuratModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showMediaSurat"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

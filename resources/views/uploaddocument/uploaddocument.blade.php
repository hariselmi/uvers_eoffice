<div class="" id="uploaddocumentDetails">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>{{ __('Upload Dokumen') }}
            {{-- <a class="btn btn-small btn-success pull-right" href="#addUploadDocumentModal" data-toggle='modal'>
      <i class="fa fa-plus"></i>&nbsp; {{__('Add')}}</a></h1> --}}
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/uploaddocuments'),
                        'filter_id'=>'uploaddocumentFilter'])
                    </div>
                    <div class="box-body">
                        @include('uploaddocument.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addUploadDocumentModal">
            <div class="modal-dialog modal-lg">
                @include('uploaddocument.form', ['uploaddocument'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editUploadDocumentModal">
            <div class="modal-dialog modal-lg">
                <div id="editUploadDocument"></div>
            </div>
        </div>
        <div class="modal fade sub-modal" id="showUploadDocumentModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showUploadDocument"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>


<div style="display:none;">
    <table id="sample_table">
        <tr id="">
            <td class="text-center"><span class="sn"></span>.</td>
            <td><input name='uploaddocument[]' type='text' placeholder='UploadDocument' class='form-control input-md'
                    required /></td>
            <td class="text-center"><a class="btn btn-xs delete-record" data-id="0"><i
                        class="glyphicon glyphicon-trash"></i></a></td>
        </tr>
    </table>
</div>

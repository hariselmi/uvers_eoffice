<div class="" id="documentDetails">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>{{ __('Daftar Dokumen') }}
            {{-- <a class="btn btn-small btn-success pull-right" href="#addDocumentModal" data-toggle='modal'>
      <i class="fa fa-plus"></i>&nbsp; {{__('Add')}}</a></h1> --}}
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/documents'), 'filter_id'=>'documentFilter'])
                    </div>
                    <div class="box-body">
                        @include('document.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addDocumentModal">
            <div class="modal-dialog modal-lg">
                @include('document.form', ['document'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editDocumentModal">
            <div class="modal-dialog modal-lg">
                <div id="editDocument"></div>
            </div>
        </div>
        <div class="modal fade sub-modal" id="showDocumentModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showDocument"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>


<div style="display:none;">
    <table id="sample_table">
        <tr id="">
            <td class="text-center">
                <span class="sn">1</span>.
                <input type="hidden" name="id[]" value="0">
            </td>
            <td><input name='document[]' type='text' placeholder='Document' class='form-control input-md' required />
            </td>
            <td class="text-center">
                <a class="btn btn-xs delete-record" data-id="0">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
            </td>
        </tr>
    </table>
</div>

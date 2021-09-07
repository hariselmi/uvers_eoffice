<div class="" id="standarddetailDetails">
    <!-- Content Header (Page header) -->
    @if (auth()->user()->checkSpPermission('standarddetails.create'))
    <section class="content-header m-3">
        <h1>{{ __('Standar') }}
            <a class="btn btn-small btn-success pull-right" href="#addStandardDetailModal" data-toggle='modal'>
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
                        @include('partials.filters', ['filter_route'=>url('/standarddetails'), 'filter_id'=>'standarddetailFilter'])
                    </div>
                    <div class="box-body">
                        @include('standarddetail.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addStandardDetailModal">
            <div class="modal-dialog modal-lg">
                @include('standarddetail.formadd', ['standarddetail'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editStandardDetailModal">
            <div class="modal-dialog modal-lg">
                @include('standarddetail.formedit', ['standarddetail'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="showStandardDetailModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showStandardDetail"></div>
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


<div style="display:none;">
    <table id="edit_sample_table">
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


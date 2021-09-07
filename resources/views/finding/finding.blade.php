<div class="" id="findingDetails">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>{{ __('Daftar Temuan') }}
            {{-- <a class="btn btn-small btn-success pull-right" href="#addFindingModal" data-toggle='modal'>
      <i class="fa fa-plus"></i>&nbsp; {{__('Add')}}</a></h1> --}}
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/findings'), 'filter_id'=>'findingFilter'])
                    </div>
                    <div class="box-body">
                        @include('finding.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addFindingModal">
            <div class="modal-dialog modal-lg">
                @include('finding.form', ['finding'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editFindingModal">
            <div class="modal-dialog modal-lg">
                <div id="editFinding"></div>
            </div>
        </div>
        <div class="modal fade sub-modal" id="showFindingModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showFinding"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>


<div style="display:none;">
    <table id="sample_table">
        <tr id="">
            <td class="text-center">
                <input type="hidden" name="id[]" value="0">
                <span class="sn">1</span>.
            </td>
            <td>
                <select class="form-select form-control" aria-label="Default select example" id="category"
                    name="category[]">
                    <option value="1">KTS (Minor)</option>
                    <option value="2">KTS (Mayor)</option>
                    <option value="3">OB</option>
                </select>
            </td>
            <td><textarea class="form-control" name="reference[]" id="reference" rows="3"
                    placeholder="Referensi"></textarea></td>
            <td><textarea class="form-control" name="statement[]" id="statement" rows="3"
                    placeholder="Pernyataan"></textarea></td>
            <td>
                <select class="form-select form-control" aria-label="Default select example" id="answer"
                    name="answer[]">
                    <option value="1">Setuju</option>
                    <option value="2">Tidak Setuju</option>
                </select>
            </td>
            <td><textarea class="form-control" name="reason[]" id="reason" rows="3"
                    placeholder="Alasan Tidak Setuju"></textarea></td>
            <td class="text-center"><a class="btn btn-xs delete-record" data-id="0"><i
                        class="glyphicon glyphicon-trash"></i></a></td>
        </tr>
    </table>
</div>

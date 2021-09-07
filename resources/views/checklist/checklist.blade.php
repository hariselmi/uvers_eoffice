<div class="" id="checklistDetails">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>{{ __('Daftar Checklist') }}
            {{-- <a class="btn btn-small btn-success pull-right" href="#addChecklistModal" data-toggle='modal'>
      <i class="fa fa-plus"></i>&nbsp; {{__('Add')}}</a></h1> --}}
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/checklists'),
                        'filter_id'=>'checklistFilter'])
                    </div>
                    <div class="box-body">
                        @include('checklist.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addChecklistModal">
            <div class="modal-dialog modal-lg">
                @include('checklist.form', ['checklist'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editChecklistModal">
            <div class="modal-dialog modal-lg">
                <div id="editChecklist"></div>
            </div>
        </div>
        <div class="modal fade sub-modal" id="showChecklistModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showChecklist"></div>
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
            <td><textarea class="form-control" name="reference[]" id="reference" rows="3"
                    placeholder="Referensi"></textarea></td>
            <td><textarea class="form-control" name="question[]" id="question" rows="3"
                    placeholder="Pertanyaan"></textarea></td>
            <td>
                <select class="form-select form-control" aria-label="Default select example" name="answer[]">
                    <option value="1">Ya</option>
                    <option value="2">Tidak</option>
                </select>
            </td>
            <td><textarea class="form-control" name="special_note[]" id="special_note" rows="3"
                    placeholder="Catatan Khusus"></textarea></td>
            <td><textarea class="form-control" name="audit[]" id="audit" rows="3"
                    placeholder="Audit Lapangan"></textarea></td>
            <td class="text-center"><a class="btn btn-xs delete-record" data-id="0"><i
                        class="glyphicon glyphicon-trash"></i></a></td>
        </tr>
    </table>
</div>

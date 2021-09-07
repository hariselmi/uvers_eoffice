<div class="" id="agendaDetails">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>{{ __('Berita Acara') }}
            {{-- <a class="btn btn-small btn-success pull-right" href="#addAgendaModal" data-toggle='modal'>
      <i class="fa fa-plus"></i>&nbsp; {{__('Add')}}</a></h1> --}}
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/agenda'), 'filter_id'=>'agendaFilter'])
                    </div>
                    <div class="box-body">
                        @include('agenda.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addAgendaModal">
            <div class="modal-dialog modal-lg">
                @include('agenda.form', ['agenda'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editAgendaModal">
            <div class="modal-dialog modal-lg">
                <div id="editAgenda"></div>
            </div>
        </div>
        <div class="modal fade sub-modal" id="showAgendaModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showAgenda"></div>
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
            <td><input name='agenda[]' type='text' placeholder='Agenda' class='form-control input-md' required />
            </td>
            <td class="text-center">
                <a class="btn btn-xs delete-record" data-id="0">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
            </td>
        </tr>
    </table>
</div>

<div class="" id="verificationDetails">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
        <h1>{{ __('Verifikasi Tindak Lanjut') }}
            {{-- <a class="btn btn-small btn-success pull-right" href="#addVerificationModal" data-toggle='modal'>
      <i class="fa fa-plus"></i>&nbsp; {{__('Add')}}</a></h1> --}}
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        @include('partials.filters', ['filter_route'=>url('/verification'), 'filter_id'=>'verificationFilter'])
                    </div>
                    <div class="box-body">
                        @include('verification.table')
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade sub-modal" id="addVerificationModal">
            <div class="modal-dialog modal-lg">
                @include('verification.form', ['verification'=>''])
            </div>
        </div>
        <div class="modal fade sub-modal" id="editVerificationModal">
            <div class="modal-dialog modal-lg">
                <div id="editVerification"></div>
            </div>
        </div>
        <div class="modal fade sub-modal" id="showVerificationModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="showVerification"></div>
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
            <td><input name='verification[]' type='text' placeholder='Verification' class='form-control input-md' required />
            </td>
            <td class="text-center">
                <a class="btn btn-xs delete-record" data-id="0">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
            </td>
        </tr>
    </table>
</div>

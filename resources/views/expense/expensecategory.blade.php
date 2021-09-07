@extends('layouts.admin_dynamic')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header m-3">
      <h1>{{__('Expense Category')}}<a class="btn btn-small btn-success pull-right" href="#expenseCategoryAdd" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp; {{__('Create Expense Category')}}</a></h1>
      {{-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
        <li><a href="#">{{__('Expense Category')}}</a></li>
        <li class="active">{{__('All')}}</li>
      </ol> --}}
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <!-- /.box-header -->
          <!-- /.box -->
            
          {{-- <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">{{__('Expense Category List')}}</h3>
            </div>
          </div> --}}
            <!-- /.box-header -->
            <div class="box box-success">
              <div class="box-header">
                @include('expense.add_category_btn', ['page'=>'expense-category'])
              </div>
            <div class="box-body">
              <div id="expenseTable">
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="modal fade" id="expenseCategoryAdd">
        <div class="modal-dialog">
          @include('expense.category_form', ['page'=>'expense-category'])
        </div>
      </div>
      <div class="modal fade sub-modal" id="editExpenseModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="editExpense"></div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection

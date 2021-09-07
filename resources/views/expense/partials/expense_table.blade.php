<div id="expenseTable">
@if(!empty($expenses))
<table id="myTableExpense" class="table table-bordered table-hover table-striped table-responsive">
    <thead>
        <tr>
            <th>{{__('Created at')}}</th>
            <th class="hidden-xs">{{__('Qty')}}</th>
            <th class="hidden-xs">{{__('Unit Price')}}</th>
            <th>{{__('Total')}}</th>
            <th>{{__('Payment')}}</th>
            <th class="hidden-xs">{{__('Dues')}}</th>
            <th class="hidden-xs">{{__('Category')}}</th>
            <th width="50" class="hidden-xs">{{__('Type')}}</th>
            <th class="hidden-xs">{{__('Created By')}}</th>
            <th class="text-center">{{__('Action')}}</th>
        </tr>
    </thead>
    <tbody>
      @foreach($expenses as $value)
      <tr>
        <td>{{ $value->created_at->format('d M, Y') }}</td>
        <td class="hidden-xs">{{ $value->qty }}</td>
        <td class="hidden-xs">{{ $value->unit_price }}</td>
        <td>{{ $value->total }}</td>
        <td>{{$value->payment}}</td>
        <td class="hidden-xs">{{$value->dues}}</td>
        <td class="hidden-xs">{{$value->expense_category->name}}</td>
        <td class="hidden-xs">{{$value->payment_type}}</td>
        <td class="hidden-xs">{{$value->user->name}}</td>
        <td class="item_btn_group">
            {{-- <div class="btn-group">
              <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-list"></i><span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('expense/'.$value->id.'/edit') }}"><i class="fa fa-pencil"></i> {{trans('expense.edit')}}</a></li>
                <li>
                    <a href="#" class="delete-form" onclick="return confirm('are you sure?')"><i class="fa fa-trash-o"></i>{{ Form::open(array('url' => 'expense/' . $value->id, 'class' => 'form-inline')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit(trans('expense.delete'), array('class' => 'delete-btn')) }}
                {{ Form::close() }}</a></li>
              </ul>
            </div> --}}
            @php
            $actions = [
              ['data-replace'=>'#editExpense','url'=>'#editExpenseModal','ajax-url'=>url('expense/'.$value->id.'/edit'), 'name'=>trans('item.edit'), 'icon'=>'pencil'],
              ['url'=>'expense/' . $value->id,'name'=>'delete']];
            @endphp
            @include('partials.actions', ['actions'=>$actions])
        </td>
      </tr>
      @endforeach
  </tbody>
</table>
@include('partials.pagination', ['items'=>$expenses, 'index_route'=>$index_route])
@endif

</div>
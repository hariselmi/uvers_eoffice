<div id="transactionTable">
    <table id="myTableTransaction" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>{{__('Created at')}}</th>
            <th>{{__('Transaction Type')}}</th>
            <th>{{__('Amount')}}</th>
            <th class="hidden-xs">{{__('Company')}}</th>
            <th class="hidden-xs">{{__('Created By')}}</th>
            <th class="text-center">{{__('Action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($transactions as $value)
            <tr>
                <td>{{ $value->created_at->format('d M, Y') }}</td>
                @if($value->transaction_type == 1)
                <td>{{__('Payment')}}</td>
                @elseif($value->transaction_type == 2)
                <td>{{__('Receipt')}}</td>
                @else
                <td>{{__('Charge')}}</td>
                @endif
                <td>{{ $value->amount}}</td>
                <td class="hidden-xs">{{ $value->account->company }}</td>
                <td class="hidden-xs">{{$value->user->name}}</td>
                <td class="item_btn_group">
                    @php
                    $actions = [
                      ['data-replace'=>'#editTransaction','url'=>'#editTransactionModal','ajax-url'=>url('transactions/'.$value->id.'/edit'), 'name'=>trans('item.edit'), 'icon'=>'pencil'],
                      ['url'=>'transactions/' . $value->id,'name'=>'delete']];
                    @endphp
                    @include('partials.actions', ['actions'=>$actions])
                    {{-- <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-list"></i><span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('transactions/' . $value->id . '/edit') }}"><i class="fa fa-pencil"></i> {{trans('transaction.edit')}}</a></li>
                            <li>
                                <a href="#" class="delete-form" onclick="return confirm('are you sure?')"><i class="fa fa-trash-o"></i>{{ Form::open(array('url' => 'transactions/' . $value->id, 'class' => 'form-inline')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit(trans('transaction.delete'), array('class' => 'delete-btn')) }}
                                {{ Form::close() }}</a></li>
                        </ul>
                    </div> --}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$transactions, 'index_route'=>route('transactions.index')])
</div>
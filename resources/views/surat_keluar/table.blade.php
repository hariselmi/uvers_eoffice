<div class="" id="memberTable">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                {{-- <th width="50" class="hidden-xs">{{trans('member.customer_id')}}</th> --}}
                <th>{{ trans('member.chief_auditor') }}</th>
                <th>{{ trans('member.member_name') }}</th>
                <th>{{ trans('member.email') }}</th>
                <th class="hidden-xs">{{ trans('member.telp') }}</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $value)
                <tr>
                    {{-- <td class="hidden-xs">{{ $value->id }}</td> --}}
                    <td>{{ Get_field::get_data($value->auditor_id, 'users', 'name') }}</td>
                    <td>{{ Get_field::get_data($value->users_id, 'users', 'name') }}</td>
                    <td>{{ $value->email }}</td>
                    <td class="hidden-xs">{{ $value->telp }}</td>
                    <td class="item_btn_group">
                        @php
                            $actions = [
                                ['data-replace' => '#showMember', 'url' => '#showMemberModal', 'ajax-url' => url('members/' . $value->id . '/'), 'name' => ' Lihat', 'icon' => 'eye'], 
                                ['data-replace' => '#editMember', 'url' => '#editMemberModal', 'ajax-url' => url('members/' . $value->id . '/edit'), 'name' => ' Sunting', 'icon' => 'pencil'],
                                ['url' => 'members/' . $value->id, 'name' => 'delete']
                            ];
                        @endphp
                        @include('partials.actions', ['actions'=>$actions])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['items'=>$members, 'index_route'=>route('members.index')])
</div>

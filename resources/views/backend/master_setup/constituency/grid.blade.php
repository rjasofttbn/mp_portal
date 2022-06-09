<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th>@lang('Serial')</th>
        <th>@lang('Bangladesh Number')</th>
        <th>@lang('Constituency Name')</th>
        <th>@lang('Upazila')</th>
        <th>@lang('Status')</th>
        <th class="text-center">@lang('Action')</th>
    </tr>
    </thead>
    <tbody>

    @php
        $i=1;
    @endphp

    @foreach($data as $list)

        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $list->number }}</td>
            <td>
                @if(session()->get('language') =='bn')
                    {{$list->bn_name}}
                @else
                    {{$list->name}}
                @endif
            </td>
            
            <td>
                @if(session()->get('language') =='bn')
                {{$list->upazila->bn_name}}
                @else
                {{$list->upazila->name}}
                @endif
            </td>
            <td>{!! activeStatus($list->status) !!}</td>
            <td class="text-center">
                <a class="btn btn-sm btn-success" href="{{route('admin.master_setup.constituencies.edit',$list->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.master_setup.constituencies.destroy', $list->id)}}">

                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

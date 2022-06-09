<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th width="10%">@lang('Serial')</th>
        <th width="15%">@lang('Upazila Name')</th>
        <th width="15%">@lang('District Name')</th>
        <th width="15%">@lang('Division Name')</th>
        <th width="25%">@lang('Website URL')</th>
        <th width="10%">@lang('Status')</th>
        <th width="10%" class="text-center">@lang('Action')</th>
    </tr>
    </thead>
    <tbody>

    @php
        $i=1;
    @endphp

    @foreach($data as $list)

        <tr>
            <td>{{$i++}}</td>
            <td>
                @if(session()->get('language') =='bn')
                {{$list->bn_name}}
                @else
                {{$list->name}}
                @endif
            </td>
            <td>
                @if(session()->get('language') =='bn')
                {{$list->district->bn_name}}
                @else
                {{$list->district->name}}
                @endif
            </td>
            <td>
                @if(session()->get('language') =='bn')
                {{$list->division->bn_name}}
                @else
                {{$list->division->name}}
                @endif
            </td>
            <td>{{$list->url}}</td>
            <td>{!! activeStatus($list->status) !!}</td>
            <td class="text-center">
                <a class="btn btn-sm btn-success" href="{{route('admin.master_setup.upazilas.edit',$list->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.master_setup.upazilas.destroy', $list->id)}}">

                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

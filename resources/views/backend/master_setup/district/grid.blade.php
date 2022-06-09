<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th width="5%">@lang('Serial')</th>
        <th>@lang('District Name')</th>
        <th>@lang('Division Name')</th>
        <th>@lang('Latitude')</th>
        <th>@lang('Longitude')</th>
        <th>@lang('Website URL')</th>
        <th width="10%" class="text-center">@lang('Status')</th>
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
                {{$list->division->bn_name}}
                @else
                {{$list->division->name}}
                @endif
            </td>
            <td>{{$list->lat}}</td>
            <td>{{$list->lon}}</td>
            <td>{{$list->url}}</td>
            <td class="text-center">{!! activeStatus($list->status) !!}</td>
            <td class="text-center">
                <a class="btn btn-sm btn-success" href="{{route('admin.master_setup.districts.edit',$list->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.master_setup.districts.destroy', $list->id)}}">

                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

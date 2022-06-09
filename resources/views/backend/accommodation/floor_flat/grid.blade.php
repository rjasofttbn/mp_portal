<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th width="8%">@lang('Serial')</th>
        <th>@lang('Name (Bangla)')</th>
        <th>@lang('Name (English)')</th>
        <th>@lang('Building No.')</th>
        <th>@lang('Area')</th>
        <th>@lang('Total Floor')</th>
        <th>@lang('Total Flat')</th>
        <th width="10%" class="text-center">@lang('Action')</th>
    </tr>
    </thead>
    <tbody>

    @php
        
        $i=0;
        $j=0;
      
       
    @endphp

    @foreach($data as $value)

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$value->name_bn}}</td>
            <td>{{$value->name}}</td>
            <td>{{$value->building_no}}</td>
            <td>{{$value->areaInfo->name}}</td>
            <td>{{$value->total_floor}}</td>
            <td>{{$totalFlat[$i++]}}</td>           
            <td class="text-center">
            
                <a href="{{route('admin.accommodation-management.setup.floorflats.edit', $value->id)}}" class="btn btn-sm btn-info {{ $totalFlat[$j++]>0 ? '':'noflatmessage' }}"><i class="fa fa-edit"></i></a>
                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.accommodation-management.setup.floorflats.destroy', $value->id)}}">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

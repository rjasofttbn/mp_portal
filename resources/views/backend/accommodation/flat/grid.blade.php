<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th width="7%">@lang('Serial')</th>
        <th>@lang('Area')</th>
        <th>@lang('Building Name')</th>
        <th width="15%">@lang('Floor Number')</th>
        <th width="14%">@lang('Flat No')</th>
        <th>@lang('Flat Type')</th>
        <th  class="text-center">@lang('Action')</th>
    </tr>
    </thead>
    <tbody>

    @foreach($data as $value)

        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$value->area->name}}</td> 
            <td>{{$value->building->name}}</td> 
            <td>{{$value->floor->name}}</td> 
            <td>{{$value->number}}</td>
            <td>{{$value->flatType->name??""}}</td>



          
            <td class="text-center">
                <a class="btn btn-sm btn-info" href="{{route('admin.accommodation-management.setup.flats.edit', $value->id)}}">
                     <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.accommodation-management.setup.flats.destroy', $value->id)}}">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">@lang('Serial')</th>
                <th>@lang('Application Name')</th>
                <th>@lang('Accommodation Type')</th>
            </tr>
        </thead>
        <tbody>                                             

                @foreach ($data as $value )     

                <tr>
                    <td>{{ Lang::get($loop->iteration) }}</td>
                    <td>{{  Lang::locale()=='bn'?$value->name_bn:$value->name}}</td>
                    <td>{{  Lang::locale()=='bn'?$value->accommodationInfo->name_bn: $value->accommodationInfo->name}} </td>
                </tr>

                @endforeach
         
        </tbody>
    </table>
</div>
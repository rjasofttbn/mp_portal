<table id="approve_table" class="table table-sm table-bordered table-striped">
    <thead>
        <tr>
            <th width="5%">@lang('Serial')</th>
            <th>@lang('Flat No.')</th>
            <th>@lang('Floor Number')</th>
            <th>@lang('Flat Size')</th>
            <th>@lang('status')</th>
            <th width="10%" class="text-center">@lang('Action')</th>
        </tr>
    </thead>
    <tbody>
            @foreach($flats as $list)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{(session()->get('language') =='bn')?(en2bn(@$list['number'])):@$list['number']}}</td>
            <td>{{(session()->get('language') =='bn')?(@$list['floor']['name_bn']):@$list['floor']['name']}}</td>
            <td>{{(session()->get('language') =='bn')?(@$list['flatType']['name_bn']):@$list['flatType']['name']}}</td>
            <td>aaaaa</td>
            <td>
                <a style="margin-left:2px;" class="btn btn-sm btn-info" data-flat_id="{{$list->id}}" data-accommodation_application_id="{{$accommodation_application_id}}" id="confirm">Allocate</a>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <script type="text/javascript">                     
        $(document).ready(function() {
            $('#approve_table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
            });
        });
    </script>
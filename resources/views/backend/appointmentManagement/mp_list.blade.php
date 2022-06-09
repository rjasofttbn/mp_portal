<label class="control-label" for="requested_to">
        @if($is_mp)
            @lang('Honourable MP')
        @else
            @lang('Honourable Minister')
        @endif
    <span style="color: red;"> *</span></label>
<select id="requested_to" name="requested_to" class="form-control">
    <option value="">@lang('Select Name')</option>
    @foreach ($profileList as $list)
        @if($list['id']==$requested_to)
            <option selected
                    value="{{$list['id']}}">{{$list['name_eng']}}</option>
        @else
            <option  value="{{$list['id']}}">{{$list['name_eng']}}</option>
        @endif
    @endforeach
</select>
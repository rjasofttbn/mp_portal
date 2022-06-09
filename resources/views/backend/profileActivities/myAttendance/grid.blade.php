@php
    $i=1;

@endphp

@foreach($data as $list)

    <tr>
        <td>{{$i++}}</td>
        <td>{{$list->user->name_bn}}</td>
        <td>{{ Lang::get($list->parliament->parliament_number) }}</td>
        <td>{{ Lang::get($list->parliamentSession->session_no) }}</td>
        <td>{{ digitDateLang(date('d F, Y', strtotime($list->date))) }}</td>

        <td>{!! activeStatus($list->status) !!}</td>

    </tr>
@endforeach

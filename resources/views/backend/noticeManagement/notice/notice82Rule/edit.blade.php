@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Notice Management')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Notice Management')</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<div class="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('Create Notice')</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.notice_management.notices.update', $editData->id) }}"
                    enctype="multipart/form-data">
                  @csrf
                  @if (isset($editData))
                      @method('PUT')
                  @endif

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <label class="control-label" for="subject">@lang('1'). @lang('Subject') <span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-12 col-md-10 col-lg-10">
                                <select name="subject" id="subject" readonly class="form-control">
                                    <option value="{{ $editData->rule_number }}">{{ $editData->name }}</option>
                                </select>

                                @error('subject')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    
                    <input type="hidden" name="rule_number" id="rule_number" value="{{ $editData->parliamentRule->rule_number }}">
                    <input type="hidden" name="notice_from" id="notice_from" value="{{ $editData->notice_from }}">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <label class="control-label" for="bill_title">@lang('3'). @lang('Title of The Bill') <span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-12 col-md-10 col-lg-10">
                                <select id="bill_title" name="description[bill_title]" class="@error('description.bill_title') is-invalid @enderror form-control form-control-sm select2">
                                    <option value="">@lang('Select Bill Title')</option>
                                    @foreach ($bills as $bill)
                                        <option {{ $descriptions->bill_title == $bill->id ? 'selected' : '' }} value="{{ $bill->id }}" {{ old('description.bill_title') == $bill->id ? 'selected' : '' }}>
                                            @if(session()->get('language') =='bn')
                                            {{ $bill->name_bn }}
                                            @else
                                            {{ $bill->name }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                <div>
                                    @error('description.bill_title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label class="control-label" for="to_ministry_id">@lang('2'). @lang('Ministry') <span class="text-danger"> *</span></label>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <select id="to_ministry_id" name="to_ministry_id"  class="@error('to_ministry_id') is-invalid @enderror form-control form-control-sm select2">
                                            <option value="">@lang('Select Ministry Name')</option>
                                                @foreach ($ministries as $ministry)
                                                <option {{ ($editData->to_ministry_id == $ministry->id) ? 'selected' : ''}} value="{{ $ministry->id }}">
                                                    @if(session()->get('language') =='bn')
                                                        {{ $ministry->name_bn }}
                                                    @else
                                                        {{ $ministry->name }}
                                                    @endif
                                                </option>
                                                @endforeach
                                         
                                        </select>
                                        @error('to_ministry_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4 pl-4">
                                        <label class="control-label" for="to_wing_id">@lang('3'). @lang('Ministry Wings') <span class="text-danger"> *</span></label>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <select id="to_wing_id" name="to_wing_id" class="@error('to_wing_id') is-invalid @enderror form-control form-control-sm select2">
                                            @foreach($wing_list as $w)
                                            <option value="{{$w->id}}" {{ ($editData->to_wing_id==$w->id)?'selected="selected"':''}}>{{$w->name_bn}}</option>
                                            @endforeach
                                        </select>
                                        @error('to_wing_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" id="notice_to" name="notice_to" value="{{$editData->notice_to}}">
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        {{-- <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label class="control-label" for="notice_to">@lang('2'). @lang('To') <span class="text-danger"> *</span></label>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <select id="notice_to" name="notice_to" class="@error('notice_to') is-invalid @enderror form-control form-control-sm select2">
                                            <option value="">@lang('Select the Recipient')</option>
                                            @if (isset($allProfileData) && count($allProfileData) > 0)
                                            @foreach ($allProfileData as $data)
                                                @if($data->user_id == $editData->notice_to)
                                                    <option selected value="{{ $data->user_id }}">{{ $data->name_bn }} ({{ $data->voter_area }})</option>
                                                @elseif($data->user_id != auth()->user()->id)
                                                    <option value="{{ $data->user_id }}">{{ $data->name_bn }} ({{ $data->voter_area }})</option>
                                                @endif
        
                                            @endforeach
                                            @endif
                                        </select>
                                        @error('notice_to')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            
                        </div>
                        
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <label class="control-label" for="bill_topic">@lang('4'). @lang('Raise the Amendment') <span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-12 col-md-10 col-lg-10">
                                <select id="raise_amendment" name="bill_topic" data-id="{{ $editData->bill_topic }}" class="@error('bill_topic') is-invalid @enderror form-control form-control-sm select2">
                                    <option value="">@lang('??????????????? ?????????????????????????????? ???????????????????????? ??????????????? ???????????????????????? ????????????')</option>
                                    <option {{ $editData->bill_topic == 1 ? 'selected' : '' }} value="1">@lang('???????????? ???????????????????????? ????????? ????????????????????????')</option>
                                    <option {{ $editData->bill_topic == 2 ? 'selected' : '' }} value="2">@lang('???????????? ????????? ??????????????????')</option>
                                    <option {{ $editData->bill_topic == 3 ? 'selected' : '' }} value="3">@lang('????????????-????????? ??????????????????')</option>
                                    <option {{ $editData->bill_topic == 4 ? 'selected' : '' }} value="4">@lang('??????????????????/???????????????????????? ???????????????')</option>
                                    <option {{ $editData->bill_topic == 5 ? 'selected' : '' }} value="5">@lang('???????????????????????? ????????????????????????')</option>
                                    <option {{ $editData->bill_topic == 6 ? 'selected' : '' }} value="6">@lang('????????????????????? ???????????????????????? ?????????????????? ????????????????????????')</option>
                                    <option {{ $editData->bill_topic == 7 ? 'selected' : '' }} value="7">@lang('???????????????????????? ??????????????? ????????? ??????????????????????????? ???????????????????????? ???????????? ???????????????????????? ????????????????????????')</option>
                                </select>
                                <div>
                                    @error('bill_topic')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="clauseExchange" class="d-none">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="bill_clause">@lang('????????? ????????????????????????') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">

                                    <select id="exchange_bill_clause" name="description[bill_clause]" class="bill_clause @error('description.bill_clause') is-invalid @enderror form-control form-control-sm select2">
                                        <option value="">@lang('????????? ????????????????????? ???????????????????????? ????????????')</option>
                                        @if (isset($descriptions->bill_clause))
                                            @foreach ($clauses as $clause)
                                                <option  {{ $clause->number == $descriptions->bill_clause ? 'selected' : '' }}  
                                                value="{{ $clause->number }}"> {{ $clause->number }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div>
                                        @error('description.bill_clause')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="exchange_clause_add">@lang('????????? ????????????????????????') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <textarea id="exchange_clause_add" name="description[exchange_clause_add]"
                                    class="textareaWithoutImgVideo form-control @error('description.exchange_clause_add') is-invalid @enderror">
                                        {{old('description.exchange_clause_add') ?? $descriptions->exchange_clause_add ?? ''}}
                                    </textarea>

                                    @error('description.exchange_clause_add')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="addNewClause" class="d-none">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="bill_clause">@lang('???????????? ?????????') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">

                                    <select id="new_bill_clause" name="description[bill_clause]" class="bill_clause @error('description.bill_clause') is-invalid @enderror form-control form-control-sm select2">
                                        <option value="">@lang('????????? ????????????????????? ???????????????????????? ????????????')</option>
                                        @if (isset($descriptions->bill_clause))
                                            @foreach ($clauses as $clause)
                                                <option  {{ $clause->number == $descriptions->bill_clause ? 'selected' : '' }}  
                                                value="{{ $clause->number }}"> {{ $clause->number }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div>
                                        @error('description.bill_clause')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="new_clause_add">@lang('???????????? ????????? ??????????????????') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <textarea id="new_clause_add" name="description[new_clause_add]"
                                    class="textareaWithoutImgVideo form-control @error('description.new_clause_add') is-invalid @enderror">
                                        {{old('description.new_clause_add') ?? $descriptions->new_clause_add ?? ''}}
                                    </textarea>

                                    @error('description.new_clause_add')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="addConditionalClause" class="d-none">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="bill_clause">@lang('???????????? ?????????') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">

                                    <select id="conditional_bill_clause" name="description[bill_clause]" class="bill_clause @error('description.bill_clause') is-invalid @enderror form-control form-control-sm select2">
                                        <option value="">@lang('????????? ????????????????????? ???????????????????????? ????????????')</option>
                                        @if (isset($descriptions->bill_clause))
                                            @foreach ($clauses as $clause)
                                                <option  {{ $clause->number == $descriptions->bill_clause ? 'selected' : '' }}  
                                                value="{{ $clause->number }}"> {{ $clause->number }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div>
                                        @error('description.bill_clause')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>                            
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="conditional_clause_add"> @lang('????????????-????????? ??????????????????') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <textarea id="conditional_clause_add" name="description[conditional_clause_add]"
                                    class="textareaWithoutImgVideo form-control @error('description.conditional_clause_add') is-invalid @enderror">
                                    {{old('description.conditional_clause_add') ?? $descriptions->conditional_clause_add ?? ''}}
                                    </textarea>

                                    @error('description.conditional_clause_add')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="eliminationWords" class="d-none">
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="bill_clause">@lang('?????????') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">

                                    <select id="elimination_words_bill_clause" name="description[bill_clause]" class="bill_clause @error('description.bill_clause') is-invalid @enderror form-control form-control-sm select2">
                                        <option value="">@lang('????????? ????????????????????? ???????????????????????? ????????????')</option>
                                        @if (isset($descriptions->bill_clause))
                                            @foreach ($clauses as $clause)
                                                <option  {{ $clause->number == $descriptions->bill_clause ? 'selected' : '' }}  
                                                value="{{ $clause->number }}"> {{ $clause->number }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div>
                                        @error('description.bill_clause')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                            <label class="control-label" for="elimination_words_line"> @lang('??????????????????') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8">
                                            <textarea id="elimination_words_line" name="description[elimination_words_line]"
                                            class="form-control @error('description.elimination_words_line') is-invalid @enderror">
                                            {{old('description.elimination_words_line') ?? $descriptions->elimination_words_line ?? ''}}
                                            </textarea>
        
                                            @error('description.elimination_words_line')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4 pl-4">
                                            <label class="control-label" for="elimination_words"> @lang('??????????????????/???????????????????????? ???????????????') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8">
                                            <textarea id="elimination_words" name="description[elimination_words]"
                                            class="form-control @error('description.elimination_words') is-invalid @enderror">
                                            {{old('description.elimination_words') ?? $descriptions->elimination_words ?? ''}}
                                            </textarea>
        
                                            @error('description.elimination_words')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>


                    <div id="addNewWords" class="d-none">
        
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                            <label class="control-label" for="bill_clause">@lang('?????????') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8">
        
                                            <select id="new_words_bill_clause" name="description[bill_clause]" class="bill_clause @error('description.bill_clause') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('????????? ????????????????????? ???????????????????????? ????????????')</option>
                                                @if (isset($descriptions->bill_clause))
                                                    @foreach ($clauses as $clause)
                                                        <option  {{ $clause->number == $descriptions->bill_clause ? 'selected' : '' }}  
                                                        value="{{ $clause->number }}"> {{ $clause->number }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div>
                                                @error('description.bill_clause')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                            <label class="control-label" for="new_words_line"> @lang('??????????????????') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8">
                                            <textarea id="new_words_line" name="description[new_words_line]"
                                            class="form-control @error('description.new_words_line') is-invalid @enderror">
                                            {{old('description.new_words_line') ?? $descriptions->new_words_line ?? ''}}
                                            </textarea>
        
                                            @error('description.new_words_line')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4 pl-4">
                                            <label class="control-label" for="bill_sub_clause">@lang('??????-?????????') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8">
        
                                            <select id="new_words_sub_clause" name="description[bill_sub_clause]" class="bill_sub_clause @error('description.bill_sub_clause') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('????????? ????????? ???????????????????????? ????????????')</option>
                                                @if (isset($descriptions->bill_sub_clause))
                                                    @foreach ($clauses as $clause)
                                                        <option  {{ $clause->number == $descriptions->bill_sub_clause ? 'selected' : '' }}  
                                                        value="{{ $clause->number }}"> {{ $clause->number }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div>
                                                @error('description.bill_sub_clause')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4 pl-4">
                                            <label class="control-label" for="new_words_add_after"> @lang('??????????????????/???????????????????????? ?????????') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8">
                                            <textarea id="new_words_add_after" name="description[new_words_add_after]"
                                            class="form-control @error('description.new_words_add_after') is-invalid @enderror">
                                            {{old('description.new_words_add_after') ?? $descriptions->new_words_add_after ?? ''}}
                                            </textarea>
        
                                            @error('description.new_words_add_after')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="new_words_add"> @lang('??????????????????/???????????????????????? ????????????????????????') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <textarea id="new_words_add" name="description[new_words_add]"
                                    class="form-control @error('description.new_words_add') is-invalid @enderror">
                                    {{old('description.new_words_add') ?? $descriptions->new_words_add ?? ''}}
                                    </textarea>

                                    @error('description.new_words_add')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="exchangeParagraph" class="d-none">
        
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                            <label class="control-label" for="bill_clause">@lang('?????????') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8">
        
                                            <select id="exchange_paragraph_bill_clause" name="description[bill_clause]" class="bill_clause @error('description.bill_clause') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('????????? ????????????????????? ???????????????????????? ????????????')</option>
                                                @if (isset($descriptions->bill_clause))
                                                    @foreach ($clauses as $clause)
                                                        <option  {{ $clause->number == $descriptions->bill_clause ? 'selected' : '' }}  
                                                        value="{{ $clause->number }}"> {{ $clause->number }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div>
                                                @error('description.bill_clause')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4 pl-4">
                                            <label class="control-label" for="bill_sub_clause">@lang('??????-?????????') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8">
        
                                            <select id="exchange_paragraph_sub_clause" name="description[bill_sub_clause]" class="bill_sub_clause @error('description.bill_sub_clause') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('????????? ????????? ???????????????????????? ????????????')</option>
                                                
                                                @if (isset($descriptions->bill_sub_clause))
                                                    @foreach ($subClauses as $clause)
                                                        <option  {{ $clause->number == $descriptions->bill_sub_clause ? 'selected' : '' }}  
                                                        value="{{ $clause->number }}"> {{ $clause->number }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div>
                                                @error('description.bill_sub_clause')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="exchange_paragraph"> @lang('????????????????????? ????????????????????????') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <textarea id="exchange_paragraph" name="description[exchange_paragraph]"
                                    class="form-control @error('description.exchange_paragraph') is-invalid @enderror">
                                    {{old('description.exchange_paragraph') ?? $descriptions->exchange_paragraph ?? ''}}
                                    </textarea>

                                    @error('description.exchange_paragraph')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="exchange_paragraph_add"> @lang('????????????????????? ????????????????????????') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <textarea id="exchange_paragraph_add" name="description[exchange_paragraph_add]"
                                    class="form-control @error('description.exchange_paragraph_add') is-invalid @enderror">
                                    {{old('description.exchange_paragraph_add') ?? $descriptions->exchange_paragraph_add ?? ''}}
                                    </textarea>

                                    @error('description.exchange_paragraph_add')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="exchangeWordsFromParagraph" class="d-none">
        
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                            <label class="control-label" for="bill_clause">@lang('?????????') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8">
        
                                            <select id="exchange_words_bill_clause" name="description[bill_clause]" class="bill_clause @error('description.bill_clause') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('????????? ????????????????????? ???????????????????????? ????????????')</option>
                                                @if (isset($descriptions->bill_clause))
                                                    @foreach ($clauses as $clause)
                                                        <option  {{ $clause->number == $descriptions->bill_clause ? 'selected' : '' }}  
                                                        value="{{ $clause->number }}"> {{ $clause->number }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div>
                                                @error('description.bill_clause')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                            <label class="control-label" for="exchange_words_para"> @lang('??????????????????') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8">
                                            <input type="text" name="description[exchange_words_para]" id="exchange_words_para" 
                                            value="{{old('description.exchange_words_para') ?? $descriptions->exchange_words_para ?? ''}}"
                                            class="form-control @error('description.exchange_words_para') is-invalid @enderror" placeholder="?????????????????? ?????? ???????????????">
                                            
                                            @error('description.exchange_words_para')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4 pl-4">
                                            <label class="control-label" for="bill_sub_clause">@lang('??????-?????????') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8">
        
                                            <select id="exchange_words_sub_clause" name="description[bill_sub_clause]" class="bill_sub_clause @error('description.bill_sub_clause') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('????????? ????????? ???????????????????????? ????????????')</option>
                                                
                                                @if (isset($descriptions->bill_sub_clause))
                                                    @foreach ($subClauses as $clause)
                                                        <option  {{ $clause->number == $descriptions->bill_sub_clause ? 'selected' : '' }}  
                                                        value="{{ $clause->number }}"> {{ $clause->number }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div>
                                                @error('description.bill_sub_clause')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4 pl-4">
                                            <label class="control-label" for="exchange_words_line"> @lang('??????????????????') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8">
                                            <input type="text" name="description[exchange_words_line]" id="exchange_words_line" 
                                            value="{{old('description.exchange_words_line') ?? $descriptions->exchange_words_line ?? ''}}"
                                            class="form-control @error('description.exchange_words_line') is-invalid @enderror" placeholder="?????????????????? ?????? ???????????????">
                                            
        
                                            @error('description.exchange_words_line')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="exchange_words_elimination"> @lang('???????????????????????? ???????????????') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <textarea id="exchange_words_elimination" name="description[exchange_words_elimination]"
                                    class="form-control @error('description.exchange_words_elimination') is-invalid @enderror">
                                    {{old('description.exchange_words_elimination') ?? $descriptions->exchange_words_elimination ?? ''}}
                                    </textarea>

                                    @error('description.exchange_words_elimination')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="exchange_words_change"> @lang('???????????????????????? ????????????????????????') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <textarea id="exchange_words_change" name="description[exchange_words_change]"
                                    class="form-control @error('description.exchange_words_change') is-invalid @enderror">
                                    {{old('description.exchange_words_change') ?? $descriptions->exchange_words_change ?? ''}}
                                    </textarea>

                                    @error('description.exchange_words_change')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="exchange_words_add"> @lang('???????????????????????? ????????????????????????') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <textarea id="exchange_words_add" name="description[exchange_words_add]"
                                    class="form-control @error('description.exchange_words_add') is-invalid @enderror">
                                    {{old('description.exchange_words_add') ?? $descriptions->exchange_words_add ?? ''}}
                                    </textarea>

                                    @error('description.exchange_words_add')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <label class="control-label" for="attachment">@lang('5'). @lang('Attachment (if any)')</label>
                            </div>
                            <div class="col-sm-12 col-md-10 col-lg-10">
                                <div class="file p-0">
                                    <input type="file" class="form-control attachment_upload pl-1" name="attachment[]" id="attachment" multiple accept=".png, .jpg, .jpeg, .pdf">
                                </div>

                                @error('attachment')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        @if(auth()->user()->usertype=='staff')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label class="control-label" for="decision_proposal">???????????????????????????</label>
                                </div>
                                <div class="col-3">
                                    <select class="form-control select2" id="status_id" name="status_id">
                                        <option value="">??????????????????????????? ???????????????????????? ????????????</option>
                                        @foreach($status_list as $list)
                                        <option value="{{$list->status_id}}" @if($list->status_id==$editData->status) {{'selected="selected"'}} @endif>{{$list->name_bn}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3 text-right acceptable_tag">
                                    <input type="hidden" id="acceptable_without_correction" name="acceptance_tag" value="1" >
                                </div>
                                
                            </div>
                        </div>
                        <!-- <div class="form-group @if($editData->comments=='') d-none @endif" id="comment_container"> -->
                        <div class="form-group" id="comment_container">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="decision_proposal">?????????????????????</label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <textarea id="other_comments" name="comments" class="form-control">{{$editData->comments}}</textarea>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-secondary btn-sm white-text">
                                    <a href="{{ route('admin.notice_management.notices.index') }}">@lang('Back')</a>
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                @if (auth()->user()->usertype != 'ps')
                                <input type="submit" name="draft" value="@lang('Save as Draft')" class="btn btn-info btn-sm">
                                <input type="submit" name="submit" value="@lang('Save')" class="btn btn-success btn-sm">
                                @else
                                <input type="submit" name="submit" value="@lang('Save')" class="btn btn-success btn-sm">
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    

    


    @endsection
    @section('script')
    <script>
        $(function () {

            $('#bill_title').on('change', function () {
                var parliament_bill_id = $(this).val();

                $('.bill_clause').empty();
                $('.bill_clause').append('<option value="">@lang('????????? ???????????????????????? ????????????')</option>');

                if (parliament_bill_id > 0) {
                    $.ajax({
                        url: '{{url("clauseByParliamentBillId")}}',
                        data:{parliament_bill_id:parliament_bill_id},
                        type: "GET",
                        dataType: "json",
                        success: function (result) {
                            $.each(result.data, function (k, val) {
                                $('.bill_clause').append('<option value="' + val.number + '">' + val.number + '</option>'); 
                            });
                        }
                    });
                }
            });

            $('.bill_clause').on('change', function () {
                var parliament_bill_id = $('#bill_title').val();
                var bill_clause_id = $(this).val();

                $('.bill_sub_clause').empty();
                $('.bill_sub_clause').append('<option value="">@lang('??????-????????? ???????????????????????? ????????????')</option>');

                if (parliament_bill_id > 0) {
                                     
                    $.ajax({
                        url: '{{url("subClauseByParliamentBillId")}}',
                        data:{parliament_bill_id:parliament_bill_id, bill_clause_id:bill_clause_id},
                        type: "GET",
                        dataType: "json",
                        success: function (result) {
                            $.each(result.data, function (k, val) {
                                $('.bill_sub_clause').append('<option value="' + val.number + '">' + val.number + '</option>'); 

                            });
                        }
                    });
                }
            });
            
        });

        var raise_amendment = $('#raise_amendment').data('id');

        if(raise_amendment == 1){
            $("#clauseExchange").removeClass('d-none');
            $("#addNewClause").addClass('d-none');
            $("#addConditionalClause").addClass('d-none');
            $("#eliminationWords").addClass('d-none');
            $("#addNewWords").addClass('d-none');
            $("#exchangeParagraph").addClass('d-none');
            $("#exchangeWordsFromParagraph").addClass('d-none');

            $("#exchange_bill_clause").prop('disabled', false);
            $("#exchange_clause_add").prop('disabled', false);
            $("#new_bill_clause").prop('disabled', true);
            $("#new_clause_add").prop('disabled', true);
            $("#conditional_bill_clause").prop('disabled', true);
            $("#conditional_clause_add").prop('disabled', true);
            $("#elimination_words_bill_clause").prop('disabled', true);
            $("#elimination_words_line").prop('disabled', true);
            $("#elimination_words").prop('disabled', true);
            $("#new_words_bill_clause").prop('disabled', true);
            $("#new_words_line").prop('disabled', true);
            $("#new_words_sub_clause").prop('disabled', true);
            $("#new_words_add_after").prop('disabled', true);
            $("#new_words_add").prop('disabled', true);
            $("#exchange_paragraph_bill_clause").prop('disabled', true);
            $("#exchange_paragraph_sub_clause").prop('disabled', true);
            $("#exchange_paragraph").prop('disabled', true);
            $("#exchange_paragraph_add").prop('disabled', true);
            $("#exchange_words_bill_clause").prop('disabled', true);
            $("#exchange_words_line").prop('disabled', true);
            $("#exchange_words_sub_clause").prop('disabled', true);
            $("#exchange_words_para").prop('disabled', true);
            $("#exchange_words_elimination").prop('disabled', true);
            $("#exchange_words_change").prop('disabled', true);
            $("#exchange_words_add").prop('disabled', true);

        }else if(raise_amendment == 2){
            $("#clauseExchange").addClass('d-none');
            $("#addNewClause").removeClass('d-none');
            $("#addConditionalClause").addClass('d-none');
            $("#eliminationWords").addClass('d-none');
            $("#addNewWords").addClass('d-none');
            $("#exchangeParagraph").addClass('d-none');
            $("#exchangeWordsFromParagraph").addClass('d-none');

            $("#exchange_bill_clause").prop('disabled', true);
            $("#exchange_clause_add").prop('disabled', true);
            $("#new_bill_clause").prop('disabled', false);
            $("#new_clause_add").prop('disabled', false);
            $("#conditional_bill_clause").prop('disabled', true);
            $("#conditional_clause_add").prop('disabled', true);
            $("#elimination_words_bill_clause").prop('disabled', true);
            $("#elimination_words_line").prop('disabled', true);
            $("#elimination_words").prop('disabled', true);
            $("#new_words_bill_clause").prop('disabled', true);
            $("#new_words_line").prop('disabled', true);
            $("#new_words_sub_clause").prop('disabled', true);
            $("#new_words_add_after").prop('disabled', true);
            $("#new_words_add").prop('disabled', true);
            $("#exchange_paragraph_bill_clause").prop('disabled', true);
            $("#exchange_paragraph_sub_clause").prop('disabled', true);
            $("#exchange_paragraph").prop('disabled', true);
            $("#exchange_paragraph_add").prop('disabled', true);
            $("#exchange_words_bill_clause").prop('disabled', true);
            $("#exchange_words_line").prop('disabled', true);
            $("#exchange_words_sub_clause").prop('disabled', true);
            $("#exchange_words_para").prop('disabled', true);
            $("#exchange_words_elimination").prop('disabled', true);
            $("#exchange_words_change").prop('disabled', true);
            $("#exchange_words_add").prop('disabled', true);

                
        }else if(raise_amendment == 3){
            $("#clauseExchange").addClass('d-none');
            $("#addNewClause").addClass('d-none');
            $("#addConditionalClause").removeClass('d-none');
            $("#eliminationWords").addClass('d-none');
            $("#addNewWords").addClass('d-none');
            $("#exchangeParagraph").addClass('d-none');
            $("#exchangeWordsFromParagraph").addClass('d-none');

            $("#exchange_bill_clause").prop('disabled', true);
            $("#exchange_clause_add").prop('disabled', true);
            $("#new_bill_clause").prop('disabled', true);
            $("#new_clause_add").prop('disabled', true);
            $("#conditional_bill_clause").prop('disabled', false);
            $("#conditional_clause_add").prop('disabled', false);
            $("#elimination_words_bill_clause").prop('disabled', true);
            $("#elimination_words_line").prop('disabled', true);
            $("#elimination_words").prop('disabled', true);
            $("#new_words_bill_clause").prop('disabled', true);
            $("#new_words_line").prop('disabled', true);
            $("#new_words_sub_clause").prop('disabled', true);
            $("#new_words_add_after").prop('disabled', true);
            $("#new_words_add").prop('disabled', true);
            $("#exchange_paragraph_bill_clause").prop('disabled', true);
            $("#exchange_paragraph_sub_clause").prop('disabled', true);
            $("#exchange_paragraph").prop('disabled', true);
            $("#exchange_paragraph_add").prop('disabled', true);
            $("#exchange_words_bill_clause").prop('disabled', true);
            $("#exchange_words_line").prop('disabled', true);
            $("#exchange_words_sub_clause").prop('disabled', true);
            $("#exchange_words_para").prop('disabled', true);
            $("#exchange_words_elimination").prop('disabled', true);
            $("#exchange_words_change").prop('disabled', true);
            $("#exchange_words_add").prop('disabled', true);


        }else if(raise_amendment == 4){
            $("#clauseExchange").addClass('d-none');
            $("#addNewClause").addClass('d-none');
            $("#addConditionalClause").addClass('d-none');
            $("#eliminationWords").removeClass('d-none');
            $("#addNewWords").addClass('d-none');
            $("#exchangeParagraph").addClass('d-none');
            $("#exchangeWordsFromParagraph").addClass('d-none');

            $("#exchange_bill_clause").prop('disabled', true);
            $("#exchange_clause_add").prop('disabled', true);
            $("#new_bill_clause").prop('disabled', true);
            $("#new_clause_add").prop('disabled', true);
            $("#conditional_bill_clause").prop('disabled', true);
            $("#conditional_clause_add").prop('disabled', true);
            $("#elimination_words_bill_clause").prop('disabled', false);
            $("#elimination_words_line").prop('disabled', false);
            $("#elimination_words").prop('disabled', false);
            $("#new_words_bill_clause").prop('disabled', true);
            $("#new_words_line").prop('disabled', true);
            $("#new_words_sub_clause").prop('disabled', true);
            $("#new_words_add_after").prop('disabled', true);
            $("#new_words_add").prop('disabled', true);
            $("#exchange_paragraph_bill_clause").prop('disabled', true);
            $("#exchange_paragraph_sub_clause").prop('disabled', true);
            $("#exchange_paragraph").prop('disabled', true);
            $("#exchange_paragraph_add").prop('disabled', true);
            $("#exchange_words_bill_clause").prop('disabled', true);
            $("#exchange_words_line").prop('disabled', true);
            $("#exchange_words_sub_clause").prop('disabled', true);
            $("#exchange_words_para").prop('disabled', true);
            $("#exchange_words_elimination").prop('disabled', true);
            $("#exchange_words_change").prop('disabled', true);
            $("#exchange_words_add").prop('disabled', true);

        }else if(raise_amendment == 5){
            $("#clauseExchange").addClass('d-none');
            $("#addNewClause").addClass('d-none');
            $("#addConditionalClause").addClass('d-none');
            $("#eliminationWords").addClass('d-none');
            $("#addNewWords").removeClass('d-none');
            $("#exchangeParagraph").addClass('d-none');
            $("#exchangeWordsFromParagraph").addClass('d-none');

            $("#exchange_bill_clause").prop('disabled', true);
            $("#exchange_clause_add").prop('disabled', true);
            $("#new_bill_clause").prop('disabled', true);
            $("#new_clause_add").prop('disabled', true);
            $("#conditional_bill_clause").prop('disabled', true);
            $("#conditional_clause_add").prop('disabled', true);
            $("#elimination_words_bill_clause").prop('disabled', true);
            $("#elimination_words_line").prop('disabled', true);
            $("#elimination_words").prop('disabled', true);
            $("#new_words_bill_clause").prop('disabled', false);
            $("#new_words_line").prop('disabled', false);
            $("#new_words_sub_clause").prop('disabled', false);
            $("#new_words_add_after").prop('disabled', false);
            $("#new_words_add").prop('disabled', false);
            $("#exchange_paragraph_bill_clause").prop('disabled', true);
            $("#exchange_paragraph_sub_clause").prop('disabled', true);
            $("#exchange_paragraph").prop('disabled', true);
            $("#exchange_paragraph_add").prop('disabled', true);
            $("#exchange_words_bill_clause").prop('disabled', true);
            $("#exchange_words_line").prop('disabled', true);
            $("#exchange_words_sub_clause").prop('disabled', true);
            $("#exchange_words_para").prop('disabled', true);
            $("#exchange_words_elimination").prop('disabled', true);
            $("#exchange_words_change").prop('disabled', true);
            $("#exchange_words_add").prop('disabled', true);

        }else if(raise_amendment == 6){
            $("#clauseExchange").addClass('d-none');
            $("#addNewClause").addClass('d-none');
            $("#addConditionalClause").addClass('d-none');
            $("#eliminationWords").addClass('d-none');
            $("#addNewWords").addClass('d-none');
            $("#exchangeParagraph").removeClass('d-none');
            $("#exchangeWordsFromParagraph").addClass('d-none');

            $("#exchange_bill_clause").prop('disabled', true);
            $("#exchange_clause_add").prop('disabled', true);
            $("#new_bill_clause").prop('disabled', true);
            $("#new_clause_add").prop('disabled', true);
            $("#conditional_bill_clause").prop('disabled', true);
            $("#conditional_clause_add").prop('disabled', true);
            $("#elimination_words_bill_clause").prop('disabled', true);
            $("#elimination_words_line").prop('disabled', true);
            $("#elimination_words").prop('disabled', true);
            $("#new_words_bill_clause").prop('disabled', true);
            $("#new_words_line").prop('disabled', true);
            $("#new_words_sub_clause").prop('disabled', true);
            $("#new_words_add_after").prop('disabled', true);
            $("#new_words_add").prop('disabled', true);
            $("#exchange_paragraph_bill_clause").prop('disabled', false);
            $("#exchange_paragraph_sub_clause").prop('disabled', false);
            $("#exchange_paragraph").prop('disabled', false);
            $("#exchange_paragraph_add").prop('disabled', false);
            $("#exchange_words_bill_clause").prop('disabled', true);
            $("#exchange_words_line").prop('disabled', true);
            $("#exchange_words_sub_clause").prop('disabled', true);
            $("#exchange_words_para").prop('disabled', true);
            $("#exchange_words_elimination").prop('disabled', true);
            $("#exchange_words_change").prop('disabled', true);
            $("#exchange_words_add").prop('disabled', true);

        }else if(raise_amendment == 7){
            $("#clauseExchange").addClass('d-none');
            $("#addNewClause").addClass('d-none');
            $("#addConditionalClause").addClass('d-none');
            $("#eliminationWords").addClass('d-none');
            $("#addNewWords").addClass('d-none');
            $("#exchangeParagraph").addClass('d-none');
            $("#exchangeWordsFromParagraph").removeClass('d-none');

            $("#exchange_bill_clause").prop('disabled', true);
            $("#exchange_clause_add").prop('disabled', true);
            $("#new_bill_clause").prop('disabled', true);
            $("#new_clause_add").prop('disabled', true);
            $("#conditional_bill_clause").prop('disabled', true);
            $("#conditional_clause_add").prop('disabled', true);
            $("#elimination_words_bill_clause").prop('disabled', true);
            $("#elimination_words_line").prop('disabled', true);
            $("#elimination_words").prop('disabled', true);
            $("#new_words_bill_clause").prop('disabled', true);
            $("#new_words_line").prop('disabled', true);
            $("#new_words_sub_clause").prop('disabled', true);
            $("#new_words_add_after").prop('disabled', true);
            $("#new_words_add").prop('disabled', true);
            $("#exchange_paragraph_bill_clause").prop('disabled', true);
            $("#exchange_paragraph_sub_clause").prop('disabled', true);
            $("#exchange_paragraph").prop('disabled', true);
            $("#exchange_paragraph_add").prop('disabled', true);
            $("#exchange_words_bill_clause").prop('disabled', false);
            $("#exchange_words_line").prop('disabled', false);
            $("#exchange_words_sub_clause").prop('disabled', false);
            $("#exchange_words_para").prop('disabled', false);
            $("#exchange_words_elimination").prop('disabled', false);
            $("#exchange_words_change").prop('disabled', false);
            $("#exchange_words_add").prop('disabled', false);

        }
        
        $(document).on('change', '#raise_amendment', function() {

            var raise_amendment = $(this).val();

            if(raise_amendment == 1){
                $("#clauseExchange").removeClass('d-none');
                $("#addNewClause").addClass('d-none');
                $("#addConditionalClause").addClass('d-none');
                $("#eliminationWords").addClass('d-none');
                $("#addNewWords").addClass('d-none');
                $("#exchangeParagraph").addClass('d-none');
                $("#exchangeWordsFromParagraph").addClass('d-none');

                $("#exchange_bill_clause").prop('disabled', false);
                $("#exchange_clause_add").prop('disabled', false);
                $("#new_bill_clause").prop('disabled', true);
                $("#new_clause_add").prop('disabled', true);
                $("#conditional_bill_clause").prop('disabled', true);
                $("#conditional_clause_add").prop('disabled', true);
                $("#elimination_words_bill_clause").prop('disabled', true);
                $("#elimination_words_line").prop('disabled', true);
                $("#elimination_words").prop('disabled', true);
                $("#new_words_bill_clause").prop('disabled', true);
                $("#new_words_line").prop('disabled', true);
                $("#new_words_sub_clause").prop('disabled', true);
                $("#new_words_add_after").prop('disabled', true);
                $("#new_words_add").prop('disabled', true);
                $("#exchange_paragraph_bill_clause").prop('disabled', true);
                $("#exchange_paragraph_sub_clause").prop('disabled', true);
                $("#exchange_paragraph").prop('disabled', true);
                $("#exchange_paragraph_add").prop('disabled', true);
                $("#exchange_words_bill_clause").prop('disabled', true);
                $("#exchange_words_line").prop('disabled', true);
                $("#exchange_words_sub_clause").prop('disabled', true);
                $("#exchange_words_para").prop('disabled', true);
                $("#exchange_words_elimination").prop('disabled', true);
                $("#exchange_words_change").prop('disabled', true);
                $("#exchange_words_add").prop('disabled', true);

            }else if(raise_amendment == 2){
                $("#clauseExchange").addClass('d-none');
                $("#addNewClause").removeClass('d-none');
                $("#addConditionalClause").addClass('d-none');
                $("#eliminationWords").addClass('d-none');
                $("#addNewWords").addClass('d-none');
                $("#exchangeParagraph").addClass('d-none');
                $("#exchangeWordsFromParagraph").addClass('d-none');

                $("#exchange_bill_clause").prop('disabled', true);
                $("#exchange_clause_add").prop('disabled', true);
                $("#new_bill_clause").prop('disabled', false);
                $("#new_clause_add").prop('disabled', false);
                $("#conditional_bill_clause").prop('disabled', true);
                $("#conditional_clause_add").prop('disabled', true);
                $("#elimination_words_bill_clause").prop('disabled', true);
                $("#elimination_words_line").prop('disabled', true);
                $("#elimination_words").prop('disabled', true);
                $("#new_words_bill_clause").prop('disabled', true);
                $("#new_words_line").prop('disabled', true);
                $("#new_words_sub_clause").prop('disabled', true);
                $("#new_words_add_after").prop('disabled', true);
                $("#new_words_add").prop('disabled', true);
                $("#exchange_paragraph_bill_clause").prop('disabled', true);
                $("#exchange_paragraph_sub_clause").prop('disabled', true);
                $("#exchange_paragraph").prop('disabled', true);
                $("#exchange_paragraph_add").prop('disabled', true);
                $("#exchange_words_bill_clause").prop('disabled', true);
                $("#exchange_words_line").prop('disabled', true);
                $("#exchange_words_sub_clause").prop('disabled', true);
                $("#exchange_words_para").prop('disabled', true);
                $("#exchange_words_elimination").prop('disabled', true);
                $("#exchange_words_change").prop('disabled', true);
                $("#exchange_words_add").prop('disabled', true);

                    
            }else if(raise_amendment == 3){
                $("#clauseExchange").addClass('d-none');
                $("#addNewClause").addClass('d-none');
                $("#addConditionalClause").removeClass('d-none');
                $("#eliminationWords").addClass('d-none');
                $("#addNewWords").addClass('d-none');
                $("#exchangeParagraph").addClass('d-none');
                $("#exchangeWordsFromParagraph").addClass('d-none');

                $("#exchange_bill_clause").prop('disabled', true);
                $("#exchange_clause_add").prop('disabled', true);
                $("#new_bill_clause").prop('disabled', true);
                $("#new_clause_add").prop('disabled', true);
                $("#conditional_bill_clause").prop('disabled', false);
                $("#conditional_clause_add").prop('disabled', false);
                $("#elimination_words_bill_clause").prop('disabled', true);
                $("#elimination_words_line").prop('disabled', true);
                $("#elimination_words").prop('disabled', true);
                $("#new_words_bill_clause").prop('disabled', true);
                $("#new_words_line").prop('disabled', true);
                $("#new_words_sub_clause").prop('disabled', true);
                $("#new_words_add_after").prop('disabled', true);
                $("#new_words_add").prop('disabled', true);
                $("#exchange_paragraph_bill_clause").prop('disabled', true);
                $("#exchange_paragraph_sub_clause").prop('disabled', true);
                $("#exchange_paragraph").prop('disabled', true);
                $("#exchange_paragraph_add").prop('disabled', true);
                $("#exchange_words_bill_clause").prop('disabled', true);
                $("#exchange_words_line").prop('disabled', true);
                $("#exchange_words_sub_clause").prop('disabled', true);
                $("#exchange_words_para").prop('disabled', true);
                $("#exchange_words_elimination").prop('disabled', true);
                $("#exchange_words_change").prop('disabled', true);
                $("#exchange_words_add").prop('disabled', true);


            }else if(raise_amendment == 4){
                $("#clauseExchange").addClass('d-none');
                $("#addNewClause").addClass('d-none');
                $("#addConditionalClause").addClass('d-none');
                $("#eliminationWords").removeClass('d-none');
                $("#addNewWords").addClass('d-none');
                $("#exchangeParagraph").addClass('d-none');
                $("#exchangeWordsFromParagraph").addClass('d-none');

                $("#exchange_bill_clause").prop('disabled', true);
                $("#exchange_clause_add").prop('disabled', true);
                $("#new_bill_clause").prop('disabled', true);
                $("#new_clause_add").prop('disabled', true);
                $("#conditional_bill_clause").prop('disabled', true);
                $("#conditional_clause_add").prop('disabled', true);
                $("#elimination_words_bill_clause").prop('disabled', false);
                $("#elimination_words_line").prop('disabled', false);
                $("#elimination_words").prop('disabled', false);
                $("#new_words_bill_clause").prop('disabled', true);
                $("#new_words_line").prop('disabled', true);
                $("#new_words_sub_clause").prop('disabled', true);
                $("#new_words_add_after").prop('disabled', true);
                $("#new_words_add").prop('disabled', true);
                $("#exchange_paragraph_bill_clause").prop('disabled', true);
                $("#exchange_paragraph_sub_clause").prop('disabled', true);
                $("#exchange_paragraph").prop('disabled', true);
                $("#exchange_paragraph_add").prop('disabled', true);
                $("#exchange_words_bill_clause").prop('disabled', true);
                $("#exchange_words_line").prop('disabled', true);
                $("#exchange_words_sub_clause").prop('disabled', true);
                $("#exchange_words_para").prop('disabled', true);
                $("#exchange_words_elimination").prop('disabled', true);
                $("#exchange_words_change").prop('disabled', true);
                $("#exchange_words_add").prop('disabled', true);

            }else if(raise_amendment == 5){
                $("#clauseExchange").addClass('d-none');
                $("#addNewClause").addClass('d-none');
                $("#addConditionalClause").addClass('d-none');
                $("#eliminationWords").addClass('d-none');
                $("#addNewWords").removeClass('d-none');
                $("#exchangeParagraph").addClass('d-none');
                $("#exchangeWordsFromParagraph").addClass('d-none');

                $("#exchange_bill_clause").prop('disabled', true);
                $("#exchange_clause_add").prop('disabled', true);
                $("#new_bill_clause").prop('disabled', true);
                $("#new_clause_add").prop('disabled', true);
                $("#conditional_bill_clause").prop('disabled', true);
                $("#conditional_clause_add").prop('disabled', true);
                $("#elimination_words_bill_clause").prop('disabled', true);
                $("#elimination_words_line").prop('disabled', true);
                $("#elimination_words").prop('disabled', true);
                $("#new_words_bill_clause").prop('disabled', false);
                $("#new_words_line").prop('disabled', false);
                $("#new_words_sub_clause").prop('disabled', false);
                $("#new_words_add_after").prop('disabled', false);
                $("#new_words_add").prop('disabled', false);
                $("#exchange_paragraph_bill_clause").prop('disabled', true);
                $("#exchange_paragraph_sub_clause").prop('disabled', true);
                $("#exchange_paragraph").prop('disabled', true);
                $("#exchange_paragraph_add").prop('disabled', true);
                $("#exchange_words_bill_clause").prop('disabled', true);
                $("#exchange_words_line").prop('disabled', true);
                $("#exchange_words_sub_clause").prop('disabled', true);
                $("#exchange_words_para").prop('disabled', true);
                $("#exchange_words_elimination").prop('disabled', true);
                $("#exchange_words_change").prop('disabled', true);
                $("#exchange_words_add").prop('disabled', true);

            }else if(raise_amendment == 6){
                $("#clauseExchange").addClass('d-none');
                $("#addNewClause").addClass('d-none');
                $("#addConditionalClause").addClass('d-none');
                $("#eliminationWords").addClass('d-none');
                $("#addNewWords").addClass('d-none');
                $("#exchangeParagraph").removeClass('d-none');
                $("#exchangeWordsFromParagraph").addClass('d-none');

                $("#exchange_bill_clause").prop('disabled', true);
                $("#exchange_clause_add").prop('disabled', true);
                $("#new_bill_clause").prop('disabled', true);
                $("#new_clause_add").prop('disabled', true);
                $("#conditional_bill_clause").prop('disabled', true);
                $("#conditional_clause_add").prop('disabled', true);
                $("#elimination_words_bill_clause").prop('disabled', true);
                $("#elimination_words_line").prop('disabled', true);
                $("#elimination_words").prop('disabled', true);
                $("#new_words_bill_clause").prop('disabled', true);
                $("#new_words_line").prop('disabled', true);
                $("#new_words_sub_clause").prop('disabled', true);
                $("#new_words_add_after").prop('disabled', true);
                $("#new_words_add").prop('disabled', true);
                $("#exchange_paragraph_bill_clause").prop('disabled', false);
                $("#exchange_paragraph_sub_clause").prop('disabled', false);
                $("#exchange_paragraph").prop('disabled', false);
                $("#exchange_paragraph_add").prop('disabled', false);
                $("#exchange_words_bill_clause").prop('disabled', true);
                $("#exchange_words_line").prop('disabled', true);
                $("#exchange_words_sub_clause").prop('disabled', true);
                $("#exchange_words_para").prop('disabled', true);
                $("#exchange_words_elimination").prop('disabled', true);
                $("#exchange_words_change").prop('disabled', true);
                $("#exchange_words_add").prop('disabled', true);

            }else if(raise_amendment == 7){
                $("#clauseExchange").addClass('d-none');
                $("#addNewClause").addClass('d-none');
                $("#addConditionalClause").addClass('d-none');
                $("#eliminationWords").addClass('d-none');
                $("#addNewWords").addClass('d-none');
                $("#exchangeParagraph").addClass('d-none');
                $("#exchangeWordsFromParagraph").removeClass('d-none');

                $("#exchange_bill_clause").prop('disabled', true);
                $("#exchange_clause_add").prop('disabled', true);
                $("#new_bill_clause").prop('disabled', true);
                $("#new_clause_add").prop('disabled', true);
                $("#conditional_bill_clause").prop('disabled', true);
                $("#conditional_clause_add").prop('disabled', true);
                $("#elimination_words_bill_clause").prop('disabled', true);
                $("#elimination_words_line").prop('disabled', true);
                $("#elimination_words").prop('disabled', true);
                $("#new_words_bill_clause").prop('disabled', true);
                $("#new_words_line").prop('disabled', true);
                $("#new_words_sub_clause").prop('disabled', true);
                $("#new_words_add_after").prop('disabled', true);
                $("#new_words_add").prop('disabled', true);
                $("#exchange_paragraph_bill_clause").prop('disabled', true);
                $("#exchange_paragraph_sub_clause").prop('disabled', true);
                $("#exchange_paragraph").prop('disabled', true);
                $("#exchange_paragraph_add").prop('disabled', true);
                $("#exchange_words_bill_clause").prop('disabled', false);
                $("#exchange_words_line").prop('disabled', false);
                $("#exchange_words_sub_clause").prop('disabled', false);
                $("#exchange_words_para").prop('disabled', false);
                $("#exchange_words_elimination").prop('disabled', false);
                $("#exchange_words_change").prop('disabled', false);
                $("#exchange_words_add").prop('disabled', false);

            }

        });

        $(document).ready(function() {
            $("#status_id").on('change', function() {
                if ($(this).val() == 6) {
                    $(".acceptable_tag").removeClass('d-none');
                    $(".acceptable_tag").addClass('block');
                    $("#acceptable_without_correction").prop('disabled', false);
                } else {
                    $(".acceptable_tag").removeClass('block');
                    $(".acceptable_tag").addClass('d-none');
                    $("#acceptable_without_correction").prop('disabled', true);
                }
            });
        });
        
        
    </script>
    <script>
        $(function() {

            $("#to_ministry_id").on('change',function(){
                var ministry_id = $(this).val();
                if(ministry_id==''){
                    $('#to_wing_id').html('');
                }
                load_items('wing', ministry_id);
            });
        })
        
        function load_items(type, ministry = null) {
            var request_data = {};
            if (type == 'ministry') {
                $('#to_wing_id').html('');
                var selected_date = $("#datepicker").val();
                request_data = {
                    type: type,
                    circular_date: selected_date
                };

            } else if (type == 'wing') {
                request_data = {
                    type: type,
                    ministry_id: ministry
                };
            }

            $.ajax({
                url: '{{url("admin/notice-management/ministryitem")}}',
                data: request_data,
                type: "GET",
                dataType: "json",
                success: function(result) {
                    console.log(result);
                    if (type == 'ministry') {
                        $('#to_ministry_id').html('');
                        $('#to_ministry_id').append(result.data);
                    }
                    else if (type == 'wing') {
                        $('#to_wing_id').html('');
                        $('#to_wing_id').append(result.data);
                    }
                }
            });
        }
    </script>
@endsection
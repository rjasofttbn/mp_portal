<div>    
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day --}}
    <input type="hidden" name="deletedRows" value={{ $deletedRows }}>
    @foreach($inputs as $key => $value)
    <input type="hidden" name="clause_ids[]" value={{ $value['clause_id'] ?? '' }}>
    <div class="add-input">
        <div class="clause-div form-row">
            <div class="form-group col-sm-5">
                <label class="control-label"> @lang('Clause Title') <span class="text-danger">*</span></label>
                <input type="text" name="title[]" wire:model="inputs.{{ $key }}.title" class="form-control form-control-sm" placeholder="@lang('Enter Clause Title')">
            </div>
            <div class="form-group col-sm-2">
                <label class="control-label">@lang('Clause Number') <span class="text-danger">*</span></label>
                <input type="text" name="number[]" wire:model="inputs.{{ $key }}.number" class="form-control form-control-sm" placeholder="@lang('Enter Clause Number')">
            </div>
            <div class="form-group col-sm-2">
                <label class="control-label">@lang('Sub Clause Number') <span class="text-danger">*</span></label>
                <input type="text" name="sub_clause_qty[]" wire:model="inputs.{{ $key }}.sub_clause_qty" class="form-control form-control-sm" placeholder="@lang('Enter Sub Clause Number')">
            </div>
            <div class="form-group col-sm-2">
                <label class="control-label">@lang('Status') <span class="text-danger">*</span></label>
                <select name="clause_status[]" class="form-control form-control-sm clause_id">
                    {!! activeStatusDropdown($value['status'] ?? '') !!}
                </select>
            </div>
            <div class="form-group col-sm-1 mt-auto">
                <button class="btn text-white btn-info btn-sm"
                    wire:click.prevent="add({{ $key }})"><i class="fa fa-plus"></i></button>
                @if ($loop->index)                    
                <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{ $key }}, {{ $value['clause_id'] ?? '' }})"><i
                    class="fa fa-trash"></i></button>
                @endif
                <button class="btn text-white btn-warning btn-sm"
                    wire:click.prevent="testMe({{ $key }})"><i class="fa fa-list"></i></button>
            </div>
        </div>

    </div>
    @endforeach
</div>



<div>
    <div class="col-md-2 mt-4 mb-2">
        <button type="button" class="btn text-white btn-success btn-sm" wire:click="add">{{ __('buttons.add') . ' ' .  __('general.' . $title) }}</button>
    </div>
    @foreach($inputs as $key => $value)
        <div class=" add-input">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group mt-2">
                        <input type="text" class="form-control" placeholder="{{ __('general.' . $placeHolder) }}" wire:model="arrayValues.{{ $value }}">
                        @error('values.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-2 mt-3">
                    <button type="button" class="btn btn-danger btn-sm" wire:click="remove({{$key}})">{{ __('buttons.delete') }}</button>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row justify-content-between">
    <div class="col-xl-4 col-lg-5 col-md-6">
        <div class="form-group smalls row align-items-center">
            <label class="col-xl-2 col-lg-2 col-sm-2 col-form-label">{{ __('general.search') }}</label>
            <div class="col-xl-10 col-lg-10 col-sm-10">
                <input wire:model.live.debounce.150ms="search" type="text" class="form-control">
            </div>
        </div>
    </div>
</div>

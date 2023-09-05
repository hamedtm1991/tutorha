<div class="row justify-content-between">
    <div class="col-lg-12 col-md-12 col-sm-12 pb-4">
        <div class="dashboard_wrap d-flex align-items-center justify-content-between">
            <div class="arion">
                <nav class="transparent">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('general.dashboard') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.' . $title) }}</li>
                    </ul>
                </nav>
            </div>
            @if($modelName && Auth::user()->can($modelName . '.create'))
                <div class="elkios">
                    <a wire:click="create" href="#" class="add_new_btn"><i class="fas fa-plus-circle ml-1"></i></a>
                </div>
            @endif
        </div>
    </div>
</div>

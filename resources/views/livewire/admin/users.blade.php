<div>
    <div class="row justify-content-between">
        <div class="col-lg-12 col-md-12 col-sm-12 pb-4">
            <div class="dashboard_wrap d-flex align-items-center justify-content-between">
                <div class="arion">
                    <nav class="transparent">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('general.dashboard') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('general.users') }}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="dashboard_wrap">
                @if($showForm)
                    <form wire:submit.prevent="save" autocomplete="off">
                        <livewire:widgets.select instance="Role" title="role" :items="$items" :searchItems="$searchItems" />
                        <div class="mt-2">
                            @error('roles.*') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group smalls mt-4">
                            <button type="submit" class="btn theme-bg text-white">{{ __('buttons.submit') }}</button>
                            <button wire:click="cancel" type="button" class="btn btn-secondary text-white">{{ __('buttons.cancel') }}</button>
                        </div>
                    </form>
                @else
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 mb-4">
                            <h6 class="m-0">{{ __('general.users') }}</h6>
                        </div>
                    </div>

                    <div class="row justify-content-between">
                        <div class="col-xl-4 col-lg-5 col-md-6">
                            <div class="form-group smalls row align-items-center">
                                <label class="col-xl-2 col-lg-2 col-sm-2 col-form-label">جستجو</label>
                                <div class="col-xl-10 col-lg-10 col-sm-10">
                                    <input wire:model.live.debounce.150ms="search" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 mb-2">
                            <div class="table-responsive">
                                <table class="table dash_list">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('general.name') }}</th>
                                        <th scope="col">{{ __('general.mobile') }}</th>
                                        <th scope="col">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $model)
                                        <tr>
                                            <th scope="row">{{ $model->id }}</th>
                                            <td>{{ $model->name }}</td>
                                            <td>{{ $model->mobile }}</td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn btn-action" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="drp-select dropdown-menu">
                                                        @if(Auth::user()->can('user.delete'))
                                                            <a onclick="getConfirm('admin.users', 'delete', {{ $model->id }}, '{{ __('general.sure') }}', '{{ __('general.noRevert') }}', '{{ __('buttons.yes') }}', '{{ __('buttons.no') }}')" class="dropdown-item">{{ __('buttons.delete') }}</a>
                                                        @endif
                                                        @if(Auth::user()->can('user.update'))
                                                            <a onclick="dispatch('admin.users', 'roles', {{ $model->id }})"  class="dropdown-item">{{ __('buttons.managingRoles') }}</a>
                                                            @if(!$model->tutor)
                                                                <a onclick="dispatch('admin.users', 'makeTutor', {{ $model->id }})"  class="dropdown-item">{{ __('buttons.makeTutor') }}</a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{ $data->links('pagination') }}
                @endif
            </div>
        </div>
    </div>
</div>

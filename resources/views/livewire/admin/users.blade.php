<div>
    <x-head-view title="users" />

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="dashboard_wrap">
                @if($showForm)
                    <form wire:submit.prevent="save" autocomplete="off">
                        <livewire:widgets.select instance="Role" title="role" :items="$items" :searchItems="$searchItems" />
                        <div class="mt-2">
                            @error('roles.*') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <x-form-buttons/>
                    </form>
                @else
                    <x-title title="users" />
                    <x-search/>

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
                                                            <a onclick="getConfirm('admin.users', 'delete', '{{ 'User-' . $model->id }}', '{{ __('general.sure') }}', '{{ __('general.noRevert') }}', '{{ __('buttons.yes') }}', '{{ __('buttons.no') }}')" class="dropdown-item">{{ __('buttons.delete') }}</a>
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

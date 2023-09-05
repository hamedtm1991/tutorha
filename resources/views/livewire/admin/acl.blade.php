<div>
    <x-head-view title="acl" modelName="permission" />

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="dashboard_wrap">
                @if($showForm)
                    <form wire:submit.prevent="save" autocomplete="off">
                        <div class="form-group smalls">
                            <label class="mb-2">{{ __('general.name') }}</label>
                            <input wire:model="name" type="text" class="form-control">
                            <div class="mt-2">
                                @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <livewire:widgets.select instance="Permission" title="permissions" :items="$items" :searchItems="$searchItems" />
                        <div class="mt-2">
                            @error('permissions.*') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <x-form-buttons/>
                    </form>
                @else
                    <x-title title="acl" />
                    <x-search/>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 mb-2">
                            <div class="table-responsive">
                                <table class="table dash_list">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('general.name') }}</th>
                                        <th scope="col">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $model)
                                        <tr>
                                            <th scope="row">{{ $model->id }}</th>
                                            <td>{{ $model->name }}</td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn btn-action" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="drp-select dropdown-menu">
                                                        @if(Auth::user()->can('permission.update'))
                                                            <a onclick="dispatch('admin.acl', 'update', {{ $model->id }})" href="#" class="dropdown-item">{{ __('buttons.edit') }}</a>
                                                        @endif
                                                        @if(Auth::user()->can('permission.delete'))
                                                            <a onclick="getConfirm('admin.acl', 'delete', {{ $model->id }}, '{{ __('general.sure') }}', '{{ __('general.noRevert') }}', '{{ __('buttons.yes') }}', '{{ __('buttons.no') }}')" class="dropdown-item">{{ __('buttons.delete') }}</a>
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

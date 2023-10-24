<div>
    <x-head-view title="episodes" modelName="episode" />

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="dashboard_wrap">
                <div class="mb-2 font-lg text-white" style="background-color: #198754; text-align: center">{{ __('general.course') . ': ' . $product->id . ' / ' . $product->title }}</div>
                <div class="{{ $showForm ? '' : 'd-none' }}">
                    <form wire:submit="save" autocomplete="off">
                        <div class="form-group smalls">
                            <label class="mb-2">{{ __('general.name') }}</label>
                            <input wire:model="form.title" type="text" class="form-control">
                            <div class="mt-2">
                                @error('form.title') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group smalls">
                            <label class="mb-2">{{ __('general.group') }}</label>
                            <input wire:model="form.group" type="text" class="form-control">
                            <div class="mt-2">
                                @error('form.group') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group smalls">
                            <label class="mb-2">{{ __('general.price') }}</label>
                            <input wire:model="form.price" type="number" class="form-control">
                            <div class="mt-2">
                                @error('form.price') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group smalls">
                            <label class="mb-2">{{ __('general.fakePrice') }}</label>
                            <input wire:model="form.fakePrice" type="number" class="form-control">
                            <div class="mt-2">
                                @error('form.fakePrice') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group smalls">
                            <label class="mb-2">{{ __('general.cover') }}</label>
                            <input type="file" wire:model="form.photo" class="form-control">
                            <div class="mt-2">
                                @error('form.photo') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            @if ($form->photo)
                                <div class="mb-2">
                                    <img src="{{ $form->photo->temporaryUrl() }}" style="max-width: 250px">
                                </div>
                            @endif
                            @foreach($imageList as $image)
                                <div class="mb-2">
                                    <img src="{{ url(route('getPublicImage', [$image, rand()])) }}" style="max-width: 250px">
                                    <a onclick="getConfirm('admin.courses', 'deleteImage', '{{ $image }}', '{{ __('general.sure') }}', '{{ __('general.noRevert') }}', '{{ __('buttons.yes') }}', '{{ __('buttons.no') }}')" class="fa fa-trash-alt text-danger" style="font-size: 40px"></a>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group smalls">
                            <label class="mb-2">{{ __('general.time') }}</label>
                            <input wire:model="form.time" type="text" class="form-control">
                            <div class="mt-2">
                                @error('form.time') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <livewire:widgets.multipleinputs title="links" placeHolder="links" wire:model="form.links" />
                        <div class="mt-2">
                            @error('form.links.*') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <x-form-buttons/>
                    </form>
                </div>
                <div class="{{ $showForm ? 'd-none' : '' }}">
                    <x-title title="episodes" />
                    <x-search/>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 mb-2">
                            <div class="table-responsive">
                                <table class="table dash_list">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('general.name') }}</th>
                                        <th scope="col">{{ __('general.time') }}</th>
                                        <th scope="col">{{ __('general.price') }}</th>
                                        <th scope="col">{{ __('general.fakePrice') }}</th>
                                        <th scope="col">{{ __('general.group') }}</th>
                                        <th scope="col">{{ __('general.status') }}</th>
                                        <th scope="col">{{ __('general.options') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $model)
                                        <tr>
                                            <th scope="row">{{ $model->id }}</th>
                                            <td>{{ $model->title }}</td>
                                            <td>{{ $model->time }}</td>
                                            <td>{{ number_format($model->price) }}</td>
                                            <td>{{ number_format($model->fake_price) }}</td>
                                            <td>{{ $model->group }}</td>
                                            <td onclick="getConfirm('admin.episodes', 'status', {{ $model->id }},  '{{ __('general.sure') }}', '', '{{ __('buttons.yes') }}', '{{ __('buttons.no') }}')">
                                                <i class="{{ $model->status ? 'fa fa-check text-success' : 'fa fa-times text-danger' }}"></i>
                                            </td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn btn-action" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="drp-select dropdown-menu">
                                                        @if(Auth::user()->can('product.update'))
                                                            <a onclick="dispatch('admin.episodes', 'update', {{ $model->id }})" class="dropdown-item">{{ __('buttons.edit') }}</a>
                                                        @endif
                                                        @if(Auth::user()->can('product.delete'))
                                                            <a onclick="getConfirm('admin.episodes', 'delete', '{{ 'Episode-' . $model->id }}', '{{ __('general.sure') }}', '{{ __('general.noRevert') }}', '{{ __('buttons.yes') }}', '{{ __('buttons.no') }}')" class="dropdown-item">{{ __('buttons.delete') }}</a>
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
                </div>
            </div>
        </div>
    </div>
</div>

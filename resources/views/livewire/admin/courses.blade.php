<div>
    <x-head-view title="courses" modelName="product" />

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="dashboard_wrap">
                <div class="{{ $showForm ? '' : 'd-none' }}">
                    <form wire:submit="save" autocomplete="off">
                        <div class="form-group smalls">
                            <label class="mb-2">{{ __('general.title') }}</label>
                            <input wire:model="form.title" type="text" class="form-control">
                            <div class="mt-2">
                                @error('form.title') <span class="error text-danger">{{ $message }}</span> @enderror
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
                        <livewire:widgets.ckeditor id="ckeditor1" title="description" />
                        <div class="mt-2">
                            @error('form.ckeditor1') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <livewire:widgets.ckeditor id="ckeditor2" title="longDescription" />
                        <div class="mt-2">
                            @error('form.ckeditor2') <span class="error text-danger">{{ $message }}</span> @enderror
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
                            <label class="mb-2">{{ __('general.courseTime') }}</label>
                            <input wire:model="form.time" type="text" class="form-control">
                            <div class="mt-2">
                                @error('form.time') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group smalls">
                            <label class="mb-2">{{ __('general.numberOfEpisodes') }}</label>
                            <input wire:model="form.numberOfEpisodes" type="number" class="form-control">
                            <div class="mt-2">
                                @error('form.numberOfEpisodes') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group smalls">
                            <label class="mb-2">{{ __('general.level') }}</label>
                            <select wire:model="form.level" class="form-select" aria-label="Default select example">
                                <option selected>{{ __('general.openSelect') }}</option>
                                <option value="beginner">{{ __('general.beginner') }}</option>
                                <option value="intermediate">{{ __('general.intermediate') }}</option>
                                <option value="advanced">{{ __('general.advanced') }}</option>
                            </select>
                            <div class="mt-2">
                                @error('form.level') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <livewire:widgets.multipleinputs title="features" placeHolder="feature" wire:model="form.features" />
                        <div class="mt-2">
                            @error('form.features.*') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <livewire:widgets.multipleinputs title="episodes" placeHolder="episode" wire:model="form.episodes" />
                        <div class="mt-2">
                            @error('form.episodes.*') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <livewire:widgets.select instance="Tag" title="tags" :searchItems="$searchItems" wire:model="form.tags" key="1" />

                        <livewire:widgets.select instance="Tutor" title="tutors" :searchItems="$searchItemTutors" wire:model="form.tutors" key="2" />
                        <div class="mt-2">
                            @error('form.tutors') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <x-form-buttons/>
                    </form>
                </div>
                <div class="{{ $showForm ? 'd-none' : '' }}">

                    <x-title title="courses" />
                    <x-search/>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 mb-2">
                            <div class="table-responsive">
                                <table class="table dash_list">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('general.name') }}</th>
                                        <th scope="col">{{ __('general.price') }}</th>
                                        <th scope="col">{{ __('general.fakePrice') }}</th>
                                        <th scope="col">{{ __('general.courseTime') }}</th>
                                        <th scope="col">{{ __('general.numberOfEpisodes') }}</th>
                                        <th scope="col">{{ __('general.level') }}</th>
                                        <th scope="col">{{ __('general.createdAt') }}</th>
                                        <th scope="col">{{ __('general.updatedAt') }}</th>
                                        <th scope="col">{{ __('general.options') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $model)
                                        <tr>
                                            <th scope="row">{{ $model->id }}</th>
                                            <td>{{ $model->title }}</td>
                                            <td>{{ number_format($model->price) }}</td>
                                            <td>{{ number_format($model->fake_price) }}</td>
                                            <td>{{ $model->options['time'] ?? '' }}</td>
                                            <td>{{ $model->options['numberOfEpisodes'] ?? '' }}</td>
                                            <td>{{ empty($model->options['level']) ? '' : __('general.' . $model->options['level']) }}</td>
                                            <td>{{ localDate($model->created_at) }}</td>
                                            <td>{{ localDate($model->updated_at) }}</td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn btn-action" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="drp-select dropdown-menu">
                                                        @if(Auth::user()->can('product.update'))
                                                            <a onclick="dispatch('admin.courses', 'update', {{ $model->id }})" class="dropdown-item">{{ __('buttons.edit') }}</a>
                                                        @endif
                                                        @if(Auth::user()->can('product.delete'))
                                                            <a onclick="getConfirm('admin.courses', 'delete', '{{ 'Product-' . $model->id }}', '{{ __('general.sure') }}', '{{ __('general.noRevert') }}', '{{ __('buttons.yes') }}', '{{ __('buttons.no') }}')" class="dropdown-item">{{ __('buttons.delete') }}</a>
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


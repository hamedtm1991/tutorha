<div>
    <x-head-view title="tutors" />

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="dashboard_wrap">
                <div class="{{ $showForm ? '' : 'd-none' }}">
                    <form wire:submit="save" autocomplete="off">
                        <div class="form-group smalls">
                            <label class="mb-2">{{ __('general.name') }}</label>
                            <input wire:model="form.name" type="text" class="form-control">
                            <div class="mt-2">
                                @error('form.name') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group smalls">
                            <label class="mb-2">{{ __('general.description') }}</label>
                            <textarea wire:model="form.description" type="text" class="form-control"></textarea>
                            <div class="mt-2">
                                @error('form.description') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group smalls">
                            <label class="mb-2">{{ __('general.image') }}</label>
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
                                    <a onclick="getConfirm('admin.tutors', 'deleteImage', '{{ $image }}', '{{ __('general.sure') }}', '{{ __('general.noRevert') }}', '{{ __('buttons.yes') }}', '{{ __('buttons.no') }}')" class="fa fa-trash-alt text-danger" style="font-size: 40px"></a>
                                </div>
                            @endforeach
                        </div>
                        <x-form-buttons/>
                    </form>
                </div>
                <div class="{{ $showForm ? 'd-none' : '' }}">
                    <x-title title="tutors" />
                    <x-search/>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 mb-2">
                            <div class="table-responsive">
                                <table class="table dash_list">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('general.name') }}</th>
                                        <th scope="col">{{ __('general.status') }}</th>
                                        <th scope="col">{{ __('general.options') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $model)
                                        <tr>
                                            <th scope="row">{{ $model->id }}</th>
                                            <td>{{ $model->name ?? $model->user->id . ' / ' .$model->user->name }}</td>
                                            <td onclick="getConfirm('admin.tutors', 'status', {{ $model->id }},  '{{ __('general.sure') }}', '', '{{ __('buttons.yes') }}', '{{ __('buttons.no') }}')">
                                                <i class="{{ $model->status ? 'fa fa-check text-success' : 'fa fa-times text-danger' }}"></i>
                                            </td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn btn-action" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="drp-select dropdown-menu">
                                                        @if(Auth::user()->can('tutor.update'))
                                                            <a onclick="dispatch('admin.tutors', 'update', {{ $model->id }})" class="dropdown-item">{{ __('buttons.edit') }}</a>
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


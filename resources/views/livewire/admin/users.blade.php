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
                                        <td>{{ $model->first_name }}  {{ $model->last_name }}</td>
                                        <td>{{ $model->mobile }}</td>
                                        <td>
                                            <div class="dropdown show">
                                                <a class="btn btn-action" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </a>
                                                <div class="drp-select dropdown-menu">
                                                    @if(\Illuminate\Support\Facades\Auth::user()->can('user.delete'))
                                                        <a onclick="getConfirm('admin.users', 'delete', {{ $model->id }}, '{{ __('general.sure') }}', '{{ __('general.noRevert') }}', '{{ __('buttons.yes') }}', '{{ __('buttons.no') }}')" class="dropdown-item">{{ __('buttons.delete') }}</a>
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

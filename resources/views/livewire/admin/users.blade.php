<div>
    <!-- Row -->
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
    <!-- /Row -->

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="dashboard_wrap">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 mb-4">
                        <h6 class="m-0">{{ __('general.users') }}</h6>
                    </div>
                </div>

{{--                <div class="row align-items-end mb-5">--}}
{{--                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label>دسته بندی</label>--}}
{{--                            <div class="smalls">--}}
{{--                                <select id="cates" class="form-control">--}}
{{--                                    <option value="">&nbsp;</option>--}}
{{--                                    <option value="1">فناوری اطلاعات</option>--}}
{{--                                    <option value="2">حسابداری</option>--}}
{{--                                    <option value="3">برنامه نویسی</option>--}}
{{--                                    <option value="4">مدیریت</option>--}}
{{--                                    <option value="5">طراحی و گرافیک</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <button type="button" class="btn text-white full-width theme-bg">فیلتر</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

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
{{--                                                    <a class="dropdown-item" href="JavaScript:Void(0);">مشاهده</a>--}}
{{--                                                    <a class="dropdown-item" href="JavaScript:Void(0);">ویرایش</a>--}}
                                                    @if(\Illuminate\Support\Facades\Auth::user()->can('user.delete'))
                                                        <a onclick="getConfirm('admin.users', 'delete', {{ $model->id }}, '{{ __('crud.sure') }}', '{{ __('crud.noRevert') }}')" class="dropdown-item">حذف</a>
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

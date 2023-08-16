<div class="mt-5">
    <label class="mb-2">{{ __('general.'. $title) }}</label>
    <div class="input-group mb-3">
        <input wire:model.live="selectSearch" type="text" name="item" class="form-control">
        @error('selectSearch') <span class="text-danger w-100">{{ $message }}</span> @enderror
    </div>
    @if($selectSearch)
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container-fluid ">
                <!--begin::Row-->
                <div class="row">
                @foreach($selectData as $item)
                    <!--begin::Col-->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <!--begin::Card-->
                            <div class="card card-custom gutter-b card-stretch">
                                <!--begin::Body-->
                                <div class="card-body text-center pt-4">
                                    <span class="label label-inline label-lg label-light-warning font-weight-bold">{{ $item->id }}</span>

                                    <!--begin::برچسب-->
                                    <span class="label label-inline label-lg label-light-success font-weight-bold">{{ $item->mobile }}</span>
                                    <!--end::برچسب-->

                                    <!--begin::نام-->
                                    <span class="font-weight-bold">{{ $item->name }}</span>
                                    <!--end::نام-->
                                </div>
                                <div onclick="dispatch('widgets.select', 'add', '{{ $item->id }}', '{{ $item->name }}')" class="btn btn-sm btn-warning mt-3">{{ __('buttons.add') }}</div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Col-->
                    @endforeach
                </div>
                <!--end::Row-->

                <!--begin::صفحه بندی-->
                {{ $selectData->links('pagination') }}
            <!--end::صفحه بندی-->
            </div>
            <!--end::Container-->
        </div>
    @endif


    @if($items)
        <div class="row mt-2">
            @foreach($items as $index => $item)
                <div class="col-md-3">
                    <span class="fa fa-trash-alt text-danger" onclick="dispatch('widgets.select', 'delete', {{ $index }})"></span>
                    <span>{{ $item }}/{{ $index }}</span>
                </div>
            @endforeach
        </div>
    @endif
</div>

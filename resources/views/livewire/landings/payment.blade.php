<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div>
    <!-- ============================ Page Title Start================================== -->
    <section class="page-title gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <div class="breadcrumbs-wrap text-center">
                        <h1 class="breadcrumb-title font-2">{{ __('general.increaseBalance') }}</h1>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ============================ Page Title End ================================== -->

    <!-- ============================ Our Story Start ================================== -->
    <div class="container">
        <section class="gray-simple">
        <form wire:submit="bank">
            <div class="text-center display-3 mb-5">
                <input wire:model="price"  id="pay-input-main" type="text" hidden="hidden">
                <div>
                    <input onkeyup="changeValue()" class="form-control" dir="ltr" id="pay-input" type="text" placeholder="مبلغ">
                </div>
                <div>
                    @error('price') <span class="error text-danger fs-2">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-md-center">
                    <a onclick="autoValue(200000);" class="col-lg-3 col-md-3 col-sm-6 border border-success me-lg-2 text-center my-2 p-5 rounded display-5 d-flex align-items-end">۲۰۰,۰۰۰ <div class="fs-4">{{ __('general.toman') }}</div></a>
                    <a onclick="autoValue(500000);" class="col-lg-3 col-md-3 col-sm-6 border border-success me-lg-2 text-center my-2 p-5 rounded display-5 d-flex align-items-end">۵۰۰,۰۰۰ <div class="fs-4">{{ __('general.toman') }}</div></a>
                    <a onclick="autoValue(1000000);" class="col-lg-3 col-md-3 col-sm-6 border border-success me-lg-2 text-center my-2 p-5 rounded display-5 d-flex align-items-end">۱,۰۰۰,۰۰۰ <div class="fs-4">{{ __('general.toman') }}</div></a>
                </div>
            </div>

            <div class="text-center mt-5">
                <button type="submit" class="btn btn-success">{{ __('buttons.pay') }}</button>
            </div>
        </form>
    </section>
    </div>
    <!-- ============================ Our Story End ================================== -->


    <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
</div>

@push('scripts')
    <script>
        function autoValue(value)
        {
            Livewire.first().set('price', value)
            document.getElementById("pay-input").value = Number(value).toLocaleString().replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }

        function changeValue()
        {
            let value = document.getElementById("pay-input").value;
            Livewire.first().set('price', value.replace(/\D/g, ""))
            let afterEdit = value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            document.getElementById("pay-input").value = afterEdit;
        }

        document.addEventListener('livewire:init', (event) => {
            Livewire.on('price', ({price}) => {
                let value = price;
                let afterEdit = value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                document.getElementById("pay-input").value = afterEdit;
            });
        });
    </script>
@endpush

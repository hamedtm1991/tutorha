<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->
<!-- Start Navigation -->
<div class="header header-light head-shadow">
    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <a class="nav-brand" href="{{ route('home') }}">
                    <img src="{{ secure_asset('storage/logo.png') }}" class="logo" alt="" />
                </a>
                <div class="nav-toggle"></div>
                <div class="mobile_nav">
                    <ul>
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">{{__('general.increaseBalance')}}
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        @php($value = optional(\Illuminate\Support\Facades\Auth::user()->wallet)->value)
                                        {{__('general.toman')}}
                                        {{ empty($value) ? 0 : number_format($value) }}
                                    </a>

                                    <a class="dropdown-item" href="#">
                                        {{__('buttons.logout')}}
                                    </a>
                                </div>
                            </div>
{{--                            <li>--}}
{{--                                <a href="{{ route('payment') }}">--}}
{{--                                    <span class="mx-2">--}}
{{--                                        {{ __('general.increaseBalance') }}--}}
{{--                                    </span>--}}
{{--                                    <i class="fas fa-plus"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('transactions') }}">--}}
{{--                                    @php($value = optional(\Illuminate\Support\Facades\Auth::user()->wallet)->value)--}}
{{--                                    <span class="mx-2">--}}
{{--                                        {{ __('general.toman') }} {{ empty($value) ? 0 : number_format($value) }}--}}
{{--                                    </span>--}}
{{--                                    <i class="fas fa-wallet"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('logout') }}" class="crs_yuo12 w-auto text-white bg-danger">--}}
{{--                                    <span class="embos_45">{{ __('buttons.logout') }}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="crs_yuo12 w-auto text-white theme-bg">
                                    <span class="embos_45">{{ __('buttons.login') }}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="nav-menus-wrapper">
                <ul class="nav-menu">
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <li class="{{ request()->routeIs('home') ? 'active' : ''  }}"><a class="fs-5" href="{{ route('home') }}">{{ __('general.home') }}</a></li>
                        <li class="{{ request()->routeIs('transactions') ? 'active' : ''  }}"><a class="fs-5" href="{{ route('transactions') }}">{{ __('general.transactions') }}</a></li>
                    @endif
                </ul>

                    @if(\Illuminate\Support\Facades\Auth::check())


                    <ul class="nav-menu nav-menu-social align-to-left">


                        <li class="">
                            <a class="fs-5" href="{{ route('payment') }}">
                                <span class="">
                                    {{ __('general.increaseBalance') }}
                                </span>
                                <i class="fas fa-plus"></i>
                            </a>
                        </li>
                        <li class="mx-5">
                            <a class="fs-5" href="{{ route('transactions') }}">
                                @php($value = optional(\Illuminate\Support\Facades\Auth::user()->wallet)->value)
                                <span class="">
                                    {{ __('general.toman') }} {{ empty($value) ? 0 : number_format($value) }}
                                </span>
                                <i class="fas fa-wallet"></i>
                            </a>
                        </li>
                        <li class="add-listing bg-danger">
                            <a href="{{ route('logout') }}" class="text-white">{{ __('buttons.logout') }}</a>
                        </li>
                    </ul>

                    @else
                    <ul class="nav-menu nav-menu-social align-to-left">

                        <li class="add-listing theme-bg">
                            <a href="{{ route('login') }}" class="text-white">{{ __('buttons.login') }}</a>
                        </li>
                    </ul>
                    @endif
            </div>
        </nav>
    </div>
</div>
<!-- End Navigation -->
<div class="clearfix"></div>
<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->

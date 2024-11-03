<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->
<!-- Start Navigation -->
<div class="header header-light head-shadow">
    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <a class="nav-brand" href="{{ route('home') }}">
                    <img src="{{ secure_asset('storage/logo.png') }}" class="logo" alt="logo" />
                </a>
                @if(\Illuminate\Support\Facades\Auth::check())
                    <div class="nav-toggle"></div>
                @endif
                <div class="mobile_nav">
                    <ul>
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                        <a class="dropdown-item" href="{{ route('transactions') }}">{{ __('general.transactions') }}</a>
                                        <a class="dropdown-item" href="{{ route('my-courses') }}">{{ __('general.myCourses') }}</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('payment') }}">{{__('general.increaseBalance')}}
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        @php($value = optional(\Illuminate\Support\Facades\Auth::user()->wallet)->value)
                                        اعتبار:
                                        {{ empty($value) ? 0 : number_format($value) }}
                                        <span style="font-size: 10px">{{__('general.toman')}}</span>
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}">
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
                    <li><a href="{{ route('all-courses', ['tag' => 'all']) }}" class="fs-6">دوره های آموزشی<span class="submenu-indicator"></span></a>
                            <ul class="nav-dropdown nav-submenu">
                                <li><a href="{{ route('all-courses', ['tag' => 'all']) }}">همه</a></li>
                                <li><a href="{{ route('all-courses', ['tag' => 'programming']) }}">برنامه نویسی</a></li>
                                <li><a href="{{ route('all-courses', ['tag' => 'php']) }}">php</a></li>
                            </ul>
                        </li>
                    <li class="{{ request()->routeIs('tutors') ? 'active' : ''  }}"><a class="fs-6" href="{{ route('tutors') }}">{{ __('general.tutors') }}</a></li>
                    <li class="{{ request()->routeIs('blog') ? 'active' : ''  }}"><a class="fs-6" href="{{ route('blog') }}">{{ __('general.blog') }}</a></li>
                </ul>

                    @if(\Illuminate\Support\Facades\Auth::check())


                    <ul class="nav-menu nav-menu-social align-to-left">
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <li class="{{ request()->routeIs('transactions') ? 'active' : ''  }}"><a class="fs-6" href="{{ route('transactions') }}">{{ __('general.transactions') }}</a></li>
                            <li class="{{ request()->routeIs('courses') ? 'active' : ''  }}"><a class="fs-6" href="{{ route('my-courses') }}">{{ __('general.myCourses') }}</a></li>
                        @endif
                        <li class="">
                            <a class="fs-6" href="{{ route('payment') }}">
                                <span class="">
                                    {{ __('general.increaseBalance') }}
                                </span>
                                <i class="fas fa-plus"></i>
                            </a>
                        </li>
                        <li class="mx-5">
                            <span class="fs-6" href="{{ route('transactions') }}">
                                @php($value = optional(\Illuminate\Support\Facades\Auth::user()->wallet)->value)
                                <span class="">
                                    {{ __('general.toman') }} {{ empty($value) ? 0 : number_format($value) }}
                                </span>
                                <i class="fas fa-wallet"></i>
                            </span>
                        </li>
                        <li class="add-listing" style="background-color: #e1002d">
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

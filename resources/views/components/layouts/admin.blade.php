<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="author" content="Themezhub" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SkillUp - قالب HTML دوره آنلاین و آموزش</title>
    <!-- Custom CSS -->
    @vite(['resources/css/app.css'])
    @stack('styles')

</head>

<body dir="rtl">
    <x-header/>

    <div id="main-wrapper">

        <section class="gray pt-4">
            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-3 col-md-3">
                        <div class="dashboard-navbar">

                            <div class="d-user-avater">
                                <img src="assets/img/user-3.jpg" class="img-fluid avater" alt="">
                                <h4>{{ \App\Models\User::nameOrMobile() }}</h4>
                                <div class="elso_syu77">
                                    <div class="one_third"><div class="one_45ic text-warning bg-light-warning"><i class="fas fa-star"></i></div><span>امتیازات</span></div>
                                    <div class="one_third"><div class="one_45ic text-success bg-light-success"><i class="fas fa-file-invoice"></i></div><span>دوره ها</span></div>
                                    <a href="{{ route('admin.users') }}" class="one_third"><div class="one_45ic text-purple bg-light-purple"><i class="fas fa-user"></i></div><span>{{ __('general.users') }}</span></a>
                                </div>
                            </div>

                            <div class="d-navigation">
                                <ul id="side-menu">
                                    <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : ''  }}"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-th"></i>{{ __('general.dashboard') }}</a></li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0);"><i class="fas fa-user"></i>{{ __('general.users') }}<span class="ti-angle-left"></span></a>
                                        <ul class="nav nav-second-level {{ request()->routeIs('admin.users', 'admin.acl') ? 'collapse show' : ''  }}">
                                            <li class="{{ request()->routeIs('admin.users') ? 'active' : ''  }}"><a href="{{ route('admin.users') }}">{{ __('general.users') }}</a></li>
                                            <li class="{{ request()->routeIs('admin.acl') ? 'active' : ''  }}"><a href="{{ route('admin.acl') }}">{{ __('general.acl') }}</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-9 col-md-9 col-sm-12">
                        {{ $slot }}
                    </div>

                </div>

            </div>
        </section>

    </div>

    <x-footer/>

    @vite(['resources/js/app.js'])
    @vite(['resources/js/bootstrap.js'])
    @vite(['resources/js/app2.js'])
    @vite(['resources/js/metisMenu.js'])
    @vite(['resources/js/custom.js'])

    @stack('scripts')
</body>

</html>

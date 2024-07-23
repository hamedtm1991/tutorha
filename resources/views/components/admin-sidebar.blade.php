<div class="col-lg-3 col-md-3">
    <div class="dashboard-navbar">

        <div class="d-user-avater">
            <img src="assets/img/user-3.jpg" class="img-fluid avater" alt="">
            <h4>{{ \App\Models\User::nameOrMobile() }}</h4>
            <div class="elso_syu77">
                <div class="one_third"><div class="one_45ic text-warning bg-light-warning"><i class="fas fa-star"></i></div><span>امتیازات</span></div>
                <div class="one_third"><div class="one_45ic text-success bg-light-success"><i class="fas fa-file-invoice"></i></div><span>دوره‌ها</span></div>
                <a href="{{ route('admin.users') }}" class="one_third"><div class="one_45ic text-purple bg-light-purple"><i class="fas fa-user"></i></div><span>{{ __('general.users') }}</span></a>
            </div>
        </div>

        <div class="d-navigation">
            <ul id="side-menu">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : ''  }}"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-th"></i>{{ __('general.dashboard') }}</a></li>
                <li class="dropdown">
                    <a href="javascript:void(0);"><i class="fas fa-user"></i>{{ __('general.users') }}<span class="ti-angle-left"></span></a>
                    <ul class="nav nav-second-level {{ request()->routeIs('admin.users', 'admin.acl', 'admin.tutors') ? 'collapse show' : ''  }}">
                        <li class="{{ request()->routeIs('admin.users') ? 'active' : ''  }}"><a href="{{ route('admin.users') }}">{{ __('general.users') }}</a></li>
                        <li class="{{ request()->routeIs('admin.acl') ? 'active' : ''  }}"><a href="{{ route('admin.acl') }}">{{ __('general.acl') }}</a></li>
                        <li class="{{ request()->routeIs('admin.tutors') ? 'active' : ''  }}"><a href="{{ route('admin.tutors') }}">{{ __('general.tutors') }}</a></li>
                    </ul>
                </li>
                <li class="{{ request()->routeIs('admin.courses') ? 'active' : ''  }}"><a href="{{ route('admin.courses') }}"><i class="fas fa-chalkboard-teacher"></i>{{ __('general.courses') }}</a></li>
                <li class="{{ request()->routeIs('admin.tags') ? 'active' : ''  }}"><a href="{{ route('admin.tags') }}"><i class="fas fa-tags"></i>{{ __('general.tags') }}</a></li>
                <li class="dropdown">
                    <a href="javascript:void(0);"><i class="fas fa-dollar-sign"></i>{{ __('general.financial') }}<span class="ti-angle-left"></span></a>
                    <ul class="nav nav-second-level {{ request()->routeIs('admin.transactions', 'admin.orders', 'admin.payments') ? 'collapse show' : ''  }}">
                        <li class="{{ request()->routeIs('admin.transactions') ? 'active' : ''  }}"><a href="{{ route('admin.transactions') }}">{{ __('general.transactions') }}</a></li>
                        <li class="{{ request()->routeIs('admin.orders') ? 'active' : ''  }}"><a href="{{ route('admin.orders') }}">{{ __('general.orders') }}</a></li>
                        <li class="{{ request()->routeIs('admin.payments') ? 'active' : ''  }}"><a href="{{ route('admin.payments') }}">{{ __('general.payments') }}</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</div>

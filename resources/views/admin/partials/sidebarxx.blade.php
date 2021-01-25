@include('admin.partials.menu')

<!-- BEGIN: Sidebar -->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ route('admin.index') }}">
                    <i class="feather icon-shopping-cart"></i>
                    <h2 class="brand-text mb-0" style="color: #fff">{{ trans('admin.sitename') }}</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
                    <i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
                        data-ticon="icon-disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="navigation-header"></li>
            <li {{ request()->route()->getName() === 'admin.index' ? 'class=active' : '' }}>
                <a href="{{ route('admin.index') }}" class="nav-link">
                    <i class="feather icon-home"></i>
                    <span class="title">{{ trans('admin.home') }}</span>
                </a>
            </li>
            @if (auth()->user()->can('read_trade_marks'))
            <li {{ request()->route()->getName() === 'admin.trade_marks.index' ? 'class=active' : '' }}>
                <a href="{{ route('admin.trade_marks.index') }}" class="nav-link">
                    <i class="feather icon-bookmark"></i>
                    <span class="title">{{ trans('admin.trade_marks') }}</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a href="#">
                    <i class="feather icon-tag"></i>
                    <span class="menu-title">{{ trans('admin.categories_management') }}</span>
                </a>
                <ul class="menu-content">
                    @if (auth()->user()->can('read_categories'))
                    <li {{ request()->route()->getName() === 'admin.categories.index' ? 'class=active' : '' }}>
                        <a href="{{ route('admin.categories.index') }}" class="nav-link">
                            <i class="feather icon-tag"></i>
                            <span class="title">{{ trans('admin.categories') }}</span>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->can('read_sub_categories'))
                    <li {{ request()->route()->getName() === 'admin.sub_categories.index' ? 'class=active' : '' }}>
                        <a href="{{ route('admin.sub_categories.index') }}" class="nav-link">
                            <i class="feather icon-tag"></i>
                            <span class="title">{{ trans('admin.sub_categories') }}</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @if (auth()->user()->can('read_manufacturers'))
            <li {{ request()->route()->getName() === 'admin.manufacturers.index' ? 'class=active' : '' }}>
                <a href="{{ route('admin.manufacturers.index') }}" class="nav-link">
                    <i class="feather icon-bookmark"></i>
                    <span class="title">{{ trans('admin.manufacturers') }}</span>
                </a>
            </li>
            @endif
            @if (auth()->user()->can('read_shippings'))
            <li {{ request()->route()->getName() === 'admin.shippings.index' ? 'class=active' : '' }}>
                <a href="{{ route('admin.shippings.index') }}" class="nav-link">
                    <i class="feather icon-bookmark"></i>
                    <span class="title">{{ trans('admin.shippings') }}</span>
                </a>
            </li>
            @endif
            @if (auth()->user()->can('read_malls'))
            <li {{ request()->route()->getName() === 'admin.malls.index' ? 'class=active' : '' }}>
                <a href="{{ route('admin.malls.index') }}" class="nav-link">
                    <i class="feather icon-bookmark"></i>
                    <span class="title">{{ trans('admin.malls') }}</span>
                </a>
            </li>
            @endif
            @if (auth()->user()->can('read_notifications'))
            <li {{ request()->route()->getName() === 'admin.notifications.index' ? 'class=active' : '' }}>
                <a href="{{ route('admin.notifications.index') }}" class="nav-link">
                    <i class="feather icon-bell"></i>
                    <span class="title">{{ trans('admin.notifications') }}</span>
                </a>
            </li>
            @endif
            @if (auth()->user()->can('read_contacts'))
            <li {{ request()->route()->getName() === 'admin.contacts.index' ? 'class=active' : '' }}>
                <a href="{{ route('admin.contacts.index') }}" class="nav-link">
                    <i class="ficon feather icon-mail"></i>
                    <span class="title">{{ trans('admin.contacts') }}</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a href="#">
                    <i class="feather icon-info"></i>
                    <span class="menu-title">{{ trans('admin.system_constants') }}</span>
                    {{-- <span class="badge badge badge-primary badge-pill float-right mr-2">New</span> --}}
                </a>
                <ul class="menu-content">
                    @if (auth()->user()->can('read_countries'))
                    <li {{ request()->route()->getName() === 'admin.countries.index' ? 'class=active' : '' }}>
                        <a href="{{ route('admin.countries.index') }}" class="nav-link">
                            <i class="feather icon-flag"></i>
                            <span class="title">{{ trans('admin.countries') }}</span>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->can('read_cities'))
                    <li {{ request()->route()->getName() === 'admin.cities.index' ? 'class=active' : '' }}>
                        <a href="{{ route('admin.cities.index') }}" class="nav-link">
                            <i class="fa fa-building-o"></i>
                            <span class="title">{{ trans('admin.cities') }}</span>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->can('read_states'))
                    <li {{ request()->route()->getName() === 'admin.states.index' ? 'class=active' : '' }}>
                        <a href="{{ route('admin.states.index') }}" class="nav-link">
                            <i class="fa fa-building-o"></i>
                            <span class="title">{{ trans('admin.states') }}</span>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->can('read_colors'))
                    <li {{ request()->route()->getName() === 'admin.colors.index' ? 'class=active' : '' }}>
                        <a href="{{ route('admin.colors.index') }}" class="nav-link">
                            <i class="feather icon-droplet"></i>
                            <span class="title">{{ trans('admin.colors') }}</span>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->can('read_weights'))
                    <li {{ request()->route()->getName() === 'admin.weights.index' ? 'class=active' : '' }}>
                        <a href="{{ route('admin.weights.index') }}" class="nav-link">
                            <i class="fa fa-balance-scale"></i>
                            <span class="title">{{ trans('admin.weights') }}</span>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->can('read_sizes'))
                    <li {{ request()->route()->getName() === 'admin.sizes.index' ? 'class=active' : '' }}>
                        <a href="{{ route('admin.sizes.index') }}" class="nav-link">
                            <i class="feather icon-camera"></i>
                            <span class="title">{{ trans('admin.sizes') }}</span>
                        </a>
                    </li>
                    @endif
                    {{-- <li {{ request()->route()->getName() === 'admin.payments.index' ? 'class=active' : '' }}>
                        <a href="{{ route('admin.payments.index') }}" class="nav-link">
                            <i class="fa fa-money"></i>
                            <span class="title">{{ trans('admin.payments') }}</span>
                        </a>
                    </li> --}}
                </ul>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="feather icon-users"></i>
                    <span class="menu-title">{{ trans('admin.users_management') }}</span>
                </a>
                <ul class="menu-content">
                    @if (auth()->user()->can('read_users'))
                    <li {{ request()->route()->getName() === 'admin.users.index' ? 'class=active' : '' }}>
                        <a href="{{ route('admin.users.index') }}" class="nav-link">
                            <i class="feather icon-users"></i>
                            <span class="title">{{ trans('admin.users') }}</span>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->can('read_roles'))
                    <li {{ request()->route()->getName() === 'admin.roles.index' ? 'class=active' : '' }}>
                        <a href="{{ route('admin.roles.index') }}" class="nav-link">
                            <i class="feather icon-sliders"></i>
                            <span class="title">{{ trans('admin.per_roles') }}</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="feather icon-bar-chart"></i>
                    <span class="menu-title">{{ trans('admin.reports') }}</span>
                </a>
                <ul class="menu-content">
                    @if (auth()->user()->can('read_shippings'))
                    <li {{ request()->route()->getName() === 'admin.reports.shippings.index' ? 'class=active' : '' }}>
                        <a href="#" class="nav-link">
                            <i class="fa fa-money"></i>
                            <span class="title">{{ trans('admin.reports_shippings') }}</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @if (auth()->user()->can('read_settings'))
            <li {{ request()->route()->getName() === 'admin.settings.index' ? 'class=active' : '' }}>
                <a href="{{ route('admin.settings.index') }}" class="nav-link">
                    <i class="feather icon-settings"></i>
                    <span class="title">{{ trans('admin.settings') }}</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</div>
<!-- END: Sidebar -->

@include('admin.partials.master')
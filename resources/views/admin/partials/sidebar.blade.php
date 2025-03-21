@include('admin.partials.menu')

<!-- BEGIN: Sidebar -->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ route('admin.index') }}">
                    <span class="brand-logo">
                        <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                            <defs>
                                <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%"
                                    y2="89.4879456%">
                                    <stop stop-color="#000000" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                                <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%"
                                    y2="100%">
                                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                            </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                    <g id="Group" transform="translate(400.000000, 178.000000)">
                                        <path class="text-primary" id="Path"
                                            d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                            style="fill:currentColor"></path>
                                        <path id="Path1"
                                            d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                            fill="url(#linearGradient-1)" opacity="0.2"></path>
                                        <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                                            points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325">
                                        </polygon>
                                        <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                                            points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338">
                                        </polygon>
                                        <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                                            points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                    </g>
                                </g>
                            </g>
                        </svg></span>
                    <h2 class="brand-text">{{ trans('admin.sitename') }}</h2>
                </a></li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li {{ request()->route()->getName() === 'admin.index' ? 'class=active' : '' }}>
                <a href="{{ route('admin.index') }}" class="d-flex align-items-center">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate">{{ trans('admin.home') }}</span>
                </a>
            </li>
            @if (auth()->user()->can('read_appointments'))
            <li {{ request()->route()->getName() === 'admin.appointments.index' ? 'class=active' : '' }}>
                <a href="{{ route('admin.appointments.index') }}" class="d-flex align-items-center">
                    <i data-feather='calendar'></i>
                    <span class="menu-title text-truncate">{{ trans('admin.appointments') }}</span>
                </a>
            </li>
            @endif
            @if (auth()->user()->can('read_patients'))
            <li {{ request()->route()->getName() === 'admin.patients.index' ? 'class=active' : '' }}>
                <a href="{{ route('admin.patients.index') }}" class="d-flex align-items-center">
                    <i data-feather="users"></i>
                    <span class="menu-title text-truncate">{{ trans('admin.patients') }}</span>
                </a>
            </li>
            @endif
            @if (auth()->user()->can('read_services'))
            <li {{ request()->route()->getName() === 'admin.services.index' ? 'class=active' : '' }}>
                <a href="{{ route('admin.services.index') }}" class="d-flex align-items-center">
                    <i data-feather='check-circle'></i>
                    <span class="menu-title text-truncate">{{ trans('admin.services') }}</span>
                </a>
            </li>
            @endif
            @if (auth()->user()->can('read_drugs'))
            <li {{ request()->route()->getName() === 'admin.drugs.index' ? 'class=active' : '' }}>
                <a href="{{ route('admin.drugs.index') }}" class="d-flex align-items-center">
                    <i data-feather='octagon'></i>
                    <span class="menu-title text-truncate">{{ trans('admin.drugs') }}</span>
                </a>
            </li>
            @endif
            @if (auth()->user()->can('read_tests'))
            <li {{ request()->route()->getName() === 'admin.tests.index' ? 'class=active' : '' }}>
                <a href="{{ route('admin.tests.index') }}" class="d-flex align-items-center">
                    <i data-feather='file-text'></i>
                    <span class="menu-title text-truncate">{{ trans('admin.tests') }}</span>
                </a>
            </li>
            @endif
            @if (auth()->user()->can('read_notifications'))
            <li {{ request()->route()->getName() === 'admin.notifications.index' ? 'class=active' : '' }}>
                <a href="{{ route('admin.notifications.index') }}" class="d-flex align-items-center">
                    <i data-feather="bell"></i>
                    <span class="menu-title text-truncate">{{ trans('admin.notifications') }}</span>
                </a>
            </li>
            @endif
            @if (auth()->user()->can('read_contacts'))
            <li {{ request()->route()->getName() === 'admin.contacts.index' ? 'class=active' : '' }}>
                <a href="{{ route('admin.contacts.index') }}" class="d-flex align-items-center">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">{{ trans('admin.contacts') }}</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a href="#" class="d-flex align-items-center">
                    <i data-feather="info"></i>
                    <span class="menu-title text-truncate">{{ trans('admin.system_constants') }}</span>
                    {{-- <span class="badge badge-light-warning badge-pill ml-auto mr-1">2</span>
                    <span class="badge badge badge-primary badge-pill float-right mr-2">New</span> --}}
                </a>
                <ul class="menu-content">
                    @if (auth()->user()->can('read_countries'))
                    <li {{ request()->route()->getName() === 'admin.countries.index' ? 'class=active' : '' }}>
                        <a href="{{ route('admin.countries.index') }}" class="d-flex align-items-center">
                            <i data-feather="flag"></i>
                            <span class="menu-title text-truncate">{{ trans('admin.countries') }}</span>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->can('read_cities'))
                    <li {{ request()->route()->getName() === 'admin.cities.index' ? 'class=active' : '' }}>
                        <a href="{{ route('admin.cities.index') }}" class="d-flex align-items-center">
                            <i data-feather="bookmark"></i>
                            <span class="menu-title text-truncate">{{ trans('admin.cities') }}</span>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->can('read_districts'))
                    <li {{ request()->route()->getName() === 'admin.districts.index' ? 'class=active' : '' }}>
                        <a href="{{ route('admin.districts.index') }}" class="d-flex align-items-center">
                            <i data-feather="droplet"></i>
                            <span class="menu-title text-truncate">{{ trans('admin.districts') }}</span>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->can('read_locations'))
                    <li {{ request()->route()->getName() === 'admin.locations.index' ? 'class=active' : '' }}>
                        <a href="{{ route('admin.locations.index') }}" class="d-flex align-items-center">
                            <i data-feather="map-pin"></i>
                            <span class="menu-title text-truncate">{{ trans('admin.locations') }}</span>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->can('read_constants'))
                    <li {{ request()->route()->getName() === 'admin.constants.index' ? 'class=active' : '' }}>
                        <a href="{{ route('admin.constants.index') }}" class="d-flex align-items-center">
                            <i data-feather="award"></i>
                            <span class="menu-title text-truncate">{{ trans('admin.constants') }}</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="d-flex align-items-center">
                    <i data-feather="users"></i>
                    <span class="menu-title text-truncate">{{ trans('admin.users_management') }}</span>
                </a>
                <ul class="menu-content">
                    @if (auth()->user()->can('read_users'))
                    <li {{ request()->route()->getName() === 'admin.users.index' ? 'class=active' : '' }}>
                        <a href="{{ route('admin.users.index') }}" class="d-flex align-items-center">
                            <i data-feather="users"></i>
                            <span class="menu-title text-truncate">{{ trans('admin.users') }}</span>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->can('read_roles'))
                    <li {{ request()->route()->getName() === 'admin.roles.index' ? 'class=active' : '' }}>
                        <a href="{{ route('admin.roles.index') }}" class="d-flex align-items-center">
                            <i data-feather="sliders"></i>
                            <span class="menu-title text-truncate">{{ trans('admin.per_roles') }}</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="d-flex align-items-center">
                    <i data-feather="bar-chart"></i>
                    <span class="menu-title text-truncate">{{ trans('admin.reports') }}</span>
                </a>
                <ul class="menu-content">
                    @if (auth()->user()->can('read_patients'))
                    <li {{ request()->route()->getName() === 'admin.reports.patients.index' ? 'class=active' : '' }}>
                        <a href="#" class="d-flex align-items-center">
                            <i class="fa fa-money"></i>
                            <span class="menu-title text-truncate">{{ trans('admin.reports_patients') }}</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @if (auth()->user()->can('read_settings'))
            <li {{ request()->route()->getName() === 'admin.settings.index' ? 'class=active' : '' }}>
                <a href="{{ route('admin.settings.index') }}" class="d-flex align-items-center">
                    <i data-feather="settings"></i>
                    <span class="menu-title text-truncate">{{ trans('admin.settings') }}</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</div>
<!-- END: Sidebar -->

@include('admin.partials.master')
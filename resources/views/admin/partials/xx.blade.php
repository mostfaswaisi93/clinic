<!-- BEGIN: Menu -->
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto">
                            <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                                <i class="ficon feather icon-menu"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">
                    {{-- Start Language --}}
                    <li class="dropdown dropdown-language nav-item">
                        @if(app()->getLocale() == 'en')
                        <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
                        @else
                        <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="flag-icon flag-icon-sa"></i><span class="selected-language">العربية</span></a>
                        @endif
                        <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if($localeCode == LaravelLocalization::getCurrentLocale())
                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                @if(app()->getLocale() == 'en')
                                <i class="flag-icon flag-icon-us"></i>
                                @else
                                <i class="flag-icon flag-icon-sa"></i>
                                @endif
                                {{ $properties['native'] }}
                            </a>
                            @elseif($url = LaravelLocalization::getLocalizedURL($localeCode))
                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                @if(app()->getLocale() == 'en')
                                <i class="flag-icon flag-icon-sa"></i>
                                @else
                                <i class="flag-icon flag-icon-us"></i>
                                @endif
                                {{ $properties['native'] }}
                            </a>
                            @endif
                            @endforeach
                        </div>
                    </li>
                    {{-- End Language --}}
                    {{-- Start Search --}}
                    <li class="nav-item nav-search">
                        <a class="nav-link nav-link-search">
                            <i class="ficon feather icon-search"></i>
                        </a>
                        <div class="search-input">
                            <div class="search-input-icon">
                                <i class="feather icon-search primary"></i>
                            </div>
                            <input class="input" type="text" placeholder="..." tabindex="-1"
                                data-search="template-list">
                            <div class="search-input-close">
                                <i class="feather icon-x"></i>
                            </div>
                            <ul class="search-list search-list-main"></ul>
                        </div>
                    </li>
                    {{-- End Search --}}
                    {{-- Start Messages --}}
                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                            <i class="ficon feather icon-mail"></i>
                            <span class="badge badge-pill badge-primary badge-up">2</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header m-0 p-2">
                                    <h3 class="white">2 New</h3>
                                    <span class="notification-title">App Messages</span>
                                </div>
                            </li>
                            <li class="scrollable-container media-list">
                                <a class="d-flex justify-content-between" href="javascript:void(0)">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left"><i
                                                class="feather icon-plus-square font-medium-5 primary"></i></div>
                                        <div class="media-body">
                                            <h6 class="primary media-heading">You have new order!</h6><small
                                                class="notification-text"> Are your going to meet me tonight?</small>
                                        </div><small>
                                            <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">9 hours
                                                ago</time></small>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center"
                                    href="javascript:void(0)">Read all messages</a></li>
                        </ul>
                    </li>
                    {{-- End Messages --}}
                    {{-- Start Notifications --}}
                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                            <i class="ficon feather icon-bell"></i>
                            <span class="badge badge-pill badge-primary badge-up">2</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header m-0 p-2">
                                    <h3 class="white">2 New</h3>
                                    <span class="notification-title">App Notifications</span>
                                </div>
                            </li>
                            <li class="scrollable-container media-list">
                                <a class="d-flex justify-content-between" href="javascript:void(0)">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left"><i
                                                class="feather icon-plus-square font-medium-5 primary"></i></div>
                                        <div class="media-body">
                                            <h6 class="primary media-heading">You have new order!</h6><small
                                                class="notification-text"> Are your going to meet me tonight?</small>
                                        </div><small>
                                            <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">9 hours
                                                ago</time></small>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center"
                                    href="javascript:void(0)">Read all notifications</a></li>
                        </ul>
                    </li>
                    {{-- End Notifications --}}
                    {{-- Start User --}}
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none">
                                <span class="user-name text-bold-600">
                                    {{ auth()->user()->full_name }}
                                </span>
                                <span class="user-status">{{ trans('admin.available') }}</span>
                            </div>
                            <span class="avatar" style="margin: unset">
                                <img class="round"
                                    src="{{ url('backend/app-assets/images/portrait/small/avatar-s-11.jpg') }}"
                                    alt="avatar" height="40" width="40">
                                <span class="avatar-status-online avatar-status-lg"></span>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="page-user-profile.html">
                                <i class="feather icon-user"></i>
                                Edit Profile
                            </a>
                            <a class="dropdown-item" href="app-email.html">
                                <i class="feather icon-mail"></i>
                                My Inbox
                            </a>
                            <a class="dropdown-item" href="app-todo.html">
                                <i class="feather icon-check-square"></i>
                                Task
                            </a>
                            <a class="dropdown-item" href="app-chat.html">
                                <i class="feather icon-message-square"></i>
                                Chats
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="feather icon-power"></i> {{ trans('admin.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    {{-- End User --}}
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Menu -->
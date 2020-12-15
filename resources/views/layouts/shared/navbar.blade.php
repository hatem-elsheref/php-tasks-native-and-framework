<!-- Header -->
<header class="main-header " id="header">
    <nav class="navbar navbar-static-top navbar-expand-lg">
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">{{ env('APP_NAME') }}</span>
        </button>
        <!-- search form -->
        <div class="search-form d-none d-lg-inline-block">
            <div id="search-results-container">
                <ul id="search-results"></ul>
            </div>
        </div>

        <div class="navbar-right ">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu">
                    <button class="dropdown-toggle" data-toggle="dropdown">
                        <i class="mdi mdi-bell-outline"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" >
                    </ul>
                </li>


                <!-- User Account -->
                <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img src="{{ uploads(auth()->user()->avatar) }}" class="user-image" alt="{{ auth('web')->user()->name }} avatar" />
                        <span class="d-none d-lg-inline-block">{{ auth('web')->user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <!-- User image -->
                        <li class="dropdown-header">
                            <img src="{{uploads(auth()->user()->avatar)}}" class="img-circle" alt="{{ auth('web')->user()->name }} avatar" />
                            <div class="d-inline-block">
                                {{ auth('web')->user()->name }} <small class="pt-1">{{ auth('web')->user()->email }}</small>
                            </div>
                        </li>

                        <li>
                            <a href="{{ route('my-account.show') }}">
                                <i class="mdi mdi-account"></i> {{__('backend.profile')}}
                            </a>
                        </li>


                        <li class="right-sidebar-in">
                            <a href="javascript:0"> <i class="mdi mdi-settings"></i> {{__('backend.layout_settings')}} </a>
                        </li>

                        <li class="dropdown-footer">
                            <a href="javascript:void(0)"   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> <i class="mdi mdi-logout"></i> {{__('backend.logout')}} </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </ul>

                </li>

            </ul>
        </div>
    </nav>


</header>

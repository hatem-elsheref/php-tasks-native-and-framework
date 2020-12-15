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
                        <li  id="put-the-new-notification-here" class="dropdown-header the-notifications-messages-title" data-total="{{count($unReadNotifications)}}">{{str_replace('#',count($unReadNotifications),__('backend.you_have_number_of_notifications'))}}</li>
                        @foreach($unReadNotifications as $notification)
                            <li>
                                <a href="{{route('notification.mark_as_read',$notification->id)}}">
                                    <i class="mdi mdi-clock-end "></i> {{$notification->data['title']}}
                                    <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> {{$notification->data['date']}}</span>
                                </a>
                            </li>
                        @endforeach


                            <li class="dropdown-footer" id="mark-all-as-read" @if(count($unReadNotifications) == 0) hidden @endif>
                                <a class="text-center" href="{{route('notification.mark_all_as_read')}}"> {{__('backend.mark_all_as_read')}} </a>
                            </li>


                    </ul>
                </li>



                <li class="dropdown notifications-menu language-menu">
                    <button class="dropdown-toggle" data-toggle="dropdown">
                        <i class="mdi mdi-translate"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" style="width: 230px">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    <i class="flag-icon flag-icon-{{$properties['flag']}}" title="{{$localeCode}}" id="{{$localeCode}}"></i> {{$properties['native']}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <!-- User Account -->
                <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img src="{{ uploads(auth('web')->user()->avatar) }}" class="user-image" alt="{{ auth('web')->user()->name }} avatar" />
                        <span class="d-none d-lg-inline-block">{{ auth('web')->user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <!-- User image -->
                        <li class="dropdown-header">
                            <img src="{{uploads(auth('web')->user()->avatar)}}" class="img-circle" alt="{{ auth('web')->user()->name }} avatar" />
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
                            <a href="/logout"> <i class="mdi mdi-logout"></i> {{__('backend.logout')}} </a>
                        </li>

                    </ul>

                </li>

            </ul>
        </div>
    </nav>


</header>

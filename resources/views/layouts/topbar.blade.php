<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('/assets/images/logo-dark-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('/assets/images/logo-dark.png') }}" alt="" height="18">
                    </span>
                </a>

                <a href="index" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('/assets/images/logo-light-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('/assets/images/logo-light.png') }}" alt="" height="18">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
          
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ml-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="uil-search"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="@lang('translation.Search')"
                                    aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- <div class="dropdown d-inline-block language-switch">
                <button type="button" class="btn header-item waves-effect" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    @switch(Session::get('lang'))
                        @case('ru')
                        <img src="{{ URL::asset('assets/images/flags/russia.jpg') }}" alt="Header Language" height="16">
                        @break
                        @case('it')
                        <img src="{{ URL::asset('assets/images/flags/italy.jpg') }}" alt="Header Language" height="16">
                        @break
                        @case('de')
                        <img src="{{ URL::asset('assets/images/flags/germany.jpg') }}" alt="Header Language" height="16">
                        @break
                        @case('es')
                        <img src="{{ URL::asset('assets/images/flags/spain.jpg') }}" alt="Header Language" height="16">
                        @break
                        @default
                        <img src="{{ URL::asset('assets/images/flags/us.jpg') }}" alt="Header Language" height="16">
                    @endswitch
                </button>
                <div class="dropdown-menu dropdown-menu-right">

                    <!-- item-->
                    <a href="{{ url('index/en') }}" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('assets/images/flags/us.jpg') }}" alt="user-image" class="mr-1"
                            height="12"> <span class="align-middle">English</span>
                    </a>

                    <!-- item-->
                    <a href="{{ url('index/es') }}" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('assets/images/flags/spain.jpg') }}" alt="user-image" class="mr-1"
                            height="12"> <span class="align-middle">Spanish</span>
                    </a>

                    <!-- item-->
                    <a href="{{ url('index/de') }}" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('assets/images/flags/germany.jpg') }}" alt="user-image" class="mr-1"
                            height="12"> <span class="align-middle">German</span>
                    </a>

                    <!-- item-->
                    <a href="{{ url('index/it') }}" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('assets/images/flags/italy.jpg') }}" alt="user-image" class="mr-1"
                            height="12"> <span class="align-middle">Italian</span>
                    </a>

                    <!-- item-->
                    <a href="{{ url('index/ru') }}" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('assets/images/flags/russia.jpg') }}" alt="user-image" class="mr-1"
                            height="12"> <span class="align-middle">Russian</span>
                    </a>
                </div>
            </div> --}}

            <div class="dropdown d-inline-block language-switch">
                <button type="button" class="btn header-item waves-effect" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    {{__('Welcome')}} {{Auth::user()->name}}
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="icon-sm" data-feather="bell"></i>
                    @if(count(notifications())> 0 || count(admin_notifications())> 0)
                    <span class="noti-dot bg-danger"></span>
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-15">@lang('translation.Notifications') </h5>
                            </div>
                            <div class="col-auto">
                                <a href="{{route('notification.index')}}" class="small">@lang('translation.Mark_read')</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        @foreach(admin_notifications() as $key => $value)
                            <a href="{{route('notification.index')}}" class="text-reset notification-item">
                                <div class="media">
                                    <div class="avatar-xs mr-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="uil-shopping-basket"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1">{{$value->type}}</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">{{$value->content}}</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i>{{now()->diffInHours($value->updated_at)}} {{__('hours ago')}}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        @foreach(notifications() as $key => $value)
                            <a href="{{route('notification.index')}}" class="text-reset notification-item">
                                <div class="media">
                                    <div class="avatar-xs mr-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="uil-shopping-basket"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1">{{$value->type}}</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">{{$value->content}}</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i>{{now()->diffInHours($value->updated_at)}} {{__('hours ago')}}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="p-2 border-top">
                        <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="{{route('notification.index')}}">
                            <i class="uil-arrow-circle-right mr-1"></i> @lang('translation.View_More')
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(auth()->user()->photo)
                    <img class="rounded-circle header-profile-user"
                        src="{{ URL::asset('public/assets/profile/'.auth()->user()->photo) }}" alt="Header Avatar">
                    @else
                    <img class="rounded-circle header-profile-user"
                        src="{{ asset('/assets/logo/default_profile.png') }}" alt="Header Avatar">
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="{{route('profile')}}"><i
                            class="uil uil-user-circle font-size-16 align-middle text-muted mr-1"></i> <span
                            class="align-middle">@lang('translation.View_Profile')</span></a>
                    <a class="dropdown-item" href="{{route('change-password')}}">
                        <i class="uil uil-lock-alt font-size-16 align-middle mr-1 text-muted"></i> <span
                            class="align-middle">{{__('Change Password')}}</span></a>
                    <!-- <a class="dropdown-item d-block" href="#"><i
                            class="uil uil-cog font-size-16 align-middle mr-1 text-muted"></i> <span
                            class="align-middle">@lang('translation.Settings')</span> 
                            <span
                            class="badge badge-soft-success badge-pill mt-1 ml-2">03</span></a> -->
                    <a class="dropdown-item" href="javascript:void();"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="uil uil-sign-out-alt font-size-16 align-middle mr-1 text-muted"></i> <span
                            class="align-middle">@lang('translation.Sign_out')</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>

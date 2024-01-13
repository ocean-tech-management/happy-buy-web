<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('admin.home') }}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('admin_assets/images/erya_black.png')}}" alt="" height="22">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{ asset('admin_assets/images/erya_black.png')}}" alt="" height="17">
                                </span>
                </a>

                <a href="{{ route('admin.home') }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('admin_assets/images/erya_white.png')}}" alt="" height="22">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{ asset('admin_assets/images/erya_white.png')}}" alt="" height="19">
                                </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

        </div>

        <div class="d-flex">


            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ strtoupper(app()->getLocale()) }}
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    @foreach(config('panel.available_languages') as $langLocale => $langName)
                        <a href="{{ url()->current() }}?change_language={{ $langLocale }}" class="dropdown-item notify-item language" data-lang="en">
                            <span class="align-middle">{{ $langName }}</span>
                        </a>
                    @endforeach

                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(auth()->user()->profile_photo)
                        <img class="rounded-circle header-profile-user" src="{{ auth()->user()->profile_photo->getUrl('preview') }}" alt="Header Avatar">
                    @else
                        <img class="rounded-circle header-profile-user" src="{{ url('/admin_assets/images/users/default_user.png') }}" alt="Header Avatar">
                    @endif

                    <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ auth()->user()->name }}<br/>
                        @if(Auth::guard('admin')->check())
                            <small>{{ Auth::guard('admin')->user()->roles[0]->name }}</small>
                        @endif
                    </span>

                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item text-danger" href="" onclick="event.preventDefault(); document.getElementById('logoutform').submit();"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">{{ trans('global.logout') }}</span></a>
                </div>
            </div>

        </div>
    </div>
</header>

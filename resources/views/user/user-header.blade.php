<!-- start section -->
<section class="p-0">
    <div class="container-fluid bg-medium-gold">
        <div class="row">
            <div class="col-12 wow animate__fadeIn"
                 style="visibility: visible; animation-name: fadeIn;">
            @if(Auth::user()->roles[0]->id != 8)
                <!-- start tab navigation -->
                <ul class="nav nav-pills nav-tabs user-nav-tabs text-uppercase justify-content-center text-center alt-font font-weight-500"
                    id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link line-height-44px letter-spacing-2px text-extra-medium user-nav {{ Route::current()->getName() == "user.home"? "active" : "" }}"
                           href="{{ route('user.home') }}">{{ __('user-portal.my_profile') }}</a>
                        <span class="tab-border bg-dark-gold"></span>
                    </li>
                    <li class="nav-item">
                        <a class="relative nav-link line-height-44px letter-spacing-2px text-extra-medium user-nav {{ Route::current()->getName() == "user.my-point"? "active" : "" }}"
                           href="{{ route('user.my-point') }}">{{ __('user-portal.my_points') }}
                            @if(getRequestPointActiveCount() > 0)
                                <span class="alert-count alt-font bg-dark-red text-white">  </span>
                            @endif
                        </a>

                        <span class="tab-border bg-dark-gold"></span>
                    </li>
                    @if(Auth::guard('user')->user()->roles[0]->id == 2)
                    <li class="nav-item">
                        <a class="nav-link line-height-44px letter-spacing-2px text-extra-medium user-nav {{ Route::current()->getName() == "user.my-bonus"? "active" : "" }}"
                           href="{{ route('user.my-bonus') }}">{{ __('user-portal.my_bonus') }}</a>
                        <span class="tab-border bg-dark-gold"></span>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link line-height-44px letter-spacing-2px text-extra-medium user-nav {{ Route::current()->getName() == "user.shop"? "active" : "" }}"
                           href="{{ route('user.shop') }}">{{ __('user-portal.shop') }}</a>
                        <span class="tab-border bg-dark-gold"></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link line-height-44px letter-spacing-2px text-extra-medium user-nav {{ Route::current()->getName() == "user.shop-redeem"? "active" : "" }}"
                           href="{{ route('user.shop-redeem') }}">{{ __('user-portal.redeem') }}</a>
                        <span class="tab-border bg-dark-gold"></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link line-height-44px letter-spacing-2px text-extra-medium user-nav {{ Route::current()->getName() == "user.my-order"? "active" : "" }}"
                           href="{{ route('user.my-order') }}">{{ __('user-portal.my_orders') }}</a>
                        <span class="tab-border bg-dark-gold"></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link line-height-44px letter-spacing-2px text-extra-medium user-nav {{ Route::current()->getName() == "user.shipping"? "active" : "" }}"
                           href="{{ route('user.shipping') }}">{{ __('user-portal.shipping') }}</a>
                        <span class="tab-border bg-dark-gold"></span>
                    </li>
                    @if(Auth::guard('user')->user()->roles[0]->id != 3)
                    <li class="nav-item">
                        <a class="relative nav-link line-height-44px letter-spacing-2px text-extra-medium user-nav {{ Route::current()->getName() == "user.downline"? "active" : "" }}"
                           href="{{ route('user.downline') }}">{{ __('user-portal.merchant') }}
                            @if(getPendingUpgradeDownlines() > 0)
                                <span class="alert-count alt-font bg-dark-red text-white">  </span>
                            @endif
                        </a>

                        <span class="tab-border bg-dark-gold"></span>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link line-height-44px letter-spacing-2px text-extra-medium user-nav"
                           href="{{ route('user.password.edit') }}">{{ __('user-portal.settings') }}</a>
                        <span class="tab-border bg-dark-gold"></span>
                    </li>
                </ul>
                <!-- end tab navigation -->
                @else
                <!-- start tab navigation -->
                    <ul class="nav nav-pills nav-tabs user-nav-tabs text-uppercase justify-content-center text-center alt-font font-weight-500"
                        id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link line-height-44px letter-spacing-2px text-extra-medium user-nav {{ Route::current()->getName() == "user.home"? "active" : "" }}"
                               href="{{ route('user.home') }}">{{ __('user-portal.my_profile') }}</a>
                            <span class="tab-border bg-dark-gold"></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link line-height-44px letter-spacing-2px text-extra-medium user-nav {{ Route::current()->getName() == "user.shop-redeem"? "active" : "" }}"
                               href="{{ route('user.shop-redeem') }}">{{ __('user-portal.redeem') }}</a>
                            <span class="tab-border bg-dark-gold"></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link line-height-44px letter-spacing-2px text-extra-medium user-nav {{ Route::current()->getName() == "user.my-order"? "active" : "" }}"
                               href="{{ route('user.my-order') }}">{{ __('user-portal.my_orders') }}</a>
                            <span class="tab-border bg-dark-gold"></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link line-height-44px letter-spacing-2px text-extra-medium user-nav"
                               href="{{ route('user.password.edit') }}">{{ __('user-portal.settings') }}</a>
                            <span class="tab-border bg-dark-gold"></span>
                        </li>
                    </ul>
                    <!-- end tab navigation -->
                @endif
            </div>
        </div>
    </div>

</section>
<!-- end section -->

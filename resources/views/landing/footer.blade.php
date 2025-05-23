<!-- start footer -->
<footer class="footer-dark " style="background-color:#232323">
    <div class="footer-top padding-five-tb lg-padding-eight-tb md-padding-50px-tb">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4 col-sm-6 xs-margin-25px-bottom">
                    <span class="alt-font font-weight-500 d-block text-white margin-20px-bottom xs-margin-10px-bottom">{{ __('landing.contact_information') }}</span>
                    <ul>
                        <li>GLOBALCARE ONE STOP SOLUTIONS SDN. BHD. (1540496-K)</li>
                        <li>
                            <a href="{{ route('landing.contactUs') }}">
                            MXB TOWER
                            SOUTHBANK COMMERCIAL
                            UNIT SB/BO-02,BLOCK 2,
                            PUSAT KOMERSIAL TEBING SELATAN,
                            NO.179,JALAN KLANG LAMA,
                            58000 KUALA LUMPUR.
                            </a>
                        </li>
                        <li>
                            Customer Service Contact Number
                            <br>
                            &bullet; 60189596003
                            <br>
                            &bullet; 60189596004
                        </li>
                    </ul>
                </div>
                {{-- <div class="col-12 col-lg-2 col-sm-6 md-margin-40px-bottom xs-margin-25px-bottom">
                    <span class="alt-font font-weight-500 d-block text-white margin-20px-bottom xs-margin-10px-bottom">{{ __('landing.categories') }}</span>
                    <ul>
                        <li><a href="{{ route('landing.home') }}">{{ __('landing.brand_special') }}</a></li>
                        <li><a href="{{ route('landing.home') }}">{{ __('landing.great_value_buy') }}</a></li>
                        <li><a href="{{ route('landing.home') }}">{{ __('landing.low_price_flash_sale') }}</a></li>
                    </ul>
                </div> --}}
                <div class="col-12 col-lg-2 col-sm-6 md-margin-40px-bottom xs-margin-25px-bottom">
                    <span class="alt-font font-weight-500 d-block text-white margin-20px-bottom xs-margin-10px-bottom">{{ __('landing.product') }}</span>
                    <ul>
                        <li><a href="{{ route('landing.products-and-services') }}">{{ __('landing.product_tab_health') }}</a></li>
                        <li><a href="{{ route('landing.products-and-services') }}">{{ __('landing.product_tab_beauty') }}</a></li>
                        <li><a href="{{ route('landing.products-and-services') }}">{{ __('landing.product_tab_personal_care') }}</a></li>
                    </ul>
                </div>
                <div class="col-12 col-lg-2 col-sm-6 md-margin-40px-bottom xs-margin-25px-bottom">
                    <span class="alt-font font-weight-500 d-block text-white margin-20px-bottom xs-margin-10px-bottom">{{ __('landing.site_map') }}</span>
                    <ul>
                        <li><a href="{{ route('landing.home') }}">{{ __('landing.home') }}</a></li>
                        <li><a href="{{ route('landing.reward') }}">{{ __('landing.reward') }}</a></li>
                        <li><a href="{{ route('landing.faq') }}">{{ __('landing.faq') }}</a></li>
                    </ul>
                </div>
                <div class="col-12 col-lg-2 col-sm-6 md-margin-40px-bottom xs-margin-25px-bottom">
                    <span class="alt-font font-weight-500 d-block text-white margin-20px-bottom xs-margin-10px-bottom">{{ __('landing.social_media') }}</span>
                    <ul>
                        <li><a href="#">X (Twitter)</a></li>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Youtube</a></li>
                        <li><a href="#">Linktree</a></li>
                    </ul>
                </div>
                <div class="col-12 col-lg-4 col-sm-6 xs-margin-25px-bottom">
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom padding-40px-tb border-top border-color-white-transparent">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 last-paragraph-no-margin sm-margin-20px-bottom">
                    <p>Copyright © HappyBuy. All Rights Reserved.</p>
                </div>
                <div class="col-12 col-md-6 ">
                    <a class="ml-4" href="{{ route('landing.privacy-policy') }}" target="_blank">{{ __('landing.privacy_policy') }}</a>
                    <a class="ml-4" href="{{ route('landing.terms-of-use') }}" target="_blank">{{ __('landing.terms_of_use') }}</a>
{{--                    <a class="ml-4" href="{{ route('landing.delivery-policy') }}" target="_blank">{{ __('landing.delivery_policy') }}</a>--}}
                    <a class="ml-4" href="{{ route('landing.refund-return-policy') }}" target="_blank">{{ __('landing.refund_&_return_policy') }}</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->

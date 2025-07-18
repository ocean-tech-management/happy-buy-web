@extends('landing.app')


@section('content')
    <!-- start section -->
    <section class=" wow animate__fadeIn cover-background"
             style="background-image: url('{{asset('landing/images/product-details_banner.png')}}');">
        <div class="container">
            <div class="row justify-content-center">
                <div class="row col-12  justify-content-center" style="max-width: 935px;">
                    <h6 class="title-small alt-font font-weight-300 dark-gold">{{ __('landing.refund_&_return_policy') }}</h6>
                    <form class="bg-white padding-4-rem-all lg-margin-35px-top md-padding-2-half-rem-alls shadow">
                        <div class="row">

                            <div class="text-extra-medium">
                                {!!
                                "
                                <p><strong>SHIPPING, CANCELLATION, AND REFUND POLICY CANCELLATION PRIOR &nbsp;TO SHIPMENT&nbsp;</strong></p><p>If you cancel your order(s) before it ships from our warehouse, you will not be&nbsp; charged any additional fees. We require a cancellation request to be submitted&nbsp; by emailing us at <strong>happybuyappofficial@gmail.com&nbsp;</strong></p><p>Once the cancellation request is received, a full refund will be initiated. We&nbsp; would advise a cancellation request within 24 hours upon your order submission&nbsp; in order for a cancellation prior to goods shipment&nbsp;</p><p><strong>RETURN POLICY&nbsp;</strong></p><p>The following are the policies to be eligible for return requests after shipment/&nbsp; receipt of goods:&nbsp;</p><p>Orders are returnable within 7 working days starting from the day the goods are&nbsp; delivered to you if they are incorrect, damaged or defective.&nbsp;</p><p>Only items that have been purchased directly from HappyBuy app&nbsp; Page can be eligible for a return.&nbsp;</p><p>Any Happy Buy product purchased through other retailers is not eligible for&nbsp; this policy and must be in accordance to the respective retailers’ returns and&nbsp; refunds policy.&nbsp;</p><p>Goods are eligible for a return if the following are applied:&nbsp;</p><p>Incorrect:&nbsp;</p><p>The item is not the item you ordered. Wrong size or the colour is different from&nbsp; what is indicated on the order summary, or there are missing items inside the&nbsp; packaging.&nbsp;</p><p><strong>Damaged</strong>:&nbsp;</p><p>The items is found to be damaged upon receipt. Items has been&nbsp; tampered/refurbished or modified. Customers will be responsible for all shipping&nbsp; charges to return goods. Only products that are complete, unused, andunopened in their original packaging are eligible for return.&nbsp;</p><p>Returned items must meet the following requirements:</p><p>- The item must be shipped back to us within 7 working days upon receipt. (as&nbsp; proved&nbsp;</p><p>by the postal or courier receipt).&nbsp;</p><p>- You have proof of purchase (order invoice number and receipt). - Item must be in new condition and returned in its original packaging and free&nbsp; gifts&nbsp;</p><p>received with it. All packaging must be unused, unmarked and not defaced in&nbsp; any manner.&nbsp;</p><p>&nbsp;&nbsp;</p><p>- Item must be returned in the original box (or with, at least, suitable packaging)&nbsp; to protect the Product from damage during return delivery.&nbsp;</p><p>Change of order and cancellation of order will not be permitted once payment&nbsp; has been confirmed. Any cancellations due to a change of mind will not be&nbsp; accepted.&nbsp;</p><p>We reserve the right to reject any cancellation, refund that deemed unfit or&nbsp; unreasonable.&nbsp;</p><p><strong>REFUND POLICY&nbsp;</strong></p><p>Your full refund will be issued once we have received and examined the&nbsp; returned goods at our return center. Once the returned goods fulfil our return&nbsp; policy, the full refund will be initiated. The method of refund will be processed&nbsp; depending on your original payment method:&nbsp;</p><p>- Online Bank Transfer, full refunds will be credited into your bank account via&nbsp; online bank transfer, which should be posted within 3-5 working days. - Credit card refunds services, refunds will be sent to the card-issuing bank. Kindly contact your card-issuing bank with regards to the duration of the credit&nbsp; refunds.&nbsp;</p><p><strong>SHIPPING POLICY&nbsp;</strong></p><p>Shipping Address&nbsp;</p><p>We will only ship to addresses provided in the billing address or shipment&nbsp; address provided during your purchase.&nbsp;</p><p>Please ensure correct addresses and reachable phone number are provided&nbsp; when completing your order. We do not ship to P.O Boxes (Post-Office Box) and&nbsp;</p><p>only to valid legitimate shipping addresses.&nbsp;</p><p>We will not be liable in the event of an incorrect shipping address is provided&nbsp; and goods are returned to us.&nbsp;</p><p>All re-delivery of goods to you will be charged for a associated shipping charges&nbsp; which will be disclosed upon request for a second delivery attempt. Change In Shipping Address&nbsp;</p><p>If you have any request for change of shipping address, please email us at&nbsp; happybuyappofficial@gmail.com within 12 hours upon your order submission. If request of change in shipping address is made after 12 hours upon order&nbsp; confirmation, customers will be responsible for any associated shipping charges.&nbsp;&nbsp;&nbsp;</p><p>Shipping Time&nbsp;</p><p>It typically takes between 3-7 working days (Monday to Friday) for goods to&nbsp; arrive at your destination. The shipment will be delivered during office hours&nbsp; between 9:00 am to 5:00 pm weekdays only.&nbsp;</p><p>Tracking Number&nbsp;</p><p>Once goods leave our warehouse and picked up by our shipping partner, the&nbsp; tracking ID for the package will be communicated to you via email or messenger&nbsp; and updated on your member’s account.</p>
                                " !!}
                            </div>
                            {{--                           <div class="col-12 margin-10px-bottom row justify-content-center">--}}
                            {{--                               <a href="#signing-form"--}}
                            {{--                                  class=" popup-with-form text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px padding-2-half-rem-lr margin-2-half-rem-top ml-5">--}}
                            {{--                                   {{__('global.submit')}}--}}
                            {{--                               </a>--}}
                            {{--                           </div>--}}
                        </div>
                    </form>
                </div>

                {{--               <!-- start contact form -->--}}
                {{--               <form id="signing-form" action="{{ route('user.register-agreement-action') }}" method="post" class="white-popup-block col-xl-3 col-lg-7 col-sm-9  p-0 mx-auto mfp-hide">--}}
                {{--                   @csrf--}}
                {{--                   <input type="hidden" value="{{ $user_agreement->id }}" name="user_agreement_id" />--}}
                {{--                   <div class="padding-ten-all bg-white border-radius-6px xs-padding-six-all">--}}
                {{--                       <h6 class="text-extra-dark-gray alt-font font-weight-500 margin-35px-bottom xs-margin-15px-bottom">--}}
                {{--                           {{ __('user-portal.confirmation') }}--}}
                {{--                           <p  class="text-text-dark-gray alt-font text-extra-medium margin-35px-bottom xs-margin-15px-bottom line-height-18px"> {{ __('user-portal.confirmation_msg') }}</p>--}}
                {{--                       </h6>--}}
                {{--                       <div>--}}
                {{--                           <label class="text-extra-dark-gray alt-font margin-15px-bottom" for="birthday">{{ __('user-portal.full_name') }} <span--}}
                {{--                                   class="text-radical-red">*</span></label>--}}
                {{--                           <input class="medium-input margin-25px-bottom xs-margin-10px-bottom required" type="text" name="fullname" placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.full_name')]) }}" required>--}}
                {{--                           <label class="text-extra-dark-gray alt-font margin-15px-bottom" for="birthday">{{ __('user-portal.identity_card_passport_number') }} <span--}}
                {{--                                   class="text-radical-red">*</span></label>--}}
                {{--                           <input class="medium-input margin-25px-bottom xs-margin-10px-bottom required" type="text" name="identity_id" placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.identity_card_passport_number')]) }}" required>--}}

                {{--                           <button class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px margin-1-half-rem-top w-100" type="submit">--}}
                {{--                               {{__('global.submit')}}</button>--}}
                {{--                           <div class="form-results d-none"></div>--}}
                {{--                       </div>--}}
                {{--                   </div>--}}
                {{--               </form>--}}
                {{--               <!-- end contact form -->--}}

            </div>
        </div>
    </section>
    <!-- end section -->
@endsection


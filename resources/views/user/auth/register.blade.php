@extends('landing.app')
@section('css')
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <style>
        .iti.iti--allow-dropdown{
            width: 100% ;
        }
    </style>
@endsection
@section('content')
    <!-- start section -->
    <section class=" wow animate__fadeIn cover-background"
             style="background-image: url('{{asset('landing/images/product-details_banner.png')}}');">
        <div class="container">
            <div class="row justify-content-center">
                <div class="row col-12  justify-content-center" style="max-width: 935px;">
                    <h6 class="title-small alt-font font-weight-300 dark-gold">{{ __('user-portal.user_registration') }}</h6>

                    <form method="post" action="{{route('register')}}" id="register-form"
                          enctype="multipart/form-data"
                          class="bg-white padding-4-rem-all lg-margin-35px-top md-padding-2-half-rem-alls shadow">
                        @csrf
                        <div class="row">
                            @if ($errors->any())
                                <div class="col-md-12 margin-5px-bottom">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-12 margin-5px-bottom">
                                 <span class="text-extra-dark-gray text-extra-medium alt-font">
                                   {{ __('user-portal.your_personal_information') }}
                                </span>
                            </div>
                            <div class="col-md-12 margin-5px-bottom">
                                <span class="text-medium-gray alt-font text-small "> {{ __('user-portal.register_msg_2') }} <span class="text-radical-red">*</span> </span>
                            </div>
                            <div class="col-md-12 margin-5px-bottom">
                                <hr>
                            </div>
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.full_name') }} <span
                                        class="text-radical-red">*</span></label>
                                <input class="small-input border-all border-radius-5px" type="text" name="name" id="name"
                                       placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.full_name')]) }}" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-dark-gray alt-font margin-15px-bottom" for="birthday">{{ __('user-portal.birthday') }} <span
                                        class="text-radical-red">*</span></label>
                                <input class="small-input border-all border-radius-5px" type="date" name="birthday" value="{{ old('birthday') }}" required>
                            </div>
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.gender') }} <span
                                        class="text-radical-red">*</span></label>
                                <select name="gender" id="gender" class="small-input border-all border-radius-5px">
                                    <option>{{ __('user-portal.select_' , ['title'=> __('user-portal.gender')]) }}</option>
                                    <option value="1" {{ old('gender') == 1 ? "selected" : "" }}>{{ __('user-portal.male') }}</option>
                                    <option value="2" {{ old('gender') == 2 ? "selected" : "" }}>{{ __('user-portal.female') }}</option>
                                </select>
                            </div>
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.identity_card_passport_number') }} <span
                                        class="text-radical-red">*</span></label>
                                <select name="identity_type" id="identity_type" class="small-input border-all border-radius-5px" required>
                                    <option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.identity_type')]) }}</option>
                                    <option value="1" {{ old('identity_type') == 1 ? "selected" : "" }}>{{ App\Models\User::IDENTITY_TYPE_SELECT[1] }}</option>
                                    <option value="2" {{ old('identity_type') == 2 ? "selected" : "" }}>{{ App\Models\User::IDENTITY_TYPE_SELECT[2] }}</option>
                                    <option value="2" {{ old('identity_type') == 3 ? "selected" : "" }}>{{ App\Models\User::IDENTITY_TYPE_SELECT[3] }}</option>
                                </select>
                                <input class="small-input border-all border-radius-5px" type="text" name="identity_no"
                                       placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.identity_card_passport_number')]) }}"
                                       value="{{ old('identity_no') }}" required>
                            </div>
                            {{--                            <div class="col-md-6 margin-10px-bottom">--}}
                            {{--                            </div>--}}
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.password') }} <span
                                        class="text-radical-red">*</span></label>
                                <input class="small-input border-all border-radius-5px" type="password" name="password" autocomplete="off"
                                       placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.password')]) }}" required>
                            </div>
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.confirm_password') }} <span
                                        class="text-radical-red">*</span></label>
                                <input class="small-input border-all border-radius-5px" type="password"
                                       name="password_confirmation" placeholder="{{ __('user-portal.reenter_your_password') }}" required>
                            </div>
                            <div class="col-md-12 margin-5px-bottom margin-50px-top">
                                 <span class="text-extra-dark-gray text-extra-medium alt-font">
                                    {{ __('user-portal.your_contact_information') }}
                                </span>
                            </div>
                            <div class="col-md-12 margin-5px-bottom">
                                <span class="text-medium-gray alt-font text-small "> {{ __('user-portal.register_msg_2') }}  <span
                                        class="text-radical-red">*</span> </span>
                            </div>
                            <div class="col-md-12 margin-5px-bottom">
                                <hr>
                            </div>
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-dark-gray alt-font margin-15px-bottom" >{{ __('user-portal.phone') }} <span
                                        class="text-radical-red">*</span></label>
                                <br>
                                <input class="small-input border-all border-radius-5px w-100" type="text" name="phone" id="phone"
                                       placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.phone')]) }}" value="{{ old('phone') }}" required>
                                <input class="small-input border-all border-radius-5px w-100" type="hidden" name="formatted_phone" id="formatted_phone">
                            </div>
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.email') }} <span
                                        class="text-radical-red">*</span></label>
                                <input class="small-input border-all border-radius-5px" type="email" name="email"
                                       placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.email')]) }}" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-12 margin-10px-bottom">
                                <label class="margin-15px-bottom">{{ __('user-portal.address') }} <span
                                        class="text-radical-red">*</span></label>
                                <input class="small-input border-all border-radius-5px" type="text" name="address"
                                       placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.address')]) }}" value="{{ old('address') }}" required>
                                <input class="small-input border-all border-radius-5px" type="text" name="address2"
                                       placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.address')]) }}2"
                                       value="{{ old('address2') }}">
                            </div>
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.country') }} <span
                                        class="text-radical-red">*</span></label>
                                <select name="country" id="country" class="small-input border-all border-radius-5px" required>
                                    <option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.country')]) }}</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.state') }} <span
                                        class="text-radical-red">*</span></label>
                                <select name="state" id="state" class="small-input border-all border-radius-5px" required>
                                    <option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.state')]) }}</option>
                                </select>
                                {{--                                <input class="small-input border-all border-radius-5px" type="text" name="state"--}}
                                {{--                                       placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.state')]) }}" value="{{ old('state') }}" required>--}}
                            </div>
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.postcode') }} <span
                                        class="text-radical-red">*</span></label>
                                <input class="small-input border-all border-radius-5px" type="text" name="postcode"
                                       placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.postcode')]) }}" value="{{ old('postcode') }}" required>
                            </div>
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.city') }} <span
                                        class="text-radical-red">*</span></label>
                                <input class="small-input border-all border-radius-5px" type="text" name="city"
                                       placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.city')]) }}" value="{{ old('city') }}" required>
                            </div>
                            <div class="col-md-12 margin-5px-bottom margin-50px-top">
                                 <span class="text-extra-dark-gray text-extra-medium alt-font">
                                    {{ __('user-portal.bank_setting') }}
                                </span>
                            </div>
                                <div class="col-md-12 margin-5px-bottom">
                                    <hr>
                                </div>
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-medium text-extra-dark-gray  alt-font margin-15px-bottom">{{ __('user-portal.bank') }} <span class="required-error text-radical-red">*</span></label>
                                <select name="bank" id="bank"
                                        class="small-input border-all border-radius-5px">
                                    <option>{{ __('user-portal.select_', ['title'=> __('user-portal.bank')]) }}</option>
                                    @foreach($bank_list as $bank)
                                        <option value="{{$bank->id}}" {{ (old('bank') == $bank->id) ? 'selected' : '' }}>{{$bank->bank_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-medium text-extra-dark-gray  alt-font margin-15px-bottom">{{__('user-portal.bank_account')}}<span class="required-error text-radical-red">*</span></label>
                                <input class="small-input border-all border-radius-5px" type="text" value="{{ old('bank_account')  }}"
                                       name="bank_account" placeholder="{{ __('user-portal.enter_', ['title' => __('user-portal.bank_account')]) }}" required>
                            </div>
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-medium text-extra-dark-gray  alt-font margin-15px-bottom">{{__('user-portal.beneficiary_name')}}<span class="required-error text-radical-red">*</span></label>
                                <input class="small-input border-all border-radius-5px" type="text" value="{{  old('beneficiary_name') }}"
                                       name="beneficiary_name" placeholder="{{ __('user-portal.enter_', ['title' => __('user-portal.beneficiary_name')]) }}" required>
                            </div>

                            <div class="col-md-12 margin-5px-bottom margin-50px-top">
                                 <span class="text-extra-dark-gray text-extra-medium alt-font">
                                    {{ __('user-portal.membership') }}
                                </span>
                            </div>
                            <div class="col-md-12 margin-5px-bottom">
                                <hr>
                            </div>
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.ranking') }} <span
                                        class="text-radical-red">*</span></label>
                                <select name="ranking_id" id="ranking_id" class="small-input border-all border-radius-5px" required>
                                    <option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.ranking')]) }}</option>
                                    <option value="2">Millionaire</option>
                                    <option value="4">Manager</option>
                                    <option value="3">Executive</option>
                                </select>
                            </div>
                            <div class="col-md-6 margin-10px-bottom">
                                <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.enter_reference_code') }} <span
                                        class="text-radical-red">*</span></label>
                                <input class="small-input border-all border-radius-5px" type="text" name="ref_code"
                                       placeholder="{{ __('user-portal.enter_' , ['title'=> __('user-portal.enter_reference_code')]) }}"
                                       value="{{  Request::get('ref_code') ?? old('ref_code') }}" required>
                            </div>
                            {{--                            <div class="col-md-6 margin-10px-bottom">--}}
                            {{--                                <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.member_type') }} <span--}}
                            {{--                                        class="text-radical-red">*</span></label>--}}
                            {{--                                <select name="member_type" id="member_type" class="small-input border-all border-radius-5px" required>--}}
                            {{--                                    <option value="">{{ __('user-portal.member_type') }}</option>--}}
                            {{--                                    @foreach([1,2,3] as $id)--}}
                            {{--                                        <option value="{{ $id }}">{{ ($id == 1)? "Agent - Executive " : (($id == 2)? "Agent - Manager ": "Merchant - Millionaire" ) }}</option>--}}
                            {{--                                    @endforeach--}}
                            {{--                                    @foreach($roles as $id => $role)--}}
                            {{--                                        <option value="{{ $id }}">{{ $role }}</option>--}}
                            {{--                                    @endforeach--}}
                            {{--                                </select>--}}
                            {{--                            </div>--}}

{{--                            <div class="col-md-6 margin-10px-bottom" id="paymentDateDiv">--}}
{{--                                <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.payment_date') }} <span--}}
{{--                                        class="text-radical-red">*</span></label>--}}
{{--                                <input class="small-input border-all border-radius-5px" type="date" name="payment_date" id="payment_date" value="{{ old('payment_date') }}" required>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6 margin-10px-bottom" id="paymentFileDiv">--}}
{{--                                <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.upload_membership_fee_payment') }} <span--}}
{{--                                        class="text-radical-red">*</span></label>--}}
{{--                                <input class="small-input border-all border-radius-5px" type="file" name="file" id="first-payment-receipt" accept="image/*"--}}
{{--                                       placeholder="{{ __('user-portal.select_file_to_upload') }}" required>--}}
{{--                            </div>--}}

                            <div class="col-12 margin-10px-bottom row justify-content-center">
                                <button id="submit-btn"
                                        class="hidden text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px padding-2-half-rem-lr margin-2-half-rem-top ml-5"
                                        type="submit">
                                    {{ __('global.submit') }}
                                </button>
                                <button onclick="processForm()"
                                        class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px padding-2-half-rem-lr margin-2-half-rem-top ml-5"
                                        type="button">
                                    {{ __('global.submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </section>
    <!-- end section -->
@endsection

@section('js')
    <script>
        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            preferredCountries: ['my'],
            separateDialCode: true,
            onlyCountries: ["my", "bn", "au", "sg"],
            initialCountry: "my",
            utilsScript:
                "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });

        function processForm(){
            const phoneNumber = phoneInput.getNumber();

            console.log(phoneNumber);
            $('#formatted_phone').val(phoneNumber);
            $('#submit-btn').click();
        }
    </script>
    <script>
        $(document).ready(function () {

            $("#paymentDateDiv").hide();
            $("#paymentFileDiv").hide();

            $('#country').change(function () {
                if ($(this).val() !== "") {
                    var country_id = $(this).val();

                    var formData = {
                        "_token": "{{ csrf_token() }}",
                        'country_id': country_id,
                    };
                    var type = "POST";
                    var ajaxurl = '{{ route('user.getStates')}}';
                    $.ajax({
                        type: type,
                        url: ajaxurl,
                        data: formData,
                        success: function (data) {
                            var decoded = JSON.parse(data);
                            if (decoded.success) {
                                var htmlcode = "";
                                htmlcode = '<option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.state')]) }}</option>';
                                $.each(decoded.states, function (key, value) {
                                    htmlcode = htmlcode + ' <option value=' + value.id + '>' + value.name + '</option>';
                                });
                                $('#state').html(htmlcode);

                            }
                        },
                        error: function (data) {
                            console.log("Error");
                        }
                    });
                }
            });
            @if(old('country'))
            $("#country").val({{ old('country') }});

            var formData = {
                "_token": "{{ csrf_token() }}",
                'country_id': '{{ old('country') }}',
            };
            var type = "POST";
            var ajaxurl = '{{ route('user.getStates')}}';
            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                success: function (data) {
                    var decoded = JSON.parse(data);
                    if (decoded.success) {
                        var htmlcode = "";
                        htmlcode = '<option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.state')]) }}</option>';
                        $.each(decoded.states, function (key, value) {
                            htmlcode = htmlcode + ' <option value=' + value.id + '>' + value.name + '</option>';
                        });
                        $('#state').html(htmlcode);

                        @if(old('state'))
                        $("#state").val({{ old('state') }});
                        @endif
                    }
                },
                error: function (data) {
                    console.log("Error");
                }
            });
            @endif

            $('#first-payment-receipt').change(function () {

                $('#submit-btn').prop("disabled", true);
                var file_data = $('#first-payment-receipt').prop('files')[0];
                var form_data = new FormData();

                form_data.append('size', 2);
                form_data.append('width', 4096);
                form_data.append('height', 4096);
                form_data.append('file', file_data);
                form_data.append('_token', '{{ csrf_token() }}')
                $.ajax({
                    url: "{{route('user.storeMedia')}}",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $('#register-form').append('<input type="hidden" name="first_payment_receipt" value="' + data.name + '">');
                        // $('#profile_upload_form').submit();

                        $('#submit-btn').prop("disabled", false);
                    }
                });
            });

            $('#ranking_id').on('change', function () {
                var selectVal = $("#ranking_id option:selected").val();
                console.log(selectVal);

                if(selectVal == 2){
                    $("#paymentDateDiv").show();
                    $("#paymentFileDiv").show();
                    $('#payment_date').prop('required',true);
                    $('#first-payment-receipt').prop('required',true);
                }else{
                    $("#paymentDateDiv").hide();
                    $("#paymentFileDiv").hide();
                    $('#payment_date').prop('required',false);
                    $('#first-payment-receipt').prop('required',false);
                }
            });
        });
    </script>
@endsection

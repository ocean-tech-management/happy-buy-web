@extends('landing.app')

@section('content')
    @include('user.user-header')
    <div class="cover-background"
         style="background-image: url('{{asset('landing/images/product-details_banner.png')}}')">
        <section>
            <div class="container">
                <div class="row">
                    @component('user.components.left-aside-bar')
                    @endcomponent
                    <form
                        class="col-12 col-lg-8 col-md-8 padding-30px-left md-padding-15px-left sm-margin-30px-bottom" method="POST" action="{{ route("user.add-address.store") }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"/>
                        <div
                            class="bg-white shadow wow animate__fadeIn border-radius-5px margin-1-half-rem-bottom"
                            style="visibility: visible; animation-name: fadeIn;">
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row  align-items-center margin-10px-bottom">
                                    <div class="col-7">
                                        <span class="dark-gold alt-font ">{{ __('user-portal.address_book') }}</span>
                                    </div>
                                    <div class="col-5 text-right">
                                        <button class="text-extra-small alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gold text-uppercase text-white"
                                                style="padding: 3px 10px;min-width: 90px" type="submit">
                                            {{ __('user-portal.save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @if ($errors->any())
                                <div class="col-md-12 margin-5px-bottom">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->getMessages() as $key => $error)
                                                <li>{{ $error[0] }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <input type="hidden" name="user" value="{{ Auth::user()->id }}"/>
                            <div class="row padding-30px-left" style="margin-left:auto;;margin-right:auto;">
                                <div class="col-md-6 margin-10px-bottom">
                                    <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.contact_name') }} <span
                                            class="text-radical-red">*</span></label>
                                    <input class="small-input border-all border-radius-5px" type="text" name="name" id="name"
                                           placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.contact_name')]) }}" value="{{ old('name', '') }}" required>
                                </div>
                                <div class="col-md-6 margin-10px-bottom">
                                    <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.phone_number') }} <span
                                            class="text-radical-red">*</span></label>
                                    <input class="small-input border-all border-radius-5px" type="text" name="phone" id="phone"
                                           placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.phone_number')]) }}" value="{{ old('phone', '') }}" required>
                                </div>
                                <div class="col-12 margin-10px-bottom">
                                    <label class="margin-15px-bottom">{{ __('user-portal.address') }} <span
                                            class="text-radical-red">*</span></label>
                                    <input class="small-input border-all border-radius-5px" type="text" name="address_1" id="address_1"
                                           placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.address')]) }}" value="{{ old('address_1', '') }}" required>
                                    <input class="small-input border-all border-radius-5px" type="text" name="address2" id="address_2"
                                           placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.address')]) }}2"
                                           value="{{ old('address_1', '') }}">
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
                                </div>
                                <div class="col-md-6 margin-10px-bottom">
                                    <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.postcode') }} <span
                                            class="text-radical-red">*</span></label>
                                    <input class="small-input border-all border-radius-5px" type="text" name="postcode" id="postcode"
                                           placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.postcode')]) }}" value="{{ old('postcode', '') }}" required>
                                </div>
                                <div class="col-md-6 margin-10px-bottom">
                                    <label class="text-extra-dark-gray alt-font margin-15px-bottom">{{ __('user-portal.city') }} <span
                                            class="text-radical-red">*</span></label>
                                    <input class="small-input border-all border-radius-5px" type="text" name="city" id="city"
                                           placeholder="{{ __('user-portal.enter_your' , ['title'=> __('user-portal.city')]) }}" value="{{ old('city', '') }}" required>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')

    <script>
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
    </script>

@endsection


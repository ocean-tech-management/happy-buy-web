@extends('layouts.admin')
@section('content')

    <form method="POST" action="{{ route('admin.users.address-book.update', [$address_book->id]) }}">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-1"></div>
            <div class="col-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">{{ trans('global.edit') }} {{ trans('cruds.user.fields.address_book') }}</h4>
                        <div class="row">
                            <div class="form-group col-6">
                                <label class="required" for="name">{{ trans('cruds.user.fields.contact_name') }}</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $address_book->name) }}" required>
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.contact_name_helper') }}</span>
                            </div>
                            <div class="form-group col-6">
                                <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $address_book->phone) }}" required>
                                @if($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                            </div>
                            <div class="form-group col-12">
                                <label class="required" for="address_1">{{ trans('cruds.user.fields.address_1') }}</label>
                                <input class="form-control {{ $errors->has('address_1') ? 'is-invalid' : '' }}" type="text" name="address_1" id="address_1" value="{{ old('address_1', $address_book->address_1) }}" required>
                                @if($errors->has('address_1'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('address_1') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.address_1_helper') }}</span>
                            </div>
                            <div class="form-group col-12">
                                <label class="required" for="address_2">{{ trans('cruds.user.fields.address_2') }}</label>
                                <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text" name="address_2" id="address_2" value="{{ old('address_2', $address_book->address_2) }}" required>
                                @if($errors->has('address_2'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('address_2') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.address_2_helper') }}</span>
                            </div>
                            <div class="form-group col-6">
                                <label class="required" for="country">{{ trans('cruds.user.fields.country') }}</label>
                                <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country" id="country"  required>
                                    @foreach($countries as $id => $country)
                                        <option value="{{ $id }}" {{ ($id == $address_book->state->country_id)? "selected": "" }}>{{ $country }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('country') }}
                                </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.country_helper') }}</span>
                            </div>
                            <div class="form-group col-6">
                                <label class="required" for="state">{{ trans('cruds.user.fields.state') }}</label>
                                <select class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state" id="state"  required>
                                    <option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.state')]) }}</option>
                                </select>                                    
                                @if($errors->has('state'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('state') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.state_helper') }}</span>
                            </div>
                            <div class="form-group col-6">
                                <label class="required" for="postcode">{{ trans('cruds.user.fields.postcode') }}</label>
                                <input class="form-control {{ $errors->has('postcode') ? 'is-invalid' : '' }}" type="text" name="postcode" id="postcode" value="{{ old('postcode', $address_book->postcode) }}" required>
                                @if($errors->has('postcode'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('postcode') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.state_helper') }}</span>
                            </div>
                            <div class="form-group col-6">
                                <label class="required" for="city">{{ trans('cruds.user.fields.city') }}</label>
                                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $address_book->city) }}" required>
                                @if($errors->has('city'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('city') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.city_helper') }}</span>
                            </div>
                        </div>                   
                        <hr>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </form>

@endsection

@section('scripts')
<script>

    $(document).ready(function () {
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

        {{--$('#country').val("{{ Auth::user()->country_id }}");--}}
        $('#country option[value="{{ $address_book->state->country_id }}"]').prop("selected", "selected");

        var formData = {
            "_token": "{{ csrf_token() }}",
            'country_id': '{{ $address_book->state->country_id }}',
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
                        htmlcode = htmlcode + ' <option value=' + value.id +'>' + value.name + '</option>';
                    });
                    $('#state').html(htmlcode);

                    $('#state').val("{{ $address_book->state->id }}");
                }
            },
            error: function (data) {
                console.log("Error");
            }
        });
    });
</script>
@endsection

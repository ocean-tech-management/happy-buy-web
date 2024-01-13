@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.order.fields.add_order_item_to_order_id', ['value' => $order->order_number]) }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.orders.add-order-item", ['id' => $order->id]) }}" enctype="multipart/form-data">
                @csrf
{{--                <input type="text" name="order_id", value="{{ $order->id }}">--}}

                <div class="form-group">
                    <label class="required" for="product_variant_id">{{ trans('cruds.cart.fields.product_variant') }}</label>
                    <select class="form-control select2 {{ $errors->has('product_variant') ? 'is-invalid' : '' }}" name="product_variant_id" id="product_variant_id" required>
                        @foreach($product_variants as $id => $entry)
                            <option value="{{ $id }}" {{ old('product_variant_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('product_variant'))
                        <div class="invalid-feedback">
                            {{ $errors->first('product_variant') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cart.fields.product_variant_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required">{{ trans('cruds.cart.fields.type') }}</label>
                    <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                        <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Cart::TYPE_SELECT as $key => $label)
                            @if($key == 2)
                                <option value="{{ $key }}" {{ old('type', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endif
                        @endforeach
                    </select>
                    @if($errors->has('type'))
                        <div class="invalid-feedback">
                            {{ $errors->first('type') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cart.fields.type_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="quantity">{{ trans('cruds.cart.fields.quantity') }}</label>
                    <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="1" required>
                    @if($errors->has('quantity'))
                        <div class="invalid-feedback">
                            {{ $errors->first('quantity') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cart.fields.quantity_helper') }}</span>
                </div>

                <div class="form-group" hidden>
                    <label class="required">{{ trans('cruds.cart.fields.status') }}</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Cart::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cart.fields.status_helper') }}</span>
                </div>

                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- <div class="page-loader"></div> --}}
@endsection

@section('scripts')
    @parent
    <script>

        $(function () {

            $('.dynamic').change(function () {
                if($(this).val() != '')
                {
                    $(document).on({
                        ajaxStart: function(){
                            $("body").addClass("loading");
                        },
                        ajaxStop: function(){
                            $("body").removeClass("loading");
                        }
                    });
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = $('input[name="_token"]').val();
                    var target = $("#to_user_id>option").map(function() { return $(this).val(); });
                    $("#address").prop('disabled', false);
                    $.ajax({
                        url: "{{ route('admin.carts.fetch.addressBook')}}",
                        method: "POST",
                        data: { select:select, value:value, _token:_token, dependent:dependent},
                        success: function(result)
                        {
                            $('#'+dependent).html(result);
                        }
                    })
                } else {
                    $("#address").prop('disabled', true);
                    $("#address > option").prop("selected", "");
                }
                $("#address > option").prop("selected", "");

            });
        })


    </script>
@endsection

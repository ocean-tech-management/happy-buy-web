@extends('landing.app')

@section('content')
    @include('user.user-header')
    <!-- start section -->
    <livewire:checkout/>
    <!-- end section -->
@endsection

@section('js')
{{--    <script type="text/javascript">--}}
{{--        $(function () {--}}
{{--            $('.popup-modal').magnificPopup({--}}
{{--                type: 'inline',--}}
{{--                preloader: false,--}}
{{--                focus: '#username',--}}
{{--                modal: true--}}
{{--            });--}}
{{--            $(document).on('click', '.popup-modal-dismiss', function (e) {--}}
{{--                e.preventDefault();--}}
{{--                $.magnificPopup.close();--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        var withShipping = true;--}}
{{--        var pickup_location_id = 0;--}}
{{--        var subtotal = 0;--}}
{{--        var shipping_fee = 0;--}}
{{--        var total = 0;--}}
{{--        var total_item_qty = 0;--}}
{{--        var total_item_qty_for_shipping_rebate = 0;--}}
{{--        var shipping_add_on = 0;--}}
{{--        var max_quantity_b4_shipping_add_on = 0;--}}
{{--        var use_product_add_on = true;--}}

{{--        var wallet_id = 0;--}}

{{--        var addr_id = 0;--}}
{{--        var shipping_method = 0;--}}

{{--        var address_name = "";--}}
{{--        var address_phone = "";--}}
{{--        var address1 = "";--}}
{{--        var address2 = "";--}}
{{--        var country = "";--}}
{{--        var state = "";--}}
{{--        var postcode = "";--}}
{{--        var city = '';--}}

{{--        $(document).ready(function () {--}}
{{--            wallet_id = $('#wallet_id').attr('value');--}}
{{--            // console.log("wallet_id" + wallet_id);--}}
{{--            total_item_qty = 0;--}}
{{--            total_item_qty_for_shipping_rebate = 0;--}}

{{--            @foreach($carts as $cart)--}}
{{--                total_item_qty += parseInt({{ $cart->quantity }});--}}
{{--            @endforeach--}}


{{--            $('.shipping-method').first().click();--}}

{{--            --}}{{--            @foreach( $addressBooks as $addressBook)--}}
{{--            --}}{{--            @if($addressBook->set_default == 1)--}}
{{--            --}}{{--            $(".selection-address[value='{{ $addressBook->id }}']").click();--}}
{{--            --}}{{--            getShippingFee({{ $addressBook->state->id }});--}}
{{--            --}}{{--            @endif--}}
{{--            --}}{{--            @endforeach--}}



{{--            // console.log("state_id: " + addr_id);--}}
{{--            //--}}
{{--            // console.log('shippingmethod_click');--}}

{{--            $('#address-target').on('change', function () {--}}
{{--                // console.log(this.value);--}}
{{--                if (this.value == 1) {--}}
{{--                    $('#my-address-container').removeClass('d-none');--}}
{{--                    $('#vip-address-container').addClass('d-none');--}}
{{--                    $('#order-user-id').attr('value', {{Auth::user()->id}});--}}
{{--                } else {--}}
{{--                    $('#my-address-container').addClass('d-none');--}}
{{--                    $('#vip-address-container').removeClass('d-none');--}}
{{--                }--}}
{{--            });--}}

{{--            $('#address-target option:eq(1)').prop('selected', 'selected').change();--}}

{{--            $('#my-adddresses').on('change', function () {--}}

{{--                var selection = $('option:selected', this);--}}
{{--                $('#name').val(selection.attr('addressName'));--}}
{{--                $('#phone').val(selection.attr('addressPhone'));--}}
{{--                $('#address_1').val(selection.attr('addressAddr1'));--}}
{{--                $('#address_2').val(selection.attr('addressAddr2'));--}}
{{--                $('#country option[value="' + selection.attr('addressCountryId') + '"]').attr('selected', 'selected');--}}
{{--                var country_id = selection.attr('addressCountryId');--}}

{{--                var formData = {--}}
{{--                    "_token": "{{ csrf_token() }}",--}}
{{--                    'country_id': country_id,--}}
{{--                };--}}
{{--                var type = "POST";--}}
{{--                var ajaxurl = '{{ route('user.getStates')}}';--}}
{{--                $.ajax({--}}
{{--                    type: type,--}}
{{--                    url: ajaxurl,--}}
{{--                    data: formData,--}}
{{--                    success: function (data) {--}}
{{--                        var decoded = JSON.parse(data);--}}
{{--                        if (decoded.success) {--}}
{{--                            var htmlcode = "";--}}
{{--                            htmlcode = '<option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.state')]) }}</option>';--}}
{{--                            $.each(decoded.states, function (key, value) {--}}
{{--                                htmlcode = htmlcode + ' <option value=' + value.id + '>' + value.name + '</option>';--}}
{{--                            });--}}
{{--                            $('#state').html(htmlcode);--}}

{{--                            $('#state option[value="' + selection.attr('addressStateId') + '"]').attr('selected', 'selected');--}}
{{--                            $('#state option[value="' + selection.attr('addressStateId') + '"]').prop('selected', 'selected').change();--}}
{{--                            state = selection.attr('addressStateId');--}}
{{--                            // console.log("state: " + selection.attr('addressStateId'));--}}
{{--                            useAddress();--}}
{{--                        }--}}
{{--                    },--}}
{{--                    error: function (data) {--}}
{{--                        console.log("Error");--}}
{{--                    }--}}
{{--                });--}}

{{--                $('#postcode').val($('option:selected', this).attr('addressPostcode'));--}}
{{--                $('#city').val($('option:selected', this).attr('addressCity'));--}}


{{--                $('#address_manual_name').html(address_name);--}}
{{--                $('#address_manual_phone').html(address_phone);--}}
{{--                $('#address_manual_addr1').html(address1);--}}
{{--                $('#address_manual_addr2').html(address2);--}}
{{--                $('#address_manual_postcode_city').html(postcode + ", " + city);--}}
{{--                $('#address_manual_state').html(address_name);--}}

{{--            });--}}

{{--            $.each($("#my-adddresses option"), function (index) {--}}
{{--                // console.log($(this).text() + " - " + $(this).val());--}}
{{--                // console.log($(this).attr('defaultAddress'));--}}
{{--                if ($(this).attr('defaultAddress') == "1") {--}}
{{--                    console.log($(this).attr('defaultAddress') + " - YES " + index);--}}
{{--                    $('#my-adddresses option:eq(' + index + ')').prop('selected', 'selected').change();--}}
{{--                }--}}
{{--            });--}}


{{--            $('#vips').on('change', function () {--}}
{{--                // console.log(this.value);--}}
{{--                $('#order-user-id').val(this.value);--}}
{{--                //run ajax retrieve vip address book--}}
{{--                var formData = {--}}
{{--                    "_token": "{{ csrf_token() }}",--}}
{{--                    'user_id': this.value,--}}
{{--                };--}}
{{--                var type = "GET";--}}
{{--                var ajaxurl = '{{ route('user.getAddressBook')}}';--}}
{{--                $.ajax({--}}
{{--                    type: type,--}}
{{--                    url: ajaxurl,--}}
{{--                    data: formData,--}}
{{--                    success: function (data) {--}}
{{--                        var decoded = JSON.parse(data);--}}
{{--                        // console.log(decoded);--}}
{{--                        if (decoded.success) {--}}
{{--                            var htmlcode = "";--}}
{{--                            htmlcode = '<option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.address')]) }}</option>';--}}
{{--                            // console.log(decoded.address_book);--}}
{{--                            $.each(decoded.address_book, function (key, value) {--}}

{{--                                htmlcode = htmlcode +--}}

{{--                                    '<option addressName="' + value.name + '"' +--}}
{{--                                    ' addressPhone="' + value.phone + '"' +--}}
{{--                                    ' addressAddr1="' + value.address_1 + '"' +--}}
{{--                                    ' addressAddr2="' + value.address_2 + '"' +--}}
{{--                                    ' addressPostcode="' + value.postcode + '"' +--}}
{{--                                    ' addressCity="' + value.city + '"' +--}}
{{--                                    ' addressCountryId="' + value.country_id + '"' +--}}
{{--                                    ' addressStateId="' + value.state_id + '"' +--}}
{{--                                    ' defaultAddress="' + value.set_default + '"' +--}}
{{--                                    '>' +--}}
{{--                                    '<div class="show-address" ' +--}}
{{--                                    '  > ' +--}}
{{--                                    '<div id="address-name" class="line-height-20px margin-1-rem-bottom "> ' +--}}
{{--                                    '  <div>' + value.name + ' </div> ' +--}}
{{--                                    '  <div>' + value.phone + ' </div> ' +--}}
{{--                                    ' </div> ' +--}}
{{--                                    ' <span id="address-lines" class="line-height-20px"> ' +--}}
{{--                                    ' <div>' + value.address_1 + ',</div> ' +--}}
{{--                                    ' <div>' + value.address_2 + '</div>' +--}}
{{--                                    ' <div>' + value.postcode + ', ' + value.city + '</div>' +--}}
{{--                                    ' <div>' + value.state_name + '</div>' +--}}
{{--                                    '  </span>' +--}}
{{--                                    '  </div>' +--}}
{{--                                    ' </option>';--}}
{{--                            });--}}
{{--                            $('#vips-address').html(htmlcode);--}}

{{--                            // $('#state option[value="'+ selection.attr('addressStateId') +'"]').attr('selected', 'selected');--}}
{{--                            @if($selected_user_id != Auth::guard('user')->user()->id)--}}
{{--                            $('#vips-address option:eq(1)').prop('selected', 'selected').change();--}}
{{--                            @endif--}}
{{--                        }--}}
{{--                    },--}}
{{--                    error: function (data) {--}}
{{--                        console.log("Error");--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}

{{--            $('#vips-address').on('change', function () {--}}


{{--                // console.log($('option:selected', this).attr('addressName'));--}}

{{--                var selection = $('option:selected', this);--}}

{{--                $('#name').val(selection.attr('addressName'));--}}
{{--                $('#phone').val(selection.attr('addressPhone'));--}}
{{--                $('#address_1').val(selection.attr('addressAddr1'));--}}
{{--                $('#address_2').val(selection.attr('addressAddr2'));--}}
{{--                $('#country option[value="' + selection.attr('addressCountryId') + '"]').attr('selected', 'selected');--}}
{{--                var country_id = selection.attr('addressCountryId');--}}

{{--                var formData = {--}}
{{--                    "_token": "{{ csrf_token() }}",--}}
{{--                    'country_id': country_id,--}}
{{--                };--}}
{{--                var type = "POST";--}}
{{--                var ajaxurl = '{{ route('user.getStates')}}';--}}
{{--                $.ajax({--}}
{{--                    type: type,--}}
{{--                    url: ajaxurl,--}}
{{--                    data: formData,--}}
{{--                    success: function (data) {--}}
{{--                        var decoded = JSON.parse(data);--}}
{{--                        if (decoded.success) {--}}
{{--                            var htmlcode = "";--}}
{{--                            htmlcode = '<option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.state')]) }}</option>';--}}
{{--                            $.each(decoded.states, function (key, value) {--}}
{{--                                htmlcode = htmlcode + ' <option value=' + value.id + '>' + value.name + '</option>';--}}
{{--                            });--}}
{{--                            $('#state').html(htmlcode);--}}

{{--                            $('#state option[value="' + selection.attr('addressStateId') + '"]').attr('selected', 'selected');--}}

{{--                        }--}}
{{--                    },--}}
{{--                    error: function (data) {--}}
{{--                        console.log("Error");--}}
{{--                    }--}}
{{--                });--}}


{{--                // console.log("state id " + $('option:selected', this).attr('addressStateId'));--}}
{{--                // $('#state').val( $('option:selected', this).attr('addressName'));--}}
{{--                $('#postcode').val($('option:selected', this).attr('addressPostcode'));--}}
{{--                $('#city').val($('option:selected', this).attr('addressCity'));--}}


{{--                $('#address_manual_name').html(address_name);--}}
{{--                $('#address_manual_phone').html(address_phone);--}}
{{--                $('#address_manual_addr1').html(address1);--}}
{{--                $('#address_manual_addr2').html(address2);--}}
{{--                $('#address_manual_postcode_city').html(postcode + ", " + city);--}}
{{--                $('#address_manual_state').html(address_name);--}}

{{--            });--}}

{{--            @if($selected_user_id != Auth::guard('user')->user()->id)--}}
{{--            $('#vips option:eq(1)').prop('selected', 'selected').change();--}}
{{--            @endif--}}

{{--            $('#vips-pickup').on('change', function () {--}}
{{--                $('#order-user-id').val(this.value);--}}
{{--            });--}}

{{--        });--}}

{{--        function updateLayout() {--}}
{{--            subtotal = 0;--}}
{{--            add_on = 0;--}}
{{--            total_item_qty = 0;--}}
{{--            total_item_qty_for_shipping_rebate = 0;--}}

{{--            var sameProductQty = [];--}}
{{--            $.each($('.cart-cart-item'), function (k, v) {--}}

{{--                if (sameProductQty[$('.product-id').eq(k).html()] === undefined) {--}}
{{--                    sameProductQty[$('.product-id').eq(k).html()] = {qty : 0, category_id: 0};--}}
{{--                    console.log(sameProductQty);--}}
{{--                }--}}
{{--            });--}}
{{--            $.each($('.cart-cart-item'), function (k, v) {--}}
{{--                var quantity = parseInt($('.qty-text').eq(k).html());--}}
{{--                var unit_price = parseFloat($('.product-price').eq(k).attr('value' + wallet_id));--}}
{{--                var unit_subtotal = quantity * unit_price;--}}
{{--                $('.product-price').eq(k).html(addCommas(unit_subtotal) + ' PV');--}}
{{--                $('.product-subtotal').eq(k).html(addCommas(unit_subtotal) + ' PV');--}}
{{--                $('#subtotal').eq(k).html(addCommas(unit_subtotal) + ' PV');--}}
{{--                if (use_product_add_on) {--}}
{{--                    add_on += parseFloat($('.product-price-add-on').eq(k).html()) * (quantity);--}}
{{--                    console.log("add_on  " + add_on);--}}
{{--                }--}}

{{--                total_item_qty += quantity;--}}
{{--                sameProductQty[$('.product-id').eq(k).html()].qty += quantity;--}}
{{--                sameProductQty[$('.product-id').eq(k).html()].category_id = $('.product-category-id').eq(k).html();--}}

{{--                console.log("test qty: " + sameProductQty[$('.product-id').eq(k).html()].qty);--}}
{{--                console.log("test category: " + sameProductQty[$('.product-id').eq(k).html()].category_id);--}}

{{--                if($('.product-category-id').eq(k).html() != 4 &&--}}
{{--                    $('.product-category-id').eq(k).html() != 6 &&--}}
{{--                    $('.product-category-id').eq(k).html() != 8 &&--}}
{{--                    $('.product-category-id').eq(k).html() != 9 &&--}}
{{--                    $('.product-id').eq(k).html() != 5 &&--}}
{{--                    $('.product-id').eq(k).html() != 6--}}
{{--                ){--}}
{{--                    total_item_qty_for_shipping_rebate += quantity;--}}
{{--                }--}}


{{--                subtotal += unit_subtotal;--}}
{{--            });--}}



{{--            modify_shipping_fee = 0;--}}
{{--            if($('#state').val() !== "12" && $('#state').val() !== "13") {--}}
{{--                if($('#state').val() !== "17" && $('#state').val() !== "18" && $('#state').val() !== "19"){--}}
{{--                    console.log("total_item_qty_for_shipping_rebate: " + total_item_qty_for_shipping_rebate);--}}
{{--                    while(total_item_qty_for_shipping_rebate >= 30){--}}
{{--                        total_item_qty -= 30;--}}
{{--                        total_item_qty_for_shipping_rebate -= 30;--}}

{{--                        var deduct_buffer = 0;--}}
{{--                        let shouldSkip = false;--}}
{{--                        $.each(sameProductQty, function (k, v) {--}}

{{--                            if (sameProductQty[k] === undefined) {--}}
{{--                                return;--}}
{{--                            } else {--}}
{{--                                if(sameProductQty[k].category_id != 4 &&--}}
{{--                                    sameProductQty[k].category_id != 6 &&--}}
{{--                                    sameProductQty[k].category_id != 8 &&--}}
{{--                                    sameProductQty[k].category_id != 9 &&--}}
{{--                                    k != 5 &&--}}
{{--                                    k != 6--}}
{{--                                ) {--}}
{{--                                    if (shouldSkip) {--}}
{{--                                        return;--}}
{{--                                    } else {--}}
{{--                                        if (sameProductQty[k].qty + deduct_buffer >= 30) {--}}
{{--                                            var shouldDeduct = 30 - deduct_buffer;--}}
{{--                                            deduct_buffer += shouldDeduct;--}}
{{--                                            sameProductQty[k].qty -= shouldDeduct;--}}
{{--                                        } else {--}}
{{--                                            deduct_buffer += sameProductQty[k].qty;--}}
{{--                                            sameProductQty[k].qty -= sameProductQty[k].qty;--}}
{{--                                        }--}}
{{--                                        if (deduct_buffer === 30) {--}}
{{--                                            shouldSkip = true;--}}
{{--                                            return;--}}
{{--                                        }--}}
{{--                                    }--}}
{{--                                }--}}
{{--                            }--}}
{{--                        });--}}
{{--                    }--}}

{{--                    $.each(sameProductQty, function (k, v) {--}}

{{--                        if (sameProductQty[k] === undefined) {--}}
{{--                            return;--}}
{{--                        } else {--}}
{{--                            if(sameProductQty[k].category_id != 4 &&--}}
{{--                                sameProductQty[k].category_id != 6 &&--}}
{{--                                sameProductQty[k].category_id != 8 &&--}}
{{--                                sameProductQty[k].category_id != 9 &&--}}
{{--                                k != 5 &&--}}
{{--                                k != 6--}}
{{--                            ) {--}}
{{--                                while (sameProductQty[k].qty >= 10) {--}}
{{--                                    total_item_qty -= 10;--}}
{{--                                    total_item_qty_for_shipping_rebate -= 10;--}}
{{--                                    sameProductQty[k].qty -= 10;--}}
{{--                                }--}}
{{--                            }--}}
{{--                        }--}}
{{--                    });--}}

{{--                    var bufferItem = [];--}}
{{--                    $.each(sameProductQty, function (k, v) {--}}

{{--                        // console.log("loop: " + k);--}}
{{--                        if (sameProductQty[k] === undefined) {--}}
{{--                            return;--}}
{{--                        } else {--}}
{{--                            if(sameProductQty[k].category_id != 4 &&--}}
{{--                                sameProductQty[k].category_id != 6 &&--}}
{{--                                sameProductQty[k].category_id != 8 &&--}}
{{--                                sameProductQty[k].category_id != 9 &&--}}
{{--                                k != 5 &&--}}
{{--                                k != 6--}}
{{--                            ) {--}}
{{--                                if (sameProductQty[k].qty >= 5) {--}}
{{--                                    if (bufferItem.length === 0) {--}}
{{--                                        console.log("pushed1: " + k);--}}
{{--                                        bufferItem.push(k);--}}
{{--                                    } else {--}}
{{--                                        console.log("pushed2: " + k);--}}
{{--                                        bufferItem.push(k);--}}
{{--                                        console.log("bufferItem: " + bufferItem);--}}
{{--                                        $.each(bufferItem, function (key, value) {--}}
{{--                                            console.log("buffer value: " + value);--}}
{{--                                            sameProductQty[value].qty -= 5;--}}
{{--                                        });--}}
{{--                                        total_item_qty -= 10;--}}
{{--                                        total_item_qty_for_shipping_rebate -= 10;--}}
{{--                                        bufferItem = [];--}}
{{--                                    }--}}
{{--                                }--}}
{{--                            }--}}
{{--                        }--}}
{{--                    });--}}
{{--                    // console.log(sameProductQty);--}}
{{--                    // console.log(total_item_qty);--}}

{{--                }--}}

{{--            }--}}
{{--            else{--}}
{{--                var temp_total_item_qty = total_item_qty_for_shipping_rebate;--}}
{{--                while(temp_total_item_qty >= 30){--}}
{{--                    temp_total_item_qty -= 30;--}}
{{--                    modify_shipping_fee -= 35;--}}

{{--                    var deduct_buffer = 0;--}}
{{--                    let shouldSkip = false;--}}

{{--                    $.each(sameProductQty, function (k, v) {--}}
{{--                        if(sameProductQty[k] === undefined){--}}
{{--                            return;--}}
{{--                        }else {--}}
{{--                            if(sameProductQty[k].category_id != 4 &&--}}
{{--                                sameProductQty[k].category_id != 6 &&--}}
{{--                                sameProductQty[k].category_id != 8 &&--}}
{{--                                sameProductQty[k].category_id != 9 &&--}}
{{--                                k != 5 &&--}}
{{--                                k != 6--}}
{{--                            ) {--}}
{{--                                if (shouldSkip) {--}}
{{--                                    return;--}}
{{--                                } else {--}}
{{--                                    if (sameProductQty[k].qty + deduct_buffer >= 30) {--}}
{{--                                        var shouldDeduct = 30 - deduct_buffer;--}}
{{--                                        deduct_buffer += shouldDeduct;--}}
{{--                                        sameProductQty[k].qty -= shouldDeduct;--}}
{{--                                    } else {--}}
{{--                                        deduct_buffer += sameProductQty[k].qty;--}}
{{--                                        sameProductQty[k].qty -= sameProductQty[k].qty;--}}
{{--                                    }--}}
{{--                                    if (deduct_buffer === 30) {--}}
{{--                                        shouldSkip = true;--}}
{{--                                        return;--}}
{{--                                    }--}}
{{--                                }--}}
{{--                            }--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}

{{--                $.each(sameProductQty, function (k, v) {--}}
{{--                    if (sameProductQty[k] === undefined) {--}}
{{--                        return;--}}
{{--                    } else {--}}
{{--                        if(sameProductQty[k].category_id != 4 &&--}}
{{--                            sameProductQty[k].category_id != 6 &&--}}
{{--                            sameProductQty[k].category_id != 8 &&--}}
{{--                            sameProductQty[k].category_id != 9 &&--}}
{{--                            k != 5 &&--}}
{{--                            k != 6--}}
{{--                        ) {--}}
{{--                            while (sameProductQty[k].qty >= 10) {--}}
{{--                                // total_item_qty -= 10;--}}
{{--                                sameProductQty[k].qty -= 10;--}}
{{--                                modify_shipping_fee -= 10;--}}
{{--                            }--}}
{{--                        }--}}
{{--                    }--}}
{{--                });--}}

{{--                var bufferItem = [];--}}
{{--                $.each(sameProductQty, function (k, v) {--}}
{{--                    // console.log("loop: " + k);--}}
{{--                    if (sameProductQty[k] === undefined) {--}}
{{--                        return;--}}
{{--                    } else {--}}
{{--                        if(sameProductQty[k].category_id != 4 &&--}}
{{--                            sameProductQty[k].category_id != 6 &&--}}
{{--                            sameProductQty[k].category_id != 8 &&--}}
{{--                            sameProductQty[k].category_id != 9 &&--}}
{{--                            k != 5 &&--}}
{{--                            k != 6--}}
{{--                        ) {--}}
{{--                            if (sameProductQty[k].qty >= 5) {--}}
{{--                                if (bufferItem.length === 0) {--}}
{{--                                    // console.log("pushed1: " + k);--}}
{{--                                    bufferItem.push(k);--}}
{{--                                } else {--}}
{{--                                    // console.log("pushed2: " + k);--}}
{{--                                    bufferItem.push(k);--}}
{{--                                    // console.log("bufferItem: " + bufferItem);--}}
{{--                                    $.each(bufferItem, function (key, value) {--}}
{{--                                        // console.log("buffer value: " + value);--}}
{{--                                        sameProductQty[value].qty -= 5;--}}
{{--                                    });--}}
{{--                                    // total_item_qty -= 10;--}}
{{--                                    modify_shipping_fee -= 10;--}}
{{--                                    bufferItem = [];--}}
{{--                                }--}}
{{--                            }--}}
{{--                        }--}}
{{--                    }--}}
{{--                });--}}
{{--                console.log(sameProductQty);--}}
{{--                console.log(total_item_qty);--}}
{{--                console.log("Sabah sarawark modify_shipping_fee: " +  modify_shipping_fee);--}}
{{--            }--}}

{{--            var formData = {--}}
{{--                "_token": "{{ csrf_token() }}",--}}
{{--                'state_id': $('#state').val(),--}}
{{--                'qty': total_item_qty,--}}
{{--            };--}}
{{--            var type = "POST";--}}
{{--            var ajaxurl = '{{ route('user.get-shipping-fee')}}';--}}

{{--            console.log(formData);--}}
{{--            $.ajax({--}}
{{--                type: type,--}}
{{--                url: ajaxurl,--}}
{{--                data: formData,--}}
{{--                success: function (data) {--}}
{{--                    console.log(data);--}}
{{--                    var decoded = JSON.parse(data);--}}
{{--                    if (decoded.success) {--}}
{{--                        use_product_add_on = decoded.shipping_fee_add_on == 0 ? true : false;--}}
{{--                        max_quantity_b4_shipping_add_on = decoded.max_quantity;--}}
{{--                        shipping_fee = parseFloat(decoded.shipping_fee);--}}
{{--                        shipping_add_on = parseFloat(decoded.shipping_fee_add_on);--}}
{{--                        $('#address_manual_state').html(decoded.state_name);--}}


{{--                        // console.log("max_quantity_b4_shipping_add_on: " + max_quantity_b4_shipping_add_on);--}}
{{--                        console.log("shipping_fee: " + shipping_fee);--}}
{{--                        // console.log("total_item_qty: " + total_item_qty);--}}
{{--                        console.log("use_product_add_on: " + use_product_add_on);--}}
{{--                        if (!use_product_add_on) {--}}
{{--                            // console.log("total_item_qty  "+ total_item_qty);--}}
{{--                            // console.log("max_quantity_b4_shipping_add_on  "+ max_quantity_b4_shipping_add_on);--}}
{{--                            if (total_item_qty > max_quantity_b4_shipping_add_on) {--}}
{{--                                add_on += shipping_add_on * (total_item_qty - max_quantity_b4_shipping_add_on);--}}
{{--                                console.log("product add_on  " + add_on);--}}
{{--                                console.log("shipping_add_on  " + shipping_add_on);--}}

{{--                            } else {--}}
{{--                                add_on += 0;--}}
{{--                            }--}}
{{--                            console.log("hi you see me?");--}}
{{--                        } else {--}}
{{--                            console.log("max_quantity_b4_shipping_add_on  " + max_quantity_b4_shipping_add_on);--}}
{{--                            if (total_item_qty <= max_quantity_b4_shipping_add_on) {--}}
{{--                                add_on = 0;--}}
{{--                            }--}}
{{--                        }--}}

{{--                        //calculate only for mother's day special--}}
{{--                        $.each($('.cart-cart-item'), function (k, v) {--}}
{{--                            // console.log("112233: " + $('.product-variant-id').eq(k).html());--}}
{{--                            if ($('.product-variant-id').eq(k).html() == 126) {--}}
{{--                                var quantity = parseInt($('.qty-text').eq(k).html());--}}
{{--                                add_on += parseFloat($('.product-price-add-on').eq(k).html()) * (quantity);--}}
{{--                                console.log(add_on);--}}
{{--                            }--}}
{{--                        });--}}

{{--                        if (addr_id == 0) {--}}
{{--                            // console.log("addr_id == 0");--}}
{{--                            $('.show-address').removeClass('d-block');--}}
{{--                            $('#show-address-manual').addClass('d-block');--}}
{{--                        }--}}

{{--                        if (withShipping) {--}}
{{--                            sub_shipping_total = shipping_fee + add_on + modify_shipping_fee;--}}
{{--                            total = subtotal + sub_shipping_total;--}}
{{--                            $('#shipping').removeClass('d-none');--}}
{{--                            $('#shipping_text').removeClass('d-none');--}}
{{--                            $('#shipping').html(addCommas(sub_shipping_total) + ' PV');--}}
{{--                            $('#subtotal').html(addCommas(subtotal) + ' PV');--}}
{{--                            $('#total').html(addCommas(total) + ' PV')--}}
{{--                        } else {--}}
{{--                            total = subtotal;--}}
{{--                            $('#shipping').addClass('d-none');--}}
{{--                            $('#shipping_text').addClass('d-none');--}}
{{--                            $('#subtotal').html(addCommas(subtotal) + ' PV');--}}
{{--                            $('#total').html(addCommas(total) + ' PV')--}}
{{--                        }--}}

{{--                    }--}}
{{--                },--}}
{{--                error: function (data) {--}}
{{--                    console.log("get shipping Error");--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}

{{--        function updateQuantity(cart_id, index, quantity) {--}}
{{--            // console.log("cart_id: " + cart_id);--}}
{{--            // console.log("index: " + index);--}}
{{--            // console.log("quantity: " + quantity);--}}
{{--            if ((quantity != -1 && $('.qty-text').eq(index).html() == 1) || $('.qty-text').eq(index).html() > 1) {--}}
{{--                var final_quantity = parseInt($('.qty-text').eq(index).html()) + quantity;--}}

{{--                var formData = {--}}
{{--                    "_token": "{{ csrf_token() }}",--}}
{{--                    index: index,--}}
{{--                    cart_id: cart_id,--}}
{{--                    quantity: final_quantity,--}}
{{--                };--}}
{{--                var type = "POST";--}}
{{--                var ajaxurl = '{{ route('user.cart.update-quantity')}}';--}}

{{--                // console.log(formData);--}}
{{--                $.ajax({--}}
{{--                    type: type,--}}
{{--                    url: ajaxurl,--}}
{{--                    data: formData,--}}
{{--                    success: function (data) {--}}
{{--                        // console.log(data);--}}
{{--                        var decoded = JSON.parse(data);--}}
{{--                        if (decoded.success) {--}}
{{--                            $('.qty-text').eq(index).val(final_quantity);--}}
{{--                            updateLayout();--}}
{{--                        } else {--}}
{{--                            $('.qty-text').eq(index).val(final_quantity - quantity);--}}
{{--                        }--}}
{{--                    },--}}
{{--                    error: function (data) {--}}
{{--                        $('.qty-text').eq(index).val(final_quantity - quantity);--}}
{{--                        // console.log(data);--}}
{{--                    }--}}
{{--                });--}}


{{--            } else if (quantity == -1 && $('.qty-text').eq(index).html() == 1) {--}}
{{--                removeItem(cart_id, index);--}}
{{--            }--}}
{{--        }--}}

{{--        function removeItem(cart_id, index) {--}}
{{--            var r = confirm("Do you want to delete this item?");--}}
{{--            if (r == true) {--}}
{{--                var formData = {--}}
{{--                    "_token": "{{ csrf_token() }}",--}}
{{--                    index: index,--}}
{{--                    cart_id: cart_id,--}}
{{--                    quantity: 0,--}}
{{--                };--}}
{{--                var type = "POST";--}}
{{--                var ajaxurl = '{{ route('user.cart.update-quantity')}}';--}}
{{--                $.ajax({--}}
{{--                    type: type,--}}
{{--                    url: ajaxurl,--}}
{{--                    data: formData,--}}
{{--                    success: function (data) {--}}
{{--                        // console.log(data);--}}
{{--                        $('.cart-cart-item').eq(index).remove();--}}
{{--                        location.reload();--}}
{{--                    },--}}
{{--                    error: function (data) {--}}
{{--                        // console.log(data);--}}
{{--                    }--}}
{{--                });--}}
{{--            } else {--}}
{{--                $('.qty-text').eq(index).val(2);--}}
{{--            }--}}
{{--        }--}}


{{--        $('.selection-address').on('click', function () {--}}
{{--            $('.selection-address').parent().parent().removeClass('shadow');--}}
{{--            $('.selection-address').parent().parent().removeClass('bg-white');--}}
{{--            $(this).parent().parent().addClass('bg-white');--}}
{{--            $(this).parent().parent().addClass('shadow');--}}
{{--            addr_id = $(this).attr('value');--}}
{{--            // console.log('selection-address inside de addr_id: ' + addr_id);--}}
{{--            shipping_fee = parseFloat($(this).attr('shipping_fee'));--}}
{{--        });--}}


{{--        $('.selection-pickup').on('click', function () {--}}
{{--            $('.selection-pickup').parent().parent().removeClass('shadow');--}}
{{--            $('.selection-pickup').parent().parent().removeClass('bg-white');--}}
{{--            $(this).parent().parent().addClass('bg-white');--}}
{{--            $(this).parent().parent().addClass('shadow');--}}
{{--            pickup_location_id = $(this).attr('value');--}}
{{--        });--}}
{{--        $('.selection-pickup').first().click();--}}
{{--        $('.show-pickuplocation').removeClass('d-block');--}}
{{--        $('#show-pickuplocation-' + pickup_location_id).addClass('d-block');--}}

{{--        function selectAddress() {--}}
{{--            // console.log('select address: ' + addr_id);--}}
{{--            // console.log('shipping fee: ' + shipping_fee);--}}
{{--            $('.show-address').removeClass('d-block');--}}
{{--            $('#show-address-' + addr_id).addClass('d-block');--}}
{{--            var state = $('#show-address-' + addr_id).attr('state');--}}
{{--            // console.log('state' + state);--}}
{{--            // getShippingFee(state);--}}
{{--            updateLayout();--}}
{{--        }--}}

{{--        function selectPickUp() {--}}
{{--            //show-pickup-location--}}
{{--            $('.show-pickuplocation').removeClass('d-block');--}}
{{--            $('#show-pickuplocation-' + pickup_location_id).addClass('d-block');--}}
{{--        }--}}

{{--        function useAddress() {--}}
{{--            address_name = $('#name').val();--}}
{{--            address_phone = $('#phone').val();--}}
{{--            address1 = $('#address_1').val();--}}
{{--            address2 = $('#address_2').val();--}}
{{--            country = $('#country').val();--}}
{{--            state = $('#state').val();--}}
{{--            postcode = $('#postcode').val();--}}
{{--            city = $('#city').val();--}}


{{--            $('#address_manual_name').html(address_name);--}}
{{--            $('#address_manual_phone').html(address_phone);--}}
{{--            $('#address_manual_addr1').html(address1);--}}
{{--            $('#address_manual_addr2').html(address2);--}}
{{--            $('#address_manual_postcode_city').html(postcode + ", " + city);--}}
{{--            $('#address_manual_state').html(address_name);--}}

{{--            $('.selection-address').attr('checked', false);--}}
{{--            $('.selection-address').prop('checked', false);--}}


{{--            // console.log(address_name);--}}
{{--            // console.log(address_phone);--}}
{{--            // console.log(address1);--}}
{{--            // console.log(address2);--}}
{{--            // console.log(country);--}}
{{--            // console.log(state);--}}
{{--            // console.log(postcode);--}}
{{--            // console.log(city);--}}
{{--            addr_id = 0;--}}

{{--            getShippingFee(state);--}}
{{--            // updateLayout();--}}
{{--        }--}}

{{--        function getShippingFee(state) {--}}
{{--            var formData = {--}}
{{--                "_token": "{{ csrf_token() }}",--}}
{{--                'state_id': state,--}}
{{--                'qty': total_item_qty,--}}
{{--            };--}}
{{--            var type = "POST";--}}
{{--            var ajaxurl = '{{ route('user.get-shipping-fee')}}';--}}

{{--            console.log(formData);--}}
{{--            $.ajax({--}}
{{--                type: type,--}}
{{--                url: ajaxurl,--}}
{{--                data: formData,--}}
{{--                success: function (data) {--}}
{{--                    console.log(data);--}}
{{--                    var decoded = JSON.parse(data);--}}
{{--                    if (decoded.success) {--}}
{{--                        use_product_add_on = decoded.shipping_fee_add_on == 0 ? true : false;--}}
{{--                        max_quantity_b4_shipping_add_on = decoded.max_quantity;--}}
{{--                        shipping_fee = parseFloat(decoded.shipping_fee);--}}
{{--                        shipping_add_on = parseFloat(decoded.shipping_fee_add_on);--}}
{{--                        $('#address_manual_state').html(decoded.state_name);--}}
{{--                        updateLayout();--}}
{{--                    }--}}
{{--                },--}}
{{--                error: function (data) {--}}
{{--                    console.log("Error");--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}

{{--        $('.shipping-method').on('click', function () {--}}
{{--            shipping_method = $(this).attr('value');--}}
{{--            // console.log(shipping_method);--}}
{{--            if (shipping_method == 1) {--}}
{{--                withShipping = false;--}}
{{--                updateLayout();--}}
{{--                $('.address').addClass('d-none');--}}
{{--                $('.pickup-select').removeClass('d-none');--}}
{{--            } else {--}}
{{--                withShipping = true;--}}
{{--                updateLayout();--}}
{{--                $('.pickup-select').addClass('d-none');--}}
{{--                $('.address').removeClass('d-none');--}}
{{--            }--}}
{{--        });--}}

{{--        function addCommas(nStr) {--}}
{{--            nStr += '';--}}
{{--            x = nStr.split('.');--}}
{{--            x1 = x[0];--}}
{{--            x2 = x.length > 1 ? '.' + x[1] : '';--}}
{{--            var rgx = /(\d+)(\d{3})/;--}}
{{--            while (rgx.test(x1)) {--}}
{{--                x1 = x1.replace(rgx, '$1' + ',' + '$2');--}}
{{--            }--}}
{{--            return x1 + x2;--}}
{{--        }--}}
{{--    </script>--}}

{{--    <script>--}}
{{--        $('#country').change(function () {--}}
{{--            if ($(this).val() !== "") {--}}
{{--                var country_id = $(this).val();--}}

{{--                var formData = {--}}
{{--                    "_token": "{{ csrf_token() }}",--}}
{{--                    'country_id': country_id,--}}
{{--                };--}}
{{--                var type = "POST";--}}
{{--                var ajaxurl = '{{ route('user.getStates')}}';--}}
{{--                $.ajax({--}}
{{--                    type: type,--}}
{{--                    url: ajaxurl,--}}
{{--                    data: formData,--}}
{{--                    success: function (data) {--}}
{{--                        var decoded = JSON.parse(data);--}}
{{--                        if (decoded.success) {--}}
{{--                            var htmlcode = "";--}}
{{--                            htmlcode = '<option value="">{{ __('user-portal.select_' , ['title'=> __('user-portal.state')]) }}</option>';--}}
{{--                            $.each(decoded.states, function (key, value) {--}}
{{--                                htmlcode = htmlcode + ' <option value=' + value.id + '>' + value.name + '</option>';--}}
{{--                            });--}}
{{--                            $('#state').html(htmlcode);--}}

{{--                        }--}}
{{--                    },--}}
{{--                    error: function (data) {--}}
{{--                        console.log("Error");--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}


@endsection

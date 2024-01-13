<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $invoice->name }}</title>

    <link rel="stylesheet" type="text/css" href="{{asset('landing/css/theme-vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('landing/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('landing/css/responsive.css')}}">
    <style>
        .padding {
            padding: 2rem !important
        }

        .card {
            margin-bottom: 30px;
            border: none;
            -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22)
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e6e6f2
        }

        h3 {
            font-size: 20px
        }

        h5 {
            font-size: 15px;
            line-height: 26px;
            color: #3d405c;
            margin: 0px 0px 15px 0px;
        }

        .text-dark {
            color: #3d405c !important
        }
    </style>
</head>
<body class="alt-font">
<div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
    <div class="card">
        <div class="card-header p-4">
            <a class="pt-2 d-inline-block title-extra-small" data-abc="true">Erya Phoenix Sdn. Bhd.</a>
            <div class="float-right">
                <h3 class="mb-0">{{ $invoice->new_invoice_number }}</h3>
                Date: {{ $invoice->created_at->format('d/m/Y') }}
            </div>
        </div>
        <div class="card-body">
            <div class="table-borderless table-responsive-sm">
                <table class="table table-borderless">
                    <tr>
                        <td style="width: 50%">
                            <div class="text-dark">
                                <h5 class="mb-3">From:</h5>
                                @if($invoice->from_name && $invoice->from_name != null)
                                <h3 class="text-dark mb-1">{{ $invoice->from_name }}</h3>
                                <div>Email: {{ $invoice->from_email }}</div>
                                <div>Phone: {{ $invoice->from_phone }}</div>
                                @else
                                <h3 class="text-dark mb-1">Erya Phoenix Sdn. Bhd.</h3>
                                <div>No 25, Jalan Perniagaan Pusat Perniagaan Kenanga</div>
                                <div>Muar Batu 1 1/4 Jalan Bakri Bakri,</div>
                                <div>84000 Muar, Johor</div>
                                <div>Email: eryaphoenix@gmail.com</div>
                                @endif
                            </div>
                        </td>

                        <td style="width: 50%">
                            <div class="text-dark">
                                <h5 class="mb-3">To:</h5>
                                @if($invoice->order_type == 2)
                                    <h3 class="text-dark mb-1">{{ $invoice->billing_name }}</h3>
                                    {{--                                    <div>{{$incoi}}</div>--}}
                                    {{--                                    <div>Chandni chowk, New delhi, 110006</div>--}}
                                    <div>Email: {{ $invoice->billing_phone }}</div>
                                    <div>Phone: {{ $invoice->billing_address }}</div>
                                @else
                                    <h3 class="text-dark mb-1">{{ $invoice->invoice_user->name }}</h3>
                                    {{--                                    <div>{{$incoi}}</div>--}}
                                    {{--                                    <div>Chandni chowk, New delhi, 110006</div>--}}
                                    <div>Email: {{ $invoice->invoice_user->email }}</div>
                                    <div>Phone: {{ $invoice->invoice_user->phone }}</div>
                                @endif

                            </div>
                        </td>
                    </tr>

                </table>
            </div>
            <div class="table-responsive-sm">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>Item</th>
                        <th>Description</th>
                        <th class="right">Price</th>
                        <th class="right">Disc.</th>
                        <th class="center">Qty.</th>
                        <th class="right">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{-- @foreach($invoice->order_item as $key => $item)
                        <tr>
                            <td class="center">{{$key +1}}</td>
                            <td class="left strong">{{ $item->product->name }}</td>
                            <td class="left">{{ $item->product_color.', '. $item->product_size }}</td>
                            <td class="right">RM {{ number_format($item->purchase_price,2) }}</td>
                            <td class="center">{{ $item->product_quantity }}</td>
                            <td class="right">RM {{ number_format($item->purchase_price * $item->product_quantity,2) }}</td>
                        </tr>
                    @endforeach --}}

                    @foreach($invoice_item_from_user['record'] as $key => $item)
                        <tr>
                            <td class="center">{{$key+1}}</td>
                            <td class="left strong">{{ $item['product_name'] }}
                                @if (array_key_exists("type",$item))
                                    @if($item['type'] == 2)
                                        <br/><small>Free</small>
                                    @endif
                                @endif
                            </td>
                            <td class="left">{{ $item['product_description']}}</td>
                            <td class="right">
                                @if($invoice->order_type == 2)
                                    <s>
                                        RM {{ number_format($item['sales_price'],2) }}
                                    </s><br/>
                                    RM {{ number_format($item['product_price'],2) }}
                                @else
                                    RM {{ number_format($item['product_price'],2) }}
                                @endif
                            </td>
                            <td class="right">
                                @if($invoice->order_type == 2)
                                    @if($item['type'] == 1)
                                        @if($item['sales_price'] > $item['product_price'])
                                            {{ number_format((($item['sales_price']-$item['product_price'])/$item['sales_price'])*100,2) }} %
                                        @else
                                            0%
                                        @endif
                                    @else
                                        100%
                                    @endif
                                @else
                                    @if($item['type'] == 1)
                                        0%
                                    @else
                                        100%
                                    @endif
                                @endif
                            </td>
                            <td class="center">{{ $item['product_quantity'] }}</td>
                            <td class="right">
                                @if (array_key_exists("type",$item))
                                    @if($item['type'] == 2)
                                        RM 0
                                    @else
                                        RM {{ number_format($item['total_per_variant'],2) }}
                                    @endif
                                @else
                                    RM {{ number_format($item['total_per_variant'],2) }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-5">
                </div>
                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                        <tr>
                            <td style="width: 70%;border-bottom: 0">
                            </td>
                            <td class="left">
                                <strong class="text-dark">Subtotal</strong>
                            </td>
                            {{-- <td class="right">RM {{ number_format($invoice->sub_total,2) }}</td> --}}
                            <td class="right">RM {{ number_format($invoice_item_from_user['subtotal'], 2) }}</td>
                        </tr>
                        <tr>
                            <td style="width: 70%;border-bottom: 0">
                            </td>
                            <td class="left">
                                <strong class="text-dark">Discount</strong>
                            </td>
                            {{-- <td class="right">RM {{ number_format($invoice->sub_total,2) }}</td> --}}
                            @if($invoice->order_type == 2)
                                <td class="right">RM 0</td>
                            @else
                                <td class="right">RM {{ number_format($invoice->voucher_amount, 2) }}</td>
                            @endif

                        </tr>
                        <tr>
                            <td style="width: 70%;border-bottom: 0">
                            </td>
                            <td class="left">
                                <strong class="text-dark">Shipping</strong>
                            </td>
                            {{-- <td class="right">RM {{ number_format($invoice->total_add_on + $invoice->total_shipping, 2) }}</td> --}}
                            <td class="right">RM {{ number_format($invoice->total_shipping, 2) }}</td>
                        </tr>

                        <tr>
                            <td style="width: 70%">
                            </td>
                            <td class="left">
                                <strong class="text-dark">Total</strong> </td>
                            <td class="right">
                                @if($invoice->order_type == 1)
                                    <strong class="text-dark">RM {{ number_format($invoice_item_from_user['subtotal'] + $invoice->total_shipping - $invoice->voucher_amount ,2) }}</strong>
                                @else
                                    <strong class="text-dark">RM {{ number_format($invoice_item_from_user['subtotal'] + $invoice->total_shipping ,2) }}</strong>
                                @endif
                                {{-- <strong class="text-dark">RM {{ number_format($invoice->amount + $invoice->total_add_on + $invoice->total_shipping + $invoice->voucher_amount ,2) }}</strong> --}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <h5 class="mb-0 font-weight-700">Thank you for your business! </h5>
            @if($invoice->order_type == 2)
            <p class="mb-0"><span>Extra Notes: </span><br/>
                1. All cheques should be crossed and made payable to {{ $deposit_bank->bank_account_name }}<br/>
                2. Goods sold are neither returnable nor refundable.<br/>
                3. Payment method:<br/>
                Bank Name: {{ $deposit_bank->bank->bank_name }}<br/>
                Bank Account No: {{ $deposit_bank->bank_account_number }}
            </p>
            @endif
        </div>
    </div>
</div>

</body>
</html>

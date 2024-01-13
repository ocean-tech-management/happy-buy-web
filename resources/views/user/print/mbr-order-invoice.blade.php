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
                <h3 class="mb-0">{{ $invoice->name }}</h3>
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
                                <h3 class="text-dark mb-1">{{ $invoice->user->name }}</h3>
                                <div>Email: {{ $invoice->user->email }}</div>
                                <div>Phone: {{ $invoice->user->phone }}</div>
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
                        <th class="center">Qty</th>
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

                    <tr>
                        <td class="center">1</td>
                        <td class="left strong">E5</td>
                        <td class="left">E-hera</td>
                        <td class="right">RM {{ number_format($invoice['unit_price'],2) }}</td>
                        <td class="center">{{ $invoice['quantity'] }}</td>
                        <td class="right">RM {{ number_format(($invoice['unit_price']*$invoice['quantity']),2) }}</td>
                    </tr>

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
                            <td class="right">RM {{ number_format($invoice['unit_price']*$invoice['quantity'], 2) }}</td>
                        </tr>
                        <tr>
                            <td style="width: 70%;border-bottom: 0">
                            </td>
                            <td class="left">
                                <strong class="text-dark">Shipping</strong>
                            </td>
                            <td class="right">RM {{ number_format(0, 2) }}</td>
                        </tr>

                        <tr>
                            <td style="width: 70%">
                            </td>
                            <td class="left">
                                <strong class="text-dark">Total</strong> </td>
                            <td class="right">
                                <strong class="text-dark">RM {{ number_format($invoice['unit_price']*$invoice['quantity'] ,2) }}</strong>
                                {{-- <strong class="text-dark">RM {{ number_format($invoice->amount + $invoice->total_add_on + $invoice->total_shipping + $invoice->voucher_amount ,2) }}</strong> --}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
{{--        <div class="card-footer bg-white">--}}
{{--            <h5 class="mb-0 font-weight-700">Thank you for your business! </h5>--}}
{{--            <p class="mb-0"><span>Extra Notes: </span>  {{ $invoice->footnote }} </p>--}}
{{--        </div>--}}
    </div>
</div>

</body>
</html>

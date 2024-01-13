@extends('landing.app')

@section('content')
    <section class="wow animate__fadeIn" style="visibility: visible; animation-name: fadeIn;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="row lg-padding-30px-lr md-padding-15px-lr sm-margin-40px-bottom justify-content-center " style="max-width: 1200px;">
                    <h6 class="title-small alt-font font-weight-300 dark-gold">{{ __('landing.product_qr_check') }}</h6>
                    <div class="col-12">
                        <table class="table alt-font">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Agent Name</th>
                                <th>Agent ID</th>
                                <th>Agent Rank</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="row">
                                        <img style="height: 60px;width:60px"
                                             src="{{ $order_item->product->image_1->url  }}"/>
                                        <div class="pl-2">
                                            <div>{{ $order_item->name }}</div>
                                            <div>
                                                {{ $order_item->product_variant->color->name .", ". $order_item->product_variant->size->name}}
                                            </div>
                                        </div>

                                    </div>

                                </td>
                                <td>{{ $order_item->order->order_number }}</td>
                                <td>{{ $order_item->created_at->format('d-m-Y | h:i') }}</td>
                                <td>{{ $order_item->order->user->name }}</td>
                                <td>{{ $order_item->order->user->personal_code }}</td>
                                <td>{{ str_replace('Merchant-', '', str_replace('Agent-', '', $order_item->order->user->roles[0]->name)) }}</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <button onclick="" class="text-medium alt-font font-weight-300 btn btn-shadow bg-dark-gold text-uppercase text-white letter-spacing-2px margin-50px-top padding-1-half-rem-lr">
                        {{ __('global.back') }}
                    </button>
                </div>

            </div>
        </div>
    </section>

@endsection

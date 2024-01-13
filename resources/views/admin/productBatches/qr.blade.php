<html>
    <head>
        <style type="text/css">
            /*div.page*/
            /*{*/
            /*    !*page-break-after: always;*!*/
            /*    page-break-inside: avoid;*/
            /*}*/
            .page-break {
                page-break-after: always;
            }
            .page-break:last-child {
                page-break-after: avoid;
            }
        </style>
    </head>
    <body>
    @foreach($pages as $item)
        @if($item != null)
            @if($productBatch->product_variant->qr_quantity == 1)

                <div class="page-break">
                    <table>
                        <tr>
                            <td>
                                <img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chld=H|0&choe=UTF-8&chl={{ $item->qr_code }}">
                            </td>
                            <td>
                                <p>ERYA </p>
                                <p>{{ substr($item->qr_code,0, 7) }}
                                    <br>
                                    {{ substr($item->qr_code,7, 7) }}
                                    <br>
                                    {{ substr($item->qr_code,14, 7) }}
                                    <br>
                                    {{ substr($item->qr_code,21, 7) }}
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            @else
                <div class="page-break">
                    <table>
                        <tr>
                            <td>
                                <img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chld=H|0&choe=UTF-8&chl={{ $item->qr_code }}">
                            </td>
                            <td>
                                <p>ERYA </p>
                                <p>{{ substr($item->qr_code,0, 7) }}
                                    <br>
                                    {{ substr($item->qr_code,7, 7) }}
                                    <br>
                                    {{ substr($item->qr_code,14, 7) }}
                                    <br>
                                    {{ substr($item->qr_code,21, 7) }}
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="page-break">
                    <table>
                        <tr>
                            <td>
                                <img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chld=H|0&choe=UTF-8&chl={{ $item->qr_code }}">
                            </td>
                            <td>
                                <p>ERYA </p>
                                <p>{{ substr($item->qr_code,0, 7) }}
                                    <br>
                                    {{ substr($item->qr_code,7, 7) }}
                                    <br>
                                    {{ substr($item->qr_code,14, 7) }}
                                    <br>
                                    {{ substr($item->qr_code,21, 7) }}
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            @endif
        @endif
    @endforeach

    </body>
</html>

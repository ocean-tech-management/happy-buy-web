<div>
    @if($selected_user_id != Auth::guard('user')->user()->id && sizeof($carts) > 0)
        <div>
            <span class="text-extra-dark-gray alt-font text-extra-large">VIP PV summary</span>

            <table class="table w-100 table-bordered">
                <tr>
                    <td><strong>Cash Voucher Balance </strong></td>
                    <td class="text-right">{{ getCashVoucherBalance($selected_user_id) }}</td>
                </tr>
                <tr>
                    <td><strong>Total item valid for cash voucher </strong></td>
                    <td class="text-right">{{ $total_deduct_for_cash_voucher_count }}</td>
                </tr>
                <tr>
                    <td><strong>Total cash voucher will be use </strong></td>
                    <td class="text-right"> {{ $total_deduct_for_cash_voucher }} PV</td>
                </tr>
                <tr>
                    <td><strong>Cash voucher balance after deduction </strong></td>
                    <td class="text-right">  {{ $balance }} PV</td>
                </tr>
                <tr>
                    <td><strong>VIP will need to pay </strong><br> <span class="text-extra-small">**Not yet calculate shipping </span></td>
                    <td class="text-right">  {{ $total_vip_price - $total_deduct_for_cash_voucher  }} PV</td>
                </tr>
                <tr>
                    <td><strong>VIP will get pv </strong></td>
                    <td class="text-right">{{ ($total_vip_price - $total_deduct_for_cash_voucher) * ($double_point ? 2 : 1) }} PV</td>
                </tr>
            </table>
        </div>
    @endif
</div>

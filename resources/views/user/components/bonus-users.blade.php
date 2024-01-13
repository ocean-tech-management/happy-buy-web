@foreach($millionaires as $millionaire)
    <tr class="justify-content-center d-md-table-row d-none">
        <td>
            <div class="flex">
                <img class="rounded-circle h-70px w-70px {{ $millionaire->profile_photo ? "cover-img" : ""}} bg-dark-gold"
                     src="{{ $millionaire->profile_photo ? $millionaire->profile_photo->url : asset('landing/images/default_profile.png') }}"/>
                <div class="pl-2">
                    <div> {{ $millionaire->name }}</div>
                    <div class="text-medium-gray"> {{$millionaire->status == 1 ? "Verified" : 'Not Verify'}} </div>
                </div>
            </div>

        </td>
        <td>{{ $millionaire->phone }}</td>
        <td class="text-uppercase">{{ $millionaire->latest_agreement->created_at->format('d M Y') }}</td>
        <td class="alt-font text-center">{{getSelfMonthlyTopupAmount($millionaire->id)}} </td>
        <td class="alt-font text-center">{{getPersonalAnnualSales($millionaire->id, false)}} </td>
    </tr>

    <tr class="justify-content-center d-md-none d-table-row">
        <td>
            <div class="flex">
                <img class="rounded-circle h-40px w-40px {{ $millionaire->profile_photo ? "cover-img" : ""}} bg-dark-gold"
                     src="{{ $millionaire->profile_photo ? $millionaire->profile_photo->url : asset('landing/images/default_profile.png') }}"/>
                <div class="pl-2">
                    <div> {{ $millionaire->name }} 小</div>
                    <div class="text-medium-gray"> {{$millionaire->status == 1 ? "Not Verify" : 'Verified'}} </div>
                </div>
            </div>
            <table class="table-borderless">
                <tr>
                    <td>Phone: {{ $millionaire->phone }}</td>
                    <td>Date Joined: {{ $millionaire->latest_agreement->created_at->format('d M Y') }}</td>
                </tr>
                <tr>
                    <td>Top-Up PV {{getSelfMonthlyTopupAmount($millionaire->id)}}</td>
                    <td> Annual Top-Up PV {{getPersonalAnnualSales($millionaire->id, false)}}</td>
                </tr>
            </table>

        </td>
    </tr>


@endforeach

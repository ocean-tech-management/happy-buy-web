@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <a class="btn btn-secondary" onclick="history.back(); return false;">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <h4 class="card-title">{{ trans('cruds.report.fields.member_detail') }}</h4>
            <div class="card-body">
                <div class="row pt-3">
                    <div class="col-md-6">
                        <table class="table table-responsive table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <th>{{ trans('cruds.report.fields.user_name') }}</th>
                                    <td field-key="member_name">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('cruds.report.fields.user_id') }}</th>
                                    <td field-key="member_id">{{ $user->id }}</td>
                                </tr>
                                <th>
                                    {{ trans('cruds.userEntry.fields.user_ic') }}
                                <td field-key="member_ic_number">{{ $user->identity_no }}</td>
                                </th>
                                <tr>
                                    <th>{{ trans('global.status') }}</th>
                                    <td field-key="status">{{ \App\Models\User::STATUS_SELECT[$user->status] }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('cruds.report.fields.date_joined') }}</th>
                                    <td field-key="date_joined">{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}</td>
                                </tr>
                                {{-- @if ($request->has('start_date') && filled($request['start_date']))
                                <tr>
                                    <th>{{ trans('cruds.report.fields.transaction_period') }}</th>
                                    <td field-key="transaction_period">{{ $request->start_date }} @if ($request->has('end_date') && filled($request['end_date']))- {{ $request->end_date}} @endif</td>
                                </tr>
                                @elseif(($request->has('end_date') && filled($request['end_date'])))
                                <tr>
                                    <th>{{ trans('cruds.report.fields.transaction_period') }}</th>
                                    <td field-key="transaction_period">{{ $request->end_date }}</td>
                                </tr> --}}
                                @if (count($all) == 1)
                                    <tr>
                                        <th>{{ trans('cruds.report.fields.transaction_period') }}</th>
                                        <td field-key="transaction_period">{{ \Carbon\Carbon::parse($all[0]->transaction_date)->format('Y-m-d') }}</td>
                                    </tr>
                                @elseif(count($all) >= 2)
                                    <tr>
                                        <th>{{ trans('cruds.report.fields.transaction_period') }}</th>
                                        <td field-key="transaction_period">{{ \Carbon\Carbon::parse($all[0]->transaction_date)->format('Y-m-d') }} -
                                            {{ \Carbon\Carbon::parse($all[count($all) - 1]->transaction_date)->format('Y-m-d') }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <form action="{{ route('admin.reports.stock-credit-balance-topup-millionaire-detail.export') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="start_date" value="{{ $request->start_date ?? $request->start_date}}">
                        <input type="hidden" name="end_date" value="{{ $request->end_date ?? $request->end_date}}">

                        <button id="export-btn" type="submit" value="Export" class="btn btn-secondary btn-secondary--icon tw-rounded" style="background-color:rgb(40, 151, 199)">
                            <i class="fas fa-file-export"></i> {{trans('global.export')}}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ trans('cruds.report.fields.transaction_detail') }}</h4>
            <div class="card-body">
                <div class="row pt-3">
                    <h5>{{ trans('cruds.report.fields.previous_balance') }}: {{ $previousBalance }}</h5>
                    <div class="col-md-12">
                        <table class="table table-responsive table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">{{ trans('global.date') }}</th>
                                    <th scope="col">{{ trans('cruds.report.fields.document_no') }}</th>
                                    <th scope="col">{{ trans('global.description') }}</th>
                                    <th scope="col">{{ trans('cruds.report.fields.amount') }}</th>
                                    <th scope="col">{{ trans('cruds.report.fields.total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                $total += $previousBalance;
                                ?>
                                @if (count($all) != 0)
                                    @foreach ($all as $key => $item)
                                        <?php
                                        switch ($item->from_table) {
                                            case 'transaction_point_purchases':
                                                $total += $item->amount;
                                                break;
                                            case 'orders':
                                                $total -= abs($item->amount);
                                                break;
                                            case 'point_converts':
                                                $total += $item->amount;
                                                break;
                                            default:
                                                $total += 0;
                                        }
                                        ?>
                                        <tr>
                                            <th>{{ $item->transaction_date }}</th>
                                            <th>
                                                @switch($item->from_table)
                                                    @case('transaction_point_purchases')
                                                        <a href={{ route('admin.transaction-point-purchases.top-up-receipt', $item->from_table_id) }}>{{ $item->document_no }}</a>
                                                    @break

                                                    @case('orders')
                                                        <a href={{ route('admin.orders.invoice-pdf', $item->from_table_id) }}>{{ $item->document_no }}</a>
                                                    @break

                                                    @case('point_converts')
                                                    @break

                                                    @default
                                                @endswitch
                                            </th>
                                            <th>{{ $item->description }}</th>
                                            <th>{{ $item->amount >= 0 ? abs($item->amount) : '(' . abs($item->amount) . ')' }}</th>
                                            <th>{{ $total }}</th>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

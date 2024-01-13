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
                                    <td field-key="member_name">{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('cruds.report.fields.user_id') }}</th>
                                    <td field-key="member_id">{{$user->id}}</td>
                                </tr>
                                <th>
                                    {{ trans('cruds.userEntry.fields.user_ic') }}
                                    <td field-key="member_ic_number">{{$user->identity_no}}</td>
                                </th>
                                <tr>
                                    <th>{{ trans('global.status') }}</th>
                                    <td field-key="status">{{\App\Models\User::STATUS_SELECT[$user->status]}}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('cruds.report.fields.date_joined') }}</th>
                                    <td field-key="date_joined">{{\Carbon\Carbon::parse($user->created_at)->format('Y-m-d')}}</td>
                                </tr>
                                @if(count($deposit) == 1)
                                <tr>
                                    <th>{{ trans('cruds.report.fields.transaction_period') }}</th>
                                    <td field-key="transaction_period">{{\Carbon\Carbon::parse($deposit[0]->created_at)->format('Y-m-d')}}</td>
                                </tr>
                                @elseif(count($deposit) >= 2)
                                <tr>
                                    <th>{{ trans('cruds.report.fields.transaction_period') }}</th>
                                    <td field-key="transaction_period">{{\Carbon\Carbon::parse($deposit[0]->created_at)->format('Y-m-d')}} - {{\Carbon\Carbon::parse($deposit[count($deposit)-1]->created_at)->format('Y-m-d')}}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ trans('cruds.report.fields.transaction_detail') }}</h4>
            <div class="card-body">
                <div class="row pt-3">
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
                                <?php $total = 0; ?>
                                @if(count($deposit) != 0)
                                    @foreach($deposit as $key => $item)
                                        <?php $total += $item->deposit; ?>
                                        <tr>
                                            <th>{{$item->created_at}}</th>
                                            <th><a href={{ route('admin.user-entries.desposit-receipt', $item->id) }}>{{$item->new_receipt_number}}</a></th>
                                            <th>{{ trans('cruds.userEntry.fields.deposit') }}</th>
                                            <th>{{$item->deposit}}</th>
                                            <th>{{$total}}</th>
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

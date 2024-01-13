@can($viewGate)
    <a class="btn btn-sm btn-primary" href="{{ route('admin.reports.stock-credit-balance-topup-agent-detail', ['id' => $row->user_id, 'start_date' => $request->start_date, 'end_date' => $request->end_date]) }}" data-value="{{$row->id}}">
        {{ trans('global.view') }} {{ trans('cruds.report.fields.detail') }}
    </a>
    {{-- <button class="btn btn-sm btn-primary" id="view_detail" value="{{$row->user_id}}">
        {{ trans('global.view') }} {{ trans('cruds.report.fields.detail') }}
    </button> --}}
@endcan
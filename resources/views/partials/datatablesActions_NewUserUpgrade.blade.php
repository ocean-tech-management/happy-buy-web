@can($viewGate)
    {{-- <a class="btn btn-sm btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
        {{ trans('global.view') }}
    </a> --}}
    <div>
        @if ($row->status == 2)
        <form action="{{ route('admin.user-upgrades.approve-reject') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $row->id }}">
            <input type="hidden" name="status" value="1">
            <input type="submit" class="btn btn-sm btn-danger" value="{{ trans('global.reject') }}">
        </form>

        <form action="{{ route('admin.user-upgrades.approve-reject') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $row->id }}">
            <input type="hidden" name="status" value="3">
            <input type="submit" class="btn btn-sm btn-success" value="{{ trans('global.approve') }}">
        </form>
    @endif
    </div>

@endcan

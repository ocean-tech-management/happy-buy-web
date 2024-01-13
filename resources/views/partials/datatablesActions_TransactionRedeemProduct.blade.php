@can($viewGate)
    <a class="btn btn-xs btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
        {{ trans('global.view') }}
    </a>
@endcan
@can($editGate)
    <a class="btn btn-xs btn-info" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
        {{ trans('global.edit') }}
    </a>
@endcan
@can($deleteGate)
    <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
    </form>
@endcan

@can($toShipGate)
    @if($row->status == 1 && $row->collect_type == 2)
        <a class="btn btn-xs btn-info" href="{{ route('admin.' . $crudRoutePart . '.to-ship', ['id' => $row->id]) }}">
            {{ trans('global.toShip') }}
        </a>
    @endif
@endcan

@can($cancelGate)
    @if($row->status == 1)
    <form action="{{ route('admin.' . $crudRoutePart . '.to-cancel') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $row->id }}">
        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.cancel') }}">
    </form>
    @endif
@endcan

@can($completeGate)
    @if($row->status == 2)
        <form action="{{ route('admin.' . $crudRoutePart . '.to-complete') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $row->id }}">
            <input type="submit" class="btn btn-xs btn-success" value="{{ trans('global.complete') }}">
        </form>
    @endif
@endcan

{{--@can($viewGate)--}}
{{--    <a class="btn btn-sm btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">--}}
{{--        {{ trans('global.view') }}--}}
{{--    </a>--}}
{{--@endcan--}}
{{--@can($editGate)--}}
{{--    <a class="btn btn-sm btn-info" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">--}}
{{--        {{ trans('global.edit') }}--}}
{{--    </a>--}}
{{--@endcan--}}
{{--@can($deleteGate)--}}
{{--    <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">--}}
{{--        <input type="hidden" name="_method" value="DELETE">--}}
{{--        <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--        <input type="submit" class="btn btn-sm btn-danger" value="{{ trans('global.delete') }}">--}}
{{--    </form>--}}
{{--@endcan--}}

@can($statusChangeGate)
    @if($row->status == 1)
        <form action="{{ route('admin.' . $crudRoutePart . '.change-status') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="status" value="2">
            <input type="hidden" name="id" value="{{ $row->id }}">
            <input type="submit" class="btn btn-sm btn-danger" value="{{ trans('global.deactivate') }}">
        </form>
    @endif
@endcan

@can($statusChangeGate)
    @if($row->status == 2)
        <form action="{{ route('admin.' . $crudRoutePart . '.change-status') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="status" value="1">
            <input type="hidden" name="id" value="{{ $row->id }}">
            <input type="submit" class="btn btn-sm btn-warning" value="{{ trans('global.activate') }}">
        </form>
    @endif
@endcan


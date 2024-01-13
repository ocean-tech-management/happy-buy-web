{{--@can($viewGate)--}}
{{--    <a class="btn btn-sm btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">--}}
{{--        {{ trans('global.view') }}--}}
{{--    </a>--}}
{{--@endcan--}}
@can($editGate)
    @if($row->status != 2)
        <a class="btn btn-sm btn-info" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
            {{ trans('global.edit') }}
        </a>
    @endif
@endcan
@can($deleteGate)
    @if($row->status != 2)
        <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="btn btn-sm btn-danger" value="{{ trans('global.delete') }}">
        </form>
    @endif
@endcan

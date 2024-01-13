{{--@can($viewGate)--}}
{{--    <a class="btn btn-sm btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">--}}
{{--        {{ trans('global.view') }}--}}
{{--    </a>--}}
{{--@endcan--}}
@can($inStockGate)
    @if($row->status == 1)
        <form action="{{ route('admin.' . $crudRoutePart . '.to-in-stock') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $row->id }}">
            <input type="submit" class="btn btn-sm btn-info" value="{{ trans('global.in_stock') }}">
        </form>
    @endif

@endcan
@can($generateQrGate)
    <a class="btn btn-sm btn-success" target="_blank" href="{{ route('admin.' . $crudRoutePart . '.qr-pdf', ['id' => $row->id]) }}">
        {{ trans('global.generate_qr') }}
    </a>
@endcan
@can($damageGate)
    @if($row->status == 1 || $row->status == 2)
        <form action="{{ route('admin.' . $crudRoutePart . '.to-damage') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $row->id }}">
            <input type="submit" class="btn btn-sm btn-danger" value="{{ trans('global.damage') }}">
        </form>
    @endif

    @if($row->status == 1 || $row->status == 2)
        <form action="{{ route('admin.' . $crudRoutePart . '.to-free') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $row->id }}">
            <input type="submit" class="btn btn-sm btn-warning" value="{{ trans('global.free') }}">
        </form>
    @endif

    @if($row->status == 1 || $row->status == 2)
        <form action="{{ route('admin.' . $crudRoutePart . '.to-sample') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}','fff');" style="display: inline-block;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $row->id }}">
            <input type="submit" class="btn btn-sm btn-secondary" value="{{ trans('global.sample') }}">
        </form>
    @endif
@endcan



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


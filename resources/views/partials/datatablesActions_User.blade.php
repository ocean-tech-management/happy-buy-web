@can($viewGate)
    @if(str_contains($row->roles[0]->name, 'Merchant'))
        <a class="btn btn-sm btn-primary" href="{{ route('admin.users.merchants.show', ['user' => $row->id]) }}">
            {{ trans('global.view') }}
        </a>
    @elseif(str_contains($row->roles[0]->name, 'Agent'))
        <a class="btn btn-sm btn-primary" href="{{ route('admin.users.agents.show', ['user' => $row->id]) }}">
            {{ trans('global.view') }}
        </a>
    @elseif(str_contains($row->roles[0]->name, 'VIP'))
        <a class="btn btn-sm btn-primary" href="{{ route('admin.users.vips.show', ['user' => $row->id]) }}">
            {{ trans('global.view') }}
        </a>
    @else
    <a class="btn btn-sm btn-primary" href="{{ route('admin.users.merchants.show', ['user' => $row->id]) }}">
        {{ trans('global.view') }}
    </a>
    @endif

@endcan
@can($editGate)
    @if(str_contains($row->roles[0]->name, 'Merchant'))
        <a class="btn btn-sm btn-info" href="{{ route('admin.users.merchants.edit', ['user' => $row->id]) }}">
            {{ trans('global.edit') }}
        </a>
        <a class="btn btn-sm btn-success" href="{{ route('admin.users.address-book.list', ['user' => $row->id]) }}">
            {{ trans('global.edit') }} {{ trans('cruds.user.fields.address_book') }}
        </a>
    @elseif(str_contains($row->roles[0]->name, 'Agent'))
        <a class="btn btn-sm btn-info" href="{{ route('admin.users.agents.edit', ['user' => $row->id]) }}">
            {{ trans('global.edit') }}
        </a>
        <a class="btn btn-sm btn-success" href="{{ route('admin.users.address-book.list', ['user' => $row->id]) }}">
            {{ trans('global.edit') }} {{ trans('cruds.user.fields.address_book') }}
        </a>
    @elseif(str_contains($row->roles[0]->name, 'VIP'))
        <a class="btn btn-sm btn-info" href="{{ route('admin.users.vips.edit', ['user' => $row->id]) }}">
            {{ trans('global.edit') }}
        </a>
        <a class="btn btn-sm btn-success" href="{{ route('admin.users.address-book.list', ['user' => $row->id]) }}">
            {{ trans('global.edit') }} {{ trans('cruds.user.fields.address_book') }}
        </a>
    @else
        <a class="btn btn-sm btn-info" href="{{ route('admin.users.merchants.edit', ['user' => $row->id]) }}">
            {{ trans('global.edit') }}
        </a>
    @endif
@endcan
{{--@can($deleteGate)--}}
{{--    <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">--}}
{{--        <input type="hidden" name="_method" value="DELETE">--}}
{{--        <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--        <input type="submit" class="btn btn-sm btn-danger" value="{{ trans('global.delete') }}">--}}
{{--    </form>--}}
{{--@endcan--}}

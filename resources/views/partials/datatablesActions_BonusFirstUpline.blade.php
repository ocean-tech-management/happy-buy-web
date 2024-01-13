{{-- @can($viewGate)
    <a class="btn btn-sm btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
        {{ trans('global.view') }}
    </a>
@endcan --}}
{{-- @can($editGate)
    <a class="btn btn-sm btn-info" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
        {{ trans('global.edit') }}
    </a>
@endcan --}}

{{-- @can($editGate)
    <button id="edit_bonus_first_upline" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#bonusFirstUplineEditModal" value="{{$row->id}}">
        {{ trans('global.edit') }}
    </button>
@endcan --}}

@can($editGate)
    <button id="edit_bonus_first_upline" class="btn btn-sm btn-info" value="{{$row->id}}">
        {{ trans('global.edit') }}
    </button>
@endcan
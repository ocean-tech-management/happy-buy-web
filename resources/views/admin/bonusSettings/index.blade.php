@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ trans('cruds.bonusSetting.title') }}</h4>
            {{-- <p class="card-title-desc">Example of Vertical nav tabs</p> --}}
            <div class="row pt-3">
                <div class="col-md-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link mb-2 @if (session('tab') == null || session('tab') == 'bonus1') active @endif" id="v-pills-bonus1-tab" data-bs-toggle="pill"
                            href="ui-tabs-accordions.html#v-pills-bonus1" role="tab" aria-controls="v-pills-bonus1" aria-selected="true">{{ trans('cruds.bonusJoin.title') }}</a>
                        <a class="nav-link mb-2 @if (session('tab') == 'bonus2') active @endif" id="v-pills-bonus2-tab" data-bs-toggle="pill"
                            href="ui-tabs-accordions.html#v-pills-bonus2" role="tab" aria-controls="v-pills-bonus2"
                            aria-selected="false">{{ trans('cruds.bonusTopUpGroup.title') }}</a>
                        <a class="nav-link mb-2 @if (session('tab') == 'bonus3') active @endif" id="v-pills-bonus3-tab" data-bs-toggle="pill"
                            href="ui-tabs-accordions.html#v-pills-bonus3" role="tab" aria-controls="v-pills-bonus3"
                            aria-selected="false">{{ trans('cruds.bonusTopUpPersonal.title') }}</a>
                        {{-- <a class="nav-link mb-2 @if (session('tab') == 'bonus4') active @endif" id="v-pills-bonus4-tab" data-bs-toggle="pill" href="ui-tabs-accordions.html#v-pills-bonus4" role="tab" aria-controls="v-pills-bonus4" aria-selected="false">{{ trans('cruds.bonusGroup.title') }}</a> --}}
                        {{-- <a class="nav-link mb-2 @if (session('tab') == 'bonus5') active @endif" id="v-pills-bonus5-tab" data-bs-toggle="pill" href="ui-tabs-accordions.html#v-pills-bonus5" role="tab" aria-controls="v-pills-bonus5" aria-selected="false">{{ trans('cruds.bonusPersonal.title') }}</a> --}}
                        {{-- <a class="nav-link @if (session('tab') == 'bonus6') active @endif" id="v-pills-bonus6-tab" data-bs-toggle="pill" href="ui-tabs-accordions.html#v-pills-bonus6" role="tab" aria-controls="v-pills-bonus6" aria-selected="false">{{ trans('cruds.bonusVIP.title') }}</a> --}}
                        <a class="nav-link mb-2 @if (session('tab') == 'bonus7') active @endif" id="v-pills-bonus7-tab" data-bs-toggle="pill"
                            href="ui-tabs-accordions.html#v-pills-bonus7" role="tab" aria-controls="v-pills-bonus7"
                            aria-selected="false">{{ trans('cruds.bonusTeamCar.title') }}</a>
                        <a class="nav-link mb-2 @if (session('tab') == 'bonus8') active @endif" id="v-pills-bonus8-tab" data-bs-toggle="pill"
                            href="ui-tabs-accordions.html#v-pills-bonus8" role="tab" aria-controls="v-pills-bonus8"
                            aria-selected="false">{{ trans('cruds.bonusTeamHouse.title') }}</a>

                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                        <div class="tab-pane fade @if (session('tab') == null || session('tab') == 'bonus1') show active @endif" id="v-pills-bonus1" role="tabpanel" aria-labelledby="v-pills-bonus1-tab">

                            <div class="">
                                <div class="card">
                                    <div class="card-header">
                                        {{ trans('cruds.bonusFirstUpline.title_singular') }} {{ trans('global.list') }}
                                    </div>

                                    <div class="card-body">
                                        <a class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#bonusFirstUplineCreateModal">
                                            {{ trans('global.create') }}
                                        </a>
                                        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-BonusFirstUpline">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        {{ trans('cruds.bonusFirstUpline.fields.id') }}
                                                    </th>
                                                    <th>
                                                        {{ trans('cruds.bonusFirstUpline.fields.referral_count') }}
                                                    </th>
                                                    <th>
                                                        {{ trans('cruds.bonusFirstUpline.fields.bonus_amount') }}
                                                    </th>
                                                    <th>
                                                        {{ trans('cruds.bonusFirstUpline.fields.top_up_count') }}
                                                    </th>
                                                    <th>
                                                        {{ trans('cruds.bonusFirstUpline.fields.extra_top_up_bonus') }}
                                                    </th>
                                                    <th>
                                                        {{ trans('cruds.bonusFirstUpline.fields.days') }}
                                                    </th>
                                                    <th>
                                                        {{ trans('cruds.bonusFirstUpline.fields.status') }}
                                                    </th>
                                                    <th>
                                                        &nbsp;
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('admin.bonus-joins.update', [$bonusJoin->id]) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label class="required" for="first_upline_bonus">{{ trans('cruds.bonusJoin.fields.first_upline_bonus') }}</label>
                                    <input class="form-control {{ $errors->has('first_upline_bonus') ? 'is-invalid' : '' }}" type="number" name="first_upline_bonus"
                                        id="first_upline_bonus" value="{{ old('first_upline_bonus', $bonusJoin->first_upline_bonus) }}" step="0.01" required>
                                    @if ($errors->has('first_upline_bonus'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('first_upline_bonus') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bonusJoin.fields.first_upline_bonus_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="second_upline_bonus">{{ trans('cruds.bonusJoin.fields.second_upline_bonus') }}</label>
                                    <input class="form-control {{ $errors->has('second_upline_bonus') ? 'is-invalid' : '' }}" type="number" name="second_upline_bonus"
                                        id="second_upline_bonus" value="{{ old('second_upline_bonus', $bonusJoin->second_upline_bonus) }}" step="0.01" required>
                                    @if ($errors->has('second_upline_bonus'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('second_upline_bonus') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bonusJoin.fields.second_upline_bonus_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-danger" type="submit">
                                        {{ trans('global.save') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade @if (session('tab') == 'bonus2') show active @endif" id="v-pills-bonus2" role="tabpanel" aria-labelledby="v-pills-bonus2-tab">
                            <form method="POST" action="{{ route('admin.bonus-top-up-groups.update', [$bonusTopUpGroup->id]) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label class="required" for="point_package_id">{{ trans('cruds.bonusTopUpGroup.fields.point_package') }}</label>
                                    <select class="form-control {{ $errors->has('point_package') ? 'is-invalid' : '' }}" name="point_package_id" id="point_package_id" required>
                                        @foreach ($point_packages as $id => $entry)
                                            @if ($id == 3)
                                                <option value="{{ $id }}"
                                                    {{ (old('point_package_id') ? old('point_package_id') : $bonusTopUpGroup->point_package->id ?? '') == $id ? 'selected' : '' }}>
                                                    {{ $entry }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('point_package'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('point_package') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bonusTopUpGroup.fields.point_package_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="first_upline_bonus">{{ trans('cruds.bonusTopUpGroup.fields.first_upline_bonus') }}</label>
                                    <input class="form-control {{ $errors->has('first_upline_bonus') ? 'is-invalid' : '' }}" type="number" name="first_upline_bonus"
                                        id="first_upline_bonus" value="{{ old('first_upline_bonus', $bonusTopUpGroup->first_upline_bonus) }}" step="0.01" required>
                                    @if ($errors->has('first_upline_bonus'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('first_upline_bonus') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bonusTopUpGroup.fields.first_upline_bonus_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="second_upline_bonus">{{ trans('cruds.bonusTopUpGroup.fields.second_upline_bonus') }}</label>
                                    <input class="form-control {{ $errors->has('second_upline_bonus') ? 'is-invalid' : '' }}" type="number" name="second_upline_bonus"
                                        id="second_upline_bonus" value="{{ old('second_upline_bonus', $bonusTopUpGroup->second_upline_bonus) }}" step="0.01" required>
                                    @if ($errors->has('second_upline_bonus'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('second_upline_bonus') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bonusTopUpGroup.fields.second_upline_bonus_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-danger" type="submit">
                                        {{ trans('global.save') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade @if (session('tab') == 'bonus3') show active @endif" id="v-pills-bonus3" role="tabpanel" aria-labelledby="v-pills-bonus3-tab">
                            <form method="POST" action="{{ route('admin.bonus-top-up-personals.update', [$bonusTopUpPersonal->id]) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label class="required" for="point_package_id">{{ trans('cruds.bonusTopUpPersonal.fields.point_package') }}</label>
                                    <select class="form-control {{ $errors->has('point_package') ? 'is-invalid' : '' }}" name="point_package_id" id="point_package_id" required>
                                        @foreach ($point_packages as $id => $entry)
                                            @if ($id == 3)
                                                <option value="{{ $id }}"
                                                    {{ (old('point_package_id') ? old('point_package_id') : $bonusTopUpPersonal->point_package->id ?? '') == $id ? 'selected' : '' }}>
                                                    {{ $entry }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('point_package'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('point_package') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bonusTopUpPersonal.fields.point_package_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="first_upline_bonus">{{ trans('cruds.bonusTopUpPersonal.fields.first_upline_bonus') }}</label>
                                    <input class="form-control {{ $errors->has('first_upline_bonus') ? 'is-invalid' : '' }}" type="number" name="first_upline_bonus"
                                        id="first_upline_bonus" value="{{ old('first_upline_bonus', $bonusTopUpPersonal->first_upline_bonus) }}" step="0.01" required>
                                    @if ($errors->has('first_upline_bonus'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('first_upline_bonus') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bonusTopUpPersonal.fields.first_upline_bonus_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="second_upline_bonus">{{ trans('cruds.bonusTopUpPersonal.fields.second_upline_bonus') }}</label>
                                    <input class="form-control {{ $errors->has('second_upline_bonus') ? 'is-invalid' : '' }}" type="number" name="second_upline_bonus"
                                        id="second_upline_bonus" value="{{ old('second_upline_bonus', $bonusTopUpPersonal->second_upline_bonus) }}" step="0.01" required>
                                    @if ($errors->has('second_upline_bonus'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('second_upline_bonus') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bonusTopUpPersonal.fields.second_upline_bonus_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-danger" type="submit">
                                        {{ trans('global.save') }}
                                    </button>
                                </div>
                            </form>
                        </div>


                        {{-- <div class="tab-pane fade @if (session('tab') == 'bonus4') show active @endif" id="v-pills-bonus4" role="tabpanel" aria-labelledby="v-pills-bonus4-tab">
                        <form method="POST" action="{{ route("admin.bonus-groups.update", [$bonusGroup->id]) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label class="required" for="point">{{ trans('cruds.bonusGroup.fields.point') }}</label>
                                <input class="form-control {{ $errors->has('point') ? 'is-invalid' : '' }}" type="text" name="point" id="point" value="{{ old('point', $bonusGroup->point) }}" required>
                                @if ($errors->has('point'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('point') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.bonusGroup.fields.point_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="percent">{{ trans('cruds.bonusGroup.fields.percent') }}</label>
                                <input class="form-control {{ $errors->has('percent') ? 'is-invalid' : '' }}" type="text" name="percent" id="percent" value="{{ old('percent', $bonusGroup->percent) }}" required>
                                @if ($errors->has('percent'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('percent') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.bonusGroup.fields.percent_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="after_point">{{ trans('cruds.bonusGroup.fields.after_point') }}</label>
                                <input class="form-control {{ $errors->has('after_point') ? 'is-invalid' : '' }}" type="text" name="after_point" id="after_point" value="{{ old('after_point', $bonusGroup->after_point) }}" required>
                                @if ($errors->has('after_point'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('after_point') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.bonusGroup.fields.after_point_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="after_percent">{{ trans('cruds.bonusGroup.fields.after_percent') }}</label>
                                <input class="form-control {{ $errors->has('after_percent') ? 'is-invalid' : '' }}" type="text" name="after_percent" id="after_percent" value="{{ old('after_percent', $bonusGroup->after_percent) }}" required>
                                @if ($errors->has('after_percent'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('after_percent') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.bonusGroup.fields.after_percent_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                        </form>
                    </div> --}}


                        {{-- <div class="tab-pane fade @if (session('tab') == 'bonus5') show active @endif" id="v-pills-bonus5" role="tabpanel" aria-labelledby="v-pills-bonus5-tab">
                        <form method="POST" action="{{ route("admin.bonus-personals.update", [$bonusPersonal->id]) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label class="required" for="point">{{ trans('cruds.bonusPersonal.fields.point') }}</label>
                                <input class="form-control {{ $errors->has('point') ? 'is-invalid' : '' }}" type="text" name="point" id="point" value="{{ old('point', $bonusPersonal->point) }}" required>
                                @if ($errors->has('point'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('point') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.bonusPersonal.fields.point_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="percent">{{ trans('cruds.bonusPersonal.fields.percent') }}</label>
                                <input class="form-control {{ $errors->has('percent') ? 'is-invalid' : '' }}" type="text" name="percent" id="percent" value="{{ old('percent', $bonusPersonal->percent) }}" required>
                                @if ($errors->has('percent'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('percent') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.bonusPersonal.fields.percent_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="after_point">{{ trans('cruds.bonusPersonal.fields.after_point') }}</label>
                                <input class="form-control {{ $errors->has('after_point') ? 'is-invalid' : '' }}" type="text" name="after_point" id="after_point" value="{{ old('after_point', $bonusPersonal->after_point) }}" required>
                                @if ($errors->has('after_point'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('after_point') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.bonusPersonal.fields.after_point_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="after_percent">{{ trans('cruds.bonusPersonal.fields.after_percent') }}</label>
                                <input class="form-control {{ $errors->has('after_percent') ? 'is-invalid' : '' }}" type="text" name="after_percent" id="after_percent" value="{{ old('after_percent', $bonusPersonal->after_percent) }}" required>
                                @if ($errors->has('after_percent'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('after_percent') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.bonusPersonal.fields.after_percent_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                        </form>
                    </div> --}}

                        {{-- <div class="tab-pane fade @if (session('tab') == 'bonus6') show active @endif" id="v-pills-bonus6" role="tabpanel" aria-labelledby="v-pills-bonus6-tab">
                        <form method="POST" action="{{ route("admin.bonus-vip.update", [$bonusVIP->id]) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label class="required" for="target_amount">{{ trans('cruds.bonusVIP.fields.target_amount') }}</label>
                                <input class="form-control {{ $errors->has('target_amount') ? 'is-invalid' : '' }}" type="text" name="target_amount" id="target_amount" value="{{ old('target_amount', $bonusVIP->target_amount) }}" required>
                                @if ($errors->has('target_amount'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('target_amount') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.bonusVIP.fields.target_amount_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="bonus_reward">{{ trans('cruds.bonusVIP.fields.bonus_reward') }}</label>
                                <input class="form-control {{ $errors->has('bonus_reward') ? 'is-invalid' : '' }}" type="text" name="bonus_reward" id="bonus_reward" value="{{ old('bonus_reward', $bonusVIP->bonus_reward) }}" required>
                                @if ($errors->has('bonus_reward'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('bonus_reward') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.bonusVIP.fields.bonus_reward_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required">{{ trans('cruds.bonusVIP.fields.status') }}</label>
                                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                                    @foreach (App\Models\BonusVIP::STATUS_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('status', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('status'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('status') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.enquiry.fields.status_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="start_date">{{ trans('cruds.bonusVIP.fields.start_date') }}</label>
                                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date', $bonusVIP->start_date) }}" required>
                                @if ($errors->has('start_date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('start_date') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.bonusVIP.fields.start_date_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="end_date">{{ trans('cruds.bonusVIP.fields.end_date') }}</label>
                                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date', $bonusVIP->end_date) }}" required>
                                @if ($errors->has('end_date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('end_date') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.bonusVIP.fields.end_date_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                        </form>
                    </div> --}}

                        <div class="tab-pane fade @if (session('tab') == 'bonus7') show active @endif" id="v-pills-bonus7" role="tabpanel" aria-labelledby="v-pills-bonus7-tab">
                            <form method="POST" action="{{ route('admin.bonus-team-car.update', [$bonusTeamCar->id]) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label class="required" for="target_amount">{{ trans('cruds.bonusTeamCar.fields.target_amount') }}</label>
                                    <input class="form-control {{ $errors->has('target_amount') ? 'is-invalid' : '' }}" type="text" name="target_amount" id="target_amount"
                                        value="{{ old('target_amount', $bonusTeamCar->target_amount) }}" required>
                                    @if ($errors->has('target_amount'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('target_amount') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bonusTeamCar.fields.target_amount_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="bonus_amount">{{ trans('cruds.bonusTeamCar.fields.bonus_amount') }}</label>
                                    <input class="form-control {{ $errors->has('bonus_amount') ? 'is-invalid' : '' }}" type="text" name="bonus_amount" id="bonus_amount"
                                        value="{{ old('bonus_amount', $bonusTeamCar->bonus_amount) }}" required>
                                    @if ($errors->has('bonus_amount'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('bonus_amount') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bonusTeamCar.fields.bonus_amount_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-danger" type="submit">
                                        {{ trans('global.save') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade @if (session('tab') == 'bonus8') show active @endif" id="v-pills-bonus8" role="tabpanel" aria-labelledby="v-pills-bonus8-tab">
                            <form method="POST" action="{{ route('admin.bonus-team-house.update', [$bonusTeamHouse->id]) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label class="required" for="target_amount">{{ trans('cruds.bonusTeamHouse.fields.target_amount') }}</label>
                                    <input class="form-control {{ $errors->has('target_amount') ? 'is-invalid' : '' }}" type="text" name="target_amount" id="target_amount"
                                        value="{{ old('target_amount', $bonusTeamHouse->target_amount) }}" required>
                                    @if ($errors->has('target_amount'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('target_amount') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bonusTeamHouse.fields.target_amount_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="bonus_amount">{{ trans('cruds.bonusTeamHouse.fields.bonus_amount') }}</label>
                                    <input class="form-control {{ $errors->has('bonus_amount') ? 'is-invalid' : '' }}" type="text" name="bonus_amount" id="bonus_amount"
                                        value="{{ old('bonus_amount', $bonusTeamHouse->bonus_amount) }}" required>
                                    @if ($errors->has('bonus_amount'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('bonus_amount') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bonusTeamHouse.fields.bonus_amount_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-danger" type="submit">
                                        {{ trans('global.save') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('bonus_join_create')
        @include('admin.bonusSettings.bonusJoin.create-modal')
    @endcan
    @can('bonus_join_edit')
        @include('admin.bonusSettings.bonusJoin.edit-modal')
    @endcan
@endsection

@section('scripts')
    <script>
        $(function() {

            let dtOverrideGlobals = {
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.bonus-first-upline.index') }}",
                columns: [
                    // { data: 'placeholder', name: 'placeholder' },
                    {
                        data: 'id',
                        name: 'id',
                        visible: false
                    },
                    {
                        data: 'referral_count',
                        name: 'referral_count'
                    },
                    {
                        data: 'bonus_amount',
                        name: 'bonus_amount'
                    },
                    {
                        data: 'top_up_count',
                        name: 'top_up_count'
                    },
                    {
                        data: 'extra_top_up_bonus',
                        name: 'extra_top_up_bonus'
                    },
                    {
                        data: 'days',
                        name: 'days'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'asc']
                ],
                pageLength: 10,
            };
            let table = $('.datatable-BonusFirstUpline').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

        $('#add_bonus_first_upline').on('click', function(e) {
            e.preventDefault();
            $('#create_errors_output').html('');

            $.ajax({
                type: "POST",
                url: "{{ route('admin.bonus-first-upline.store') }}",
                dataType: "json",
                data: {
                    _token: "{{ csrf_token() }}",
                    referral_count: $('#bonus_first_upline_referral_count').val(),
                    bonus_amount: $('#bonus_first_upline_bonus_amount').val(),
                    top_up_count: $('#bonus_first_upline_top_up_count').val(),
                    extra_top_up_bonus: $('#bonus_first_upline_extra_top_up_bonus').val(),
                    days: $('#bonus_first_upline_days').val(),
                    status: $('#bonus_first_upline_status').val(),
                },
                success: function(result) {
                    if (result.msgType === "success") {
                        $('#bonus_first_upline_create_form')[0].reset();
                        $('#create_errors_output').html('');
                        location.reload();
                    } else {
                        $('#create_errors_output').html('');
                    }
                },
                error: function(result) {
                    $('#create_errors_output').html('');
                    if (result.status === 422) {
                        var errors = '';
                        $.each(result.responseJSON.errors, function(key, value) {
                            errors += '<li>' + value + '</li>'
                        });
                        $('#create_errors_output').append('<div class="alert alert-danger" role="alert"><ul>' + errors + '</ul></div>');
                    }
                    Swal.hideLoading();
                }
            });
        });

        $(document).on('click', '#edit_bonus_first_upline', function(e) {
            e.preventDefault();
            var id = $(this).val();
            $('#edit_errors_output').html('');
            $.ajax({
                url: "{{ route('admin.bonus-first-upline.edit') }}",
                method: 'GET',
                data: {
                    bonus_first_upline_id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#edit_bonus_first_upline_id').val(data.edit_bonus_first_upline_id);
                    $('#edit_bonus_first_upline_referral_count').val(data.edit_bonus_first_upline_referral_count);
                    $('#edit_bonus_first_upline_bonus_amount').val(data.edit_bonus_first_upline_bonus_amount);
                    $('#edit_bonus_first_upline_top_up_count').val(data.edit_bonus_first_upline_top_up_count);
                    $('#edit_bonus_first_upline_extra_top_up_bonus').val(data.edit_bonus_first_upline_extra_top_up_bonus);
                    $('#edit_bonus_first_upline_days').val(data.edit_bonus_first_upline_days);
                    $('#edit_bonus_first_upline_status').val(data.edit_bonus_first_upline_status);
                    $('#bonusFirstUplineEditModal').modal('show');
                }
            });
        });

        $('#update_bonus_first_upline').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('admin.bonus-first-upline.update') }}",
                dataType: "json",
                data: {
                    _token: "{{ csrf_token() }}",
                    edit_bonus_first_upline_id: $('#edit_bonus_first_upline_id').val(),
                    referral_count: $('#edit_bonus_first_upline_referral_count').val(),
                    bonus_amount: $('#edit_bonus_first_upline_bonus_amount').val(),
                    top_up_count: $('#edit_bonus_first_upline_top_up_count').val(),
                    extra_top_up_bonus: $('#edit_bonus_first_upline_extra_top_up_bonus').val(),
                    days: $('#edit_bonus_first_upline_days').val(),
                    status: $('#edit_bonus_first_upline_status').val(),
                },
                success: function(result) {
                    if (result.msgType === "success") {
                        $('#edit_errors_output').html('');
                        location.reload();
                    } else {
                        $('#edit_errors_output').html('');
                    }
                },
                error: function(result) {
                    $('#edit_errors_output').html('');
                    if (result.status === 422) {
                        var errors = '';
                        $.each(result.responseJSON.errors, function(key, value) {
                            errors += '<li>' + value + '</li>'
                        });
                        $('#edit_errors_output').append('<div class="alert alert-danger" role="alert"><ul>' + errors + '</ul></div>');
                    }
                    Swal.hideLoading();
                }
            });
        });
    </script>
@endsection

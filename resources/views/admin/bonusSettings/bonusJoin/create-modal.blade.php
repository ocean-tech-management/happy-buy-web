<div id="bonusFirstUplineCreateModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">{{ trans('cruds.bonusFirstUpline.fields.create_bonus_first_upline') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="bonus_first_upline_create_form" action="{{ route('admin.bonus-first-upline.store') }}" enctype="multipart/form-data">
                    @csrf
                    <span id="create_errors_output"></span>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="required" for="bonus_first_upline_referral_count">{{ trans('cruds.bonusFirstUpline.fields.referral_count') }}</label>
                                <input class="form-control" type="text" name="bonus_first_upline_referral_count" id="bonus_first_upline_referral_count"
                                    value="{{ old('referral_count', '') }}" required>
                                <span class="help-block">{{ trans('cruds.bonusFirstUpline.fields.referral_count_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="required" for="bonus_first_upline_bonus_amount">{{ trans('cruds.bonusFirstUpline.fields.bonus_amount') }}</label>
                                <input class="form-control" type="text" name="bonus_first_upline_bonus_amount" id="bonus_first_upline_bonus_amount"
                                    value="{{ old('bonus_amount', '') }}" required>
                                <span class="help-block">{{ trans('cruds.bonusFirstUpline.fields.bonus_amount_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="bonus_first_upline_top_up_count">{{ trans('cruds.bonusFirstUpline.fields.top_up_count') }}</label>
                                <input class="form-control" type="text" name="bonus_first_upline_top_up_count" id="bonus_first_upline_top_up_count"
                                    value="{{ old('top_up_count', '') }}">
                                <span class="help-block">{{ trans('cruds.bonusFirstUpline.fields.top_up_count_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="bonus_first_upline_extra_top_up_bonus">{{ trans('cruds.bonusFirstUpline.fields.extra_top_up_bonus') }}</label>
                                <input class="form-control" type="text" name="bonus_first_upline_extra_top_up_bonus"
                                    id="bonus_first_upline_extra_top_up_bonus" value="{{ old('extra_top_up_bonus', '') }}">
                                <span class="help-block">{{ trans('cruds.bonusFirstUpline.fields.extra_top_up_bonus_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="bonus_first_upline_days">{{ trans('cruds.bonusFirstUpline.fields.days') }}</label>
                                <input class="form-control" type="text" name="bonus_first_upline_days" id="bonus_first_upline_days"
                                    value="{{ old('days', '') }}">
                                <span class="help-block">{{ trans('cruds.bonusFirstUpline.fields.days_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="required" for="bonus_first_upline_status">{{ trans('cruds.bonusFirstUpline.fields.status') }}</label>
                            <select class="form-control" name="bonus_first_upline_status" id="bonus_first_upline_status">
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach (App\Models\BonusFirstUpline::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{ trans('cruds.bonusFirstUpline.fields.status_helper') }}</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="add_bonus_first_upline" class="btn btn-primary waves-effect waves-light">{{ trans('global.submit') }}</button>
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">{{ trans('global.close') }}</button>
            </div>
        </div>
    </div>
</div>

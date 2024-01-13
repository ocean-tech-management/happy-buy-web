@extends('layouts.admin')
@section('content')

    <div class="card-body">
        <div class="form-group">
            <div class="main-content" style="margin-left:0rem;">
                <div class="page-content" style="padding:0rem;" >
                    <div class="container-fluid">
                        {{-- @php
                            $bonusTeamCarAndHouse = getAccumulatedBonusTeamCarAndHouse($user->id);
                            // dd($bonusTeamCarAndHouse)
                        @endphp
                        {{$bonusTeamCarAndHouse[0] . " " . $bonusTeamCarAndHouse[1] . " " . $bonusTeamCarAndHouse[2] . " " . $bonusTeamCarAndHouse[3] . " " . $bonusTeamCarAndHouse[4]}} --}}
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18"><!--{{ trans('global.show') }} {{ trans('cruds.user.title') }}--></h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $user->roles[0]->name ??  trans('cruds.user.fields.agent') }}</a></li>
                                            <li class="breadcrumb-item active">Profile</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card overflow-hidden">
                                    <div class="bg-primary bg-soft">
                                        <div class="row">
                                            <div class="col-7">
                                                <div class="text-primary p-3">
{{--                                                    <h5 class="text-primary">Agent</h5>--}}
                                                    {{-- <h5 class="text-primary">{{$user->role}}</h5> --}}
                                                    {{-- <p>It will seem like simplified</p> --}}
                                                </div>
                                            </div>
                                            <div class="col-5 align-self-end">
                                                <img src="{{url('/admin_assets/images/profile-img.png')}}" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="avatar-md profile-user-wid mb-4">
                                                    @if($user->profile_photo)
                                                        <a href="{{ $user->profile_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                            <img src="{{ $user->profile_photo->getUrl('thumb') }}" alt="profile pic" class="img-thumbnail rounded-circle">
                                                        </a>
                                                    @else
                                                        <img src="{{url('/admin_assets/images/users/default_user.png')}}" alt="profile pic" class="img-thumbnail rounded-circle">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-8 pt-3">
                                                <h5 class="font-size-15 text-truncate">{{ $user->name }}</h5>
                                                <h5 class="font-size-11 text-truncate">{{ $user->roles[0]->name }}</h5>
                                                <h5 class="font-size-11 text-truncate">{{ \App\Models\User::USER_TYPE_SELECT[$user->user_type] ?? '-' }}</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="pt-2">
                                                <div class="row">
                                                    <div class="col-6 pb-2">
                                                        <h5 class="font-size-15">{{ number_format(getUserPointBalance($user->id)) }}</h5>
                                                        <p class="text-muted mb-0">{{ trans('cruds.pointBalance.title') }}</p>
                                                    </div>
                                                    <div class="col-6 pb-2">
                                                        <h5 class="font-size-15">{{ number_format(getUserPointManagerBalance($user->id)) }}</h5>
                                                        <p class="text-muted mb-0">{{ trans('cruds.pointManagerBalance.title') }}</p>
                                                    </div>
                                                    <div class="col-6 pb-2">
                                                        <h5 class="font-size-15">{{ number_format(getUserPointExecutiveBalance($user->id)) }}</h5>
                                                        <p class="text-muted mb-0">{{ trans('cruds.pointExecutiveBalance.title') }}</p>
                                                    </div>
                                                    <div class="col-6 pb-2">
                                                        <h5 class="font-size-15">{{ number_format(getUserPointBonusBalance($user->id)) }}</h5>
                                                        <p class="text-muted mb-0">{{ trans('cruds.pointBonusBalance.title') }}</p>
                                                    </div>
                                                    @if(Route::is('admin.users.merchants.show'))
                                                        <div class="col-6 pb-2">
                                                            @php
                                                            if($user->created_at != null)
                                                            {
                                                                if(\Carbon\Carbon::parse($user->created_at)->toDateTimeString() >= \Carbon\Carbon::createFromFormat('Y-m-d', '2022-08-01')->startOfDay()->toDateTimeString()) {
                                                                    $userVoucherLog = 18000-getUserVoucherLog($user->id);
                                                                } else {
                                                                    $userVoucherLog = 27000-getUserVoucherLog($user->id);
                                                                }
                                                            } else {
                                                                $userVoucherLog = 27000-getUserVoucherLog($user->id);
                                                            }
                                                            @endphp
                                                            {{-- {{\Carbon\Carbon::parse($user->created_at)->toDateTimeString()}}
                                                            {{\Carbon\Carbon::createFromFormat('Y-m-d', '2022-08-01')->startOfDay()->toDateTimeString()}} --}}
                                                            <h5 class="font-size-15">{{ number_format(getUserVoucherBalance($user->id)) }} / {{ number_format($userVoucherLog) }}</h5>
                                                            <p class="text-muted mb-0">{{ trans('cruds.voucherBalance.title') }}</p>
                                                        </div>
                                                    @endif
                                                    <div class="col-6 pb-2">
                                                        <h5 class="font-size-15">{{ number_format(getUserShippingBalance($user->id)) }}</h5>
                                                        <p class="text-muted mb-0">{{ trans('cruds.shippingBalance.title') }}</p>
                                                    </div>
                                                    <div class="col-6 pb-2">
                                                        <h5 class="font-size-15">{{ number_format(getCashVoucherBalance($user->id)) }}</h5>
                                                        <p class="text-muted mb-0">{{ trans('cruds.cashVoucherBalance.title') }}</p>
                                                    </div>
                                                    <div class="col-6 pb-2">
                                                        <h5 class="font-size-15">{{ number_format(getPvBalance($user->id)) }}</h5>
                                                        <p class="text-muted mb-0">{{ trans('cruds.pvBalance.title') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->

                                @if($user->direct_upline != null)
                                    <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-5">{{ trans('cruds.user.fields.direct_upline') }}</h4>
                                        <div class="">
                                            <ul class="verti-timeline list-unstyled">
                                                <li class="event-list">
                                                    <div class="event-timeline-dot">
                                                        <i class="bx bx-right-arrow-circle"></i>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <div>
                                                                <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">{{ $user->direct_upline->name ?? '' }}</a></h5>
                                                                <span class="text-primary">{{ $user->direct_upline->roles[0]->name }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-5">{{ trans('cruds.user.fields.upline_user') }}</h4>
                                        <div class="">
                                            <ul class="verti-timeline list-unstyled">
                                                @if($user->upline_user != null)
                                                    <li class="event-list">
                                                        <div class="event-timeline-dot">
                                                            <i class="bx bx-right-arrow-circle"></i>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1">
                                                                <div>
                                                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">{{ $user->upline_user->name ?? '' }}</a></h5>
                                                                    <span class="text-primary">{{ $user->upline_user->roles[0]->name }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if($user->upline_user_1 != null)
                                                    <li class="event-list">
                                                        <div class="event-timeline-dot">
                                                            <i class="bx bx-right-arrow-circle"></i>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1">
                                                                <div>
                                                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">{{ $user->upline_user_1->name ?? '' }}</a></h5>
                                                                    <span class="text-primary">{{ $user->upline_user_1->roles[0]->name }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if($user->upline_user_2 != null)
                                                    <li class="event-list">
                                                        <div class="event-timeline-dot">
                                                            <i class="bx bx-right-arrow-circle"></i>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1">
                                                                <div>
                                                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">{{ $user->upline_user_2->name ?? '' }}</a></h5>
                                                                    <span class="text-primary">{{ $user->upline_user_2->roles[0]->name }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        @if($user->upline_user == null && $user->upline_user_1 == null && $user->upline_user_2 == null)
                                            <span style="text-align: center">
                                                {{ trans('global.no_found', ['value' => trans('cruds.user.fields.upline_user')]) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>

                            <div class="col-xl-8">
                                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link @if(session('message') == null || session('message') == "personal") active @endif" data-bs-toggle="tab" href="#personal" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">{{ trans('cruds.user.fields.personal_information') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if(session('message') == "account") active @endif" data-bs-toggle="tab" href="#account" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                            <span class="d-none d-sm-block">{{ trans('cruds.user.fields.account_information') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if(session('message') == "bank") active @endif" data-bs-toggle="tab" href="#bank" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                            <span class="d-none d-sm-block">{{ trans('cruds.user.fields.bank_information') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if(session('message') == "addressbook") active @endif" data-bs-toggle="tab" href="#addressbook" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                            <span class="d-none d-sm-block">{{ trans('cruds.addressBook.title') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if(session('message') == "agreement") active @endif" data-bs-toggle="tab" href="#agreement" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                            <span class="d-none d-sm-block">{{ trans('cruds.userAgreement.title') }}</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="tab-content p-3 text-muted">
                                            <div class="tab-pane @if(session('message') == null ||session('message') == "personal") active @endif" id="personal" role="tabpanel">
                                                <table class="table table-nowrap mb-0">
                                                    <tbody>
                                                    <tr>
                                                        <th>{{ trans('cruds.user.fields.name') }} :</th>
                                                        <td>{{ $user->name }}</td>
                                                        <th>{{ trans('cruds.user.fields.phone') }} :</th>
                                                        <td>{{ $user->phone ?? '-' }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>{{ trans('cruds.user.fields.email') }} :</th>
                                                        <td> {{ $user->email }}</td>
                                                        <th>{{ trans('cruds.user.fields.status') }} :</th>
                                                        <td> {{ \App\Models\User::STATUS_SELECT[$user->status] ?? '-' }}

                                                            @can('user_status_change')
                                                                <form action="{{route('admin.users.status-change')}}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                                                    <input type="hidden" name="status" value="{{ $user->status }}">&nbsp;
                                                                    @if($user->status == 1)
                                                                        <input type="submit" class="btn btn-sm btn-danger" value="{{ trans('global.deactivate') }}">
                                                                    @else
                                                                        <input type="submit" class="btn btn-sm btn-info" value="{{ trans('global.activate') }}">
                                                                    @endif
                                                                </form>
                                                            @endcan

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th> {{ \App\Models\User::IDENTITY_TYPE_SELECT[$user->identity_type] ?? \App\Models\User::IDENTITY_TYPE_SELECT[1] }} :</th>
                                                        <td> {{ $user->identity_no ?? '-' }}</td>
                                                        <th>{{ trans('cruds.user.fields.date_of_birth') }} :</th>
                                                        <td> {{ $user->date_of_birth ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ trans('cruds.user.fields.gender') }} :</th>
                                                        <td> {{ \App\Models\User::GENDER_SELECT[$user->gender] ?? '-' }}</td>
                                                        <th></th>
                                                        <td>  </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane @if(session('message') == "account") active @endif" id="account" role="tabpanel">
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap mb-0">
                                                        <tbody>
                                                        <tr>
                                                            <th>{{ trans('cruds.user.fields.account_verify') }} :</th>
                                                            <td>{{ \App\Models\User::ACCOUNT_VERIFY_SELECT[$user->account_verify] ?? '-' }}
                                                                &nbsp;
                                                                @if($user->ic_photo)
                                                                    <a data-bs-toggle="modal" data-bs-target="#icModal">
                                                                        <i class="far fa-image fa-2x"></i>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                            <th>{{ trans('cruds.user.fields.ssm_verify') }} :</th>
                                                            <td>{{ \App\Models\User::SSM_VERIFY_SELECT[$user->ssm_verify] ?? '-' }}
                                                                &nbsp;
                                                                @if($user->ssm_photo)
                                                                    <a data-bs-toggle="modal" data-bs-target="#ssmModal">
                                                                        <i class="far fa-image fa-2x"></i>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th>{{ trans('cruds.user.fields.first_payment') }} :</th>
                                                            <td>{{ \App\Models\User::FIRST_PAYMENT_SELECT[$user->first_payment] ?? '-' }}
                                                                &nbsp;
                                                                @if($user->first_payment_receipt_photo)
                                                                    <a data-bs-toggle="modal" data-bs-target="#paymentModal">
                                                                        <i class="far fa-image fa-2x"></i>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                            <th>{{ trans('cruds.user.fields.shop_verify') }} :</th>
                                                            <td>{{ \App\Models\User::SHOP_VERIFY_SELECT[$user->shop_verify] ?? '-' }}
                                                                &nbsp;
                                                                @if($user->shop_photo)
                                                                    <a data-bs-toggle="modal" data-bs-target="#shopModal">
                                                                        <i class="far fa-image fa-2x"></i>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <th>{{ trans('cruds.user.fields.register_verify_at') }} :</th>
                                                            <td> {{ $user->register_verify_at ?? '-' }}</td>
                                                            <th> {{ trans('cruds.user.fields.personal_code') }} :</th>
                                                            <td> {{ $user->personal_code ?? '-' }}</td>
                                                        </tr>

                                                        {{-- <tr>
                                                            <th scope="row">{{ trans('cruds.user.fields.date_of_birth') }} :</th>
                                                            <td> {{ $user->date_of_birth}}</td>
                                                        </tr> --}}
                                                        {{-- <tr>
                                                            <th scope="row">{{ trans('cruds.user.fields.personal_code') }} :</th>
                                                            <td> {{ $user->personal_code}}</td>
                                                        </tr> --}}
                                                        {{-- <tr>
                                                            <th scope="row">Location :</th>
                                                            <td>California, United States</td>
                                                        </tr> --}}
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane @if(session('message') == "bank") active @endif" id="bank" role="tabpanel">
                                                <table class="table table-nowrap mb-0">
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">{{ trans('cruds.user.fields.bank_name') }} :</th>
                                                        <td>{{ $user->bank_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">{{ trans('cruds.user.fields.bank_account_name') }} :</th>
                                                        <td>{{ $user->bank_account_name ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">{{ trans('cruds.user.fields.bank_account_number') }} :</th>
                                                        <td> {{ $user->bank_account_number }}</td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <th scope="row">{{ trans('cruds.user.fields.date_of_birth') }} :</th>
                                                        <td> {{ $user->date_of_birth}}</td>
                                                    </tr> --}}
                                                    {{-- <tr>
                                                        <th scope="row">{{ trans('cruds.user.fields.personal_code') }} :</th>
                                                        <td> {{ $user->personal_code}}</td>
                                                    </tr> --}}
                                                    {{-- <tr>
                                                        <th scope="row">Location :</th>
                                                        <td>California, United States</td>
                                                    </tr> --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane @if(session('message') == "addressbook") active @endif" id="addressbook" role="tabpanel">
                                                <div class="row">
                                                @forelse($user->address_book as $address_book)
                                                    <div class="col-sm-6">
                                                        <div class="card p-1 border shadow-none">
                                                            <div class="p-3">
                                                                <h5>{{ $address_book->remark }}</h5>
                                                                <p class="text-muted mb-0">{{ $address_book->name }}</p>
                                                                <p class="text-muted mb-0">{{ $address_book->phone }}</p>
                                                                <p>
                                                                    {{ $address_book->address_1 }}
                                                                    {{ $address_book->address_2 ?? '' }}
                                                                    {{ $address_book->city ?? '' }}
                                                                    {{ $address_book->state->name ?? '' }}
                                                                    {{ $address_book->postcode ?? '' }}
                                                                </p>
                                                                <ul class="list-inline">
                                                                    @if($address_book->set_default == 1)
                                                                        <li class="list-inline-item me-3">
                                                                            <a href="javascript: void(0);" class="text-muted">
                                                                                <i class="bx bx bx-pin align-middle text-muted me-1"></i> {{ trans('global.default') }}
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                    <li class="list-inline-item me-3">
                                                                        <a href="javascript: void(0);" class="text-muted">
                                                                            <i class="bx bx bx-radio-circle align-middle text-muted me-1"></i> {{ \App\Models\AddressBook::STATUS_SELECT[$address_book->status] ?? '' }}
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <div>
                                                                    <a href="javascript: void(0);" class="text-primary">{{ trans('global.edit') }} <i class="mdi mdi-arrow-right"></i></a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                @empty
                                                    <span style="text-align: center">
                                                        {{ trans('global.no_found', ['value' => trans('cruds.addressBook.title')]) }}
                                                    </span>
                                                @endforelse
                                                </div>
                                            </div>
                                            <div class="tab-pane @if(session('message') == "agreement") active @endif" id="agreement" role="tabpanel">
                                                <div class="row">
                                                    @forelse($user->agreement as $agreement)
                                                        <div class="col-sm-6">
                                                            <div class="card p-1 border shadow-none">
                                                                <div class="p-3">
{{--                                                                    {{ $agreement->user_agreement->agreement_content }}--}}
                                                                    <h5>{{ $agreement->user_agreement->name }}</h5>
                                                                    <p class="text-muted mb-0">{{ trans('cruds.userAgreementLog.fields.signature_name')}}: <strong>{{ $agreement->signature_name }}</strong></p>
                                                                    <p class="text-muted mb-0">{{ trans('cruds.userAgreementLog.fields.signature_ic')}}: <strong>{{ $agreement->signature_ic }}</strong></p>
                                                                    <p class="text-muted mb-0">{{ trans('cruds.userAgreementLog.fields.signature_at')}}: <strong>{{ $agreement->signature_at }}</strong></p>
                                                                    <br/>
                                                                    <a data-bs-toggle="modal" data-id="{{ $agreement->id }}" data-title="{{ $agreement->user_agreement->name }}" data-content="{{ $agreement->user_agreement->agreement_content }}" data-signature-name="{{ $agreement->signature_name }}" data-signature-ic="{{ $agreement->signature_ic }}" data-signature-at="{{ $agreement->signature_at }}" data-bs-target="#agreementModal" class="text-primary showAgreementDialog">{{ trans('global.view') }} <i class="mdi mdi-arrow-right"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <span style="text-align: center">
                                                        {{ trans('global.no_found', ['value' => trans('cruds.userAgreement.title')]) }}
                                                    </span>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card" id="backToMenu">
                                    <div class="card-body">
                                        <h4 class="card-title mb-5">Deposit and Joining Fee records</h4>
                                        <div class="table-responsive">
                                            <table class="table table-nowrap table-hover mb-0">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Ranking</th>
                                                    <th scope="col">Deposit</th>
                                                    <th scope="col">Joining Fee</th>
                                                    <th scope="col">Payment Method</th>
                                                    <th scope="col">Action</th>
                                                    <th scope="col">Payment Receipt</th>
                                                    <th scope="col">Gateway Response</th>
                                                    <th scope="col">Payment Status</th>
                                                    <th scope="col">Payment Transaction</th>
                                                </tr>
                                                </thead>
                                                <tr>
                                                    @foreach ($userEntry as $entry)
                                                        <td>
                                                            @if($entry->user_type == 1)
                                                                Executive
                                                            @elseif($entry->user_type == 2)
                                                                Manager
                                                            @elseif($entry->user_type == 3)
                                                                Millinoaire
                                                            @elseif($entry->user_type == 4)
                                                                VIP
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $entry->deposit }}
                                                        </td>
                                                        <td>
                                                            {{ $entry->fee }}
                                                        </td>
                                                        <td>
                                                            @if($entry->payment_method_id == 1)
                                                                Bank Transfer
                                                            @elseif($entry->payment_method_id == 2)
                                                                Online Banking/Credit Card
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($entry->status == 2)
                                                                <form action="{{ route('admin.user-upgrades.approve-reject') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <input type="hidden" name="id" value="{{ $entry->id }}">
                                                                    <input type="hidden" name="status" value="1">
                                                                    <input type="submit" class="btn btn-sm btn-danger" value="{{ trans('global.reject') }}">
                                                                </form>

                                                                <form action="{{ route('admin.user-upgrades.approve-reject') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <input type="hidden" name="id" value="{{ $entry->id }}">
                                                                    <input type="hidden" name="status" value="3">
                                                                    <input type="submit" class="btn btn-sm btn-success" value="{{ trans('global.approve') }}">
                                                                </form>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($entry->receipt != null)
                                                                <a data-bs-toggle="modal" data-id="{{ $entry->id }}" data-image="{{ $entry->receipt->url }}" data-bs-target="#paymentEntryModal" class="text-primary showPaymentEntryDialog"><i class="far fa-image fa-2x"></i></a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $entry->gateway_response }}
                                                        </td>
                                                        <td>
                                                            @if($entry->gateway_status == 1)
                                                                Pending
                                                            @elseif($entry->gateway_status == 2)
                                                                Failed
                                                            @else
                                                                Success
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $entry->gateway_transaction }}
                                                        </td>

                                                    @endforeach
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" >
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium mb-2">Completed Order</p>
                                                        <h4 class="mb-0">{{$complete_order}}</h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                                            <span class="avatar-title">
                                                                <i class="bx bx-check-circle font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid">
                                            <a href="#totalTopup">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <p class="text-muted fw-medium mb-2">Total TopUp</p>
                                                            <h4 class="mb-0">{{number_format($totalTopUp)}} ({{ count($topUps) }})</h4>
                                                        </div>

                                                        <div class="flex-shrink-0 align-self-center">
                                                            <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                                                <span class="avatar-title">
                                                                    <i class="bx bx-package font-size-24"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid">
                                            <a href="#totalWithdraw">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <p class="text-muted fw-medium mb-2">Total Withdraw</p>
                                                            <h4 class="mb-0">{{$totalWithdraw}} ({{ count($withdraws) }})</h4>
                                                        </div>

                                                        <div class="flex-shrink-0 align-self-center">
                                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                            <span class="avatar-title">
                                                                <i class="bx bx-hourglass font-size-24"></i>
                                                            </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card" id="totalTopup">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">TopUps</h4>
                                        <div class="table-responsive">
                                            <a href="#backToMenu">back to menu</a>
                                            <table class="table table-nowrap table-hover mb-0">
                                                <thead>
                                                <tr>
                                                    <th scope="col">{{ trans('cruds.transactionPointPurchase.fields.id') }}</th>
                                                    <th scope="col">{{ trans('cruds.transactionPointPurchase.fields.transaction') }}</th>
                                                    <th scope="col">{{ trans('cruds.transactionPointPurchase.fields.point') }}</th>
                                                    <th scope="col">{{ trans('cruds.transactionPointPurchase.fields.payment_method') }}</th>
                                                    <th scope="col">{{ trans('cruds.transactionPointPurchase.fields.status') }}</th>
                                                    <th scope="col">{{ trans('cruds.transactionPointPurchase.fields.created_at') }}</th>
                                                </tr>
                                                </thead>
                                                @foreach ($topUps as $topUp)
                                                    <tr>
                                                        <th scope="row">{{$topUp->id}}</th>
                                                        <td>{{$topUp->transaction}}</td>
                                                        <td>{{number_format($topUp->point)}}</td>
                                                        <td>{{ ($topUp->payment_method != null) ? $topUp->payment_method->name: 'Upload Receipt'  }}</td>
                                                        <td>{{ \App\Models\TransactionPointPurchase::STATUS_SELECT[$topUp->status] }}</td>
                                                        <td>{{$topUp->created_at}}</td>
                                                        {{--                                                        <td>{{$enquiry->status}}--}}
                                                        {{-- @if ($enquiry->status == 0)
                                                            <td>Open</td>
                                                        @else
                                                            <td>Close</td>
                                                        @endif                                                     --}}
                                                    </tr>
                                                @endforeach
                                            </table>
                                            <a href="#backToMenu">back to menu</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card" id="totalWithdraw">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Withdraw</h4>
                                        <div class="table-responsive">
                                            <a href="#backToMenu">back to menu</a>
                                            <table class="table table-nowrap table-hover mb-0">
                                                <thead>
                                                <tr>
                                                    <th scope="col">{{ trans('cruds.transactionPointPurchase.fields.id') }}</th>
                                                    <th scope="col">{{ trans('cruds.transactionPointWithdraw.fields.transaction') }}</th>
                                                    <th scope="col">{{ trans('cruds.transactionPointWithdraw.fields.amount') }}</th>
                                                    <th scope="col">{{ trans('cruds.transactionPointWithdraw.fields.status') }}</th>
                                                    <th scope="col">{{ trans('cruds.transactionPointWithdraw.fields.admin') }}</th>
                                                    <th scope="col">{{ trans('cruds.transactionPointWithdraw.fields.created_at') }}</th>
                                                </tr>
                                                </thead>
                                                @foreach ($withdraws as $withdraw)
                                                    <tr>
                                                        <th scope="row">{{$withdraw->id}}</th>
                                                        <td>{{$withdraw->transaction}}</td>
                                                        <td>{{number_format($withdraw->amount)}}</td>
                                                        <td>{{ \App\Models\TransactionPointWithdraw::STATUS_SELECT[$withdraw->status] }}</td>
                                                        <td>{{ ($withdraw->admin != null) ? $topUp->admin->name: 'no admin'  }}</td>
                                                        <td>{{$withdraw->created_at}}</td>
                                                        {{--                                                        <td>{{$enquiry->status}}--}}
                                                        {{-- @if ($enquiry->status == 0)
                                                            <td>Open</td>
                                                        @else
                                                            <td>Close</td>
                                                        @endif                                                     --}}
                                                    </tr>
                                                @endforeach
                                            </table>
                                            <a href="#backToMenu">back to menu</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">{{ trans('cruds.order.title') }}</h4>
                                        <div class="table-responsive">
                                            <table class="table table-nowrap table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">{{ trans('cruds.order.fields.id') }}</th>
                                                        <th scope="col">{{ trans('cruds.order.fields.order_number') }}</th>
                                                        <th scope="col">{{ trans('cruds.order.fields.amount') }}</th>
                                                        <th scope="col">{{ trans('cruds.order.fields.status') }}</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($order as $order)
                                                    <tr>
                                                        <th scope="row">{{$order->id}}</th>
                                                        <td>{{$order->order_number}}</td>
                                                        <td>{{$order->amount}}</td>
                                                        <td>{{$order->status}}</td>
{{--                                                        <td>{{$enquiry->status}}--}}
                                                        {{-- @if ($enquiry->status == 0)
                                                            <td>Open</td>
                                                        @else
                                                            <td>Close</td>
                                                        @endif                                                     --}}
                                                    </tr>
                                                    @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4"> {{ trans('cruds.enquiry.title') }}</h4>
                                        <div class="table-responsive">
                                            <table class="table table-nowrap table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">{{ trans('cruds.enquiry.fields.id') }}</th>
                                                        <th scope="col">{{ trans('cruds.enquiry.fields.message') }}</th>
                                                        <th scope="col">{{ trans('cruds.enquiry.fields.created_at') }}</th>
                                                        <th scope="col">{{ trans('cruds.enquiry.fields.status') }}</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($enquiry as $enquiry)
                                                    <tr>
                                                        <th scope="row">{{$enquiry->id}}</th>
                                                        <td>{{$enquiry->message}}</td>
                                                        <td>{{$enquiry->created_at}}</td>
                                                        {{-- <td>{{$enquiry->status}} --}}
                                                        @if ($enquiry->status == 0)
                                                            <td>Open</td>
                                                        @else
                                                            <td>Close</td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

{{--                    ic photo modal--}}
                    <div id="icModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                        <form method="POST" action="{{ route("admin.users.to-account-verify") }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">{{ trans('cruds.user.fields.ic_photo') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if($user->ic_photo)

                                        <img src="{{ $user->ic_photo->getUrl('') }}" style="width: 100%;height: auto;">

                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">{{ trans('global.close') }}</button>
                                    @if($user->account_verify == 1 || $user->account_verify == null)
                                        @can('user_account_verify')
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">{{ trans('global.verify') }}</button>
                                        @endcan
                                    @endif
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                        </form>
                    </div>

{{--                    ssm photo modal--}}
                    <div id="ssmModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                        <form method="POST" action="{{ route("admin.users.to-ssm-verify") }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel">{{ trans('cruds.user.fields.ssm_photo') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if($user->ssm_photo)

                                            <img src="{{ $user->ssm_photo->getUrl('') }}" style="width: 100%;height: auto;">

                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">{{ trans('global.close') }}</button>
                                        @if($user->ssm_verify == 1 || $user->ssm_verify == null)
                                            @can('user_ssm_verify')
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">{{ trans('global.verify') }}</button>
                                            @endcan
                                        @endif
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </form>
                    </div>

{{--                    first payment modal--}}
                    <div id="paymentModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                        <form method="POST" action="{{ route("admin.users.to-first-payment") }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel">{{ trans('cruds.user.fields.first_payment_receipt_photo') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if($user->first_payment_receipt_photo)

                                            <img src="{{ $user->first_payment_receipt_photo->getUrl('') }}" style="width: 100%;height: auto;">

                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">{{ trans('global.close') }}</button>
                                        @if($user->first_payment == 1 || $user->first_payment == null)
                                            @can('user_first_payment_verify')
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">{{ trans('global.verify') }}</button>
                                            @endcan
                                        @endif
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </form>
                    </div>

                    <div id="shopModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                        <form method="POST" action="{{ route("admin.users.to-shop-verify") }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel">{{ trans('cruds.user.fields.shop_photo') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if($user->shop_photo)

                                            <img src="{{ $user->shop_photo->getUrl('') }}" style="width: 100%;height: auto;">

                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">{{ trans('global.close') }}</button>
                                        @if($user->shop_verify == 1 || $user->shop_verify == null)
                                            @can('user_shop_verify')
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">{{ trans('global.verify') }}</button>
                                            @endcan
                                        @endif
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </form>
                    </div>

{{--                    agreement modal--}}
                    <div id="agreementModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="agreementModalLabel">{{ trans('cruds.userAgreement.title') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="agreementModalContent">some content</div>
                                    <div class="row" style="text-align: left;">
                                        <div class="col-6">
                                            <span>{{ trans('cruds.userAgreementLog.fields.signature_name')}}:</span>
                                            <strong><span id="agreementModalSignatureName">{{ trans('cruds.userAgreementLog.fields.signature_name')}}:</span></strong>
                                        </div>
                                        <div class="col-6">
                                            <span>{{ trans('cruds.userAgreementLog.fields.signature_ic')}}:</span>
                                            <strong><span id="agreementModalSignatureIc">{{ trans('cruds.userAgreementLog.fields.signature_ic')}}:</span></strong>
                                        </div>
                                        <div class="col-6">
                                            <span>{{ trans('cruds.userAgreementLog.fields.signature_at')}}:</span>
                                            <strong><span id="agreementModalSignatureAt">{{ trans('cruds.userAgreementLog.fields.signature_at')}}:</span></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">{{ trans('global.close') }}</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>

                    <div id="paymentEntryModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">

                            @csrf

                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel">Deposit and Joining Fee payment receipt</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
{{--                                        @if($user->first_payment_receipt_photo)--}}

                                            <img id="paymentImage" src="" style="width: 100%;height: auto;">

{{--                                        @endif--}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">{{ trans('global.close') }}</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                    </div>

            <div class="form-group">
                @if(Route::is('admin.users.merchants.show'))
                <a class="btn btn-secondary" href="{{ route('admin.users.merchants') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                @elseif(Route::is('admin.users.agents.show'))
                <a class="btn btn-secondary" href="{{ route('admin.users.agents') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                @elseif(Route::is('admin.users.vips.show'))
                <a class="btn btn-secondary" href="{{ route('admin.users.vips') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                @else
                <a class="btn btn-secondary" href="{{ route('admin.users.merchants') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                @endif
                {{-- <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a> --}}
            </div>
        </div>
    </div>




@endsection

@section('scripts')
                <script>
                    $(document).on("click", ".showAgreementDialog", function () {
                        var title = $(this).data('title');
                        var content = $(this).data('content');
                        var signature_name = $(this).data('signature-name');
                        var signature_ic = $(this).data('signature-ic');
                        var signature_at = $(this).data('signature-at');
                        console.log(title);
                        $("#agreementModalLabel").text( title );
                        $("#agreementModalContent").empty().append(content);
                        $("#agreementModalSignatureName").text(signature_name);
                        $("#agreementModalSignatureIc").text(signature_ic);
                        $("#agreementModalSignatureAt").text(signature_at);
                        // As pointed out in comments,
                        // it is unnecessary to have to manually call the modal.
                        // $('#addBookDialog').modal('show');
                    });
                </script>

                <script>
                    $(document).on("click", ".showPaymentEntryDialog", function () {
                        var image = $(this).data('image');
                        console.log(image);
                        $("#paymentImage").attr('src', image);
                        // As pointed out in comments,
                        // it is unnecessary to have to manually call the modal.
                        // $('#addBookDialog').modal('show');
                    });
                </script>
    @endsection

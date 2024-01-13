@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-1"></div>
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-3 col-md-3">
                            <h4 class="card-title mb-3">{{ trans('global.edit') }} {{ trans('cruds.user.fields.address_book') }}</h4>  
                        </div>
                        <div class="col-3 col-md-3 offset-md-6 text-right">
                            <a class="font-weight-500 btn btn-success text-uppercase text-white"
                               style="padding: 3px 10px;min-width: 90px"
                               href="{{ route('admin.users.address-book.create', ['user' => $user->id]) }}">
                                {{ __('user-portal.add_address') }}
                            </a>
                        </div>
                    </div>
                    <hr>              
                    @foreach ($user->address_book as $address_book)
                    <div class="col-12">
                        <div class="row align-items-center">
                            <div class="col-6 col-md-3">
                                <div class="line-height-16px">
                                <span class="font-weight-700">{{ $address_book->name }}</span>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 sm-margin-10px-top" style="padding-top: 0px">
                                <div class="line-height-16px">
                                    <span class="font-weight-300 text-uppercase">{{ $address_book->phone }}</span>
                                </div>

                            </div>
                            <div class="col-12 col-md-3 sm-margin-10px-top" style="padding-top: 0px">
                                <div class="line-height-16px">
                                    <span class="font-weight-300 text-uppercase">{{ $address_book->address_1 }}, <br>{{ $address_book->state->name }} - {{ $address_book->city }} - {{ $address_book->postcode }}</span>
                                </div>

                            </div>
                            <div class="col-3 col-md-3 text-right d-none d-md-block">
                                <div class="text-right align-items-start">
                                    <a class="font-weight-500 btn btn-shadow btn btn-info text-uppercase text-white mb-1"
                                       style="padding: 3px 10px;min-width: 90px"
                                       href="{{ route('admin.users.address-book.edit', ['id' => $address_book->id]) }}">
                                        {{__('user-portal.edit_address')}}
                                    </a>
                                    @if($address_book->set_default == 2)
                                        <form method="post" action="{{ route('admin.users.address-book.set-default-address', ['id' => $address_book->id]) }}">
                                            @csrf
                                            <button class="font-weight-500 btn btn-shadow btn btn-secondary text-uppercase text-white"
                                               style="padding: 3px 10px;min-width: 90px">
                                                {{__('user-portal.set_as_default')}}
                                            </button>
                                        </form>
                                    @else
                                        <br>
                                        {{ __('user-portal.default_address') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
@endsection

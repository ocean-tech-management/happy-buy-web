@extends('landing.app')

@section('css')

@endsection

@section('content')
    @include('user.user-header')
    <!-- start section -->
    <livewire:cart/>
    <!-- end section -->
@endsection

@section('js')

@endsection

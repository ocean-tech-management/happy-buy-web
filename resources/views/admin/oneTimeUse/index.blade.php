@extends('layouts.admin')
@section('content')

<h2>This page only for admin or developer user.</h2>

<div class="card">
    <div class="card-body">
        <h4>One Time Use - Update Sign Required</h4>
        <form method="POST" action="{{ route("admin.one-time-use.update-sign-required") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <button class="btn btn-danger" type="submit" onclick="return confirm('Are You Sure?');">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4>One Time Use - Update B2B Sign Required</h4>
        <form method="POST" action="{{ route("admin.one-time-use.update-b2b-sign-required") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <button class="btn btn-danger" type="submit" onclick="return confirm('Are You Sure?');">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4>One Time Use - Give Second Upline Bonus (User ID 5)</h4>
        <form method="POST" action="{{ route("admin.one-time-use.give-bonus2-bonus") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <button class="btn btn-danger" type="submit" onclick="return confirm('Are You Sure?');">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4>One Time Use - Give User Upgrade First Upline Bonus Only (User ID 6) and Second Upline (User ID 4)</h4>
        <form method="POST" action="{{ route("admin.one-time-use.give-user-upgrade-first-upline-bonus") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <button class="btn btn-danger" type="submit" onclick="return confirm('Are You Sure?');">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4>Store User Upline Preserve Log</h4>
        <form method="POST" action="{{ route("admin.one-time-use.store-user-upline-preserve-log") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <button class="btn btn-danger" type="submit" onclick="return confirm('Are You Sure?');">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
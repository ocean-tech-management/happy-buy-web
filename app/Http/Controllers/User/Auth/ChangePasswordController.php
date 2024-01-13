<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        return view('user.auth.passwords.edit');
    }

    public function update(Request $request)
    {

        if (Hash::check($request->current_password, Auth::user()->password)) {
            $validate = Validator::make($request->all(), [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $validate->validate();

            Auth::user()->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('user.password.edit')->with('message', __('global.change_password_success'));

        } else {
            return redirect()->route('user.password.edit')->withErrors(__('your_password_is_incorrect'));
        }


    }
}

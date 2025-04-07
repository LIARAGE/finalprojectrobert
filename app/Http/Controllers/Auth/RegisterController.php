<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3', 'max:40'],
            'email' => ['required', 'email', 'regex:/@gmail\.com$/', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'max:12', 'confirmed'],
            'phone' => ['required', 'string', 'regex:/^08[0-9]+$/'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'user', // default user role
        ]);

        return redirect()->route('login')->with('success', 'Register berhasil! Silakan login.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|unique:users',
            'password' => 'required|min:4|max:255',
            'address' => 'required',
            'gender' => 'required',
            ''
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 'cust';

        User::create($validatedData);

        toast('Daftar berhasil! Silakan login', 'success');

        return redirect('/login');
    }

    public function authenticate()
    {
        $credentials = request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();

            toast('Berhasil login!', 'success');

            if (Gate::allows('cust')) {
                return redirect()->intended('/dashboard/rentals');
            }
            return redirect()->intended('/dashboard');
        }

        toast('Login gagal!', 'error');
        return back();
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        toast('Berhasil Logout!', 'success');
        return redirect('/');
    }
}

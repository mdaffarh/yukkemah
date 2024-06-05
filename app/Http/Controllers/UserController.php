<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.users.index', [
            'users' => User::where('role', '!=', 'admin')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'username' => 'required|unique:users',
                'password' => 'required',
                'name' => 'required',
                'gender' => 'required',
                'email' => 'required',
                'address' => 'required'
            ]);
        } catch (ValidationException $e) {
            toast('Data gagal ditambahkan', 'error');
            return back()
                ->withInput()
                ->withErrors($e->validator)
                ->with('modal_id', 'formAdd');
        }

        User::create($validatedData);

        toast('Data berhasil ditambahkan', 'success');
        return redirect('/dashboard/users');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $rules = [
                'password' => 'required',
                'name' => 'required',
                'gender' => 'required',
                'email' => 'required',
                'address' => 'required'
            ];

            if ($request->username != $user->username) {
                $rules['username'] = 'required|unique:users';
            }

            $validatedData = $request->validate($rules);
        } catch (ValidationException $e) {
            toast('Data gagal ditambahkan', 'error');
            return back()
                ->withInput()
                ->withErrors($e->validator)
                ->with('modal_id', 'formAdd');
        }

        $user->update($validatedData);

        toast('Data berhasil diedit', 'success');
        return redirect('/dashboard/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
        } catch (\Throwable $th) {
            toast('Data gagal dihapus', 'error');
            return back();
        }

        toast('Data berhasil dihapus', 'success');
        return redirect('/dashboard/users');
    }
}

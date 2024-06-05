<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.brands.index', [
            'brands' => Brand::all()
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
                'name' => 'required'
            ]);
        } catch (ValidationException $e) {
            toast('Data gagal ditambahkan', 'error');
            return back()
                ->withInput()
                ->withErrors($e->validator)
                ->with('modal_id', 'formAdd');
        }

        Brand::create($validatedData);

        toast('Data berhasil ditambahkan', 'success');
        return redirect('/dashboard/brands');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required'
            ]);
        } catch (ValidationException $e) {
            toast('Data gagal ditambahkan', 'error');
            return back()
                ->withInput()
                ->withErrors($e->validator)
                ->with('modal_id', 'formAdd');
        }

        $brand->update($validatedData);

        toast('Data berhasil diedit', 'success');
        return redirect('/dashboard/brands');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        try {
            $brand->delete();
        } catch (\Throwable $th) {
            toast('Data gagal dihapus', 'error');
            return back();
        }

        if ($brand->image) {
            Storage::delete($brand->image);
        }

        toast('Data berhasil dihapus', 'success');
        return redirect('/dashboard/brands');
    }
}

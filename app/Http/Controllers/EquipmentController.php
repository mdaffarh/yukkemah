<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.equipments.index', [
            'equipments' => Equipment::with('category', 'brand')->get(), // with = eager load
            'categories' => Category::all(),
            'brands' => Brand::all(),
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
                'name' => 'required',
                'price_per_day' => 'required',
                'description' => 'required',
                'image' => 'image|file',
                'stock' => 'required',
                'category_id' => 'required',
                'brand_id' => 'required',
            ]);
        } catch (ValidationException $e) {
            toast('Data gagal ditambahkan', 'error');
            return back()
                ->withInput()
                ->withErrors($e->validator)
                ->with('modal_id', 'formAdd');
        }

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('images');
        }

        Equipment::create($validatedData);

        toast('Data berhasil ditambahkan', 'success');
        return redirect('/dashboard/equipments');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipment $equipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipment $equipment)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'price_per_day' => 'required',
                'description' => 'required',
                'image' => 'image|file',
                'stock' => 'required',
                'category_id' => 'required',
                'brand_id' => 'required',
            ]);
        } catch (ValidationException $e) {
            toast('Data gagal ditambahkan', 'error');
            return back()
                ->withInput()
                ->withErrors($e->validator)
                ->with('modal_id', 'formAdd');
        }

        if ($request->file('image')) {
            if ($equipment->image) {
                Storage::delete($equipment->image);
            }
            $validatedData['image'] = $request->file('image')->store('images');
        }

        $equipment->update($validatedData);

        toast('Data berhasil diedit', 'success');
        return redirect('/dashboard/equipments');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        try {
            $equipment->delete();
        } catch (\Throwable $th) {
            toast('Data gagal dihapus', 'error');
            return back();
        }

        if ($equipment->image) {
            Storage::delete($equipment->image);
        }

        toast('Data berhasil dihapus', 'success');
        return redirect('/dashboard/equipments');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\RentalItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.rentals.index', [
            'rentals' => Rental::with('user', 'items')->where('status', '!=', 'Pesanan Dibatalkan')->where('status', '!=', 'Penyewaan Selesai')->orderBy('created_at', 'DESC')->get(),
            'users' => User::where('role', '!=', 'admin')->get(),
            'equipments' => Equipment::where('stock', '>', '0')->orderBy('name')->get()
        ]);
    }

    public function rentalLog()
    {
        return view('dashboard.rentals.log', [
            'rentals' => Rental::with('user')->orderBy('created_at', 'DESC')->get()
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
                'equipment_id' => 'required',
                'quantity' => 'required',
                'start_date' => 'required|after_or_equal:today',
                'end_date' => 'required|after:start_date'
            ]);
        } catch (ValidationException $e) {
            toast('Data gagal ditambahkan', 'error');
            return back()
                ->withInput()
                ->withErrors($e->validator)
                ->with('modal_id', 'formAdd');
        }

        // menghitung total
        $total = 0;
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $duration = $startDate->diffInDays($endDate);

        foreach ($request->equipment_id as $index => $item) {
            $equipment = Equipment::find($item);

            if ($request->quantity[$index] > $equipment->stock) {
                return back()
                    ->withInput()
                    ->withErrors(['error' => 'Stok tidak mencukupi'])
                    ->with('modal_id', 'formAdd');
            }

            if ($equipment) {
                // tambahkan total
                $total += ($equipment->price_per_day * $request->quantity[$index] * $duration);
            }
        }

        if ($request->user_id) {
            $validatedData['user_id'] = $request->user_id;
        } else {
            $validatedData['name'] = $request->name;
        }

        $validatedData['total'] = $total;
        $validatedData['status'] = "Menunggu Pembayaran";

        $dm = date('dm');
        $yis = date('yis');
        $validatedData['transaction_number'] = $dm . "/RENT/" . $yis;

        // create
        $rental = Rental::create($validatedData);

        // // masukan ke rental item
        foreach ($request->equipment_id as $index => $item) {
            RentalItem::create([
                'rental_id' => $rental->id,
                'equipment_id' => $item,
                'quantity' => $request->quantity[$index]
            ]);
        }

        toast('Rental berhasil ditambahkan', 'success');
        return redirect('/dashboard/rentals/confirmation/' . $rental->id);
    }

    public function showConfirmation($id)
    {
        $rental = Rental::find($id);
        return view('dashboard.rentals.confirmation', [
            'rental' => $rental
        ]);
    }

    public function cancel($id)
    {
        $rental = Rental::find($id);
        $rental->status = "Pesanan Dibatalkan";
        $rental->save();

        toast('Rental berhasil dibatalkan', 'success');
        return redirect('/dashboard/rentals');
    }

    public function handover($id)
    {
        $rental = Rental::find($id);
        $rental->status = "Dalam Penyewaan";
        $rental->save();

        toast('Penyerahan Barang Berhasil', 'success');
        return redirect('/dashboard/rentals');
    }

    public function return($id)
    {
        $rental = Rental::find($id);
        foreach ($rental->items as $item) {
            $equipment = $item->equipment;
            $equipment->stock += $item->quantity;
            $equipment->on_rent -= $item->quantity;
            $equipment->save();
        }

        $rental->status = "Penyewaan Selesai";
        $rental->save();

        toast('Rental berhasil diselesaikan', 'success');
        return redirect('/dashboard/rentals');
    }

    public function confirm($id)
    {
        $rental = Rental::find($id);
        foreach ($rental->items as $item) {
            $equipment = $item->equipment;
            $equipment->stock -= $item->quantity;
            $equipment->on_rent += $item->quantity;
            $equipment->save();
        }

        Payment::create([
            'rental_id' => $id,
            'total' => $rental->total,
            'payment_date' => Carbon::now()
        ]);

        $rental->status = "Pembayaran Dikonfirmasi";
        $rental->save();

        toast('Rental berhasil dikonfirmasi', 'success');
        return redirect('/dashboard/rentals');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rental $rental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental $rental)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rental $rental)
    {
        try {
            $validatedData = $request->validate([
                'equipment_id' => 'required',
                'quantity' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'user_id' => 'nullable',
                'name' => 'nullable|string',
            ]);


            // Calculate total based on equipment prices and duration
            $total = 0;
            $startDate = Carbon::parse($validatedData['start_date']);
            $endDate = Carbon::parse($validatedData['end_date']);
            $duration = $startDate->diffInDays($endDate);

            foreach ($validatedData['equipment_id'] as $index => $equipmentId) {
                $equipment = Equipment::find($equipmentId);

                if ($request->quantity[$index] > $equipment->stock) {
                    return back()
                        ->withInput()
                        ->withErrors(['error' => 'Stok tidak mencukupi'])
                        ->with('modal_id', 'edit' . $rental->id);
                }
                if ($equipment) {
                    $total += ($equipment->price_per_day * $validatedData['quantity'][$index] * $duration);
                }
            }

            // Update rental details
            $rental->start_date = $validatedData['start_date'];
            $rental->end_date = $validatedData['end_date'];
            $rental->total = $total;
            $rental->status = "Menunggu Pembayaran";

            if ($request->filled('user_id')) {
                $rental->user_id = $validatedData['user_id'];
                $rental->name = null;
            } else {
                $rental->user_id = null;
                $rental->name = $validatedData['name'];
            }

            $rental->save();

            // Delete existing rental items
            $rental->items()->delete();

            // Create new rental items
            foreach ($validatedData['equipment_id'] as $index => $equipmentId) {
                RentalItem::create([
                    'rental_id' => $rental->id,
                    'equipment_id' => $equipmentId,
                    'quantity' => $validatedData['quantity'][$index],
                ]);
            }

            toast('Rental berhasil diedit', 'success');
            return back();
        } catch (ValidationException $e) {
            toast('Data gagal ditambahkan', 'error');
            return back()
                ->withInput()
                ->withErrors($e->validator)
                ->with('modal_id', 'formAdd');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        //
    }
}

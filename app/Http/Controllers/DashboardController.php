<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // admin
        $monthly = Payment::whereBetween('payment_date', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->sum('total');

        $annual = Payment::whereBetween('payment_date', [
            Carbon::now()->startOfYear(),
            Carbon::now()->endOfYear()
        ])->sum('total');

        $waiting = Rental::where('status', 'Menunggu Pembayaran')->count();

        $stockRatio = DB::select('select (SUM(on_rent) / SUM(stock + on_rent)) * 100 as ratio from equipments');

        $stockRatio = round($stockRatio[0]->ratio);

        // dd($stockRatio);
        return view('dashboard.index', [
            'monthly' => $monthly,
            'annual' => $annual,
            'waiting' => $waiting,
            'stockRatio' => $stockRatio
        ]);
    }
}

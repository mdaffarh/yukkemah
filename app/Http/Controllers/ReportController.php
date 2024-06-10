<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('dashboard.reports.index');
    }

    public function filter(Request $request)
    {
        $start = $request->start_date ? $request->start_date : null;
        $end = $request->end_date ? $request->end_date : null;

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L']);

        if ($request->report_type == 'Keuangan') {
            $data = Payment::with('rental')->get();

            if (($start != NULL) && ($end == NULL)) {
                $data = Payment::with('rental')->where('payment_date', '>=', $start)->get();
            } else if (($start == NULL) && ($end != NULL)) {
                $data = Payment::with('rental')->where('payment_date', '<=', $end)->get();
            } else if (($start != NULL) && ($end != NULL)) {
                $data = Payment::with('rental')->whereBetween('payment_date', [$start, $end])->get();
            }

            $mpdf->WriteHTML(view('dashboard.reports.main', [
                'data' => $data,
                'title' => 'Report Keuangan',
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'type' => 'Keuangan'
            ]));
            if ($request->download == 1) {
                $mpdf->Output('Report Keuangan-' . Carbon::now() . '.pdf', 'D');
            } else {
                $mpdf->Output();
            }
        } else if ($request->report_type == 'Top10') {
            $data = Rental::with('user')->orderBy('total', 'DESC')->take(10)->get();

            if (($start != NULL) && ($end == NULL)) {
                $data = Rental::with('user')
                    ->where('start_date', '>=', $start)
                    ->orderBy('total', 'DESC')
                    ->take(10)
                    ->get();
            } else if (($start == NULL) && ($end != NULL)) {
                $data = Rental::with('user')
                    ->where('start_date', '<=', $end)
                    ->orderBy('total', 'DESC')
                    ->take(10)
                    ->get();
            } else if (($start != NULL) && ($end != NULL)) {
                $data = Rental::with('user')
                    ->whereBetween('start_date', [$start, $end])
                    ->orderBy('total', 'DESC')
                    ->take(10)
                    ->get();
            }


            $mpdf->WriteHTML(view('dashboard.reports.main', [
                'data' => $data,
                'title' => 'Report Top 10 Transaksi',
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'type' => 'Top10'
            ]));
            if ($request->download == 1) {
                $mpdf->Output('Report Top 10 Transaksi-' . Carbon::now() . '.pdf', 'D');
            } else {
                $mpdf->Output();
            }
        } else if ($request->report_type == 'Pelanggan') {
            $data = Rental::where('user_id', '!=', NULL)->with('user')->select('user_id', DB::raw('SUM(total) as total, COUNT(*) as times'))
                ->groupBy('user_id')
                ->orderBy('total', 'DESC')
                ->get();

            if (($start != NULL) && ($end == NULL)) {
                $data = Rental::where('user_id', '!=', NULL)->with('user')->select('user_id', DB::raw('SUM(total) as total, COUNT(*) as times'))
                    ->where('start_date', '>=', $start)
                    ->groupBy('user_id')
                    ->orderBy('total', 'DESC')
                    ->get();
            } else if (($start == NULL) && ($end != NULL)) {
                $data = Rental::where('user_id', '!=', NULL)->with('user')->select('user_id', DB::raw('SUM(total) as total, COUNT(*) as times'))
                    ->where('start_date', '<=', $end)
                    ->groupBy('user_id')
                    ->orderBy('total', 'DESC')
                    ->get();
            } else if (($start != NULL) && ($end != NULL)) {
                $data = Rental::where('user_id', '!=', NULL)->with('user')->select('user_id', DB::raw('SUM(total) as total, COUNT(*) as times'))
                    ->whereBetween('start_date', [$start, $end])
                    ->groupBy('user_id')
                    ->orderBy('total', 'DESC')
                    ->get();
            }

            $mpdf->WriteHTML(view('dashboard.reports.main', [
                'data' => $data,
                'title' => 'Report Pelanggan',
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'type' => 'Pelanggan'
            ]));
            if ($request->download == 1) {
                $mpdf->Output('Report Pelanggan-' . Carbon::now() . '.pdf', 'D');
            } else {
                $mpdf->Output();
            }
        }
    }
}

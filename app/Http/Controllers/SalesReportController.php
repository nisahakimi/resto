<?php

namespace App\Http\Controllers;

use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }
 /**
     * Generate the sales report for the selected month.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request)
    {
        $request->validate([
            'month' => 'required|date_format:Y-m',
        ]);

        $month = Carbon::createFromFormat('Y-m', $request->input('month'));


        $orders = Order::whereMonth('tanggal', $month->month)
                        ->whereYear('tanggal', $month->year)
                        ->with('meja')
                        ->get();

        $sales = $orders->sum('total_harga');

        return view('reports.result', compact('sales', 'month', 'orders'));
    }

}

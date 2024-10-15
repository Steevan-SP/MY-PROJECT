<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Carbon\Carbon;

class CashflowController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy('created_at', 'desc')->get();
        $todayEarnings = $this->getTodayEarnings();
        return view('admin.cashflow.index', compact('payments', 'todayEarnings'));
    }

    private function getTodayEarnings()
    {
        return Payment::whereDate('created_at', Carbon::today())->sum('total_amount');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');

        if (!empty($search)) {
            $payments = Payment::where('payment_mode', 'like', '%' . $search . '%')->get();
        } else {
            $payments = Payment::all();
        }
        $todayEarnings = $this->getTodayEarnings();

        return view('admin.cashflow.index', compact('payments', 'todayEarnings'));
    }
}

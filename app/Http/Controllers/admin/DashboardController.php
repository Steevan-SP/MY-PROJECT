<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\LocalGuest;
use App\Models\ForeignGuest;
use App\Models\ComplementaryGuest;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $dayBeforeYesterday = Carbon::yesterday()->subDays(1); 

        // Fetch today's wallet balance
        $paymentTodayTotal = Payment::whereDate('created_at', $today)->sum('total_amount');

        // Fetch yesterday's wallet balance
        $paymentYesterdayTotal = Payment::whereDate('created_at', $yesterday)->sum('total_amount');

        // Calculate the percentage change from yesterday to today
        $percentageChange = $paymentYesterdayTotal != 0 ? (($paymentTodayTotal - $paymentYesterdayTotal) / $paymentYesterdayTotal) * 100 : 0;

        // Other data retrieval remains the same
        $guestsToday = Guest::whereDate('created_at', $today)->count();
        $guestsYesterday = Guest::whereDate('created_at', $yesterday)->count();
            
        // day before yesterday's wallet balance
        $paymentDayBeforeYesterdayTotal = Payment::whereDate('created_at', $dayBeforeYesterday)->sum('total_amount');


        // LocalGuest Count retrieval 
        $localGuestsYesterday = LocalGuest::whereDate('created_at', $yesterday)->count();

        // ForeignGuest Count retrieval 
        $foreignGuestsYesterday =ForeignGuest::whereDate('created_at', $yesterday)->count();

        // ComplementaryGuest Count retrieval 
        $complementaryGuestsYesterday =ComplementaryGuest::whereDate('created_at', $yesterday)->count();

        // Calculate last week's dates
        $lastWeekStart = Carbon::now()->startOfWeek()->subWeek();
        $lastWeekEnd = Carbon::now()->startOfWeek()->subDay();

        // Fetch last week's guest arrivals and billing data
        $lastWeekArrivalData = Guest::whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->orderBy('created_at')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('l');
            });

        $lastWeekBillingData = Payment::whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->orderBy('created_at')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('l');
            })
            ->map(function ($grouped) {
                return $grouped->sum('total_amount');
            });

        $lastWeekLabels = [];
        $lastWeekArrivalCounts = [];
        $lastWeekBillingTotals = [];

        // Populate arrays with last week's data
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        foreach ($daysOfWeek as $day) {
            $lastWeekLabels[] = $day;
            $lastWeekArrivalCounts[] = isset($lastWeekArrivalData[$day]) ? $lastWeekArrivalData[$day]->count() : 0;
            $lastWeekBillingTotals[] = isset($lastWeekBillingData[$day]) ? $lastWeekBillingData[$day] : 0;
        }

        // Pass all necessary data to the view
        return view('admin.dashboard.index', [
            'welcomeNote' => "Welcome to your dashboard!",
            'guestsToday' => $guestsToday,
            'guestsYesterday' => $guestsYesterday,
            'paymentDayBeforeYesterdayTotal' => $paymentDayBeforeYesterdayTotal,
            'localGuestsYesterday'=>$localGuestsYesterday,
            'foreignGuestsYesterday'=>$foreignGuestsYesterday,
            'complementaryGuestsYesterday'=>$complementaryGuestsYesterday,
            'paymentTodayTotal' => $paymentTodayTotal,
            'paymentYesterdayTotal' => $paymentYesterdayTotal,
            'lastWeekArrivalData' => $lastWeekArrivalCounts,
            'lastWeekBillingData' => $lastWeekBillingTotals,
            'lastWeekLabels' => $lastWeekLabels,
            'percentageChange' => $percentageChange,
        ]);
    }

    public function profile()
    {
        return view('admin.dashboard.profile');
    }
}

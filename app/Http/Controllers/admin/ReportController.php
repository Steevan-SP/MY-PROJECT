<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Guest;
use App\Models\LocalGuest;
use App\Models\Stock;
use Carbon\Carbon;
use PDF; 

class ReportController extends Controller
{
    public function dailyTransaction(Request $request)
    {
        $date = $request->input('date', now()->format('Y-m-d'));
        $paymentMode = $request->input('payment_mode', ''); 

        
        $query = Payment::whereDate('created_at', $date);
        
        if (!empty($paymentMode)) {
            $query->where('payment_mode', $paymentMode);
        }
        
        $payments = $query->select('id', 'payment_mode', 'total_amount')
                    ->get();

        $totalAmount = $payments->sum('total_amount');

        return view('admin.report.daily_transaction', compact('date', 'payments', 'totalAmount', 'paymentMode'));
    }

    public function generatePDF(Request $request)
    {
        $date = $request->input('date', now()->format('Y-m-d'));
        $paymentMode = $request->input('payment_mode', ''); 
        $query = Payment::whereDate('created_at', $date);
        
        if (!empty($paymentMode)) {
            $query->where('payment_mode', $paymentMode);
        }
        
        $payments = $query->select('id', 'payment_mode', 'total_amount') ->get();

        $totalAmount = $payments->sum('total_amount');
        $user = auth()->user(); 
        $pdf = PDF::loadView('admin.report.pdf', compact('date', 'payments', 'totalAmount', 'user', 'paymentMode'));


        $pdf->setOptions([
            'title' => 'Daily Transaction Report',
            'tempDir' => storage_path('app/pdf'), 
        ]);

        return $pdf->stream('daily_transaction_report.pdf');
    }
    public function guestDetails(Request $request)
    {
        // Get the selected date from the request or default to current date
        $date = $request->input('date', now()->format('Y-m-d'));

        // Query guests based on date
        $guestsQuery = Guest::query();

        if ($date) {
            $guestsQuery->whereDate('created_at', $date);
        }

        $guests = $guestsQuery->get();

        return view('admin.report.guest_details', compact('guests', 'date'));
    }
    public function guest_detailsPDF(Request $request)
    {
        $date = $request->input('date', now()->format('Y-m-d'));
        $guestType = $request->input('guest_type', ''); // Get selected guest type

        $guestsQuery = Guest::whereDate('created_at', $date);

        if (!empty($guestType)) {
            $guestsQuery->where('guest_type', $guestType);
        }

        $guests = $guestsQuery->get();

        // Load the view and pass the data to it
        $pdf = PDF::loadView('admin.report.guest_details_pdf', compact('guests', 'date', 'guestType'));

        return $pdf->stream('guest_details_report.pdf');
    }
public function Total_guest(Request $request){

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Query guests based on date range
        $guests = Guest::whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])
                        ->orderBy('created_at', 'desc')
                        ->get();

        // Pass $guests variable to the view
        return view('admin.report.total_guest', ['guests' => $guests]);
   
}
public function total_guest_PDF(Request $request)
{
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');

    // Fetch guests based on date range
    $guests = Guest::whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])
                    ->get();

    // Fetch authenticated user using Auth facade
    $user = Auth::user();

    // Generate PDF using dompdf
    $pdf = PDF::loadView('admin.report.total_guestpdf', [
        'guests' => $guests,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'user' => $user,
        'date' => Carbon::parse($start_date)->format('d/m/Y'), // Format date for display
    ]);

    $pdf->setPaper([0, 0, 1000, 1000], 'landscape');
    return $pdf->stream('total_guest_details.pdf');
}
    public function Total_Stock(){
        
            // Fetch all stock items
            $stocks = Stock::all();
    
            // Pass the data to the view
        
         return view('admin.report.total_stock', compact('stocks'));
    }
    
    public function Total_Stock_PDF()
{
    // Fetch all stock items
    $stocks = Stock::all();
    
    // Fetch the current user (or any user object)
    $user = auth()->user(); // Assuming you are using Laravel's authentication

    // Load the view and pass the data
    $pdf = Pdf::loadView('admin.report.total_stockpdf', compact('stocks', 'user'));

    $pdf->setPaper([0, 0, 1000, 1000], 'landscape');
    return $pdf->stream('stock_summary_report.pdf');
}
public function Local_Guest(){
    $localGuests = LocalGuest::with('guest')->get();

    // Pass the data to the view
    return view('admin.report.local_guest', ['localGuests' => $localGuests]);
    
}
}

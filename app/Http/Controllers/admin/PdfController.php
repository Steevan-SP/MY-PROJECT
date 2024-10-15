<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Admin;
use App\Models\Payment;

class PdfController extends Controller
{
    public function generatePdf($payment_id)
    {
        dd(1);       
        $payment = Payment::findOrFail($payment_id);
        $billings = $payment->billings;
        $user = Auth::user();
        $pdf = PDF::loadView('admin.billing.pdf', compact('user', 'payment', 'billings'));
        $pdf->setPaper([0, 0, 400, 500], 'portrait');
        return $pdf->stream('ticket.pdf');
    }
    
    
}
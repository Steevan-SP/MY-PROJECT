<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\BillingStoreRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Stock;
use App\Models\User;
use App\Models\Billing;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        $users = User::all();
        $payments = Payment::all();
        
        return view('admin.billing.index', compact('stocks', 'users', 'payments'));
    }

    public function store(Request $request)
    {
        $user = auth()->user(); 
        $user_id = auth()->id();
        
        // Validate request data
        $request->validate([
            'item' => 'required|array',
            'code' => 'required|array',
            'price' => 'required|array',
            'quantity' => 'required|array',
            'subtotal' => 'required|array',
            'total_amount' => 'required|numeric',
        ]);
        
        // Prepare billing details array
        $billing_details = [];
        foreach ($request->item as $i => $item) {
            $billing_details[] = [
                'item' => $item,
                'code' => $request->code[$i], 
                'price' => $request->price[$i],
                'quantity' => $request->quantity[$i],
                'subtotal' => $request->subtotal[$i],
            ];
        }
        
        // Validate stock availability and deduct from stock
        foreach ($billing_details as $detail) {
            $itemName = $detail['item'];
            $quantity = $detail['quantity'];
            
            
        // Retrieve the stock record
        $stock = Stock::where('item_name', $itemName)->first();
        
        // If stock exists and quantity is not null, perform deduction
        if ($stock && $stock->quantity !== null) {
            if ($stock->quantity < $quantity) {
                \Log::warning("Attempted to deduct $quantity of $itemName, but only $stock->quantity available in stock. Deduction not performed.");
                return redirect()->back()->with('error', 'Insufficient stock.');
            }
            
            // Deduct from stock
            $stock->decrement('quantity', $quantity);
        }
        }
        
        // Create new billing record
        $billing = new Billing();
        $billing->user_id = $user_id;
        $billing->billing_details = $billing_details;
        $billing->total_amount = $request->total_amount;
        $billing->save();
        
        // Retrieve the latest billing record for the user
        $billing = Billing::where('user_id', $user_id)->latest()->first();
        $billNumber = $this->generateUniqueBillNumber();
        
        // Display payment view with necessary data
        return view('admin.billing.payment', compact('user', 'billNumber', 'billing'));
    }
    
    public function paymentindex()
    {
        $user = auth()->user();
        $billNumber = $this->generateUniqueBillNumber();

        $billing = Billing::where('user_id', $user->id)->first();
    
        return view('admin.billing.payment', compact('user', 'billNumber', 'billing'));
    }
    
private function generateUniqueBillNumber()
{
    $prefix = 'BILL'; 
    $randomNumber = mt_rand(10000, 99999); 
    $dateTime = now()->format('YmdHis'); 

    
    $billNumber = $prefix . '-' . $dateTime . '-' . $randomNumber;

    return $billNumber;
}

public function paymentstore(Request $request)
{
    $user = auth()->user(); 
    $user_id = $user->id;

    $billing = Billing::where('user_id', $user_id)->latest()->first();
    
    if (!$billing) {
        return redirect()->back()->with('error', 'No billing record found.');
    }

    $billing_id = $billing->id; 

    $billNumber = $this->generateUniqueBillNumber();
    $total_amount = $request->input('total_amount');

    $payment = new Payment();
    $payment->user_id = $user_id;
    $payment->billing_id = $billing_id;
    $payment->total_amount = $total_amount;
    $payment->bill_number = $billNumber; 
    $paymentMode = $request->input('payment_mode');

    if ($paymentMode == 'card') {
        $payment->payment_mode = 'card';
        $payment->card_type = $request->input('card_type');
    } else {
        $payment->payment_mode = 'cash';
    }

   
    $payment->save();

    return redirect()->route('billing.printbill')->with('success', 'Payment processed successfully.');
}




public function printbill()
{
    $payments = Payment::orderBy('created_at', 'desc')->get();
    //dd($payments);
    return view('admin.billing.printbill', compact('payments'));
}

public function bill($payment_id){
    $payment = Payment::findOrFail($payment_id);
    $billings = $payment->billings;
    //dd($billings);
   // var_dump($billings);
    //dd($payment);
    $user = $payment->user;
    //dd($user);
    $role = $user->role;
    //dd($role);
    
    //dd($billing);

    return view('admin.billing.bill', compact('payment', 'user', 'role', 'billings'));
}
public function generatePdf($payment_id)
{
           
    $payment = Payment::findOrFail($payment_id);
    $billings = $payment->billings;
    $user = Auth::user();
    $pdf = PDF::loadView('admin.billing.pdf', compact('user', 'payment', 'billings'));
    $pdf->setPaper([0, 0, 400, 500], 'portrait');
    return $pdf->stream('ticket.pdf');
}



    
}

<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GuestStoreRequest;
use App\Models\Guest;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Role;
use App\Models\Admin;
use App\Models\Receptionist;
use App\Models\LocalGuest;
use App\Models\ForeignGuest;
use App\Models\ComplementaryGuest;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;


class GuestController extends Controller
{
    public function index()
{
    $guests = Guest::orderBy('created_at', 'desc')->get();
    $localguests = LocalGuest::all();
    $foreignguests = ForeignGuest::all();
    $complementaryguests = ComplementaryGuest::all();

    foreach ($guests as $guest) {
        $guest->invoice_number = $this->generateInvoiceNumber();
        $guest->ticket_number = $this->generateTicketNumber(); 
        $guest->save();
    }
    return view('admin.guest.index', compact('guests', 'localguests', 'foreignguests', 'complementaryguests'));
}

private function generateInvoiceNumber()
{
    $currentYear = date('Y');
    $randomNumber = mt_rand(1000, 9999);

    return 'HFW-' . $currentYear . '-' . $randomNumber;
}

private function generateTicketNumber()
{
    $currentYear = date('Y');
    $randomNumber = mt_rand(1000, 9999);

    return 'HFW-TICKET-' . $currentYear . '-' . $randomNumber;
}

    public function register()
    {
        $users = User::all();
        //dd($user);
        $tickets = Ticket::all();
        $guests = Guest::all();
        return view('admin.guest.register', compact('guests', 'users', 'tickets'));
    }

    public function store(GuestStoreRequest $request)
{
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'User is not authenticated.');
    }

    $data = $request->validated();

    // Create a new guest record
    $guest = Guest::create([
        'user_id' => $user->id,
        'title' => $data['title'],
        'guestfirstname' => $data['guestfirstname'],
        'guestlastname' => $data['guestlastname'],
        'adult_count' => $data['adult_count'],
        'kids_count' => $data['kids_count'],
        'email' => $data['email'],
        'guest_type' => $data['guest_type'],
    ]);

    // Create related guest records based on guest type
    if ($data['guest_type'] === 'local') {
        $registrationDate = now()->toDateString(); // Current date in YYYY-MM-DD format

        // Check if the combination of id_number, phone, and registration_date is unique
        $existingLocalGuest = LocalGuest::where('id_number', $data['id_number'])
            ->where('phone', $data['phone'])
            ->where('registration_date', $registrationDate)
            ->exists();

        if ($existingLocalGuest) {
            return redirect()->back()->withErrors(['error' => 'This ID number and phone number combination already exists for today.']);
        }

        LocalGuest::create([
            'guest_id' => $guest->id,
            'addressline1' => $data['addressline1'],
            'addressline2' => $data['addressline2'],
            'city' => $data['city'],
            'phone' => $data['phone'],
            'id_number' => $data['id_number'],
            'registration_date' => $registrationDate, // Set registration_date
        ]);

    } elseif ($data['guest_type'] === 'foreign') {
        $foreignGuestData = [
            'guest_id' => $guest->id,
            'country' => $data['country'],
            'passport_number' => $data['passport_number'],
            'image_path' => $data['image_path'],
            'driver_name' => $data['driver_name'] ?? null,
            'vehicle_number' => $data['vehicle_number'] ?? null,
        ];

        ForeignGuest::create($foreignGuestData);

    } else {
        ComplementaryGuest::create([
            'guest_id' => $guest->id,
            'complementary_reason' => $data['complementary_reason']
        ]);
    }

    return redirect()->route('guest.index')->with('success', 'Guest has been registered successfully!');
}

    

    public function invoice(Guest $guest)
    {
        //$guest = Guest::find($guest->id);
        //dd($guest);
        //dd($admin);
        //$user = User::where('id', $user_id['id'])->first();
        $users = User::all();
        $tickets = Ticket::all();
        //$guest = Guest::all();
    
        return view('admin.guest.invoice', compact( 'guest'));
    }
    public function paymentindex($id){
        $guest = Guest::find($id);
        return view('admin.guest.payment',compact( 'guest'));
    }
    public function paymentstore(Request $request, $id) {
        $guest = Guest::find($id);
    
        if (!$guest) {
            abort(404);
        }
    
        $ticket = $guest->user->ticket;
    
        if (!$ticket) {
            abort(404);
        }
    
        if ($guest->guest_type == 'local') {
            $total_adults_price = $guest->adult_count * $ticket->sl_price;
            $total_kids_price = $guest->kids_count * $ticket->sl_price_kids;
        } elseif ($guest->guest_type == 'foreign') {
            $total_adults_price = $guest->adult_count * $ticket->foreign_price;
            $total_kids_price = $guest->kids_count * $ticket->foreign_price_kids;
        } else {
            $total_adults_price = 0;
            $total_kids_price = 0;
        }
    
        $total_amount = $total_adults_price + $total_kids_price;
    
        $userId = auth()->id();
    
        $payment = new Payment();
        $payment->user_id = $userId;
        $payment->guest_id = $guest->id;
        $payment->total_adults_price = $total_adults_price;
        $payment->total_kids_price = $total_kids_price;
        $payment->total_amount = $total_amount;
    
        $paymentMode = $request->input('payment_mode');
        if ($paymentMode == 'card') {
            $payment->payment_mode = 'card';
            $payment->card_type = $request->input('card_type');
        } else {
            $payment->payment_mode = 'cash';
        }
    
        $payment->save();
    //dd($guest);
    $guests = Guest::orderBy('created_at', 'desc')->get();
    return view('admin.guest.print_ticket', compact('guest', 'payment', 'guests'));
        
    }
    
    public function print_ticket(){
        $payments = Payment::whereNotNull('guest_id')->get();
        $guests = Guest::orderBy('created_at', 'desc')->get();
    //dd($guests);
        return view('admin.guest.print_ticket', compact('payments', 'guests'));
    }
    public function ticket($guestId) {
        $guest = Guest::findOrFail($guestId);
        $user = User::first();
        $payments = Payment::all();
        $roles = Role::all();
        $tickets = Ticket::all();
    
        return view('admin.guest.ticket', compact('payments', 'user', 'roles', 'guest','tickets'));
    }
    
    public function ticketPdf($guestId) {
        $guest = Guest::findOrFail($guestId);
        $user = User::first();
        $payments = Payment::all();
        $roles = Role::all();
        $tickets = Ticket::all();
    
    $pdf = PDF::loadView('admin.guest.pdf',compact('payments', 'user', 'roles', 'guest','tickets'));
    $pdf->setPaper([0, 0, 400, 500], 'portrait');
    return $pdf->stream('ticket.pdf');
}


    public function search(Request $request)
    {
        $idNumber = $request->query('search');

        $guest = LocalGuest::where('id_number', $idNumber)->first();
dd(guest);
        if ($guest) {
            return response()->json([
                'success' => true,
                'addressline1' => $guest->addressline1,
                'addressline2' => $guest->addressline2,
                'city' => $guest->city,
                'phone' => $guest->phone,
                'registration_date' => $guest->registration_date,
            ]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}

    
    

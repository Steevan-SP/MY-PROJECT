<?php

namespace App\Http\Controllers\Admin;

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


class PaymentController extends Controller


{
    public function index()
    {
        $payments = Payment::all();
        $guests = Guest::all();
        $localguests = LocalGuest::all();
        $foreignguests = Foreignguest::all();
        $complementaryguests = ComplementaryGuest::all();

        return view('admin.payment.index', compact('guests','localguests','foreignguests','complementaryguests','payments'));
    }
}

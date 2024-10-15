<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\TicketUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;
use App\Models\Ticket;



class TicketController extends Controller
{
    public function index(){
        
        $tickets=Ticket::all();
        return view('admin.ticket.index',compact('tickets'));
    }

    public function edit(Ticket $ticket){
                    
        $tickets = Ticket::all();
        return view('admin.ticket.edit',compact('ticket'));
    }  
    public function update(Ticket $ticket, TicketUpdateRequest $request)
    {
        $request->validate([
            'sl_price' => 'required',
            'sl_price_kids' => 'required',
            'foreign_price' => 'required',
            'foreign_price_kids' => 'required',
        ]);
    
        $data = $request->validated();
    
        $ticket->update([
            'sl_price' => $data['sl_price'],
            'sl_price_kids' => $data['sl_price_kids'],
            'foreign_price' => $data['foreign_price'],
            'foreign_price_kids' => $data['foreign_price_kids'],
        ]);
    
        return redirect()->route('ticket.index')->with('success', 'Ticket updated successfully');
    }
    
}

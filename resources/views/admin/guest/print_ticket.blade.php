@extends('layouts.admin.master')

@section('title', 'Tickets')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">TicketWizard</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">TicketCraft</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">TicketWise</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="billing-table">
                            <thead>
                                <tr>
                                    <th>GUEST TYPE</th>
                                    <th>NAME</th>
                                    <th>TICKET NUMBER</th>
                                    <th>PAYMENT ID</th>
                                    <th>PAYMENT MODE</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($guests as $guest)
                                <tr> 
                                    <td>{{ $guest->guest_type }}</td> 
                                    <td>{{ $guest->guestfirstname }}</td> 
                                    <td>{{ $guest->ticket_number }}</td>
                                    
                                    @if ($guest->payments->isNotEmpty())
                                        @foreach ($guest->payments as $payment)
                                            <td>{{ $payment->id }}</td>
                                            <td>{{ $payment->payment_mode }}</td>
                                        @endforeach
                                    @else
                                        <td>No Payment ID</td>
                                        <td>No Payment Mode</td>
                                    @endif
                                    
                                    <td>
                                        <a href="{{ route('guest.ticket', $guest->id) }}" class="btn btn-info btn-sm">View Ticket</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

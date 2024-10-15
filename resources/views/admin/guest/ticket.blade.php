@extends('layouts.admin.master')
@section('title', 'Bill')
@section('content')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #invoice, #invoice * {
            visibility: visible;
        }
        #invoice {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
    .marking-box {
        width: 20px;
        height: 20px;
        border: 1px solid #000;
        display: inline-block;
        margin-left: 5px;
        vertical-align: middle;
    }
    .rules-list {
        font-size: 14px;
        margin-left: 15px;
        padding-left: 0;
    }
    .rules-list li {
        counter-increment: rule;
        list-style-type: none;
    }
    .rules-list li:before {
        content: counter(rule) ". ";
        font-weight: bold;
    }
    .rules-list li {
        margin-bottom: 10px;
        text-align: justify;
    }
</style>

<div class="card mt-3">
    <div class="card-body">
        <div class="row mb-2">
            <div class="mt-4 col-lg-12 text-center">
                <div class="mb-2">
                    <span style="font-family: 'Times New Roman', serif; font-size: 24px;"><strong>Hunnas</strong></span>
                    <span style="font-family: 'Cursive', cursive; font-size: 18px;"> Leisure Park</span>
                </div>

                <div class="mb-2 text-center">
                    <div>Eco Friendly Tourism Project</div>
                    <div>Managed by - Estate Workers housing Co-operative Society of Hunnasgiriya Estate</div>
                    <div>Hunnasgiriya Estate Elkaduwa</div>
                    <div>Email: sphunasgeria@gmail.com</div>
                    <div>Phone: 081 7294775</div>
                </div>
                <div class="col-lg-8 offset-lg-2">
                    <div class="mb-5">
                        <div><strong>Date and Time Prepared By:</strong> {{ now()->format('d/m/Y H:i:s') }}</div>
                        <div><strong>Subject:</strong> Entrance Ticket</div>
                        <div><strong>Ticket Number:</strong> {{ $guest->ticket_number }}</div>
                        <div>
                            <strong>Prepared By:</strong>
                            @if ($user->role)
                            @if ($user->role->name == 'Admin' && $user->admin)
                            {{ $user->admin->firstname }}
                            @elseif ($user->role->name == 'Receptionist' && $user->receptionist)
                            {{ $user->receptionist->firstname }}
                            @endif
                            @endif
                        </div>
                        <div><strong>Guest Name:</strong> {{ $guest->guestfirstname . ' ' . $guest->guestlastname }}</div>
                        <div>
                            @if ($guest->guest_type == 'local')
                            <strong>Country:</strong> Sri Lanka
                            @elseif ($guest->guest_type == 'foreign')
                            <strong>Country:</strong> {{ $guest->foreignGuest->country }}
                            @endif
                        </div>
                        <div style="text-align: center; font-size: 18px;">
                            <strong>Adult Count:</strong> {{ $guest->adult_count }}
                            @if($guest->guest_type == 'local')
                            X {{ $guest->user->ticket->sl_price }} =
                            {{ $guest->adult_count * $guest->user->ticket->sl_price }}
                            @elseif($guest->guest_type == 'foreign')
                            X {{ $guest->user->ticket->sl_price }} =
                            {{ $guest->adult_count * $guest->user->ticket->foreign_price }}
                            @else
                            <strong>Complimentary Guest</strong>
                            @endif
                            <br>
                            @if($guest->kids_count > 0)
                            <strong>Kids Count:</strong> {{ $guest->kids_count }}
                            @if($guest->guest_type == 'local')
                            X {{ $guest->user->ticket->sl_price_kids }} =
                            {{ $guest->kids_count * $guest->user->ticket->sl_price_kids }}
                            @elseif($guest->guest_type == 'foreign')
                            X {{ $guest->user->ticket->foreign_price_kids }} =
                            {{ $guest->kids_count * $guest->user->ticket->foreign_price_kids }}
                            @endif
                            @endif
                            <div><strong>Total Amount :</strong>
                                @if($guest->guest_type == 'local')
                                {{ ($guest->adult_count * $guest->user->ticket->sl_price) + (($guest->kids_count ?? 0) * $guest->user->ticket->sl_price_kids) }}
                                @elseif($guest->guest_type == 'foreign')
                                {{ ($guest->adult_count * $guest->user->ticket->foreign_price) + (($guest->kids_count ?? 0) * $guest->user->ticket->foreign_price_kids) }}
                                @else
                                -
                                @endif
                            </div>
                        </div>
                        <br><br>
                        <div class="text-center">
                            <strong>Thank You!!</strong>
                        </div>
                        <div class="text-center">
                            <strong>Entrance Marking</strong>
                            <div class="marking-box"></div>
                        </div>
                        <br>
                        <div class="text-center">
                            <strong>Rules & Regulations</strong>
                            <ol class="rules-list">
                                <li>Do not use obscene language or disturb other visitors.</li>
                                <li>This is an Environmental Friendly project; please keep the surroundings clean before you leave the site.</li>
                                <li>Visiting vehicles will not be protected by the management.</li>
                                <li>Management should not be held responsible for any loss of personal belongings or casualties of visitors.</li>
                                <li>Management reserves the right to expel any person if misbehavior is observed or any obscene language is used.</li>
                                <li>Visitors will not be allowed to stay after 6:00 p.m.</li>
                            </ol>
                        </div>
                        <td>
                            <a href="{{ route('ticket.pdf', $guest->id) }}" class="btn btn-info btn-sm">Print Ticket</a>
                        </td>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection

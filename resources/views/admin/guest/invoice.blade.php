@extends('layouts.admin.master')
@section('title','Invoice')
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
</style>

<div class="card mt-3">
    <div class="card-header">
        Invoice <strong>{{ now()->format('d/m/Y') }}</strong>
        <span class="float-end"><strong>Status:</strong> Pending</span>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="mt-4 col-lg-12 text-center">
                <div class="mb-2 text-center">
                    <span style="font-family: 'Times New Roman', serif; font-size: 24px;"><strong>Hunnas</strong></span>
                    <span style="font-family: 'Cursive', cursive; font-size: 18px;"> Leisure Park</span>
                </div>

                <div class="mb-2 text-center">
                    <div style="font-family: 'Monospace', monospace;">Eco Friendly Tourism Project</div>
                    <div style="font-family: 'Monospace', monospace;">Managed by - Estate Workers housing Co-operative Society of Hunnasgiriya Estate</div>
                    <div style="font-family: 'Monospace', monospace;">Hunnasgiriya Estate Elkaduwa</div>
                    <div style="font-family: 'Monospace', monospace;">Email: sphunasgeria@gmail.com</div>
                    <div style="font-family: 'Monospace', monospace;">Phone: 081 7294775</div>
                </div>
                <div class="col-lg-4 ">
                    <div class="mb-5">
                        <div>
                            <strong>Date Prepared By:</strong> {{ now()->format('d/m/Y') }}
                        </div>
                        <div>
                            <strong>Guest Type :</strong> {{ $guest->guest_type }}
                            <br>
                            <strong>Subject:</strong> Invoice Preview
                        </div>
                        <div>
                            <strong>Prepared By:</strong>
                            {{ $guest->user->role->name == 'Admin' ? $guest->user->admin->firstname : $guest->user->receptionist->firstname }}
                        </div>
                        <strong>Contact Number:</strong> {{ $guest->user->phone }}
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <table class="table">
                                <tr>
                                    <th>Guest Name</th>
                                    <td>{{ $guest->title . ' ' . $guest->guestfirstname . ' ' . $guest->guestlastname }}</td>
                                </tr>
                                <tr>
                                    <th>Guest Email Address</th>
                                    <td>{{ $guest->email }}</td>
                                </tr>
                                <tr>
                                    <th>Adults</th>
                                    <td>{{ $guest->adult_count }}</td>
                                </tr>
                                <tr>
                                    <th>Kids</th>
                                    <td>{{ $guest->kids_count ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Per Adult price</th>
                                    <td>
                                        @if($guest->guest_type == 'local')
                                            {{ $guest->user->ticket->sl_price }}
                                        @elseif($guest->guest_type == 'foreign')
                                            {{ $guest->user->ticket->foreign_price }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Per Kid price</th>
                                    <td>
                                        @if($guest->guest_type == 'local')
                                            {{ $guest->user->ticket->sl_price_kids }}
                                        @elseif($guest->guest_type == 'foreign')
                                            {{ $guest->user->ticket->foreign_price_kids }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Invoice Number</th>
                                    <td>{{ $guest->invoice_number }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-lg-4 col-sm-5"> </div>
            <div class="col-lg-4 col-sm-5 ms-auto">
                <table class="table table-clear">
                    <tbody>
                        <tr>
                            <td class="left"><strong>Adults Price</strong></td>
                            <td class="right">
                                @if($guest->guest_type == 'local')
                                    {{ $guest->adult_count * $guest->user->ticket->sl_price }}
                                @elseif($guest->guest_type == 'foreign')
                                    {{ $guest->adult_count * $guest->user->ticket->foreign_price }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="left"><strong>Kids Price</strong></td>
                            <td class="right">
                                @if($guest->guest_type == 'local')
                                    {{ ($guest->kids_count ?? 0) * $guest->user->ticket->sl_price_kids }}
                                @elseif($guest->guest_type == 'foreign')
                                    {{ ($guest->kids_count ?? 0) * $guest->user->ticket->foreign_price_kids }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="left"><strong>Total</strong></td>
                            <td class="right">
                                @if($guest->guest_type == 'local')
                                    {{ ($guest->adult_count * $guest->user->ticket->sl_price) + (($guest->kids_count ?? 0) * $guest->user->ticket->sl_price_kids) }}
                                @elseif($guest->guest_type == 'foreign')
                                    {{ ($guest->adult_count * $guest->user->ticket->foreign_price) + (($guest->kids_count ?? 0) * $guest->user->ticket->foreign_price_kids) }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="mb-3 d-flex justify-content-end">
                    <a href="{{ route('guest.index') }}" class="btn btn-secondary me-2">Back</a>
                    
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

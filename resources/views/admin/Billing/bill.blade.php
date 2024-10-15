@extends('layouts.admin.master')
@section('title', 'Bill')
@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .card-body {
        text-align: center;
    }

  
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }
</style>

<div class="card mt-3">
    <div class="card-body">
        <div class="mb-2">
            <span style="font-size: 24px;"><strong>Hunnas</strong></span>
            <span style="font-size: 18px;"> Leisure Park</span>
        </div>

        <div class="mb-2">
            <div>Eco Friendly Tourism Project</div>
            <div>Managed by - Estate Workers housing Co-operative Society of Hunnasgiriya Estate</div>
            <div>Hunnasgiriya Estate Elkaduwa</div>
            <div>Email: sphunasgeria@gmail.com | Phone: 081 7294775</div>
        </div>
        
        <div class="col-lg-4 mx-auto">
            <div class="mb-5">
                <div>
                    <strong>Date Prepared By:</strong> {{ now()->format('d/m/Y') }}
                </div>
                <div>
                    <strong>Subject:</strong> Bill Preview
                </div>
                <div>
                    <strong>Prepared By:</strong>
                    @if ($user->role)
                        @if ($user->role->name == 'Admin' && $user->admin)
                            {{ $user->admin->firstname }}
                        @elseif ($user->role->name == 'Receptionist' && $user->receptionist)
                            {{ $user->receptionist->firstname }}
                        @else
                            Unknown
                        @endif
                    @else
                        No Role
                    @endif
                </div>
                <div>
                    <strong>Bill No:</strong>
                    {{ $payment->bill_number }}
                </div>
                <br>
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Item</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($billings->billing_details as $record)
                            <tr>
                                <td>{{ $record['item'] }}</td>
                                <td>{{ $record['price'] }}</td>
                                <td>{{ $record['quantity'] }}</td>
                                <td>{{ $record['subtotal'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div>
                    <strong>Net Total:</strong> {{ $billings->total_amount }}
                </div>
                <div>
                    <strong>Payment Mode:</strong> {{ $payment->payment_mode }}
                </div>
                <div>
                    <strong>Number of Items:</strong> {{ count($billings->billing_details) }}
                </div>
                <div>
                    Thank you and come again..!
                </div>
                  
                <a href="{{ route('generate.pdf' , $payment->id)}}" class="btn btn-primary">PDF</a>
            </div>
        </div>
    </div>
</div>
@endsection

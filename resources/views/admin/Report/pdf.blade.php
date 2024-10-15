<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .card-body {
            text-align: center;
            padding: 20px;
        }

        .mb-2 {
            margin-bottom: 10px;
        }

        .table-container {
            width: 100%;
            margin: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .float-left {
            float: left;
            margin-left: 10px;
        }

        .float-right {
            float: right;
            margin-right: 10px;
        }
    </style>
</head>
<body>
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
                        <strong>Subject:</strong> Transaction Report
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
                        <strong>Date Selected:</strong> {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
                    </div>
                    <br>
                    <div class="table-container">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Payment ID</th>
                                    <th>Payment Mode</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>{{ $payment->payment_mode }}</td>
                                    <td>{{ $payment->total_amount }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3">No transactions found for the selected date.</td>
                                </tr>
                                @endforelse
                                @if (!empty($payments))
                                <tr>
                                    <td colspan="2"><strong>Total</strong></td>
                                    <td><strong>{{ $totalAmount }}</strong></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

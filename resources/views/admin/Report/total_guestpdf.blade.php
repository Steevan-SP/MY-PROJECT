<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .card {
            width: 80%;
            margin: auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .card-body {
            padding: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
        }

        .address {
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        .address div {
            margin-bottom: 5px;
        }

        .subject {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .prepared-by {
            margin-bottom: 20px;
            font-size: 14px;
        }

        .table-container {
            width: 100%;
            margin: auto;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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
    <div class="card">
        <div class="card-body">
            <div class="header">
                <h1>Hunnas Leisure Park</h1>
                <h2>Eco Friendly Tourism Project</h2>
            </div>

            <div class="address">
                <div>Managed by - Estate Workers housing Co-operative Society of Hunnasgiriya Estate</div>
                <div>Hunnasgiriya Estate Elkaduwa</div>
                <div>Email: sphunasgeria@gmail.com | Phone: 081 7294775</div>
            </div>
            
            <div class="subject">
                <strong>Subject:</strong> Transaction Report
            </div>

            <div class="prepared-by">
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
                <strong>Date Selected:</strong> {{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}
            </div>

            <div class="table-container">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Guest Type</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Adult Count</th>
                            <th>Kids Count</th>
                            <th>Invoice Number</th>
                            <th>Ticket Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guests as $guest)
                            <tr>
                                <td>{{ $guest->id }}</td>
                                <td>{{ $guest->guest_type }}</td>
                                <td>{{ $guest->guestfirstname }}</td>
                                <td>{{ $guest->email }}</td>
                                <td>{{ $guest->adult_count }}</td>
                                <td>{{ $guest->kids_count }}</td>
                                <td>{{ $guest->invoice_number }}</td>
                                <td>{{ $guest->ticket_number }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
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
</head>
<body>
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

    <div>
        <strong>Subject:</strong> Guest Details Report
    </div>
    <div>
        <strong>Date Selected:</strong> {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
    </div>
    @if (!empty($guestType))
        <div>
            <strong>Guest Type Selected:</strong> {{ ucfirst($guestType) }}
        </div>
    @endif
    <br>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;" border="1">
        <thead>
            <tr>
                <th>Guest ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Guest Type</th>
                <th>Adult Count</th>
                <th>Kids Count</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalAdults = 0;
                $totalKids = 0;
            @endphp
            @forelse ($guests as $guest)
                <tr>
                    <td>{{ $guest->id }}</td>
                    <td>{{ $guest->guestfirstname }}</td>
                    <td>{{ $guest->guestlastname }}</td>
                    <td>{{ $guest->email }}</td>
                    <td>{{ ucfirst($guest->guest_type) }}</td>
                    <td>{{ $guest->adult_count }}</td>
                    <td>{{ $guest->kids_count ?? 'N/A' }}</td>
                </tr>
                @php
                    $totalAdults += $guest->adult_count;
                    $totalKids += $guest->kids_count ?? 0;
                @endphp
            @empty
                <tr>
                    <td colspan="7">No guests found.</td>
                </tr>
            @endforelse
            
            @if ($guests->isNotEmpty())
                <tr>
                    <td colspan="5" style="text-align: right;"><strong>Total:</strong></td>
                    <td><strong>{{ $totalAdults }}</strong></td>
                    <td><strong>{{ $totalKids }}</strong></td>
                </tr>
            @endif
        </tbody>
    </table>
</body>
</html>

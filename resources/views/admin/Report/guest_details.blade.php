@extends('layouts.admin.master')

@section('title', 'Guest Details Report')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="float-left ml-2">Guest Details Report</h6>
                <a href="{{ route('guestDetails.pdf', ['date' => $date, 'guest_type' => request('guest_type')]) }}" class="btn btn-primary float-right" target="_blank">PDF</a>
            </div>
            <div class="card-body">
                <form method="get">
                    <div class="form-row mb-3">
                        <div class="col-md-6">
                            <label for="date">Select Date:</label>
                            <input type="date" id="date" name="date" value="{{ $date }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="guest_type">Filter by Guest Type:</label>
                            <select id="guest_type" name="guest_type" class="form-control">
                                <option value="">All</option>
                                <option value="local" {{ request('guest_type') == 'local' ? 'selected' : '' }}>Local</option>
                                <option value="foreign" {{ request('guest_type') == 'foreign' ? 'selected' : '' }}>Foreign</option>
                                <option value="complimentary" {{ request('guest_type') == 'complimentary' ? 'selected' : '' }}>Complimentary</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success mt-4">Generate Report</button>
                        </div>
                    </div>
                </form>
                <br>
                <table class="table table-striped">
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
                            @if (empty(request('guest_type')) || request('guest_type') == $guest->guest_type)
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
                            @endif
                        @empty
                            <tr>
                                <td colspan="7">No guests found.</td>
                            </tr>
                        @endforelse
                        @if ($guests->isNotEmpty())
                            <tr>
                                <td colspan="5" class="text-right"><strong>Total:</strong></td>
                                <td><strong>{{ $totalAdults }}</strong></td>
                                <td><strong>{{ $totalKids }}</strong></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

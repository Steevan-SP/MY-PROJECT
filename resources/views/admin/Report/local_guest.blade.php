@extends('layouts.admin.master')

@section('title', 'Local Guest Report')

@section('content')
<div class="container">
    <h1>Local Guest Report</h1>
    
    <!-- Button to generate PDF -->
    <div class="mb-3">
        <a href="" class="btn btn-primary">Generate PDF</a>
    </div>
    
    <!-- Table to display local guest details -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>ID Number</th>
                <th>Registration Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($localGuests as $guest)
                <tr>
                    <td>{{ $guest->guest->guestfirstname }} {{ $guest->guest->guestlastname }}</td>
                    <td>{{ $guest->addressline1 }}{{ $guest->addressline2 ? ', ' . $guest->addressline2 : '' }}, {{ $guest->city }}</td>
                    <td>{{ $guest->phone }}</td>
                    <td>{{ $guest->id_number }}</td>
                    <td>{{ $guest->registration_date->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No local guests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

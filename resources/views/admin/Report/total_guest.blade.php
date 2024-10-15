@extends('layouts.admin.master')

@section('title', 'Total Guest Details')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Total Guest Details</h1>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <form action="{{ route('GD_generatePDF.pdf') }}" method="GET" target="_blank">
                            @if(request('start_date') && request('end_date'))
                                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                                <button type="submit" class="btn btn-primary mb-3">Generate PDF</button>
                            @else
                                <button type="button" class="btn btn-primary disabled" disabled>Generate PDF</button>
                            @endif
                        </form>
                    </div>

                    <div>
                        <form action="{{ route('TotalGuest.index') }}" method="GET" target="_blank">
                            <div class="form-inline mb-3">
                                <label for="start_date" class="mr-2">Start Date:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                
                                <label for="end_date" class="ml-2 mr-2">End Date:</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                
                                <button type="submit" class="btn btn-primary ml-2">Generate Report</button>
                            </div>
                        </form>
                    </div>

                    @if ($guests->count() > 0)
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered table-striped">
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
                    @else
                        <p>No guests found for the selected date range.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

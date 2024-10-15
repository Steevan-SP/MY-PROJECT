@extends('layouts.admin.master')
@section('title','Ticket Price')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h2>Ticket Price</h2>
                </div>
                @if(Auth::check() && Auth::user()->admin)
                @foreach ($tickets as $ticket)
                <div class="float-right">
                    <a class="btn btn-primary btn-md btn-rounded" href="{{ route('ticket.edit', $ticket->id) }}">
                        <i class="mdi mdi-currency-usd mdi-18px"></i> Edit The Price
                    </a>
                </div>
                @endforeach
                @endif
            </div>
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Guest Mode</th>
                        <th>Ticket Price </th>
                        <th>Updated By</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                    <tr>
                        <th>Sri Lankan Price</th>
                        <td>{{ $ticket->sl_price }}</td>
                        <td>{{ $ticket->admin->firstname }}</td>
                    </tr>
                    <tr>
                        <th>Sri Lankan Kid's Price</th>
                        <td>{{ $ticket->sl_price_kids }}</td>
                        <td>{{ $ticket->admin->firstname }}</td>
                    </tr>
                    <tr>
                        <th>Foreign Price</th>
                        <td>{{ $ticket->foreign_price }}</td>
                        <td>{{ $ticket->admin->firstname }}</td>
                    </tr>
                    <tr>
                        <th>Foreign Kid's Price</th>
                        <td>{{ $ticket->foreign_price_kids }}</td>
                        <td>{{ $ticket->admin->firstname }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection

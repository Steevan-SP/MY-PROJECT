@extends('layouts.admin.master')
@section('title', 'Register Guest')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>
<body>
<div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Guest Register</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Guest </a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h2>Guest List</h2>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-md btn-rounded" href="{{ route('guest.register') }}">
                            <i class="mdi mdi-account-plus mdi-18px"></i>Register Guest
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="text-center">
                        <h4>Total Guests: {{ $guests->count() }}</h4>
                        <p>
                            <strong style="color: #333;">Local Guests:</strong> <span style="color: #333;">{{ $localguests->count() }}</span> |
                            <strong style="color: #333;">Foreign Guests:</strong> <span style="color: #333;">{{ $foreignguests->count() }}</span> |
                            <strong style="color: #333;">Complementary Guests:</strong> <span style="color: #333;">{{ $complementaryguests->count() }}</span>
                        </p>
                    </div>

                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Guest Type</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Invoice No</th>
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guests as $guest)
                                <tr>
                                    <td>{{ $guest->guest_type }}</td>
                                    <td>{{ $guest->title . ' ' . $guest->guestfirstname }}</td>
                                    <td>{{ $guest->email }}</td>
                                    <td>{{ $guest->invoice_number }}</td>
                                    <td>
                                        <a href="{{ route('guest.invoice', $guest) }}" class="btn btn-info btn-sm">View Invoice</a>
                                        @if($guest->guest_type !== 'complementary' && $guest->payments->isEmpty())
                                            <a href="{{ route('guest.paymentindex',$guest->id)}}" class="btn btn-secondary btn-icon-split"><span class="text">Proceed to payment</span></a>
                                        @else
                                            <button class="btn btn-secondary btn-icon-split" disabled><span class="text">Proceed to payment</span></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

@endsection

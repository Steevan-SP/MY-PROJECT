@extends('layouts.admin.master')

@section('title', 'Cash Flow')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">IncomeStream</a></li>
            <li class="breadcrumb-item">CashFlow</li>
        </ol>
    </div>
   
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Earnings</h4>
                    <form action="{{ route('search.payments') }}" method="GET" class="ml-auto">
                        <div class="input-group search-area">
                            <input type="text" name="search" class="form-control" placeholder="Search by payment mode...">
                            <span class="input-group-text"><button type="submit"><i class="flaticon-381-search-2"></i></button></span>
                        </div>
                    </form>
                    <p class="card-title">Today's Earnings: {{ 'RS. ' . $todayEarnings }}</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="billing-table">
                            <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th>PAYMENT MODE</th>
                                    <th>AMOUNT</th>
                                    <th>TICKET NUMBER</th>
                                    <th>BILL NUMBER</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $payment->payment_mode }}</td>
                                    <td>{{ 'RS. ' . $payment->total_amount }}</td>
                                    <td>
                                        @if ($payment->guest && $payment->guest->ticket_number)
                                            {{ $payment->guest->ticket_number }}
                                        @else
                                            No Ticket Number
                                        @endif
                                    </td>
                                    <td>
                                        @if ($payment->bill_number)
                                            {{ $payment->bill_number }}
                                        @else
                                            No Bill Number
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
    </div>
</div>
@endsection

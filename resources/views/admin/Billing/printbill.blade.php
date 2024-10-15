@extends('layouts.admin.master')

@section('title', 'Bills')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">PayPrint</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">BillCraft</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">BillWise</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="billing-table">
                            <thead>
                                <tr>
                                    <th>PAYMENT ID</th>
                                    <th>PAYMENT MODE</th>
                                    <th>BILLING ID</th>
                                    <th>BILL NUMBER</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    @if ($payment->bill_number)
                                        <tr>
                                            <td>{{ $payment->id }}</td>
                                            <td>{{ $payment->payment_mode }}</td>
                                            <td>{{ $payment->billing_id }}</td>
                                            <td>{{ $payment->bill_number }}</td>
                                            <td>
                                                <a href="{{ route('billing.bill', $payment->id) }}" class="btn btn-info btn-sm">View Bill</a>
                                            </td>
                                        </tr>
                                    @endif
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

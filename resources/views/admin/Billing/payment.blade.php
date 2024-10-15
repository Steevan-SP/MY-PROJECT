@extends('layouts.admin.master')

@section('title', 'Proceed to Payment')

@section('content')

    @if ($errors->any())
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent Payment</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Payment Queue</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form id="payment-form" method="post" action="{{ route('billing.paymentstore', $user->id) }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Include the payment form -->
                            @include('admin.billing._paymentform')

                            <div class="row">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">Proceed with Payment</button>
                                    <a href="{{ route('guest.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

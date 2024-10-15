@extends('layouts.admin.master')
@section('title', 'Stock List')
@section('content')


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h2>Stock</h2>
                </div>
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
                            <th>Item Name</th>
                            <th>Code</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stocks as $stock)
                        <tr>
                            <td>{{ $stock->item_name }}</td>
                            <td>{{ $stock->code }}</td>
                            <td>{{ $stock->quantity }}</td>
                            <td>{{ $stock->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

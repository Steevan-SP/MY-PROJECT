@extends('layouts.admin.master')

@section('title', 'Total Stock Summary')

@section('content')
<div class="container">
    <h1>Total Stock Summary</h1>
    
    <!-- Button to generate PDF -->
    <div class="mb-3">
        <a href="{{ route('stock.report.pdf') }}" class="btn btn-primary">Generate PDF</a>
    </div>
    
    <!-- Optionally add some styling or classes -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Code</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($stocks as $stock)
                <tr>
                    <td>{{ $stock->item_name }}</td>
                    <td>{{ $stock->quantity ?? 'N/A' }}</td>
                    <td>{{ $stock->code ?? 'N/A' }}</td>
                    <td>LKR {{ number_format($stock->price, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No stock items found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.admin.master')
@section('title', 'Stock List')
@section('content')

<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Assets</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Stock</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h2>Stock</h2>
                </div>
                <div class="float-right">
                    <a href="{{ route('stock.view') }}" class="btn btn-primary btn-md btn-rounded"><i class="mdi mdi-account-plus mdi-18px"></i> View Stock Items</a>
                    <a href="{{ route('stock.create') }}" class="btn btn-primary btn-md btn-rounded"><i class="mdi mdi-account-plus mdi-18px"></i> Add Stock Items</a>
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
                            <th>Status</th> <!-- Added Status Column -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stocks as $stock)
                        <tr>
                            <td>{{ $stock->item_name }}</td>
                            <td>{{ $stock->code }}</td>
                            <td>{{ $stock->quantity ?? 'N/A' }}</td>
                            <td>{{ $stock->price }}</td>
                            <td>
                                @if ($stock->quantity === null)
                                    N/A
                                @elseif ($stock->quantity > 10)
                                    <span class="badge badge-success">Available</span>
                                @elseif ($stock->quantity > 0)
                                    <span class="badge badge-warning">Low Stock</span>
                                @else
                                    <span class="badge badge-danger">Out of Stock</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('stock.edit', $stock->id) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.admin.master')
@section('title', 'Manage Inventory')
@section('content')

<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Assets</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inventory</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h2>Inventory</h2>
                </div>
                <div class="float-right">
                    <a href="{{ route('inventory.create') }}" class="btn btn-primary btn-md btn-rounded">
                        <i class="mdi mdi-account-plus mdi-18px"></i> Add
                    </a>
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventories as $inventory)
                        <tr>
                            <td>{{ $inventory->item_name }}</td>
                            <td>{{ $inventory->code }}</td>
                            <td>{{ $inventory->quantity }}</td>
                            <td>
                                <a href="{{ route('inventory.edit', $inventory->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('inventory.destroy', $inventory->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                </form>
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

@extends('layouts.admin.master')

@section('title', 'Edit Inventory')

@section('content')

<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('inventory.index') }}">Inventory</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Inventory Item</h4>
                </div>
                <div class="card-body">
                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Edit form -->
                    <form action="{{ route('inventory.update', $inventory->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" id="item_name" name="item_name" value="{{ old('item_name', $inventory->item_name) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $inventory->code) }}" readonly>
                            <!-- The `readonly` attribute makes this field non-editable -->
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $inventory->quantity) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Inventory</button>
                        <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

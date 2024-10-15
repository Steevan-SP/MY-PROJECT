@extends('layouts.admin.master')
@section('title','Add Items')
@section('content')


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Inventory Items</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="post" action="{{ route('inventory.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    @include('admin.inventory._form')
                               
                            <div class="row">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">Add item</button>
                                    <a href="{{ route('user.index')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
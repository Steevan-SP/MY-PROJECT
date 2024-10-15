@extends('layouts.admin.master')
@section('title', 'Register Guest')
@section('content')

@if ($errors->any())
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Register Guest</h4>
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
                <h4 class="card-title">Register Guest</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form method="post" action="{{ route('guest.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                @include('admin.guest._form')
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">Register the Guest</button>
                                <a href="{{ route('guest.index')}}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

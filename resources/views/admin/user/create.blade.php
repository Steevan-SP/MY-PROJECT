@extends('layouts.admin.master')
@section('title','User Create')
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
                    <h4 class="card-title">User Create</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    @include('admin.user._form')
                               
                            <div class="row">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">Create</button>
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
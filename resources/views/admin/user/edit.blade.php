@extends('layouts.admin.master')
@section('title','User edit')
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
                    <h4 class="card-title">User Edit</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                    <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    
                            @csrf
                            @method('PATCH') 
                            <div class="row">
                                <div class="col-md-8">
                                    @include('admin.user._eform')
                               
                            <div class="row">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
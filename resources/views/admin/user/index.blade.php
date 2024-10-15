@extends('layouts.admin.master')
@section('title', 'User List')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h2>Users</h2>
                </div>
                <div class="float-right">
                    <a class="btn btn-primary btn-md btn-rounded" href="{{ route('user.create') }}">
                        <i class="mdi mdi-account-plus mdi-18px"></i> Create User
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
                            <th>User Id</th>
                            <th>First Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                @if($user->role->name == 'Admin')
                                    <td>{{ $user->admin->firstname }}</td>
                                @else
                                    <td>{{ $user->receptionist->firstname }}</td>
                                @endif
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info btn-icon-split">
                                        <span class="text">Edit</span>
                                    </a>
                                    <a href="{{ route('user.show', $user->id) }}" class="btn btn-info btn-icon-split">
                                        <span class="text">Show</span>
                                    </a>
                                    @if ($user->role->name == 'Admin')
                                        @php
                                            $onlyAdmin = $users->where('role.name', 'Admin')->count() == 1;
                                        @endphp
                                        @if ($onlyAdmin)
                                            <!-- Disable the delete button for the only admin -->
                                            <button class="btn btn-info btn-icon-split" disabled>
                                                <span class="text">Delete</span>
                                            </button>
                                        @else
                                            <a href="{{ route('user.delete', $user->id) }}" class="btn btn-info btn-icon-split">
                                                <span class="text">Delete</span>
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('user.delete', $user->id) }}" class="btn btn-info btn-icon-split">
                                            <span class="text">Delete</span>
                                        </a>
                                    @endif
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

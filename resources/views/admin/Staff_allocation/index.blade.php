@extends('layouts.admin.master')
@section('title', 'Allocate Staff')
@section('content')

<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Staff</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Allocation</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h2>Staff Allocation</h2>
                </div>
                <div class="float-right">
                    <a href="{{ route('staff.create') }}" class="btn btn-primary btn-md btn-rounded"
                       @if ($allocation_count >= 5)
                           disabled="disabled"
                       @endif>
                       <i class="mdi mdi-account-plus mdi-18px"></i> Allocate Staff
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Debugging Output -->
                <p>Allocation Count: {{ $allocation_count }}</p>

                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Staff Name</th>
                            <th>Location</th>
                            <th>Phone Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staff_allocations as $staff_allocation)
                        <tr>
                            <td>{{ $staff_allocation->staff_name }}</td>
                            <td>{{ $staff_allocation->location }}</td>
                            <td>{{ $staff_allocation->phone_number }}</td>
                            <td>
                                <form action="{{ route('staff.destroy', $staff_allocation->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this staff allocation?');">
                                        <i class="mdi mdi-delete mdi-18px"></i> Delete
                                    </button>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    var count = {{ $allocation_count }};
    var button = document.querySelector('.btn-primary');
    if (count >= 5) {
        button.classList.add('disabled');
        button.setAttribute('disabled', 'disabled');
    }
});
</script>

@endsection

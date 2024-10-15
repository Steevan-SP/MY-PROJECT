@extends('layouts.admin.master')
@section('title', 'delete')
@section('header')
@section('content')
<form method="post" action="{{ route('user.destroy',$user->id) }}" enctype="multipart/form-data" id=''>
    @method('DELETE')
    @csrf
            <button type="button" class="btn btn-danger btn-md float-right" onclick="confirmDelete()">Delete User</button>
            <a href="{{ route('user.index')}}" class="btn btn-info btn-icon-split"><span class="text">Cancel</span></a>
</form>

@endsection

<script>
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this User?')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
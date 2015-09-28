@extends('layouts.master')

@section('content')

    <h1>User</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th> <th>Name</th><th>Email</th><th>Phone</th>
            </tr>
            <tr>
                <td>{{ $user->id }}</td> <td> {{ $user->name }} </td><td> {{ $user->email }} </td><td> {{ $user->phone }} </td>
            </tr>
        </table>
    </div>

@endsection

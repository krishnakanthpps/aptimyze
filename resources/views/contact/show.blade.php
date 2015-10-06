@extends('layouts.master')

@section('content')

    <h1>Contact</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Organization</th>
                <th>Message</th>
            </tr>
            <tr>
                <td>{{ $contact->id }}</td>
                <td> {{ $contact->name }} </td>
                <td> {{ $contact->email }} </td>
                <td> {{ $contact->phone }} </td>
                <td> {{ $contact->organization }} </td>
                <td> {{ $contact->message }} </td>
            </tr>
        </table>
    </div>

@endsection

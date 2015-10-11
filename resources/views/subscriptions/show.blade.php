@extends('layouts.master')

@section('content')

    <h1>Subscription</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th> <th>Email</th>
            </tr>
            <tr>
                <td>{{ $subscription->id }}</td> <td> {{ $subscription->email }} </td>
            </tr>
        </table>
    </div>

@endsection

@extends('layouts.master')

@section('content')

    <h1>Test</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Url</th><th>Random String</th><th>Pid</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $test->id }}</td> <td> {{ $test->url }} </td><td> {{ $test->random_string }} </td><td> {{ $test->pid }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection

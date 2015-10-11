@extends('layouts.master')

@section('content')

    <h1>Contacts <a href="{{ url('/contact/create') }}" class="btn btn-primary pull-right btn-sm">New Message</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>S.No.</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Actions</th>
            </tr>
            {{-- */$x=0;/* --}}
            @foreach($contacts as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('/contact', $item->id) }}">{{ $item->first_name }}</a></td><td>{{ $item->last_name }}</td><td>{{ $item->email }}</td><td>{{ $item->phone }}</td>
                    <td><a href="{{ url('/contact/'.$item->id.'/edit') }}"><button type="submit" class="btn btn-primary btn-xs">Update</button></a> / {!! Form::open(['method'=>'delete','action'=>['ContactController@destroy',$item->id], 'style' => 'display:inline']) !!}<button type="submit" class="btn btn-danger btn-xs">Delete</button>{!! Form::close() !!}</td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection

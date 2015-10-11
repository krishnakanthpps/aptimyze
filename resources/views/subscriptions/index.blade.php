@extends('layouts.master')

@section('content')

    <h1>Subscriptions <a href="{{ url('/subscriptions/create') }}" class="btn btn-primary pull-right btn-sm">Add New Subscriptions</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>SL.</th><th>Email</th><th>Actions</th>
            </tr>
            {{-- */$x=0;/* --}}
            @foreach($subscriptions as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('/subscriptions', $item->id) }}">{{ $item->email }}</a></td>
                    <td><a href="{{ url('/subscriptions/'.$item->id.'/edit') }}"><button type="submit" class="btn btn-primary btn-xs">Update</button></a> / {!! Form::open(['method'=>'delete','action'=>['SubscriptionsController@destroy',$item->id], 'style' => 'display:inline']) !!}<button type="submit" class="btn btn-danger btn-xs">Delete</button>{!! Form::close() !!}</td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection

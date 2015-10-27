@extends('layouts.master')

@section('content')

    <h1>Tests <a href="{{ url('/test/create') }}" class="btn btn-primary pull-right btn-sm">Add New Test</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>SL.</th><th>Url</th><th>Random String</th><th>Pid</th><th>Actions</th>
                </tr>
            </thead>                
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($tests as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('/test', $item->id) }}">{{ $item->url }}</a></td><td>{{ $item->random_string }}</td><td>{{ $item->pid }}</td>
                    <td><a href="{{ url('/test/'.$item->id.'/edit') }}"><button type="submit" class="btn btn-primary btn-xs">Update</button></a> / {!! Form::open(['method'=>'delete','action'=>['TestController@destroy',$item->id], 'style' => 'display:inline']) !!}<button type="submit" class="btn btn-danger btn-xs">Delete</button>{!! Form::close() !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

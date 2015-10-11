@extends('layouts.master')

@section('content')

    <h1>Edit Message</h1>
    <hr/>

    {!! Form::model($contact, ['method' => 'PATCH', 'action' => ['ContactController@update', $contact->id], 'class' => 'form-horizontal']) !!}
        @include('contact._form', ['submitButton'=> 'Update']);
    {!! Form::close() !!}

@endsection

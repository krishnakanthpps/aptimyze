@extends('layouts.master')

@section('content')

    <h1>Edit Subscription</h1>
    <hr/>

    {!! Form::model($subscription, ['method' => 'PATCH', 'action' => ['SubscriptionsController@update', $subscription->id], 'class' => 'form-horizontal']) !!}

    <div class="form-group">
                        {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

@endsection

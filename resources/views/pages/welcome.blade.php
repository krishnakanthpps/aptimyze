@extends('layouts.master')

@section('content')

    <div class="content text-center">
        <div class="title">Aptimyze : Performance Testing : Smooth and easy.</div>
        <div class="text-justify space-line">
            <p class="lead">
                Aptimyze is cloud based SAAS performance testing platform. Uncomplicate the performance testing needs of your API's, Web Apps, Native/Hybrid mobile apps using Aptimyze and get the best of Apache JMeter on the cloud. We are here to identify your performance issues and help your application scale up to the next level.
            </p>
            <p class="lead">
                We can help you run tests up to 5000 concurrent users on across different regions across the world without any setup or installation.
            </p>
        </div>
        <div class="centered">
            <a href="{{url('/test/create')}}" class="btn btn-lg btn-primary">Run Test for 5 virtual users</a>
            <a href="{{url('/test/create')}}" class="btn btn-lg btn-success">Run Test for 25 virtual users</a>
        </div>
        <div class="row clearfix">
            &nbsp;
        </div>
        {!! Form::open(['url' => 'subscriptions', 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-3">
                    {!! Form::submit('Subscribe for updates', ['class' => 'btn btn-info form-control']) !!}
                </div>
            </div>
        {!! Form::close() !!}
        <p>
            Subscribe for updates of our latest offerings and offers.
        </p>
    </div>
@endsection

@extends('layouts.master')

@section('content')

    <h1>Forgot Password</h1>
    <hr/>

    {!! Form::open(['url' => '/password/email', 'id'=> 'passwordForm',  'class' => 'form-horizontal']) !!}

        <div class="form-group">
            {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => "Enter your email address"]) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Send Password Reset Link', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
    {!! Form::close() !!}

@endsection
@section('pagejquery')
    <script type="text/javascript" >
        $(document).ready(function(){
            $('#passwordForm').bootstrapValidator({
                message: 'This value is not valid',
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'The email is required and cannot be empty'
                            },
                            emailAddress: {
                                message: 'The input is not a valid email address'
                            }
                        }
                    }
                }
            });
        });
    </script>

@endsection
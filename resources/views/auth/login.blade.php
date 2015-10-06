@extends('layouts.master')

@section('content')

    <h1>Login</h1>
    <hr/>

    {!! Form::open(['url' => '/auth/login', 'id'=> 'loginForm',  'class' => 'form-horizontal']) !!}
    <div class="form-group">
        {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => "Enter your email address"]) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Password: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => "Enter your password"]) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right">
            {!! Form::checkbox('remember', null, ['class' => 'form-control', 'checked'=>'checked']) !!}
        </div>
        {!! Form::label('remember', 'Remember Me', ['class' => 'col-sm-3']) !!}
        <div class="col-sm-3 text-right">
            <a href="{{url('/password/email')}}">Forgot your password?</a>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Login', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>

    {!! Form::close() !!}

@endsection

@section('pagejquery')
    <script type="text/javascript" >
        $(document).ready(function(){
            $('#loginForm').bootstrapValidator({
                message: 'This value is not valid',
                fields: {
                    password: {
                        message: 'The password is not valid',
                        validators: {
                            notEmpty: {
                                message: 'The password is required and cannot be empty'
                            },
                            stringLength: {
                                min: 6,
                                max: 20,
                                message: 'The password must be more than 6 and less than 20 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9!@#$-%&_]+$/,
                                message: 'The password can only consist of alphabetical, number and following special symbol !,@,#,$,-,%,&,_'
                            }
                        }
                    },

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
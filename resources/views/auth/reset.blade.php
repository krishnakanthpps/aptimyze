@extends('layouts.master')

@section('content')

    <h1>Reset Password</h1>
    <hr/>

    {!! Form::open(['url' => '/password/reset', 'id'=>'resetForm', 'class' => 'form-horizontal']) !!}
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group">
        {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => "Enter your email address"]) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Password: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => "Enter a password"]) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('password_confirmation', 'Confirm Password: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => "Confirm the password"]) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Reset Password', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

@endsection

@section('pagejquery')

    <script type="text/javascript">
        $(document).ready(function(){
            $('#resetForm').bootstrapValidator({
                message: 'This value is not valid',
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Email is required and cannot be empty'
                            },
                            emailAddress: {
                                message: 'Input is not a valid email address'
                            }
                        }
                    },

                    password: {
                        message: 'Password is not valid',
                        validators: {
                            notEmpty: {
                                message: 'Password is required and cannot be empty'
                            },
                            stringLength: {
                                min: 6,
                                max: 20,
                                message: 'Password must be more than 6 and less than 20 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9!@#$-%&_]+$/,
                                message: 'Password can only consist of alphabetical, number and following special symbol !,@,#,$,-,%,&,_'
                            }
                        }
                    },
                    password_confirmation: {
                        message: 'Password is not valid',
                        validators: {
                            notEmpty: {
                                message: 'Password is required and cannot be empty'
                            },
                            identical: {
                                field: 'password',
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
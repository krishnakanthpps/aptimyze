@extends('layouts.master')

@section('content')

    <h1>Register</h1>
    <hr/>

    {!! Form::open(['url' => '/auth/register', 'id'=>'register', 'class' => 'form-horizontal']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => "Enter your name"]) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => "Enter your email address"]) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('phone', 'Phone: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => "Enter your phone number"]) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Password: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => "Enter a password"]) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right">
            {!! Form::checkbox('signup_terms', 'forever', ['class' => 'form-control', 'checked'=>'checked']) !!}
        </div>
        {!! Form::label('signup_terms', 'I agree to the terms and conditions', ['class' => 'col-sm-6']) !!}
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Register', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

@endsection

@section('pagejquery')

<script type="text/javascript">
    $(document).ready(function(){
        $('#register').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                name: {
                    message: 'Name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Name is required and cannot be empty'
                        },
                        stringLength: {
                            min: 2,
                            message: 'Name must be more than 2 characters long'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ]+(?:(?:\\s+|-)[a-zA-Z ]+)*$/,
                            message: 'Name can only consist of alphabets'
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
                phone: {
                    message: 'Mobile number is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Mobile number is required and cannot be empty'
                        },

                        regexp: {
                            regexp: /^([0]|\+91)?[789]\d{9}$/,
                            message: 'Mobile number consists of 10 digits with optional +91 or 0. Mobile number must begin with 7,8,9'
                        }
                    }
                },
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
                signup_terms:{
                    validators: {
                        notEmpty: {
                            message: 'You need to agree to the terms and conditions.'
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
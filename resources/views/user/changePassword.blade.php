@extends('layouts.master')

@section('content')
    {{-- */$nav_item = 3;/* --}}
    <div class="col-md-12 col-lg-10 col-sm-12 col-xs-12 uac_container col-lg-offset-1">
        <div class="col-md-4 col-sm-4 col-xs-12 col-lg-3">
            @include('user.sidebar')
        </div>
        <div class="col-md-9 col-sm-8 col-xs-12 col-lg-9">
            <div class="uac_orders row">
                <div class="uac_sidebar_header">
                    Change Password
                </div>
                <hr/>

                {!! Form::open(['url' => '/users/changepassword', 'id'=>'changePassword', 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('current_password', 'Current Password: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::password('current_password', ['class' => 'form-control', 'placeholder' => "Enter your current password"]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => "Enter a new password"]) !!}
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

            </div>
        </div>
    </div>
@endsection

@section('pagejquery')

    <script type="text/javascript">
        $(document).ready(function(){
            $('#changePassword').bootstrapValidator({
                message: 'This value is not valid',
                fields: {

                    current_password: {
                        message: 'Current Password is not valid',
                        validators: {
                            notEmpty: {
                                message: 'Current Password is required and cannot be empty'
                            },
                            stringLength: {
                                min: 6,
                                max: 20,
                                message: 'Current Password must be more than 6 and less than 20 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9!@#$-%&_]+$/,
                                message: 'Current Password can only consist of alphabetical, number and following special symbol !,@,#,$,-,%,&,_'
                            }
                        }
                    },
                    password: {
                        message: 'New Password is not valid',
                        validators: {
                            notEmpty: {
                                message: 'New Password is required and cannot be empty'
                            },
                            stringLength: {
                                min: 6,
                                max: 20,
                                message: 'New Password must be more than 6 and less than 20 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9!@#$-%&_]+$/,
                                message: 'New Password can only consist of alphabetical, number and following special symbol !,@,#,$,-,%,&,_'
                            }
                        }
                    },
                    password_confirmation: {
                        message: 'Confirmed Password is not valid',
                        validators: {
                            notEmpty: {
                                message: 'Confirmed Password is required and cannot be empty'
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
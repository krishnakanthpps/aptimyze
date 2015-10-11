@extends('layouts.master')

@section('content')
    {{-- */$nav_item = 2;/* --}}
    <div class="col-md-12 col-lg-10 col-sm-12 col-xs-12 uac_container col-lg-offset-1">
        <div class="col-md-4 col-sm-4 col-xs-12 col-lg-3">
            @include('user.sidebar')
        </div>
        <div class="col-md-9 col-sm-8 col-xs-12 col-lg-9">
            <div class="uac_orders row">
                <div class="uac_sidebar_header">
                    Edit User
                </div>
                <hr/>

                {!! Form::model($user, ['method' => 'PATCH', 'action'=>['UserController@update', $user->id], 'id'=>'update', 'class' => 'form-horizontal']) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('phone', 'Phone: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-3">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
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
            $('#update').bootstrapValidator({
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
                    }
                }
            });
        });
    </script>
@endsection

@extends('layouts.master')

@section('content')

    <h1>Contact Us</h1>
    <hr/>

    {!! Form::open(['url' => 'contact', 'id'=>'contact', 'class' => 'form-horizontal']) !!}
        @include('contact._form', ['submitButton'=> 'Submit']);
    {!! Form::close() !!}
    <div class="col-sm-offset-3 col-sm-6">
        Please provide us details so that we can reach out to you with a detailed response and quotation.
    </div>

@endsection


@section('pagejquery')

    <script type="text/javascript">
        $(document).ready(function(){
            $('#contact').bootstrapValidator({
                message: 'This value is not valid',
                fields: {
                    first_name: {
                        message: 'First Name is not valid',
                        validators: {
                            notEmpty: {
                                message: 'First Name is required and cannot be empty'
                            },
                            stringLength: {
                                min: 2,
                                message: 'First Name must be more than 2 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z ]+(?:(?:\\s+|-)[a-zA-Z ]+)*$/,
                                message: 'First Name can only consist of alphabets'
                            }
                        }
                    },
                    last_name: {
                        message: 'Last Name is not valid',
                        validators: {
                            notEmpty: {
                                message: 'Last Name is required and cannot be empty'
                            },
                            stringLength: {
                                min: 2,
                                message: 'Last Name must be more than 2 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z ]+(?:(?:\\s+|-)[a-zA-Z ]+)*$/,
                                message: 'Last Name can only consist of alphabets'
                            }
                        }
                    },
                    phone: {
                        message: 'Phone number is not valid',
                        validators: {
                            notEmpty: {
                                message: 'Phone number is required and cannot be empty'
                            },

                            regexp: {
                                regexp: /^([0]|\+91)?[789]\d{9}$/,
                                message: 'Phone number consists of 10 digits with optional +91 or 0. Phone number must begin with 7,8,9'
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
                    organization: {
                        validators: {
                            notEmpty: {
                                message: 'Organization is required and cannot be empty'
                            },
                            stringLength: {
                                min: 2,
                                message: 'Organization must be more than 2 characters long'
                            },
                        }
                    },
                    current_tool: {
                        validators: {
                            stringLength: {
                                max: 100,
                                message: 'Current tool must not be more than 100 characters long'
                            }
                        }
                    },
                    message: {
                        validators: {
                            notEmpty: {
                                message: 'Technical Details is required and cannot be empty'
                            },
                            stringLength: {
                                max: 2000,
                                message: 'Technical Details must not be more than 2000 characters long'
                            },
                        }
                    }
                }
            });
        });
    </script>
@endsection
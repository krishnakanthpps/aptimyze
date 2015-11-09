@extends('layouts.master')

@section('content')

    <div id="testDiv">
        <h1>Run New Test</h1>
        <hr/>

        {!! Form::open(['url'=>'test', "id"=>"testForm", 'class' => 'form-horizontal']) !!}

            <div class="form-group">
                {!! Form::label('url', 'Url: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::url('url', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Run Test Button', ['class' => 'btn btn-primary form-control send-btn']) !!}
                </div>
            </div>
        {!! Form::close() !!}

    </div>


    <h2 id="tes"></h2>


    <div id="testResponse" style="display: none">

        <h1>Running Test</h1>
        <hr/>
        <span id='statusMessage' style='color:green'>Completed creating folders</span>
    </div>



    <div id="testTimer" style="display: none">

        <h1>Your test will start in </h1>
        <div id="clockdiv">
            <div>
                <span class="hours"></span>:
                {{--<div class="smalltext">Hours</div>--}}
                <span class="minutes"></span>:
                {{--<div class="smalltext">Minutes</div>--}}
                <span class="seconds"></span>
                {{--<div class="smalltext">Seconds</div>--}}
            </div>
        </div>
    </div>


    <div id="rickshaw" style="margin:0px auto;width:660px;">
        <div id="chart" style="border:1px solid #59525B;"></div>
    </div>

@endsection


@section('pagejquery')
    <script type="text/javascript" >
        $(document).ready(function() {
            alert(new Date(2012, 01, 1));
            $("#testForm").bootstrapValidator({
                fields: {
                    url: {
                        validators: {
                            notEmpty: {
                                message: 'The URL is required and cannot be empty'
                            }
                        }
                    }
                }
            })
            .on('success.form.bv', function(e) {
                e.preventDefault();
                buttonClicked();
            });

            function count() {
                $.ajax({
                    url: "http://localhost:8000/test/count",
                    type: 'get',
                    dataType: 'json',
                    success: function (_response) {
                        if(_response.deadline){
                            $("#testTimer").fadeIn();
                            var deadline = _response.deadline+"000";
                            initializeClock('clockdiv', deadline);
                        }
                        else{
                            submitForm();
                        }
                    },
                    error: function( xhr ) {
                        var readyState = {
                            1: "Loading",
                            2: "Loaded",
                            3: "Interactive",
                            4: "Complete"
                        };
                        if(xhr.readyState !== 0 && xhr.status !== 0 && xhr.responseText !== undefined) {
                            $('#tes').append(xhr.responseText);
//                            alert("readyState: " + readyState[xhr.readyState] + "\n status: " + xhr.status + "\n\n responseText: " + xhr.responseText);
                        }
                    }
                });
            }

            function buttonClicked() {
                $("#testForm").submit(function (event) {
//                    event.preventDefault();
                    count();
                });
            }

            function submitForm() {
                var $form = $("#testForm");
                $.ajax({
                    url: $form.attr("action"),
                    type: 'post',
                    data: $form.serialize(), // Remember that you need to have your csrf token included
                    dataType: 'json',
                    success: function (_response) {
                        $("#testDiv").hide();
                        $("#testResponse").fadeIn();
                        $('#tes').append("<span id='statusMessage' style='color:green'>" + _response.url + "</span>");
                        // Handle your response..

                    },
                    error: function( xhr ) {
                        var readyState = {
                            1: "Loading",
                            2: "Loaded",
                            3: "Interactive",
                            4: "Complete"
                        };
                        if(xhr.readyState !== 0 && xhr.status !== 0 && xhr.responseText !== undefined) {
                            $('#tes').append(xhr.responseText);
//                            alert("readyState: " + readyState[xhr.readyState] + "\n status: " + xhr.status + "\n\n responseText: " + xhr.responseText);
                        }
                    }
                });
            }

            function getTimeRemaining(endtime){
//                var t = Date.parse(endtime) - Date.parse(new Date());
                var t = endtime - Date.parse(new Date());
                var seconds = Math.floor( (t/1000) % 60 );
                var minutes = Math.floor( (t/1000/60) % 60 );
                var hours = Math.floor( (t/(1000*60*60)) % 24 );
                return {
                    'total': t,
                    'hours': hours,
                    'minutes': minutes,
                    'seconds': seconds
                };
            }

            function initializeClock(id, endtime){
                var clock = document.getElementById(id);
                var daysSpan = clock.querySelector('.days');
                var hoursSpan = clock.querySelector('.hours');
                var minutesSpan = clock.querySelector('.minutes');
                var secondsSpan = clock.querySelector('.seconds');

                function updateClock(){
                    var t = getTimeRemaining(endtime);
                    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

                    if(t.total<=0){
                        $("#testTimer").hide();
                        submitForm();
                        clearInterval(timeinterval);
                    }
                }
                updateClock();
                var timeinterval = setInterval(updateClock,1000);
            }

        });

//        buttonClicked();
    </script>

@endsection
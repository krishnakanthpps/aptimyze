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
                    {!! Form::submit('Run Test', ['class' => 'btn btn-primary form-control send-btn']) !!}
                </div>
            </div>
        {!! Form::close() !!}

    </div>


    <h2 id="site"></h2>

    <div id="testResponse" class="tempHide">

        <h1>Running Test</h1>
        <hr/>
        <span id='statusMessage'></span>
    </div>

    <div id="stopTestDiv" class="tempHide">
        <button class="btn" id="stopBtn">STOP</button>
    </div>

    <div id="testTimer" class="tempHide">
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

    <div id="rickshaw" class="tempHide">
        <div id="chart"></div>
        <hr/>
        <div>
            <a href="{{url('#')}}"><button class="btn btn-primary">Email the result</button></a>
            <a href="{{url('#')}}"><button class="btn btn-primary">Share the result</button></a>
            <a href="{{url('/auth/register')}}"><button class="btn btn-primary">Sign Up for 100 user test</button></a>
        </div>
    </div>
@endsection


@section('pagejquery')
    <script type="text/javascript" >
        $(document).ready(function() {
            // To check if url is filled in url field or not
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
                // To stop default submitting of the form
                e.preventDefault();
                count();
            });

            // To get the count of previous running tests
            function count() {
                $.get("{{url('/test/count/')}}", function (_response) {
                    if(_response.deadline){
                        var deadline = _response.deadline+"000";
                        // To make sure deadline is not a time which has already passed
                        if(deadline>Date.parse(new Date()))
                        {
                            $("#testTimer").fadeIn();
                            initializeClock('clockdiv', deadline);
                        }
                        else
                        {
                            $("#testDiv").hide();
                            $("#testResponse").fadeIn();
                            $('#statusMessage').empty();
                            $('#statusMessage').append('Our system is busy please try after sometime');
                        }
                    }
                    else{
                        submitForm();
                    }
                });
            }

            // To submit form using ajax request
            function submitForm() {
                var $form = $("#testForm");
                $.ajax({
                    url: $form.attr("action"),
                    type: 'post',
                    data: $form.serialize(), // Remember that you need to have your csrf token included
                    dataType: 'json',
                    success: function (_response) {
                        // Handle your response..
                        $("#testDiv").hide();
                        $("#testResponse").fadeIn();
                        $('#site').append(_response.url);
                        $('#statusMessage').empty();
                        $('#statusMessage').append(_response.msg);
                        setTimeout(function(){
                            startTest(_response.id);
                        }, 2000);
                    }
                });
            }

            // To get remaining time in reaching deadline
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

            // To run timer if previous tests are not completed yet
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
                        clearInterval(timeInterval);
                    }
                }
                updateClock();
                var timeInterval = setInterval(updateClock,1000);
            }
        });

        // To check if log is generated or not
        function checkLog(id){
            $.get("{{url('/test/check/')}}/" + id, function (_response) {
                $('#statusMessage').empty();
                $('#statusMessage').append(_response.msg);
                if(_response.msg!='test.fail')
                {
                    // To call stopTest Function after 30 second
                    setTimeout(function(){
                        $('#stopTestDiv').fadeIn();

                        // Listener for stop button
                        $('#stopBtn').click(function(){
                            stopTest(id);
                        });

                        // To call function to check status
                        endTest(id);
                    }, 30000);
                }
            });
        }

        // To start test
        function startTest(id){
            $.get("{{url('/test/start/')}}/" + id, function (_response) {
                $('#statusMessage').empty();
                $('#statusMessage').append('Starting your test');
                setTimeout(function(){
                    checkLog(id);
                }, 2000);
            });
        }

        // To forcibly stop test
        function stopTest(id){
            $.get("{{url('/test/stop/')}}/" + id, function (_response) {
                $('#statusMessage').empty();
                $('#statusMessage').append(_response.msg);
            });
        }

        // To set timer for checking test status
        function endTest(id){
            // To check status of test
            function status() {
                $.get("{{url('/test/end/')}}/" + id, function (_response) {
                    if (_response.msg) {
                    // To stop checking status after test has ended
                        clearInterval(run);
                        $('#statusMessage').empty();
                        $('#statusMessage').append(_response.msg);
                        graph(id);
                    }
                });
            }
            status();
            // To call status after every 10 seconds
            var run = setInterval(function () {
                status()
            }, 10000);
        }

        // To make graph corresponding to the test
        function graph(id){
            $.get("{{url('/test/graph/')}}/"+id,function(_response){
                $('#rickshaw').fadeIn();
                var graph = new Rickshaw.Graph.Ajax({
                    element: document.querySelector("#chart"),
                    dataURL: '/resultJson/'+_response.random_string+'.json',
                    onData: function (data) {
                        return data;
                    },
                    onComplete: function (transport) {
                        var graph = transport.graph;
                        var detail = new Rickshaw.Graph.HoverDetail({graph: graph});
                    },
                    series: [
                        {
                            name: 'test',
                            color: '#ff5000',
                        }
                    ]
                });
            });
        }

    </script>

@endsection
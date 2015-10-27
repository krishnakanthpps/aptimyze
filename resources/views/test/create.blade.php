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
                    {!! Form::submit('Run Test Button', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
        {!! Form::close() !!}

    </div>
    <div id="testResponse" style="display: none">

        <h1>Running Test</h1>
        <hr/>
        <h2 id="tes"></h2>
        <span id='statusMessage' style='color:green'>Completed creating folders</span>
    </div>
@endsection


@section('pagejquery')
    <script type="text/javascript" >
        $(document).ready(function() {
            $("#testForm").on("submit", function (e) {
                e.preventDefault();
//                var bootstrapValidator = $("#testForm").data('bootstrapValidator');
                    var $form = $(this),
                        conditionMessage = "",
                        test_url = $form.find("input[name='url']").val(),
                        url = $form.attr("action");
                    var submitForm = $.post(url, {url: test_url});
                    submitForm.done(function (data) {
//                        $('#testForm').append("<span id='statusMessage' style='color:green'>Completed creating folders" + conditionMessage + "</span>");
                        $("#testDiv").hide();
                        $("#testResponse").fadeIn();
                        $('#tes').append("<span id='statusMessage' style='color:green'>" +data+ "</span>");
                    });
            });
        });
    </script>

@endsection
@section("message")

    @if($errors->has())
        <div class="alert alert-block alert-danger fade in" style="margin:0px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            @foreach($errors->all() as $error)
                <p>{{ $error }}<br></p>
            @endforeach
        </div>
    @endif


    @if(Session::has('status'))
        <div class="alert alert-info fade in" role="alert" style="margin:0px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-check-circle fa-fw fa-lg"></i>
            {{Session::get('status')}}
        </div>
    @endif

    @if(Session::has('success'))
        <div class="alert alert-success fade in" role="alert" style="margin:0px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-check-circle fa-fw fa-lg"></i>
            {{Session::get('success')}}
        </div>
    @endif

    @if(Session::has('failure'))
        <div class="alert alert-danger fade in" role="alert" style="margin:0px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-times-circle fa-fw fa-lg"></i>
            {{Session::get('failure')}}
        </div>
    @endif

@show